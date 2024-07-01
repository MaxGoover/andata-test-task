<template>
  <div>
    <!--Лоадер-->
    <q-inner-loading v-if="loaders.isShowedLoader" showing :label="$t('loader.pleaseWait')" />

    <template v-else>
      <!--Статья-->
      <q-card v-if="!isEmpty(articles.selected)" class="q-mb-sm" bordered flat role="article">
        <q-card-section>
          <div class="text-weight-bold q-mb-xs font-lato">
            <span class="q-mr-lg">{{ articles.selected.author_username }}</span>
            <span class="text-grey">{{ articles.selected.created_at }}</span>
          </div>
          <div class="text-h6 text-weight-bold q-mb-lg font-lato">
            <span>{{ articles.selected.title }}</span>
          </div>
          <div v-html="articles.selected.content" />
        </q-card-section>
      </q-card>

      <!--Добавить комментарий-->
      <q-card class="q-mb-sm" bordered flat>
        <q-card-section>
          <div class="text-weight-bold q-mb-xs">
            <span class="q-mr-lg">{{ $t('title.comments') }}</span>
            <span class="text-blue" role="figure">{{ comments.count }}</span>
          </div>
        </q-card-section>

        <q-card-section>
          <ComponentTitle :text="$t('title.add.comment')" />
        </q-card-section>

        <q-card-section>
          <CommentsForm ref="commentsFormRef" />
        </q-card-section>

        <q-card-section class="q-pt-none">
          <div class="row justify-end q-col-gutter-x-lg actions">
            <div class="col-2">
              <q-btn class="full-width" color="indigo-5" no-caps unelevated @click="createComment">
                {{ $t('action.save') }}
              </q-btn>
            </div>
          </div>
        </q-card-section>
      </q-card>

      <!--Комментарии-->
      <q-list v-if="!isEmpty(comments.list)" role="list">
        <CommentsItem
          v-for="comment in comments.list"
          :key="comment.id"
          class="js-comment"
          role="listitem"
          :comment="comment"
        />
      </q-list>
    </template>
  </div>
</template>

<script setup>
import { isEmpty } from 'lodash'
import { ref } from 'vue'
import { scrollToElement } from 'src/utils/helpers/index'
import { useArticlesStore } from 'stores/articles'
import { useCommentsStore } from 'stores/comments'
import { useI18n } from 'vue-i18n'
import { useLoadersStore } from 'stores/loaders'
import { useRoute } from 'vue-router'
import CommentsForm from 'components/comments/CommentsForm.vue'
import CommentsItem from 'components/comments/CommentsItem.vue'
import ComponentTitle from 'components/common/ComponentTitle.vue'
import LayoutBlog from 'layouts/LayoutBlog.vue'
import notify from 'src/utils/helpers/notify'

defineOptions({
  layout: LayoutBlog,
})

const { t } = useI18n()
const articles = useArticlesStore()
const comments = useCommentsStore()
const commentsFormRef = ref(null)
const loaders = useLoadersStore()
const route = useRoute()

loaders.showLoader()
comments.setFormArticleId(route.params.id)

articles.show(route.params.id).finally(() => {
  loaders.hideLoader()
})

/**
 * Возвращает поле (DOM-элемент) статьи, содержащий ошибку валидации.
 * @returns {Object}
 */
const errorFieldElement = () => {
  const elements = document.querySelectorAll('.q-field--error')
  return elements[0]
}

/**
 * Возвращает последний добавленный комментарий (DOM-элемент).
 * @returns {Object}
 */
const lastCommentElement = () => {
  const elements = document.querySelectorAll('.js-comment')
  return elements[elements.length - 1]
}

/**
 * Сохраняет комментарий.
 * @returns {Promise|false}
 */
const createComment = async () => {
  const isValidComment = await commentsFormRef.value.v$.$validate()

  if (!isValidComment) {
    scrollToElement(errorFieldElement())
    notify.error(t('message.error.validation'))
    return false
  }

  return comments.create().then(() =>
    articles.getComments(route.params.id).then(() => {
      commentsFormRef.value.v$.$reset()
      comments.clearForm()
      scrollToElement(lastCommentElement())
    }),
  )
}
</script>
