<template>
  <q-header class="text-dark" reveal>
    <q-toolbar class="q-px-sm h-64">
      <!--Логотип-->
      <ComponentIcon class="q-ml-lg" :height="80" :name="$ICONS.LOGO" :width="240">
        <IconLogo />
      </ComponentIcon>
      <q-toolbar-title>{{ $t('project.name') }}</q-toolbar-title>
      <q-space />
    </q-toolbar>
  </q-header>
</template>

<script setup>
import ComponentIcon from 'components/common/ComponentIcon.vue'
import IconLogo from 'assets/icons/IconLogo.vue'
</script>
