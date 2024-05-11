<template>
  <div>
    <q-card v-if="Object.keys(articles.selected).length !== 0" bordered flat>
      <q-card-section horizontal>
        <q-card-section>
          <div class="text-weight-bold q-mb-xs font-lato">
            <span class="q-mr-lg">{{ articles.selected.author.username }}</span>
            <span class="text-grey">{{ articles.selected.created_at }}</span>
          </div>
          <div class="text-h6 text-weight-bold q-mb-lg font-lato">
            <span>{{ articles.selected.title }}</span>
          </div>
          <div>
            <span>{{ articles.selected.content }}</span>
          </div>
        </q-card-section>

        <q-space />
      </q-card-section>

      <!-- <q-card-actions class="text-grey q-ma-sm">

      </q-card-actions> -->
    </q-card>
  </div>
</template>

<script setup>
import { useArticlesStore } from 'src/stores/articles'
import { useRoute } from 'vue-router'
import LayoutBlog from 'layouts/LayoutBlog.vue'

defineOptions({
  layout: LayoutBlog,
})

const articles = useArticlesStore()
const route = useRoute()
articles.show(route.params.id)
</script>
