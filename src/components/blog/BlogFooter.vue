<template>
  <q-footer>
    <q-toolbar class="flex flex-center text-accent-font">
      Андата &copy; {{ currentYear }}
    </q-toolbar>
  </q-footer>
</template>

<script setup>
import { ref } from 'vue'

const currentYear = ref(new Date().getFullYear())
</script>
