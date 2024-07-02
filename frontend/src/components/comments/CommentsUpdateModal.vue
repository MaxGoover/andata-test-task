<template>
  <ComponentModal :model-value="isShowed" :height="70" :hide-modal="hideModal" :width="70">
    <!--Заголовок-->
    <template #title>
      <ComponentTitle :text="$t('title.edit.comment')" />
    </template>

    <!--Форма создания статьи-->
    <template #content>
      <CommentsForm ref="commentsFormRef" class="q-mt-lg" />
    </template>

    <!--Действия-->
    <template #actions>
      <div class="row justify-end q-col-gutter-x-lg comments">
        <div class="col-3">
          <q-btn class="full-width" color="indigo-5" no-caps outline @click="hideModal">
            {{ $t('action.cancel') }}
          </q-btn>
        </div>
        <div class="col-3">
          <q-btn class="full-width" color="indigo-5" no-caps unelevated @click="updateComment">
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
import { useCommentsStore } from 'stores/comments'
import { useI18n } from 'vue-i18n'
import CommentsForm from 'components/comments/CommentsForm.vue'
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
const comments = useCommentsStore()
const commentsFormRef = ref(null)

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
const updateComment = async () => {
  const isValidComment = await commentsFormRef.value.v$.$validate()

  if (!isValidComment) {
    scrollToElement(errorFieldElement())
    notify.error(t('message.error.validation'))
    return false
  }

  return comments.update(comments.form.id).then(() => {
    props.hideModal()
    articles.getComments(comments.selected.article_id)
    comments.clearForm()
    comments.clearSelected()
    notify.success(t('message.success.comment.update'))
  })
}
</script>

<style lang="sass" scoped>
.comments
  bottom: 0
  left: 0
  padding: 20px 30px 40px 30px
  position: absolute
  right: 0
</style>
