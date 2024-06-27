<template>
  <div class="row q-col-gutter-x-md q-col-gutter-y-md q-mt-lg">
    <!--Заголовок-->
    <q-input
      v-model="form.title"
      class="col-12 q-pt-none"
      bg-color="white"
      clear-icon="close"
      clearable
      color="grey-3"
      data-type="standard"
      label-color="grey-7"
      no-error-icon
      outlined
      :error="v$.title.$error"
      :error-message="v$.title.$errors.at(-1)?.$message"
      :label="$t('field.title.article')"
      :title="$t('field.title.article')"
      @blur="v$.title.$touch"
    />

    <!--Редактор-->
    <q-field
      v-model="form.content"
      class="col-12 q-pt-sm"
      borderless
      no-error-icon
      :error="v$.content.$error"
      :error-message="v$.content.$errors.at(-1)?.$message"
      @blur="v$.content.$touch"
    >
      <template #control>
        <q-editor
          v-model="form.content"
          class="full-width"
          :max-height="config.editor.maxHeight"
          :style="v$.content.$error ? 'border-color: var(--q-negative)' : ''"
          :toolbar="config.editor.toolbar"
        />
      </template>
    </q-field>

    <!--Имя пользователя-->
    <q-input
      v-model="form.author_username"
      class="col-6"
      bg-color="white"
      clear-icon="close"
      clearable
      color="grey-3"
      data-type="standard"
      label-color="grey-7"
      no-error-icon
      outlined
      :error="v$.author_username.$error"
      :error-message="v$.author_username.$errors.at(-1)?.$message"
      :label="$t('field.username')"
      :title="$t('field.username')"
      @blur="v$.author_username.$touch"
    />

    <!--Электронная почта-->
    <q-input
      v-model="form.author_email"
      class="col-6"
      bg-color="white"
      clear-icon="close"
      clearable
      color="grey-3"
      data-type="standard"
      label-color="grey-7"
      no-error-icon
      outlined
      :error="v$.author_email.$error"
      :error-message="v$.author_email.$errors.at(-1)?.$message"
      :label="$t('field.email')"
      :title="$t('field.email')"
      @blur="v$.author_email.$touch"
    />
  </div>
</template>

<script setup>
import { email, minLength, maxLength, required } from 'src/utils/helpers/validators'
import { storeToRefs } from 'pinia'
import { useArticlesStore } from 'stores/articles'
import { useVuelidate } from '@vuelidate/core'
import config from 'src/utils/settings/config'
import validation from 'src/utils/settings/validation'

const validations = {
  author_email: { required, email, maxLength: maxLength(validation.email.maxLength) },
  author_username: {
    required,
    minLength: minLength(validation.username.minLength),
    maxLength: maxLength(validation.username.maxLength),
  },
  content: {
    required,
    minLength: minLength(validation.comment.content.minLength),
    maxLength: maxLength(validation.comment.content.maxLength),
  },
  title: {
    required,
    minLength: minLength(validation.comment.title.minLength),
    maxLength: maxLength(validation.comment.title.maxLength),
  },
}

const articles = useArticlesStore()
const { form } = storeToRefs(articles)
const v$ = useVuelidate(validations, form)

defineExpose({
  v$,
})
</script>

<style lang="sass" scoped>
:deep(.q-field__control-container)
  padding-top: 0 !important
</style>
