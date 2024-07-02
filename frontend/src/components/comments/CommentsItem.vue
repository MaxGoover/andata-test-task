<template>
  <q-card class="q-mb-sm comment" bordered flat>
    <q-card-section>
      <div class="row text-weight-bold q-mb-xs font-lato">
        <span class="q-mr-lg">{{ comment.author_username }}</span>
        <a :href="`mailto:${comment.author_email}`" class="q-mr-lg">{{ comment.author_email }}</a>
        <span class="text-grey">{{ comment.created_at }}</span>
        <q-space />
        <q-btn
          class="q-ml-xs"
          flat
          icon="mdi-pencil-outline"
          no-caps
          text-color="grey"
          :title="$t('action.edit')"
          @click="showUpdateModal"
        />
        <q-btn
          class="q-ml-xs"
          flat
          icon="mdi-delete-outline"
          no-caps
          text-color="grey"
          :title="$t('action.delete')"
          @click="showDeleteModal"
        />
      </div>
      <div class="text-italic q-mb-xs fs-16 font-lato">
        <span>{{ comment.title }}</span>
      </div>
      <div v-html="comment.content" />
    </q-card-section>
  </q-card>
</template>

<script setup>
import { useCommentsStore } from 'stores/comments'

const props = defineProps({
  comment: {
    type: Object,
    required: true,
  },
})

const comments = useCommentsStore()

/**
 * Показывает модальное окно удаления комментария.
 * @returns {void}
 */
const showDeleteModal = () => {
  comments.showDeleteModal()
  comments.setSelected(props.comment)
}

/**
 * Показывает модальное окно редактирования комментария.
 * @returns {void}
 */
const showUpdateModal = () => {
  comments.showUpdateModal()
  comments.setSelected(props.comment)
  comments.setForm(props.comment)
}
</script>
