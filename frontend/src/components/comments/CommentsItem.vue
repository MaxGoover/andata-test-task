<template>
  <q-card class="q-mb-sm comment" bordered flat>
    <q-card-section>
      <div class="text-weight-bold q-mb-xs font-lato">
        <span class="q-mr-lg">{{ comment.author_username }}</span>
        <a :href="`mailto:${comment.author_email}`" class="q-mr-lg">{{ comment.author_email }}</a>
        <span class="text-grey">{{ comment.created_at }}</span>
      </div>
      <div class="text-italic q-mb-xs fs-16 font-lato">
        <span>{{ comment.title }}</span>
      </div>
      <div v-html="comment.content" />
    </q-card-section>
  </q-card>
</template>

<script setup>
defineProps({
  comment: {
    type: Object,
    required: true,
  },
})
</script>
