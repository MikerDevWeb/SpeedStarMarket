<script setup>
defineProps({
  w: { type: String, default: '100%' },
  h: { type: String, default: '16px' }
});
</script>

<template>
  <div class="skeleton" :style="{ '--skeleton-w': w, '--skeleton-h': h }"></div>
</template>

<style scoped>
.skeleton {
  width: var(--skeleton-w);
  height: var(--skeleton-h);
  border-radius: 8px;
  background: linear-gradient(
    90deg,
    var(--background-page) 25%,
    color-mix(in srgb, var(--blackColor) 8%, var(--background-page)) 50%,
    var(--background-page) 75%
  );
  background-size: 200% 100%;
  animation: skeleton-loading 1.4s ease-in-out infinite;
}

@keyframes skeleton-loading {
  0% { background-position: 200% 0; }
  100% { background-position: -200% 0; }
}
</style>