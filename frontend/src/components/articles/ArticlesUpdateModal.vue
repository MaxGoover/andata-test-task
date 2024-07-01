<template>
  <ComponentModal :model-value="isShowed" :height="70" :hide-modal="hideModal" :width="70">
    <!--Заголовок-->
    <template #title>
      <ComponentTitle :text="$t('title.edit.article')" />
    </template>

    <!--Форма создания статьи-->
    <template #content>
      <ArticlesForm ref="articlesFormRef" />
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
          <q-btn class="full-width" color="indigo-5" no-caps unelevated @click="updateArticle">
            {{ $t('action.save') }}
          </q-btn>
        </div>
      </div>
    </template>
  </ComponentModal>
</template>

<script setup>
import { ref } from 'vue'
import { scrollToElement } from 'src/utils/helpers/index'
import { useArticlesStore } from 'stores/articles'
import { useI18n } from 'vue-i18n'
import ArticlesForm from 'components/articles/ArticlesForm.vue'
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
const articlesFormRef = ref(null)

/**
 * Возвращает поле (DOM-элемент) статьи, содержащий ошибку валидации.
 * @returns {Object}
 */
const errorFieldElement = () => {
  const elements = document.querySelectorAll('.q-field--error')
  return elements[0]
}

/**
 * Сохраняет статью.
 * @returns {Promise|false}
 */
const updateArticle = async () => {
  const isValidArticle = await articlesFormRef.value.v$.$validate()

  if (!isValidArticle) {
    scrollToElement(errorFieldElement())
    notify.error(t('message.error.validation'))
    return false
  }

  return articles.update(articles.form.id).then(() => {
    props.hideModal()
    articles.clearForm()
    articles.clearSelected()
    notify.success(t('message.success.article.update'))
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
