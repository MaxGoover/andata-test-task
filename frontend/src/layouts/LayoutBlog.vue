<template>
  <div>
    <!--Шаблон блога-->
    <q-layout class="bg-grey-1" view="lhh lpr lFf">
      <BlogHeader class="bg-gradient" />
      <q-page-container class="q-ma-md">
        <router-view />
      </q-page-container>
      <BlogFooter class="bg-grey-1" />
    </q-layout>

    <!--Модальное окно добавления статьи-->
    <ArticlesCreateModal
      :hideModal="articles.hideCreateModal"
      :isShowed="articles.isShowedCreateModal"
    />

    <!--Модальное окно удаления статьи-->
    <ArticlesDeleteModal
      :hideModal="articles.hideDeleteModal"
      :isShowed="articles.isShowedDeleteModal"
    />

    <!--Модальное окно редактирования статьи-->
    <ArticlesUpdateModal
      :hideModal="hideArticleUpdateModal"
      :isShowed="articles.isShowedUpdateModal"
    />

    <!--Модальное окно удаления комментария-->
    <CommentsDeleteModal
      :hideModal="comments.hideDeleteModal"
      :isShowed="comments.isShowedDeleteModal"
    />

    <!--Модальное окно редактирования комментария-->
    <CommentsUpdateModal
      :hideModal="hideCommentUpdateModal"
      :isShowed="comments.isShowedUpdateModal"
    />
  </div>
</template>

<script setup>
import { useArticlesStore } from 'stores/articles'
import { useCommentsStore } from 'stores/comments'
import ArticlesCreateModal from 'components/articles/ArticlesCreateModal.vue'
import ArticlesDeleteModal from 'components/articles/ArticlesDeleteModal.vue'
import ArticlesUpdateModal from 'components/articles/ArticlesUpdateModal.vue'
import CommentsDeleteModal from 'components/comments/CommentsDeleteModal.vue'
import CommentsUpdateModal from 'components/comments/CommentsUpdateModal.vue'
import BlogFooter from 'components/blog/BlogFooter.vue'
import BlogHeader from 'components/blog/BlogHeader.vue'

const articles = useArticlesStore()
const comments = useCommentsStore()

const hideArticleUpdateModal = () => {
  articles.clearForm()
  articles.hideUpdateModal()
}

const hideCommentUpdateModal = () => {
  comments.clearForm()
  comments.hideUpdateModal()
}
</script>

<style lang="sass" scoped>
.bg-gradient
  background: linear-gradient(to right, $grey-3, $grey-1)
  box-shadow: 254px 0px 102px rgba(0, 0, 0, 0.01), 143px 0px 86px rgba(0, 0, 0, 0.02), 64px 0px 64px rgba(0, 0, 0, 0.03), 16px 0px 35px rgba(0, 0, 0, 0.04), 0px 0px 0px rgba(0, 0, 0, 0.04)
</style>
