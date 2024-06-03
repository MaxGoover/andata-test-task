<template>
  <ComponentModal :model-value="isShowed" :height="70" :hide-modal="hideModal" :width="70">
    <!--Заголовок-->
    <template #title>
      <ComponentTitle :text="$t('title.add.article')" />
    </template>

    <!--Форма создания статьи-->
    <template #content>
      <ArticlesForm />
    </template>

    <!--Действия-->
    <template #actions>
      <div class="row justify-end q-col-gutter-x-lg actions">
        <div class="col-3">
          <q-btn class="full-width" color="indigo-5" no-caps outline @click="hideModal">
            {{ $t('action.cancel') }}
          </q-btn>
        </div>
        <div class="col-3">
          <q-btn class="full-width" color="indigo-5" no-caps unelevated @click="createArticle">
            {{ $t('action.save') }}
          </q-btn>
        </div>
      </div>
    </template>
  </ComponentModal>
</template>

<script setup>
import { useArticlesStore } from 'src/stores/articles'
import ArticlesForm from 'components/articles/ArticlesForm.vue'
import ComponentModal from 'components/common/ComponentModal.vue'
import ComponentTitle from 'components/common/ComponentTitle.vue'
// import notify from 'src/utils/helpers/notify'

defineProps({
  hideModal: Function,
  isShowed: Boolean,
})

const articles = useArticlesStore()

const createArticle = () => {
  articles.create().then(() => {
    // this.hideModal()
  })
}
</script>

<style lang="sass" scoped>
.actions
  bottom: 0
  left: 0
  padding: 20px 30px 40px 30px
  position: absolute
  right: 0
</style>
