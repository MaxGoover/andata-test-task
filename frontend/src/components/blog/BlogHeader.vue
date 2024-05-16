<template>
  <q-header class="text-dark" reveal>
    <q-toolbar class="q-px-md h-64">
      <!--Логотип-->
      <ComponentIcon class="q-ml-sm" :height="80" :name="$ICONS.LOGO" :width="240">
        <IconLogo />
      </ComponentIcon>

      <!--Заголовок-->
      <q-toolbar-title>{{ $t('project.name') }}</q-toolbar-title>

      <q-space />

      <!--Добавить статью-->
      <q-btn
        color="positive"
        icon="mdi-forum-plus-outline"
        no-caps
        unelevated
        :label="$t('action.add.article')"
        :title="$t('action.add.article')"
        @click="articles.showCreateModal"
      />
    </q-toolbar>
  </q-header>
</template>

<script setup>
import { useArticlesStore } from 'src/stores/articles'
import ComponentIcon from 'components/common/ComponentIcon.vue'
import IconLogo from 'assets/icons/IconLogo.vue'

const articles = useArticlesStore()
</script>
