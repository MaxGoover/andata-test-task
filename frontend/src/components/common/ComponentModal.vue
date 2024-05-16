<template>
  <q-dialog :model-value="isShowed" class="modal" @update:model-value="hideModal">
    <q-card class="bg-grey-1 modal__card" :class="`min-height-${height} min-width-${width}`">
      <q-card-section>
        <slot name="title" />

        <!--Кнопка "Закрыть"-->
        <q-btn
          class="modal__close"
          flat
          round
          icon="mdi-close"
          text-color="grey-5"
          :title="$t('action.close')"
          @click="hideModal"
        />
      </q-card-section>

      <q-card-section class="modal__body scroll">
        <slot name="content" />
      </q-card-section>

      <q-card-actions>
        <slot name="actions" />
      </q-card-actions>
    </q-card>
  </q-dialog>
</template>

<script setup>
defineProps({
  height: Number, // высота модального окна (vw)
  hideModal: Function,
  isShowed: Boolean,
  width: Number, // ширина модального окна (vw)
})
</script>

<style lang="sass" scoped>
.modal
  &__body
    max-height: 50vh

  &__card
    border-radius: 16px
    max-width: 50vw
    padding: 40px 30px 100px 40px

  &__close
    position: absolute
    right: -8px
    top: -12px
// убираем отступы у секций
:deep(.q-card__section--vert)
  padding: 0
</style>
