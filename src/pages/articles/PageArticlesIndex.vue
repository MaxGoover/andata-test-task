<template>
  <div>
    <!--Список статей-->
    <q-card v-for="article in articles.list" :key="article.id" class="q-mb-sm" bordered flat>
      <q-card-section>
        <div class="q-mb-md">
          <span class="text-blue text-weight-bold">
            {{ $t('title.article').toLocaleUpperCase() }}
          </span>
        </div>
        <div class="text-weight-bold q-mb-xs font-lato">
          <span class="q-mr-lg">{{ article.author.username }}</span>
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
        <span>{{ article.countComments }}</span>
      </q-card-actions>
    </q-card>
  </div>
</template>

<script setup>
import { useArticlesStore } from 'src/stores/articles'
import LayoutBlog from 'layouts/LayoutBlog.vue'

defineOptions({
  layout: LayoutBlog,
})

const articles = useArticlesStore()
articles.index()
</script>
