<template>
    <div class="file-area">
        <div class="loader-container" v-if="isLoading">
            <img src="/img/favicon.ico" class="ld ld-bounce">
        </div>
        <div v-if="!uploaded" :class="{'drag': isDrag === 'new'}"
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
                           v-on:change="onDrop">
                </label>
            </div>
        </div>
        <br>
        <input type="hidden" :name="name" :value="imgData"/>
        <div>
            <img v-if="imgData" :src="imgData" class="preview">
            <a v-if="imgData" v-on:click="onDelete" class="delete-btn">削除する</a>
        </div>
        <div v-if="msg" class="error-txt">
            <span>{{msg}}</span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DropImage",
        props: ['name', 'path', 'url', 'dir'],
        data() {
            return {
                'host': '',
                'msg': '',
                'imgData': null,
                'isDrag': null,
                'uploaded': false,
                'isLoading': false,
            }
        },
        created: function () {
            this.host = window.location.host;
            if (this.path) {
                this.imgData = this.path;
                this.uploaded = true;
            }
        },
        methods: {
            checkDrag(event, key, status) {
                this.isDrag = status ? key : null
            },
            onDrop (event, key = '', image = {}) {
                this.isDrag = null;
                this.isLoading = true;
                document.body.classList.toggle('is-modal')
                this.imgData = null;
                this.msg = '';
                let fileList = event.target.files || event.dataTransfer.files;
                let files  = [];
                for(let i = 0; i < fileList.length; i++){
                    files.push(fileList[i]);
                }
                // ファイルが無い時は処理を中止
                if (!files.length || !files[0].type.match('image.*')) {
                    this.msg = 'ファイル形式が不正です。';
                    this.isLoading = false;
                    document.body.classList.toggle('is-modal')
                    return false;
                }
                // ファイルサイズチェック
                if(files[0].size > 8000000){
                    this.msg = '一度にアップロードできる画像サイズの容量を超えました。';
                    this.isLoading = false;
                    document.body.classList.toggle('is-modal')
                    return false;
                }

                // 1ファイルのみ送る
                let file = files.length > 0 ? files[0] : [];
                let formData   = new FormData();
                formData.append('img', file);
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
                        self.imgData = json.path;
                        self.uploaded = true;
                    }
                    self.isLoading = false;
                    document.body.classList.toggle('is-modal')
                }).catch((error) => {
                    console.error('Error:', error);
                    this.isLoading = false;
                    document.body.classList.toggle('is-modal')
                });
            },
            onDelete () {
                this.imgData = null;
                this.uploaded = false;
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
        background: #799bd1;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 10px;
        font-size: 1rem;
        position: relative;
        top: 20px;
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
