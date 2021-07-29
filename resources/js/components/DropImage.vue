<template>
    <div class="file-area" :class="{'hasImg': imgData !== null}">
        <div class="loader-container" v-if="isLoading">
            <img alt="favicon" src="/img/favicon.ico" class="ld ld-bounce"  width="auto" height="auto">
        </div>
      <div class="file-content">
        <div v-if="!uploaded" :class="{'drag': isDrag === 'new'}"
             @dragover.prevent="checkDrag($event, 'new', true)"
             @dragleave.prevent="checkDrag($event, 'new', false)"
             @drop.prevent="onDrop" class="drop-area">
        </div>
        <div class="preview-content" v-if="imgData">
          <img alt="プレビュー画像" :src="imgData" class="preview" width="auto" height="auto">
        </div>
        <div class="buttons">
          <label class="btn file-select-btn">
            編集
            <input type="file" class="drop__input" style="display:none;"
                   v-on:change="onDrop">
          </label>
          <a v-on:click="onDelete" class="btn default-btn delete-btn" :class="{'disabled': imgData === null}" :disabled="imgData === null">削除</a>
        </div>
      </div>

        <br>
        <input type="hidden" :name="name" :value="imgData"/>

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

    .file-content {
      display: flex;
      justify-content: start;
      align-items: center;
      margin-top: 35px;

      .buttons {
        margin-left: auto;
        margin-right: 20px;
        width: 120px;

        a {
          margin-top: 15px;
        }
      }
    }

    img.preview {
        max-width: 100%;
    }

    .file-select-btn {
      color: #1A1A1A;
      background: #fff;
      border: 1px solid #1A1A1A;
    }

    .preview-content, .drop-area {
        position: relative;
        width: 150px;
        height: 150px;

        img {
          object-fit: cover;
        }

        .delete-btn {
          margin-top: 10px;

          &:disabled {
            opacity: 0.5;
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
    }
</style>
