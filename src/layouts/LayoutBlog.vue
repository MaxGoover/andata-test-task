<template>
  <q-layout class="bg-grey-1" view="lhh lpr lFf">
    <BlogHeader class="bg-gradient" />
    <q-page-container class="q-ma-md">
      <router-view />
    </q-page-container>
    <BlogFooter class="bg-grey-1" />
  </q-layout>
</template>

<script setup>
import BlogFooter from 'components/blog/BlogFooter.vue'
import BlogHeader from 'components/blog/BlogHeader.vue'
</script>

<style lang="sass" scoped>
.bg-gradient
  background: linear-gradient(to right, $grey-3, $grey-1)
  box-shadow: 254px 0px 102px rgba(0, 0, 0, 0.01), 143px 0px 86px rgba(0, 0, 0, 0.02), 64px 0px 64px rgba(0, 0, 0, 0.03), 16px 0px 35px rgba(0, 0, 0, 0.04), 0px 0px 0px rgba(0, 0, 0, 0.04)
</style>
