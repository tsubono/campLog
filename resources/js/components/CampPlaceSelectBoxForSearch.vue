<template>
  <div ref="wrapper" class="search-wrapper row">
    <input
        ref="textBox"
        type="text"
        :value="inputName"
        :class="`${isShowList ? 'focus' : ''}`"
        readonly="readonly"
        @click="textBoxClicked()"
        id="camp_place_name"
        name="camp_place_name"
    >
    <label class="form-label" for="camp_place_name">キャンプ場 口コミ検索</label>
    <input type="hidden" name="camp_place_id" :value="inputId"/>
    <div class="search-wrapper__list" v-show="isShowList">
      <div class="filter-input">
        <input
            ref="filterTextBox"
            type="text"
            class="filter-text"
            placeholder="Filter..."
            v-model="filterString"
        >
      </div>
      <ul>
        <li
            class="search-wrapper__item"
            v-if="filterString.length < 1"
            :value="null"
            @click.stop.prevent="itemClicked(null)"
        >
          この上部に入力してください。<br>
          1文字以上入力いただくと、候補がでますので、その中から選択してください。
        </li>
        <li
            class="search-wrapper__item"
            v-if="filteredItems.length > 0"
            v-for="(item, key) in filteredItems"
            :key="'item_number_' + key"
            :value="item.name"
            @click.stop.prevent="itemClicked(item)"
        >
          {{ item.name }}
        </li>
        <li v-if="1 <= filterString.length && filteredItems.length === 0">
          ない場合は一旦「リストなし」を選択して登録後、<br>
          <a href="https://line.me/ti/g2/oozel5x55AFVY99vo8-oBw" target="_blank" rel="nofollow">ユーザーコミュニティ</a>よりご要望ください。
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      filterString: '', // 検索単語
      selectedCampPlaceName: null, // 選択されたキャンプ場名
      selectedCampPlaceId: null, // 選択されたキャンプ場ID
      isShowList: false, // 選択肢表示フラグ
    }
  },
  props: ['items', 'defaultName', 'defaultId'],
  computed: {
    inputName () {
      return this.selectedCampPlaceName != null ? this.selectedCampPlaceName : this.defaultName
    },
    inputId () {
      return this.selectedCampPlaceId != null ? this.selectedCampPlaceId : this.defaultId
    },
    /**
     * フィルタリング
     *
     * @returns {Array|*}
     */
    filteredItems () {
      if (!this.filterString || !this.items || this.filterString.length < 1) return []
      const regexp = new RegExp(this.filterString)
      return this.items.filter(x => {
        return regexp.test(x.name)
      })
    },
  },
  methods: {
    /**
     * input[type=text]をクリック時
     *
     */
    textBoxClicked () {
      this.isShowList = !this.isShowList
      if (this.isShowList) {
        this.$nextTick(() => this.$refs.filterTextBox.focus())
      }
    },
    /**
     * 選択肢一覧をクリック時
     *
     * @param item
     */
    itemClicked (item) {
      if (item == null) {
        return
      }
      location.href = '/camp-places/' + item.id
    },
    /**
     * リセット
     */
    reset () {
      this.isShowList = false
      this.filterString = ''
    }
  },
  mounted () {
    const $this = this
    document.addEventListener('click', function (e) {
      const target = (e.target || e.srcElement).closest('.search-wrapper')
      if (target === $this.$refs.wrapper) return
      $this.reset()
    })
  }
}
</script>

<style lang="scss" scoped>
.search-wrapper {
  &__list {
    position: absolute;
    z-index: 1;
    top: 100%;
    left: 0;
    width: 100%;
    padding: 4px;
    border: solid 1px rgb(192, 192, 192);
    background: white;
    box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.2);
    margin-top: -1px;

    .filter-text {
      margin: 10px;
      width: 90%;
    }

    ul {
      margin: 4px 0 0 0;
      padding: 4px;
      overflow-x: auto;
      overflow-y: scroll;
      max-height: 40vh;

      li {
        padding: 10px 1px;
        cursor: pointer;
        list-style: none;
        line-height: 1.5;
        font-size: 0.8rem;

        &.search-wrapper__item:hover {
          background: aliceblue;
        }
      }
    }
  }
}
</style>
