(function () {
    'use strict'

    var ALLOWED_VIDEO_EXTS = ['.mp4', '.webm', '.mov', '.avi', '.mkv']
    var MAX_FILE_SIZE = 104857600
    var YOUTUBE_REGEX = /(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/
    var URL_VIDEO_REGEX = /\.(mp4|webm|mov|avi|mkv)(\?.*)?$/i

    function VideoDialog(editor, onInsert) {
        this.editor = editor
        this.onInsert = onInsert
        this._modal = null
        this._activeTab = 'upload'
        this._selectedFile = null
        this._urlValue = null
        this._youtubeEmbedUrl = null
    }

    VideoDialog.prototype.open = function () {
        if (this._modal) return
        this._build()
        this._showTab('upload')
        document.body.appendChild(this._modal)
    }

    VideoDialog.prototype.close = function () {
        if (this._modal && this._modal.parentNode) {
            this._modal.parentNode.removeChild(this._modal)
            this._modal = null
        }
        this._selectedFile = null
        this._urlValue = null
        this._youtubeEmbedUrl = null
    }

    VideoDialog.prototype._build = function () {
        var self = this

        this._modal = document.createElement('div')
        this._modal.className = 'ck-video-overlay'
        this._modal.setAttribute('role', 'dialog')
        this._modal.setAttribute('aria-label', 'Insert Video')

        this._modal.innerHTML =
            '<div class="ck-video-modal">' +
            '  <div class="ck-video-modal-header">' +
            '    <h3 class="ck-video-modal-title">Video</h3>' +
            '    <button class="ck-video-modal-close" data-action="close" aria-label="Close">&times;</button>' +
            '  </div>' +
            '  <div class="ck-video-modal-tabs" role="tablist">' +
            '    <button class="ck-video-tab is-active" data-tab="upload" role="tab" aria-selected="true">Upload Video</button>' +
            '    <button class="ck-video-tab" data-tab="url" role="tab" aria-selected="false">URL Video</button>' +
            '    <button class="ck-video-tab" data-tab="youtube" role="tab" aria-selected="false">YouTube</button>' +
            '  </div>' +
            '  <div class="ck-video-modal-body">' +
            // TAB: Upload
            '    <div class="ck-video-panel" data-panel="upload">' +
            '      <div class="ck-video-dropzone" id="ckVideoDropzone">' +
            '        <div class="ck-video-dropzone-icon">' +
            '          <svg viewBox="0 0 40 40" width="40" height="40" xmlns="http://www.w3.org/2000/svg">' +
            '            <path d="M20 5a15 15 0 110 30 15 15 0 010-30zm0 2a13 13 0 100 26 13 13 0 000-26zm-1 7v7h-7v2h7v7h2v-7h7v-2h-7v-7h-2z" fill="currentColor" opacity="0.6"/>' +
            '          </svg>' +
            '        </div>' +
            '        <div class="ck-video-dropzone-text">Klik atau tarik file video ke sini</div>' +
            '        <div class="ck-video-dropzone-hint">MP4, WebM, MOV, AVI, MKV &mdash; Maks 100 MB</div>' +
            '        <input type="file" accept="video/mp4,video/webm,video/quicktime,video/x-msvideo,video/x-matroska" id="ckVideoFileInput" style="display:none">' +
            '      </div>' +
            '      <div class="ck-video-progress" id="ckVideoProgress" style="display:none">' +
            '        <div class="ck-video-progress-bar">' +
            '          <div class="ck-video-progress-fill" id="ckVideoProgressFill"></div>' +
            '        </div>' +
            '        <div class="ck-video-progress-info">' +
            '          <span class="ck-video-progress-label" id="ckVideoProgressLabel">Mengupload...</span>' +
            '          <span class="ck-video-progress-pct" id="ckVideoProgressPct">0%</span>' +
            '        </div>' +
            '        <button class="ck-video-progress-cancel" id="ckVideoCancelBtn">Cancel</button>' +
            '      </div>' +
            '      <div class="ck-video-preview" id="ckVideoFilePreview" style="display:none"></div>' +
            '    </div>' +
            // TAB: URL
            '    <div class="ck-video-panel" data-panel="url" style="display:none">' +
            '      <label class="ck-video-label">Masukkan URL video (MP4, WebM, MOV, AVI, MKV)</label>' +
            '      <input type="text" class="ck-video-input" id="ckVideoUrlInput" placeholder="https://domain.com/video.mp4" autocomplete="off">' +
            '      <div class="ck-video-feedback" id="ckVideoUrlFeedback" style="display:none"></div>' +
            '      <div class="ck-video-preview" id="ckVideoUrlPreview" style="display:none"></div>' +
            '    </div>' +
            // TAB: YouTube
            '    <div class="ck-video-panel" data-panel="youtube" style="display:none">' +
            '      <label class="ck-video-label">Masukkan URL YouTube</label>' +
            '      <input type="text" class="ck-video-input" id="ckVideoYtInput" placeholder="https://www.youtube.com/watch?v=..." autocomplete="off">' +
            '      <div class="ck-video-feedback" id="ckVideoYtFeedback" style="display:none"></div>' +
            '      <div class="ck-video-preview" id="ckVideoYtPreview" style="display:none"></div>' +
            '    </div>' +
            '  </div>' +
            '  <div class="ck-video-modal-footer">' +
            '    <button class="ck-video-btn" data-action="close">Batal</button>' +
            '    <button class="ck-video-btn ck-video-btn-primary" id="ckVideoInsertBtn" disabled>Insert</button>' +
            '  </div>' +
            '</div>'

        this._bindEvents()
    }

    VideoDialog.prototype._bindEvents = function () {
        var self = this
        var modal = this._modal

        modal.querySelectorAll('[data-action="close"]').forEach(function (el) {
            el.addEventListener('click', function () {
                self.close()
            })
        })

        modal.addEventListener('click', function (e) {
            if (e.target === modal) self.close()
        })

        document.addEventListener('keydown', this._escHandler = function (e) {
            if (e.key === 'Escape') self.close()
        })

        modal.querySelectorAll('.ck-video-tab').forEach(function (tab) {
            tab.addEventListener('click', function () {
                self._showTab(this.dataset.tab)
            })
        })

        var dropzone = modal.querySelector('#ckVideoDropzone')
        var fileInput = modal.querySelector('#ckVideoFileInput')

        dropzone.addEventListener('click', function () {
            fileInput.click()
        })

        dropzone.addEventListener('dragover', function (e) {
            e.preventDefault()
            dropzone.classList.add('is-dragover')
        })

        dropzone.addEventListener('dragleave', function () {
            dropzone.classList.remove('is-dragover')
        })

        dropzone.addEventListener('drop', function (e) {
            e.preventDefault()
            dropzone.classList.remove('is-dragover')
            if (e.dataTransfer.files.length > 0) {
                self._onFileSelected(e.dataTransfer.files[0])
            }
        })

        fileInput.addEventListener('change', function () {
            if (this.files.length > 0) {
                self._onFileSelected(this.files[0])
            }
        })

        var urlInput = modal.querySelector('#ckVideoUrlInput')
        urlInput.addEventListener('input', function () {
            self._validateUrl(this.value)
        })

        var ytInput = modal.querySelector('#ckVideoYtInput')
        ytInput.addEventListener('input', function () {
            self._validateYoutube(this.value)
        })

        modal.querySelector('#ckVideoInsertBtn').addEventListener('click', function () {
            self._handleInsert()
        })

        modal.querySelector('#ckVideoCancelBtn').addEventListener('click', function () {
            self._cancelUpload()
        })
    }

    VideoDialog.prototype._showTab = function (tabName) {
        this._activeTab = tabName

        this._modal.querySelectorAll('.ck-video-tab').forEach(function (tab) {
            var isActive = tab.dataset.tab === tabName
            tab.classList.toggle('is-active', isActive)
            tab.setAttribute('aria-selected', String(isActive))
        })

        this._modal.querySelectorAll('.ck-video-panel').forEach(function (panel) {
            panel.style.display = panel.dataset.panel === tabName ? 'block' : 'none'
        })

        this._updateInsertButton()
    }

    VideoDialog.prototype._onFileSelected = function (file) {
        var ext = '.' + file.name.split('.').pop().toLowerCase()

        if (ALLOWED_VIDEO_EXTS.indexOf(ext) === -1) {
            this._notify('Tipe file tidak didukung. Gunakan: MP4, WebM, MOV, AVI, atau MKV.', 'error')
            return
        }

        if (file.size > MAX_FILE_SIZE) {
            this._notify(
                'Ukuran file maksimal 100 MB. File ini ' +
                    (file.size / 1048576).toFixed(1) +
                    ' MB.',
                'error'
            )
            return
        }

        this._selectedFile = file
        this._showFilePreview(file)
        this._updateInsertButton()
    }

    VideoDialog.prototype._showFilePreview = function (file) {
        var container = this._modal.querySelector('#ckVideoFilePreview')
        var url = URL.createObjectURL(file)
        container.innerHTML =
            '<video controls preload="metadata" width="100%" style="max-height:200px;display:block">' +
            '<source src="' + url + '">' +
            '</video>'
        container.style.display = 'block'
    }

    VideoDialog.prototype._validateUrl = function (value) {
        var feedback = this._modal.querySelector('#ckVideoUrlFeedback')
        var preview = this._modal.querySelector('#ckVideoUrlPreview')

        if (!value.trim()) {
            feedback.style.display = 'none'
            preview.style.display = 'none'
            this._urlValue = null
            this._updateInsertButton()
            return
        }

        if (!value.match(/^https?:\/\//)) {
            feedback.textContent = 'URL harus diawali http:// atau https://'
            feedback.className = 'ck-video-feedback is-error'
            feedback.style.display = 'block'
            preview.style.display = 'none'
            this._urlValue = null
            this._updateInsertButton()
            return
        }

        if (!URL_VIDEO_REGEX.test(value)) {
            feedback.textContent =
                'URL harus memiliki ekstensi video: .mp4, .webm, .mov, .avi, atau .mkv'
            feedback.className = 'ck-video-feedback is-error'
            feedback.style.display = 'block'
            preview.style.display = 'none'
            this._urlValue = null
            this._updateInsertButton()
            return
        }

        feedback.style.display = 'none'
        preview.style.display = 'block'
        preview.innerHTML =
            '<video controls preload="metadata" width="100%" style="max-height:200px;display:block">' +
            '<source src="' + value.replace(/"/g, '&quot;') + '">' +
            '</video>'
        this._urlValue = value
        this._updateInsertButton()
    }

    VideoDialog.prototype._validateYoutube = function (value) {
        var feedback = this._modal.querySelector('#ckVideoYtFeedback')
        var preview = this._modal.querySelector('#ckVideoYtPreview')

        if (!value.trim()) {
            feedback.style.display = 'none'
            preview.style.display = 'none'
            this._youtubeEmbedUrl = null
            this._updateInsertButton()
            return
        }

        var match = value.match(YOUTUBE_REGEX)

        if (!match) {
            feedback.textContent =
                'URL YouTube tidak valid. Contoh: https://www.youtube.com/watch?v=VIDEO_ID'
            feedback.className = 'ck-video-feedback is-error'
            feedback.style.display = 'block'
            preview.style.display = 'none'
            this._youtubeEmbedUrl = null
            this._updateInsertButton()
            return
        }

        var embedUrl = 'https://www.youtube.com/embed/' + match[1]
        feedback.style.display = 'none'
        preview.style.display = 'block'
        preview.innerHTML =
            '<iframe src="' +
            embedUrl +
            '" allowfullscreen width="100%" style="aspect-ratio:16/9;border:0;border-radius:6px"></iframe>'
        this._youtubeEmbedUrl = embedUrl
        this._updateInsertButton()
    }

    VideoDialog.prototype._updateInsertButton = function () {
        var btn = this._modal.querySelector('#ckVideoInsertBtn')
        var enabled = false

        if (this._activeTab === 'upload') {
            enabled = !!this._selectedFile
        } else if (this._activeTab === 'url') {
            enabled = !!this._urlValue
        } else if (this._activeTab === 'youtube') {
            enabled = !!this._youtubeEmbedUrl
        }

        btn.disabled = !enabled
    }

    VideoDialog.prototype._handleInsert = function () {
        var self = this

        if (this._activeTab === 'upload' && this._selectedFile) {
            this._uploadAndInsert(this._selectedFile)
        } else if (this._activeTab === 'url' && this._urlValue) {
            this._insertVideoUrl(this._urlValue)
            this.close()
        } else if (this._activeTab === 'youtube' && this._youtubeEmbedUrl) {
            this._insertYoutube(this._youtubeEmbedUrl)
            this.close()
        }
    }

    VideoDialog.prototype._uploadAndInsert = function (file) {
        var self = this
        var progress = this._modal.querySelector('#ckVideoProgress')
        var fill = this._modal.querySelector('#ckVideoProgressFill')
        var pctLabel = this._modal.querySelector('#ckVideoProgressPct')
        var dropzone = this._modal.querySelector('#ckVideoDropzone')
        var insertBtn = this._modal.querySelector('#ckVideoInsertBtn')

        progress.style.display = 'block'
        dropzone.style.display = 'none'
        insertBtn.disabled = true

        var data = new FormData()
        data.append('upload', file)

        var xhr = new XMLHttpRequest()

        xhr.upload.addEventListener('progress', function (evt) {
            if (evt.lengthComputable) {
                var pct = Math.round((evt.loaded / evt.total) * 100)
                fill.style.width = pct + '%'
                pctLabel.textContent = pct + '%'
            }
        })

        xhr.addEventListener('load', function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                try {
                    var response = JSON.parse(xhr.responseText)
                    var url = response.url || (response.data ? response.data.url : null)
                    if (url) {
                        self._insertVideoUrl(url)
                        self.close()
                    } else {
                        self._uploadError(response.message || 'Upload gagal')
                    }
                } catch (e) {
                    self._uploadError('Response tidak valid dari server')
                }
            } else {
                self._uploadError('Upload gagal (HTTP ' + xhr.status + ')')
            }
        })

        xhr.addEventListener('error', function () {
            self._uploadError('Network error')
        })

        xhr.addEventListener('abort', function () {
            self._uploadError(null)
        })

        var cancelBtn = this._modal.querySelector('#ckVideoCancelBtn')
        cancelBtn.onclick = function () {
            xhr.abort()
            self._resetUploadUI()
        }

        xhr.open('POST', '/cms/upload-video', true)
        var token = document.querySelector('meta[name="csrf-token"]')
        if (token) {
            xhr.setRequestHeader('X-CSRF-TOKEN', token.content)
        }
        xhr.send(data)
    }

    VideoDialog.prototype._resetUploadUI = function () {
        var progress = this._modal.querySelector('#ckVideoProgress')
        var dropzone = this._modal.querySelector('#ckVideoDropzone')
        var insertBtn = this._modal.querySelector('#ckVideoInsertBtn')
        var preview = this._modal.querySelector('#ckVideoFilePreview')
        var fileInput = this._modal.querySelector('#ckVideoFileInput')

        progress.style.display = 'none'
        dropzone.style.display = 'block'
        insertBtn.disabled = true
        preview.style.display = 'none'
        preview.innerHTML = ''
        fileInput.value = ''
        this._selectedFile = null
    }

    VideoDialog.prototype._uploadError = function (message) {
        this._resetUploadUI()
        if (message) {
            this._notify(message, 'error')
        }
    }

    VideoDialog.prototype._cancelUpload = function () {
        this._resetUploadUI()
    }

    VideoDialog.prototype._insertVideoUrl = function (url) {
        var editor = this.editor

        editor.model.change(function (writer) {
            var viewFragment = editor.data.processor.toView(
                '<figure class="video">' +
                '<video controls preload="metadata" width="100%">' +
                '<source src="' + url.replace(/"/g, '&quot;') + '">' +
                '</video>' +
                '</figure>'
            )
            var modelFragment = editor.data.toModel(viewFragment)
            editor.model.insertContent(modelFragment, editor.model.document.selection)
        })

        if (typeof this.onInsert === 'function') {
            this.onInsert(url)
        }
    }

    VideoDialog.prototype._insertYoutube = function (embedUrl) {
        var editor = this.editor

        editor.model.change(function (writer) {
            var viewFragment = editor.data.processor.toView(
                '<figure class="media">' +
                '<iframe src="' + embedUrl.replace(/"/g, '&quot;') + '" allowfullscreen></iframe>' +
                '</figure>'
            )
            var modelFragment = editor.data.toModel(viewFragment)
            editor.model.insertContent(modelFragment, editor.model.document.selection)
        })

        if (typeof this.onInsert === 'function') {
            this.onInsert(embedUrl)
        }
    }

    VideoDialog.prototype._notify = function (message, type) {
        try {
            var notifications = this.editor.plugins.get('Notifications')
            if (notifications) {
                if (type === 'error') {
                    notifications.showWarning(message)
                } else {
                    notifications.showSuccess(message)
                }
                return
            }
        } catch (e) {}

        try {
            var editor = this.editor
            editor.model.change(function (writer) {
                var el = writer.createText('')
            })
        } catch (e) {}

        alert(message)
    }

    VideoDialog.prototype.destroy = function () {
        if (this._escHandler) {
            document.removeEventListener('keydown', this._escHandler)
        }
        this.close()
    }

    window.CKVideoDialog = VideoDialog
})()
