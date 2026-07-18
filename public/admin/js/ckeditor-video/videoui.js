(function () {
    'use strict'

    function VideoUI(editor, options) {
        this.editor = editor
        this.options = Object.assign({}, options || {})
        this._dialog = null
    }

    VideoUI.prototype.init = function () {
        this._addToolbarButton()
    }

    VideoUI.prototype._addToolbarButton = function () {
        var self = this
        var editor = this.editor

        try {
            var t = editor.t
        } catch (e) {
            var t = function (s) {
                return s
            }
        }

        editor.ui.componentFactory.add('video', function (locale) {
            var ButtonView

            try {
                ButtonView = CKEditor5.ui.ButtonView
            } catch (e) {
                try {
                    ButtonView = CKEditor5.ButtonView
                } catch (e2) {
                    console.error('VideoUI: ButtonView not available', e2)
                    return null
                }
            }

            var button = new ButtonView(locale)

            button.set({
                label: 'Video',
                icon: self._getIcon(),
                tooltip: true,
                withText: false
            })

            button.on('execute', function () {
                self._openDialog()
            })

            return button
        })
    }

    VideoUI.prototype._getIcon = function () {
        return (
            '<svg viewBox="0 0 20 20" width="16" height="16" xmlns="http://www.w3.org/2000/svg">' +
            '<path d="M3 5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm2 0v10h10V5H5zm2 2l6 3-6 3V7z" fill="currentColor"/>' +
            '</svg>'
        )
    }

    VideoUI.prototype._openDialog = function () {
        var self = this
        var editor = this.editor

        if (this._dialog) {
            this._dialog.destroy()
        }

        this._dialog = new window.CKVideoDialog(editor, function (url) {
            self._dialog = null
        })

        this._dialog.open()
    }

    VideoUI.prototype.destroy = function () {
        if (this._dialog) {
            this._dialog.destroy()
            this._dialog = null
        }
    }

    window.CKVideoUI = VideoUI
})()
