<template>
  <div class="icon-area">
    <img :src="imgData ? imgData : '/img/url.png'" class="icon">
    <input
        type="file"
        class="drop__input"
        style="display:none;"
        accept="image/jpeg, image/jpg, image/png"
        ref="input"
        @change="onChangeFile"
    />
    <a v-if="!imgData" class="edit-btn" @click="onClickFileEdit()">
      編集
    </a>
    <a v-else-if="canEdit" @click="onDelete()" class="round-btn delete-btn">×</a>
    <input type="hidden" :name="name" :value="imgData"/>
  </div>
</template>

<script>
export default {
  name: 'DropImage',
  props: ['name', 'path', 'url', 'dir', 'canEdit'],
  data () {
    return {
      'host': '',
      'msg': '',
      'imgData': null,
    }
  },
  created: function () {
    this.host = window.location.host
    if (this.path) {
      this.imgData = this.path
    }
  },
  watch: {
    path: function (value) {
      this.imgData = value
    }
  },
  methods: {
    onClickFileEdit () {
      this.$refs.input.click()
    },
    onChangeFile (event) {
      this.imgData = null
      this.msg = ''
      let fileList = event.target.files || event.dataTransfer.files
      let files = []
      for (let i = 0; i < fileList.length; i++) {
        files.push(fileList[i])
      }
      // ファイルが無い時は処理を中止
      if (!files.length || !files[0].type.match('image.*')) {
        this.msg = 'ファイル形式が不正です。'
        return false
      }
      // ファイルサイズチェック
      if (files[0].size > 8000000) {
        this.msg = '一度にアップロードできる画像サイズの容量を超えました。'
        this.isLoading = false
        return false
      }

      // 1ファイルのみ送る
      let file = files.length > 0 ? files[0] : []
      let formData = new FormData()
      formData.append('img', file)
      formData.append('dir', this.dir)
      let url = '//' + this.host + this.url
      let self = this.$data

      fetch(url, {
        method: 'POST',
        body: formData,
      }).then(function (response) {
        return response.clone().json()
      }).then(function (json) {
        if (json.status === 'ok') {
          self.imgData = json.path
        }
      }).catch((error) => {
        console.error('Error:', error)
      })
    },
    onDelete () {
      this.imgData = null
    }
  }
}
</script>

<style lang="scss" scoped>
.error-txt {
  color: #e88b79;
  text-align: left;
}

.icon-area {
  position: relative;

  .icon {
    width: 40px;
    height: 40px;
  }
}

.round-btn {
  cursor: pointer;
  border-radius: 50%;
  width: 20px;
  height: 20px;
  padding: 2px 6px;
  position: relative;
}

.delete-btn {
  background: #e88b79;
  color: #fff;
  right: 12px;
  top: 5px;
}

.edit-btn {
  background: #E8E8E8;
  color: #666666;
  text-decoration: none;
  padding: 5px;
  border: none;
  cursor: pointer;
  outline: none;
  border-radius: 28px;
  display: block;
  margin: 5px auto 0;
  font-size: .7em;
  width: 44px;

  @media (max-width: 480px) {
    font-size: .6em;
    width: 40px;
  }
}
</style>
