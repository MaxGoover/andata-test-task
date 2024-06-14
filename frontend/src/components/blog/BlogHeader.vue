<template>
  <q-header class="text-dark" reveal>
    <q-toolbar class="q-px-md h-64">
      <!--Логотип-->
      <router-link
        :to="{ name: 'Home' }"
        class="text-h6 text-weight-bold font-lato text-decoration-none"
      >
        <ComponentIcon class="q-ml-sm" :height="80" :name="$ICONS.LOGO" :width="240">
          <IconLogo />
        </ComponentIcon>
      </router-link>

      <!--Заголовок-->
      <q-toolbar-title>{{ $t('project.name') }}</q-toolbar-title>

      <q-space />

      <!--Добавить статью-->
      <q-btn
        class="q-ml-lg"
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
import { useArticlesStore } from 'stores/articles'
import ComponentIcon from 'components/common/ComponentIcon.vue'
import IconLogo from 'assets/icons/IconLogo.vue'

const articles = useArticlesStore()
</script>
