<template>
  <q-card class="q-mb-sm" bordered flat>
    <q-card-section>
      <div class="q-mb-md">
        <span class="text-blue text-weight-bold">
          {{ $t('title.article').toLocaleUpperCase() }}
        </span>
      </div>
      <div class="text-weight-bold q-mb-xs font-lato">
        <span class="q-mr-lg">{{ article.author_username }}</span>
        <span class="text-grey">{{ article.created_at }}</span>
      </div>
      <router-link
        :to="{ name: 'ArticlesShow', params: { id: article.id } }"
        class="text-h6 text-weight-bold font-lato text-decoration-none"
      >
        <span>{{ article.title }}</span>
      </router-link>
    </q-card-section>

    <q-card-actions class="text-grey q-ma-sm">
      <span class="q-mr-sm">{{ $t('title.comments') }}:</span>
      <span>{{ article.count_comments }}</span>
    </q-card-actions>
  </q-card>
</template>

<script setup>
defineProps({
  article: {
    type: Object,
    required: true,
  },
})
</script>
