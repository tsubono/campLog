<template>
    <div class="file-area">
        <div class="loader-container" v-if="isLoading">
            <img src="/img/favicon.ico" class="ld ld-bounce">
        </div>
        <div :class="{'drag': isDrag === 'new'}"
             @dragover.prevent="checkDrag($event, 'new', true)"
             @dragleave.prevent="checkDrag($event, 'new', false)"
             @drop.prevent="onDrop" class="drop-area">
            <i aria-hidden="true" class="fa fa-plus"></i>
            <div class="drop">
                <p class="drag-drop-info">ここにファイルをドロップ</p>
                <p>または</p>
                <label class="file-select-btn">
                    ファイルを選択
                    <input type="file" class="drop__input" style="display:none;"
                           v-on:change="onDrop" multiple>
                </label>
            </div>
        </div>
        <br>
        <div class="image-list">
            <div v-for="(imgData, index) in imgDatas" class="image-item">
                <img v-bind:src="imgData" class="preview">
                <input type="hidden" :name="name" :value="imgData"/>
                <a v-on:click="onDelete(index)" class="delete-btn">削除する</a>
            </div>
        </div>
        <div v-if="msg" class="error-txt">
            <span>{{ msg }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DropImage",
        props: ['name', 'images', 'url', 'dir'],
        data() {
            return {
                'host': '',
                'msg': '',
                'imgDatas': [],
                'isDrag': null,
                'isLoading': false,
            }
        },
        created: function () {
            this.host = window.location.host;
            if (this.images) {
                this.imgDatas = JSON.parse(this.images);
            }
        },
        methods: {
            checkDrag(event, key, status) {
                this.isDrag = status ? key : null
            },
            onDrop (event) {
                this.isDrag = null;
                this.isLoading = true;
                this.msg = '';
                let fileList = event.target.files || event.dataTransfer.files;
                let files  = [];
                for(let i = 0; i < fileList.length; i++){
                    files.push(fileList[i]);
                }
                // ファイルチェック
                if (!files.length) {
                    this.msg = 'ファイル形式が不正です。';
                    this.isLoading = false;
                    return false;
                }
                let totalSize = 0;
                files.forEach (function(file) {
                    if (!file.type.match('image.*')) {
                        this.msg = 'ファイル形式が不正です。';
                        this.isLoading = false;
                        return false;
                    }
                    totalSize = totalSize + file.size;
                });
                // ファイルサイズチェック
                if(totalSize > 8000000){
                    this.msg = '一度にアップロードできる画像サイズの容量を超えました。';
                    this.isLoading = false;
                    return false;
                }

                let formData   = new FormData();
                files.forEach (function(file) {
                    formData.append('imgList[]', file);
                });
                formData.append('dir', this.dir);
                let url = 'https://' + this.host + this.url;
                let self = this.$data;

                fetch(url, {
                    method: 'POST',
                    body: formData,
                }).then(function (response) {
                    return response.clone().json();
                }).then(function (json) {
                    if (json.status === 'ok') {
                        self.imgDatas = self.imgDatas.concat(json.paths)
                    }
                    self.isLoading = false;
                }).catch((error) => {
                    console.error('Error:', error);
                    this.isLoading = false;
                });
            },
            onDelete (index) {
                this.imgDatas.splice(index, 1);
            }
        }
    }
</script>

<style lang="scss" scoped>
    .error-txt {
        color: #e88b79;
        text-align: left;
    }
    .drop-area {
        background: lightgray;
        width: 80%;
        height: 200px;
        text-align: center;
        padding: 30px;

        i {
            font-size: 40px;
        }

        &.drag {
            opacity: 0.5;
        }

        .drop {
            color: #5c6066;
            font-size: .9rem;
            padding: 10px;
        }
    }

    img.preview {
        max-width: 300px;
    }

    .file-select-btn {
        cursor: pointer;
        background: #62b882;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 10px;
        font-size: 1rem;
        position: relative;
        top: 20px;
    }

    .image-list {
        display: flex;
        flex-wrap: wrap;

        .image-item {
            margin: 5px;

            img {
                width: 100px;
                height: 100px;
                object-fit: cover;
            }

            .delete-btn {
                cursor: pointer;
                background: #e88b79;
                color: #fff;
                border: none;
                border-radius: 10px;
                padding: 10px;
                font-size: 0.9rem;
                position: relative;
                top: -27px;
            }
        }
    }

    .loader-container {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1;
        height: 100%;
        left: 0;
        background: #FFF;
        opacity: 0.5;
    }

    .loader-container img {
        width: 80px;
        height: 80px;
        position: relative;
        margin: 100px auto;
        top: 30%;
    }

    @media (max-width: 480px) {
        img.preview {
            max-width: 100%;
        }

        .drop-area {
            width: 100%;
        }
    }
</style>
