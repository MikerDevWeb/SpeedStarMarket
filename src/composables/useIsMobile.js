import { ref, onMounted, onUnmounted } from 'vue';

export function useIsMobile(breakpoint = 1025) {
  const isMobileScreen = ref(false);
  let mediaQuery;

  function updateMatch(e) {
    isMobileScreen.value = !e.matches; // e.matches = true significa que SÍ cumple min-width (desktop)
  }

  onMounted(() => {
    mediaQuery = window.matchMedia(`(min-width: ${breakpoint}px)`);
    isMobileScreen.value = !mediaQuery.matches;
    mediaQuery.addEventListener('change', updateMatch);
  });

  onUnmounted(() => {
    mediaQuery?.removeEventListener('change', updateMatch);
  });

  return { isMobileScreen };
}