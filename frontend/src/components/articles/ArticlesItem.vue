<template>
  <q-card class="q-mb-sm" bordered flat>
    <q-card-section>
      <div class="q-mb-md">
        <div class="row">
          <span class="text-blue text-weight-bold">
            {{ $t('title.article').toLocaleUpperCase() }}
          </span>
          <q-space />
          <q-btn class="q-ml-sm" flat no-caps :label="$t('action.edit')" @click="showUpdateModal" />
          <q-btn class="q-ml-sm" flat no-caps :label="$t('action.delete')" />
        </div>
      </div>
      <div class="text-weight-bold q-mb-xs font-lato">
        <span class="q-mr-lg">{{ article.author_username }}</span>
        <span class="text-grey">{{ article.created_at }}</span>
      </div>
      <router-link
        :to="{ name: 'ArticlesShow', params: { id: article.id } }"
        class="text-h6 text-weight-bold font-lato text-decoration-none"
      >
        <span>{{ article.title }}</span>
      </router-link>
    </q-card-section>

    <q-card-actions class="text-grey q-ma-sm">
      <span class="q-mr-sm">{{ $t('title.comments') }}:</span>
      <span>{{ article.count_comments }}</span>
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
const showUpdateModal = () => {
  articles.showUpdateModal()
  articles.setSelected(props.article)
  articles.setForm(props.article)
  console.log('form', articles.form)
}
</script>
