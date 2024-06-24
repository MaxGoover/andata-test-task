<template>
  <q-card class="q-mb-sm" bordered flat>
    <q-card-section>
      <div class="q-mb-md">
        <div class="row">
          <span class="text-blue text-weight-bold">
            {{ $t('title.article').toLocaleUpperCase() }}
          </span>
          <q-space />
          <q-btn
            class="q-ml-xs"
            flat
            icon="mdi-pencil-outline"
            no-caps
            text-color="grey"
            :title="$t('action.edit')"
            @click="showUpdateModal"
          />
          <q-btn
            class="q-ml-xs"
            flat
            icon="mdi-delete-outline"
            no-caps
            text-color="grey"
            :title="$t('action.delete')"
            @click="showDeleteModal"
          />
        </div>
      </div>
      <div class="text-weight-bold q-mb-xs font-lato">
        <span class="q-mr-lg" :title="$t('field.author.article')">{{
          article.author_username
        }}</span>
        <span class="text-grey" :title="$t('field.createdAt') + ': ' + article.created_at">{{
          article.created_at
        }}</span>
      </div>
      <router-link
        :to="{ name: 'ArticlesShow', params: { id: article.id } }"
        class="text-h6 text-weight-bold font-lato text-decoration-none"
        :title="$t('field.title.article')"
      >
        <span>{{ article.title }}</span>
      </router-link>
    </q-card-section>

    <q-card-actions class="text-grey q-ma-sm">
      <span class="q-mr-sm" :title="$t('title.comments')">{{ $t('title.comments') }}:</span>
      <span :title="$t('field.count.comments')">{{ article.count_comments }}</span>
    </q-card-actions>
  </q-card>
</template>

<script setup>
import { useArticlesStore } from 'stores/articles'

const props = defineProps({
  article: {
    type: Object,
    required: true,
  },
})

const articles = useArticlesStore()

/**
 * Показывает модальное окно удаления статьи.
 * @returns {void}
 */
const showDeleteModal = () => {
  articles.showDeleteModal()
  articles.setSelected(props.article)
}

/**
 * Показывает модальное окно редактирования статьи.
 * @returns {void}
 */
const showUpdateModal = () => {
  articles.showUpdateModal()
  articles.setSelected(props.article)
  articles.setForm(props.article)
}
</script>
