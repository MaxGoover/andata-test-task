<template>
  <div>
    <!--Лоадер-->
    <q-inner-loading v-if="loaders.isShowedLoader" showing :label="$t('loader.pleaseWait')" />

    <template v-else>
      <!--Список статей-->
      <ArticlesItem v-for="article in articles.list" :key="article.id" :article="article" />
    </template>
  </div>
</template>

<script setup>
import { useArticlesStore } from 'stores/articles'
import { useLoadersStore } from 'stores/loaders'
import ArticlesItem from 'components/articles/ArticlesItem.vue'
import LayoutBlog from 'layouts/LayoutBlog.vue'

defineOptions({
  layout: LayoutBlog,
})

const articles = useArticlesStore()
const loaders = useLoadersStore()

loaders.showLoader()

articles.index().finally(() => {
  loaders.hideLoader()
})
</script>
