<template>
  <div>
    <!--Лоадер-->
    <q-inner-loading v-if="loaders.isShowedLoader" showing :label="$t('loader.pleaseWait')" />

    <template v-else>
      <!--Список статей-->
      <q-list v-if="!isEmpty(articles.list)" role="list">
        <ArticlesItem
          v-for="article in articles.list"
          :key="article.id"
          role="listitem"
          :article="article"
        />
      </q-list>
      <div v-else class="q-ma-sm">
        <span>{{ $t('table.noData.articles') }}</span>
      </div>
    </template>
  </div>
</template>

<script setup>
import { isEmpty } from 'lodash'
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
  articles.clearSelected()
  loaders.hideLoader()
})
</script>
