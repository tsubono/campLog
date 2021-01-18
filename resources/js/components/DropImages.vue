<template>
    <div class="file-area">
        <div :class="[{'drag': isDrag == 'new'}]"
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
        <div class="image-list">
            <div v-for="(imgData, index) in imgDatas" class="image-item">
                <img v-bind:src="imgData" class="preview">
                <input type="hidden" :name="name" :value="imgData"/>
                <a v-on:click="onDelete(index)" class="delete-btn">削除する</a>
            </div>
        </div>
        <div v-if="msg">
            <span class="text-danger">{{ msg }}</span>
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
                this.msg = '';
                let fileList = event.target.files || event.dataTransfer.files;
                let files  = [];
                for(let i = 0; i < fileList.length; i++){
                    files.push(fileList[i]);
                }
                // ファイルチェック
                if (!files.length) {
                    this.msg = 'ファイル形式が不正です。';
                    return false;
                }
                files.forEach (function(file) {
                    if (!file.type.match('image.*')) {
                        this.msg = 'ファイル形式が不正です。';
                        return false;
                    }
                });

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
                });
            },
            onDelete (index) {
                this.imgDatas.splice(index, 1);
            }
        }
    }
</script>

<style lang="scss" scoped>
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

    @media (max-width: 480px) {
        img.preview {
            max-width: 100%;
        }

        .drop-area {
            width: 100%;
        }
    }
</style>
