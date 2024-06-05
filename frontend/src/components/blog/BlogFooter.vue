<template>
  <q-footer class="text-dark">
    <q-toolbar class="q-px-xl h-64">
      <!--Ссылки на мессенджеры-->
      <q-btn class="no-hover" :href="config.messenger.link.telegram" dense flat unelevated>
        <ComponentIcon :height="48" :name="$ICONS.TELEGRAM" :width="48">
          <IconTelegram />
        </ComponentIcon>
      </q-btn>

      <q-btn class="no-hover" :href="config.messenger.link.whatsapp" dense flat unelevated>
        <ComponentIcon :height="48" :name="$ICONS.WHATSAPP" :width="48">
          <IconWhatsapp />
        </ComponentIcon>
      </q-btn>

      <q-space />

      <span>Андата &copy; {{ currentYear }}</span>
    </q-toolbar>
  </q-footer>
</template>

<script setup>
import config from 'src/utils/settings/config'
import ComponentIcon from 'components/common/ComponentIcon.vue'
import IconTelegram from 'assets/icons/IconTelegram.vue'
import IconWhatsapp from 'assets/icons/IconWhatsapp.vue'

const currentYear = new Date().getFullYear()
</script>

<style lang="sass" scoped>
:deep(.q-btn.no-hover .q-focus-helper)
  display: none
</style>
