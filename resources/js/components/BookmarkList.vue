<template>
  <div class="bookmark-list">
    <draggable v-model="bookmarks" :options="options" handle=".handle" @end="onSort">
      <div class="bookmark-item" v-for="(bookmark, index) in bookmarks" :key="index">
        <i class="fas fa-ellipsis-v handle"></i>
        <a class="delete-btn" @click="onClickDelete(index, bookmark)">
          ×
        </a>
        <div class="text-left">
          <a v-if="bookmark.place.url != null"
             :href="bookmark.place.url"
             target="_blank"
             class="bookmark-item__name"
             rel="noopener">
            {{ bookmark.place.name }}
          </a>
          <span v-else>{{ bookmark.place.name }}</span>
          <a class="review-link" target="_blank" :href="`/camp-places/${bookmark.place.id}`">
            <img src="/img/messenger.svg" alt="口コミ一覧" width="15"/>
            口コミ一覧
          </a>
          <div class="bookmark-item__info">
            <div class="flex mt-10">
              <a v-if="bookmark.place.address != null"
                 :href="`https://www.google.com/maps/search/?api=1&query=${ bookmark.place.address }`"
                 target="_blank" rel="noopener">{{ bookmark.place.address }}</a>
              <a v-if="bookmark.place.tel_number != null"
                 :href="`tel:${bookmark.place.tel_number}`">
                {{ bookmark.place.tel_number }}
              </a>
            </div>
            <div class="mt-10">
              チェックイン/アウト：{{ bookmark.place.check_in }} / {{ bookmark.place.check_out }}
            </div>
          </div>
          <div class="form-content h-auto">
            <div class="form-group">
            <textarea name="memo" class="small" @input="onInput(bookmark)"
                      v-model="bookmark.memo">{{ bookmark.memo }}</textarea>
              <label class="form-label">メモ</label>
            </div>
          </div>
        </div>
      </div>
    </draggable>
  </div>
</template>

<script>
import draggable from 'vuedraggable'
export default {
  components: { draggable },
  props: {
    propBookmarks: {
      type: Array | null,
      default: [],
    },
    token: {
      type: String,
    },
  },
  data () {
    return {
      bookmarks: [],
      options: {
        animation: 200
      },
    }
  },
  mounted () {
    if (this.propBookmarks.length !== 0) {
      this.bookmarks = this.propBookmarks
    }
  },
  methods: {
    /**
     * ブックマークを削除する
     * @param index
     * @param bookmark
     */
    onClickDelete (index, bookmark) {
      let formData = new FormData()
      formData.append('id', bookmark.id)
      let self = this.$data

      fetch(`/api/user-bookmarks/destroy?api_token=${this.token}`, {
        method: 'POST',
        body: formData,
      }).then(function (response) {
        return response.clone().json()
      }).then(function (json) {
        if (json.status === 'ok') {
          self.bookmarks.splice(index, 1)
        }
      }).catch((error) => {
        console.error('Error:', error)
      })
    },
    /**
     * メモを更新する
     * @param bookmark
     */
    onInput (bookmark) {
      let formData = new FormData()
      formData.append('id', bookmark.id)
      formData.append('memo', bookmark.memo)

      fetch(`/api/user-bookmarks/update?api_token=${this.token}`, {
        method: 'POST',
        body: formData,
      }).then(function (response) {
        return response.clone().json()
      }).then(function (json) {
        if (json.status === 'ok') {
          //
        }
      }).catch((error) => {
        console.error('Error:', error)
      })
    },
    onSort (event) {
      let formData = new FormData()
      formData.append('bookmarks', JSON.stringify(this.bookmarks))

      fetch(`/api/user-bookmarks/update-sort?api_token=${this.token}`, {
        method: 'POST',
        body: formData,
      }).then(function (response) {
        return response.clone().json()
      }).then(function (json) {
        if (json.status === 'ok') {
          //
        }
      }).catch((error) => {
        console.error('Error:', error)
      })
    },
  },
}
</script>
