<template>
  <div class="file-area">
    <div class="loader-container" v-if="isLoading">
      <img alt="favicon" src="/img/logo_favi.ico" class="ld ld-bounce" width="auto" height="auto">
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
          画像を選択
          <input type="file" class="drop__input" style="display:none;"
                 v-on:change="onDrop" multiple>
        </label>
      </div>
    </div>
    <br>
    <p class="description">
      <i class="fas fa-ellipsis-v handle"></i> ボタンを動かすと順番の並べ替えができます
    </p>
    <draggable v-model="imgDatas" :options="options" handle=".handle" class="image-list">
      <div v-for="(imgData, index) in imgDatas" class="image-item">
        <div class="image-item__img">
          <i class="fas fa-ellipsis-v handle"></i>
          <img alt="プレビュー画像"
               :src="imgData.replace('camp-schedule/', 'camp-schedule/resized-') + '?' + Math.random()"
               :style="styles[index]"
               :class="`preview js-modal-image js-image-${index}`"
               width="auto"
               height="auto"
               :data-id="index"
          />
        </div>
        <input type="hidden" :name="name" :value="imgData"/>
        <input type="hidden" name="rotates[]" :value="imgRotates[index]"/>
        <a v-on:click="onDelete(index)" class="delete-btn">×</a>
        <a v-on:click="onRotate(index)" class="rotate-btn">
          <img src="/img/icon_rotate.svg" alt="回転"/>
        </a>
        <p class="img-description">メイン画像</p>
      </div>
    </draggable>
    <div v-if="msg" class="error-txt">
      <span>{{ msg }}</span>
    </div>
    <div class="image-modal-bg">
      <div class="image-content"></div>
      <div class="image-modal-close">×</div>
    </div>
  </div>
</template>

<script>
import draggable from 'vuedraggable'
export default {
  name: 'DropImage',
  components: { draggable },
  props: ['name', 'images', 'url', 'dir'],
  data () {
    return {
      host: '',
      msg: '',
      imgDatas: [],
      isDrag: null,
      isLoading: false,
      imgRotates: [],
      styles: [],
      options: {
        animation: 200
      },
    }
  },
  created: function () {
    this.host = window.location.host
    if (this.images) {
      this.imgDatas = JSON.parse(this.images)
      for (let i = 0; i < this.imgDatas.length; i++) {
        this.imgRotates[i] = 0
      }
    }
  },
  methods: {
    checkDrag (event, key, status) {
      this.isDrag = status ? key : null
    },
    onDrop (event) {
      this.isDrag = null
      this.isLoading = true
      document.body.classList.toggle('is-modal')
      this.msg = ''
      let fileList = event.target.files || event.dataTransfer.files
      let files = []
      for (let i = 0; i < fileList.length; i++) {
        files.push(fileList[i])
      }
      // ファイルチェック
      if (!files.length) {
        this.msg = 'ファイル形式が不正です。'
        this.isLoading = false
        document.body.classList.toggle('is-modal')
        return false
      }
      let totalSize = 0
      files.forEach(function (file) {
        if (!file.type.match('image.*')) {
          this.msg = 'ファイル形式が不正です。'
          this.isLoading = false
          document.body.classList.toggle('is-modal')
          return false
        }
        totalSize = totalSize + file.size
      })
      // ファイルサイズチェック
      if (totalSize > 8000000) {
        this.msg = '一度にアップロードできる画像サイズの容量を超えました。'
        this.isLoading = false
        document.body.classList.toggle('is-modal')
        return false
      }

      let formData = new FormData()
      files.forEach(function (file) {
        formData.append('imgList[]', file)
      })
      formData.append('dir', this.dir)
      let url = 'https://' + this.host + this.url
      let self = this.$data

      fetch(url, {
        method: 'POST',
        body: formData,
      }).then(function (response) {
        return response.clone().json()
      }).then(function (json) {
        if (json.status === 'ok') {
          self.imgDatas = self.imgDatas.concat(json.paths)
        }
        self.isLoading = false
        document.body.classList.toggle('is-modal')
      }).catch((error) => {
        console.error('Error:', error)
        this.isLoading = false
        document.body.classList.toggle('is-modal')
      })
    },
    onDelete (index) {
      this.imgDatas.splice(index, 1)
    },
    onRotate (index) {
      let rotate = 90
      if (this.imgRotates[index] !== undefined) {
        rotate += this.imgRotates[index]
      }
      this.$set(this.imgRotates, index, rotate)
      this.$set(this.styles, index, { transform: `rotate(${rotate}deg)` })
    },
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

.description {
  color: #5c6066;
  font-size: .8em;
  text-align: left;
  margin: 0 10px 5px 10px;
  display: flex;
  align-items: center;

  img {
    margin-right: 5px;
  }
}

.handle {
  cursor: grab;
  padding: 15px;
}

.image-list {
  display: flex;
  flex-wrap: wrap;

  .image-item {
    margin: 10px 10px;
    position: relative;
    padding: 5px;

    .img-description {
      display: none;
    }

    &:first-child {
      border: 2px solid #62b882;

      .img-description {
        display: block;
        font-size: .7em;
        color: #62b882;
        padding-top: 2px;
      }
    }

    &__img {
      display: flex;

      .handle {
        padding: 10px;
      }
    }

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
      padding: 10px;
      font-size: 0.9rem;
      position: absolute;
      top: -10px;
      right: -20px;
      font-weight: bold;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      z-index: 10;

      @media (max-width: 480px) {
        padding: 5px;
        width: 30px;
        height: 30px;
        right: -8px;
      }
    }

    .rotate-btn {
      cursor: pointer;
      background: #5c6066;
      color: #fff;
      font-size: .8rem;
      display: flex;
      justify-content: center;
      text-align: center;
      margin-top: 5px;
      width: 100px;
      margin-left: auto;

      img {
        width: 30px;
        height: 30px;
      }
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

  .preview-content {
    width: 250px;
  }
}
</style>
