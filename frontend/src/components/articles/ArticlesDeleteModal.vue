<template>
  <ComponentModal :model-value="isShowed" :height="30" :hide-modal="hideModal" :width="50">
    <!--Заголовок-->
    <template #title>
      <ComponentTitle :text="$t('title.delete.article')" />
    </template>

    <!--Форма создания статьи-->
    <template #content>
      <div class="q-mt-xl font-size-16">
        <span>
          {{ $t('confirm.delete') }}
          <span class="text-weight-bold">{{ articles.selected.title }}</span>
          ?
        </span>
      </div>
    </template>

    <!--Действия-->
    <template #actions>
      <div class="row justify-end q-col-gutter-x-lg actions">
        <div class="col-3">
          <q-btn class="full-width" color="indigo-5" no-caps outline @click="hideModal">
            {{ $t('action.cancel') }}
          </q-btn>
        </div>
        <div class="col-3">
          <q-btn class="full-width" color="indigo-5" no-caps unelevated @click="deleteArticle">
            {{ $t('action.delete') }}
          </q-btn>
        </div>
      </div>
    </template>
  </ComponentModal>
</template>

<script setup>
import { useArticlesStore } from 'stores/articles'
import { useI18n } from 'vue-i18n'
import ComponentModal from 'components/common/ComponentModal.vue'
import ComponentTitle from 'components/common/ComponentTitle.vue'
import notify from 'src/utils/helpers/notify'

const props = defineProps({
  hideModal: {
    type: Function,
    required: true,
  },
  isShowed: {
    type: Boolean,
    required: true,
  },
})

const { t } = useI18n()
const articles = useArticlesStore()

/**
 * Сохраняет статью.
 * @returns {Promise|false}
 */
const deleteArticle = async () => {
  return articles.delete(articles.selected.id).then(() => {
    props.hideModal()
    articles.clearSelected()
    notify.success(t('message.success.article.delete'))
    articles.index()
  })
}
</script>

<style lang="sass" scoped>
.actions
  bottom: 0
  left: 0
  padding: 20px 30px 40px 30px
  position: absolute
  right: 0
</style>
