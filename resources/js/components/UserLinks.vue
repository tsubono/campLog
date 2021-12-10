<template>
  <div class="links">
    <p class="description">
      <i class="fas fa-ellipsis-v handle"></i> ボタンを動かすと順番の並べ替えができます
    </p>
    <draggable v-model="links" :options="options" handle=".handle">
      <div class="link-item" v-for="(link, index) in links" :key="index">
        <i class="fas fa-ellipsis-v handle"></i>
        <div class="form-group">
          <div class="form-item">
            <div class="link-content">
              <drop-image-round
                  class="drop-image"
                  :name="`links[${index}][icon_path]`"
                  :path="link.icon_path"
                  :url="'/api/uploadImage'"
                  :dir="'uploaded/link-icon'"
                  :can-edit="!link.is_static"
              >
              </drop-image-round>
              <div>
                <input
                    :id="`link${index}name`"
                    type="text"
                    :name="`links[${index}][name]`"
                    placeholder="リンク名を入力"
                    :disabled="link.is_static"
                    class="input-name"
                    v-model="link.name"
                />
                <input
                    :id="`link${index}Url`"
                    type="text"
                    :name="`links[${index}][url]`"
                    placeholder="URLを入力"
                    class="input-url"
                    v-model="link.url"
                />
                <input type="hidden" :name="`links[${index}][name]`" :value="link.name" v-if="link.is_static"/>
                <div class="form-check-group is-public">
                  <input type="hidden" :name="`links[${index}][is_public]`" value="1"/>
                  <input
                      :id="`link${index}IsPublic`"
                      type="checkbox"
                      :name="`links[${index}][is_public]`"
                      value="0"
                      :checked="link.is_public != 1"
                  />
                  <label
                      class="form-check-label"
                      :for="`link${index}IsPublic`">
                    非公開にする
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <input type="hidden" :name="`links[${index}][id]`" :value="link.id"/>
        <div class="controls" v-if="!link.is_static">
          <a class="btn danger-btn remove-btn" @click="onClickRemoveLink(index)">削除</a>
        </div>
      </div>
    </draggable>
    <a class="btn success-btn" @click="onClickAddLink()"> + リンクを追加</a>
    <input
        type="hidden"
        name="deleted_link_ids"
        v-model="deleted_link_ids"
    />
  </div>
</template>

<script>
const link = {
  id: '',
  name: '',
  url: '',
  icon_path: '',
  is_public: 1,
}
import draggable from 'vuedraggable'

export default {
  components: { draggable },
  data () {
    return {
      links: [],
      deleted_link_ids: [],
      options: {
        animation: 200
      },
    }
  },
  props: ['propLinks'],
  methods: {
    onClickAddLink () {
      this.links.push(_.cloneDeep(link))
      this.$forceUpdate()
    },
    onClickRemoveLink (index) {
      const deleted_links = this.links.splice(index, 1)
      if (deleted_links[0].id !== null) {
        this.deleted_link_ids.push(deleted_links[0].id)
      }
      this.$forceUpdate()
    },
  },
  mounted () {
    this.links = this.propLinks
  }
}
</script>

<style lang="scss" scoped>
.links {
  width: 100%;

  .description {
    color: #5c6066;
    font-size: .8em;
    text-align: left;
    margin: 12px 10px 5px 10px;
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

  .link-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    position: relative;

    .form-group {
      border: 1px solid #959ba2;
      border-radius: 10px;
      padding: 5px 10px;

      .form-item {
        display: flex;
        align-items: center;

        .link-content {
          display: flex;
          align-items: center;
          width: 100%;
        }

        input {
          margin-right: 10px;

          &.input-name {
            width: 150px;
          }

          &.input-url {
            width: 300px
          }
        }

        @media (max-width: 480px) {
          flex-direction: column;

          input {
            &.input-name,
            &.input-url {
              width: 90%;
            }
          }
        }
      }
    }
  }

  .remove-btn {
    font-size: .7em;
    margin-left: 10px;
    position: absolute;
    background: #FFE5E5;
    color: #E05656;
    right: 20px;
    bottom: 35px;
    width: 44px;
    padding: 5px;

    @media (max-width: 480px) {
      font-size: .6em;
      width: 40px;
    }
  }

  .drop-image {
    width: 27%;
    margin-right: 10px;
  }
}
</style>