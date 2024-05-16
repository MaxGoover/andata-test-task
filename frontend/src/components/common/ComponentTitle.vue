<template>
  <div class="title">
    <span class="title-text">{{ text }}</span>
  </div>
</template>

<script setup>
defineProps({
  text: {
    type: String,
    required: true,
  },
})
</script>

<style lang="sass" scoped>
.title
  align-items: flex-start
  align-self: center
  display: flex

  &-text
    color: $grey-9
    font-size: 22px
    font-weight: bold
</style>
