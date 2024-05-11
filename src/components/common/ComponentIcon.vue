<template>
  <svg
    role="img"
    xmlns="http://www.w3.org/2000/svg"
    xmlns:xlink="http://www.w3.org/1999/xlink"
    :aria-labelledby="name"
    :height="height"
    :viewBox="`0 0 ${width} ${height}`"
    :width="width"
  >
    <g :fill="colorFill" :stroke="colorStroke">
      <slot />
    </g>
  </svg>
</template>

<script setup>
defineProps({
  colorFill: {
    type: String,
    default: 'none',
  },
  colorStroke: {
    type: String,
    default: 'none',
  },
  height: {
    type: Number,
    required: true,
  },
  name: {
    type: String,
    required: true,
  },
  width: {
    type: Number,
    required: true,
  },
})
</script>
