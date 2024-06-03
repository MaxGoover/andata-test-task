<template>
  <div>
    <!--Лоадер-->
    <q-inner-loading v-if="loaders.isShowedLoader" showing :label="$t('loader.pleaseWait')" />

    <!--Статья-->
    <q-card v-if="!isEmpty(articles.selected)" class="q-mb-sm" bordered flat>
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
          <span class="text-blue">{{ comments.count }}</span>
        </div>
      </q-card-section>

      <q-card-section>
        <ComponentTitle :text="$t('title.add.comment')" />
      </q-card-section>

      <q-card-section>
        <CommentsForm />
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
    <template v-if="!isEmpty(comments.list)">
      <q-card
        v-for="comment in comments.list"
        :key="comment.id"
        class="q-mb-sm comment"
        bordered
        flat
      >
        <q-card-section>
          <div class="text-weight-bold q-mb-xs font-lato">
            <span class="q-mr-lg">{{ comment.author_username }}</span>
            <span class="text-grey">{{ comment.created_at }}</span>
          </div>
          <div class="text-italic q-mb-xs fs-16 font-lato">
            <span>{{ comment.title }}</span>
          </div>
          <div v-html="comment.content" />
        </q-card-section>
      </q-card>
    </template>
  </div>
</template>

<script setup>
import { isEmpty } from 'lodash'
import { scroll } from 'quasar'
import { useArticlesStore } from 'stores/articles'
import { useCommentsStore } from 'stores/comments'
import { useLoadersStore } from 'src/stores/loaders'
import { useRoute } from 'vue-router'
import CommentsForm from 'components/comments/CommentsForm.vue'
import ComponentTitle from 'components/common/ComponentTitle.vue'
import LayoutBlog from 'layouts/LayoutBlog.vue'
import config from 'src/utils/settings/config'

defineOptions({
  layout: LayoutBlog,
})

const { getScrollTarget, setVerticalScrollPosition } = scroll
const articles = useArticlesStore()
const comments = useCommentsStore()
const loaders = useLoadersStore()
const route = useRoute()

loaders.showLoader()
comments.setFormArticleId(route.params.id)

articles.show(route.params.id).finally(() => {
  loaders.hideLoader()
})

const scrollToElement = (el) => {
  const target = getScrollTarget(el)
  setVerticalScrollPosition(target, el.offsetTop, config.debounce.scroll.lastComment)
}

const lastCommentElement = () => {
  const commentsElements = document.querySelectorAll('.comment')
  return commentsElements[commentsElements.length - 1]
}

const createComment = () => {
  comments.create().then(() => {
    articles.getComments(route.params.id).then(() => {
      scrollToElement(lastCommentElement())
    })
  })
}
</script>
