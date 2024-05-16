<template>
  <q-footer>
    <q-toolbar class="flex flex-center text-dark">
      <span>Андата &copy; {{ currentYear }}</span>
    </q-toolbar>
  </q-footer>
</template>

<script setup>
import { ref } from 'vue'

const currentYear = ref(new Date().getFullYear())
</script>
