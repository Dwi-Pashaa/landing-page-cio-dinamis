(function () {
    'use strict'

    var defaultConfig = {
        videoUpload: {
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
    }

    function CKVideoPlugin(editor) {
        this.editor = editor
        this._editing = null
        this._ui = null
        this._config = null
    }

    CKVideoPlugin.requires = []
    CKVideoPlugin.pluginName = 'CKVideo'

    CKVideoPlugin.prototype.init = function () {
        var config = this.editor.config
        var videoConfig = config.get('videoUpload') || defaultConfig.videoUpload

        var options = {
            uploadUrl: videoConfig.uploadUrl || defaultConfig.videoUpload.uploadUrl,
            maxFileSize: videoConfig.maxFileSize || defaultConfig.videoUpload.maxFileSize,
            allowedTypes: videoConfig.allowedTypes || defaultConfig.videoUpload.allowedTypes
        }

        this._editing = new window.CKVideoEditing(this.editor, options)
        this._editing.init()

        this._ui = new window.CKVideoUI(this.editor, options)
        this._ui.init()
    }

    CKVideoPlugin.prototype.destroy = function () {
        if (this._ui) {
            this._ui.destroy()
            this._ui = null
        }
        if (this._editing) {
            this._editing.destroy()
            this._editing = null
        }
    }

    window.CKVideoPlugin = CKVideoPlugin
})()
