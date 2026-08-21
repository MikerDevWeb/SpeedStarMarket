<script setup>
import headerComponent from '/src/components/headerComponent.vue'
import { useIsMobile } from './composables/useIsMobile';
import navbar from './components/navbar.vue';
import navBar from './components/desktop/navBar.vue';

const {isMobileScreen} = useIsMobile();
</script>

<template>
  <headerComponent/>
  <main>
    <navBar v-if="!isMobileScreen"/>
    <span class="borderWindows" v-if="!isMobileScreen"></span>
    <router-view/>
    <span class="borderWindows" v-if="!isMobileScreen"></span>
  </main>
  <navbar v-if="isMobileScreen"/>
</template>


<style scoped>
.borderWindows {
  width: 20%;
}
</style>
