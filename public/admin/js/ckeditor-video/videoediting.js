(function () {
    'use strict'

    var DEFAULT_OPTIONS = {
        uploadUrl: '/cms/upload-video',
        maxFileSize: 104857600,
        allowedTypes: [
            'video/mp4',
            'video/webm',
            'video/quicktime',
            'video/x-msvideo',
            'video/x-matroska'
        ]
    }

    function VideoEditing(editor, options) {
        this.editor = editor
        this.options = Object.assign({}, DEFAULT_OPTIONS, options || {})
        this._uploadAdapterFactory = null
    }

    VideoEditing.prototype.init = function () {
        var self = this
        var editor = this.editor

        this._defineSchema()
        this._defineConverters()
        this._setupClipboardIntegration()
    }

    VideoEditing.prototype._defineSchema = function () {
        var editor = this.editor

        editor.model.schema.register('video', {
            inheritAllFrom: '$block',
            allowAttributes: ['controls', 'preload', 'width', 'src']
        })

        editor.model.schema.register('videoSource', {
            allowIn: 'video',
            isInline: true,
            allowAttributes: ['src', 'type']
        })

        editor.model.schema.extend('$clipboardHolder', {
            allowIn: ['video', 'videoSource']
        })
    }

    VideoEditing.prototype._defineConverters = function () {
        var editor = this.editor

        editor.conversion.for('downcast').elementToElement({
            model: 'video',
            view: function (modelElement, writer) {
                var container = writer.createContainerElement('figure', { class: 'video' })
                var video = writer.createContainerElement('video', {
                    controls: 'controls',
                    preload: 'metadata',
                    width: '100%'
                })
                writer.insert(writer.createPositionAt(video, 0), video)
                writer.insert(writer.createPositionAt(container, 0), video)
                return container
            }
        })

        editor.conversion.for('upcast').elementToElement({
            view: {
                name: 'figure',
                classes: 'video'
            },
            model: function (viewElement, writer) {
                return writer.createElement('video')
            }
        })

        editor.conversion.for('upcast').elementToElement({
            view: {
                name: 'video'
            },
            model: function (viewElement, writer) {
                return writer.createElement('video')
            }
        })
    }

    VideoEditing.prototype._setupClipboardIntegration = function () {
        var self = this
        var editor = this.editor

        try {
            var clipboard = editor.plugins.get('ClipboardPipeline')

            clipboard.on('inputTransformation', function (evt, data) {
                var content = data.dataTransfer.getData('text/plain')
                if (!content) return

                content = content.trim()

                var videoUrl = self._parseVideoUrl(content)
                if (videoUrl) {
                    evt.stop()

                    var html =
                        '<figure class="video">' +
                        '<video controls preload="metadata" width="100%">' +
                        '<source src="' + videoUrl.replace(/"/g, '&quot;') + '">' +
                        '</video>' +
                        '</figure>'

                    editor.model.change(function (writer) {
                        var viewFragment = editor.data.processor.toView(html)
                        var modelFragment = editor.data.toModel(viewFragment)
                        editor.model.insertContent(
                            modelFragment,
                            editor.model.document.selection
                        )
                    })

                    data.preventDefault()
                }
            })
        } catch (e) {
            console.warn('VideoEditing: ClipboardPipeline plugin not found', e)
        }
    }

    VideoEditing.prototype._parseVideoUrl = function (text) {
        if (!text) return null

        text = text.trim()

        var urlMatch = text.match(
            /^(https?:\/\/[^\s<]+\.(mp4|webm|mov|avi|mkv)(\?[^\s<]*)?)$/i
        )
        if (urlMatch) {
            return urlMatch[0]
        }

        return null
    }

    VideoEditing.prototype.destroy = function () {
        this._uploadAdapterFactory = null
    }

    window.CKVideoEditing = VideoEditing
})()
