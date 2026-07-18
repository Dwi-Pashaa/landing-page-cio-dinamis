(function () {
    'use strict'

    var defaultOptions = {
        uploadUrl: '/cms/upload-video',
        maxFileSize: 104857600,
        allowedTypes: [
            'video/mp4',
            'video/webm',
            'video/quicktime',
            'video/x-msvideo',
            'video/x-matroska'
        ],
        allowedExtensions: ['.mp4', '.webm', '.mov', '.avi', '.mkv']
    }

    function VideoUploadAdapter(loader, options) {
        this.loader = loader
        this.options = Object.assign({}, defaultOptions, options || {})
        this.xhr = null
    }

    VideoUploadAdapter.prototype.upload = function () {
        var self = this
        return this.loader.file.then(function (file) {
            return self._validateFile(file).then(function () {
                return self._doUpload(file)
            })
        })
    }

    VideoUploadAdapter.prototype.abort = function () {
        if (this.xhr) {
            this.xhr.abort()
        }
    }

    VideoUploadAdapter.prototype._validateFile = function (file) {
        var self = this
        return new Promise(function (resolve, reject) {
            if (file.size > self.options.maxFileSize) {
                reject(
                    'Ukuran file maksimal ' +
                        (self.options.maxFileSize / 1048576).toFixed(0) +
                        ' MB. File ini ' +
                        (file.size / 1048576).toFixed(1) +
                        ' MB.'
                )
                return
            }

            var ext = '.' + file.name.split('.').pop().toLowerCase()
            if (self.options.allowedExtensions.indexOf(ext) === -1) {
                reject(
                    'Tipe file tidak didukung. Gunakan: ' +
                        self.options.allowedExtensions.join(', ').toUpperCase()
                )
                return
            }

            resolve()
        })
    }

    VideoUploadAdapter.prototype._doUpload = function (file) {
        var self = this
        return new Promise(function (resolve, reject) {
            var data = new FormData()
            data.append('upload', file)

            self.xhr = new XMLHttpRequest()

            self.loader.on('abort', function () {
                if (self.xhr) {
                    self.xhr.abort()
                }
                reject('Upload dibatalkan')
            })

            self.xhr.upload.addEventListener('progress', function (evt) {
                if (evt.lengthComputable) {
                    self.loader.uploadTotal = evt.total
                    self.loader.uploaded = evt.loaded
                }
            })

            self.xhr.addEventListener('load', function () {
                if (self.xhr.status >= 200 && self.xhr.status < 300) {
                    try {
                        var response = JSON.parse(self.xhr.responseText)
                        var url = response.url || (response.data ? response.data.url : null)
                        if (url) {
                            resolve({ default: url })
                        } else {
                            reject(response.message || 'Upload gagal')
                        }
                    } catch (e) {
                        reject('Response tidak valid dari server')
                    }
                } else {
                    reject('Upload gagal (HTTP ' + self.xhr.status + ')')
                }
            })

            self.xhr.addEventListener('error', function () {
                reject('Network error')
            })

            self.xhr.addEventListener('abort', function () {
                reject('Upload dibatalkan')
            })

            self.xhr.open('POST', self.options.uploadUrl, true)
            var token = document.querySelector('meta[name="csrf-token"]')
            if (token) {
                self.xhr.setRequestHeader('X-CSRF-TOKEN', token.content)
            }
            self.xhr.send(data)
        })
    }

    window.CKVideoUploadAdapter = VideoUploadAdapter
})()
