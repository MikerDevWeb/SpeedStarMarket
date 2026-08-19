<script setup>
import headerComponent from '/src/components/headerComponent.vue'
import { useIsMobile } from './composables/useIsMobile';

const {isMobileScreen} = useIsMobile();
</script>

<template>
  <headerComponent/>
  <main>
    <span class="borderWindows" v-if="!isMobileScreen"></span>
    <router-view/>
    <span class="borderWindows" v-if="!isMobileScreen"></span>
  </main>

</template>


<style scoped>
.borderWindows {
  width: 20%;
}
</style>
