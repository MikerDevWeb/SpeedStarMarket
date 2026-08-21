<script setup>

//icons
import homeOff from '@/assets/icons/navbar/home_off.svg';
import homeOn from '@/assets/icons/navbar/home_on.svg';
import searchOff from '@/assets/icons/navbar/search_off.svg';
import searchOn from '@/assets/icons/navbar/search_on.svg';
import accountOff from '@/assets/icons/navbar/account_off.svg';
import accountOn from '@/assets/icons/navbar/account_on.svg';
import { useRoute, useRouter } from 'vue-router';

const nevSections = [
    {
        name: 'Inicio',
        link: '/',
        icon_off: homeOff,
        icon_on: homeOn
    },
    {
        name: 'Explorar',
        link: '/searching',
        icon_off: searchOff,
        icon_on: searchOn
    },
    {
        name: 'Mi cuenta',
        link: '/account',
        icon_off: accountOff,
        icon_on: accountOn
    }
];

const route = useRoute();
const router = useRouter();

const changeSection = (link) => {
    router.push(link);
}
</script>

<template>
  <nav class="navbar glass">
    <button type="button" class="navBar__btn" v-for="sec in nevSections" :class="{optionActive: route.path === sec.link}" @click="changeSection(sec.link)">
        <img :src="sec.icon_on" :alt="sec.name" class="btn__icon" loading="lazy" v-if="route.path === sec.link">
        <img :src="sec.icon_off" :alt="sec.name" class="btn__icon" loading="lazy" v-else>
        <span class="btn__name" :class="{optionActive: route.path === sec.link}">{{ sec.name }}</span>
    </button>
  </nav>
</template>

<style scoped>
.navbar {
    width: 100%;
    height: 50px;
    position: fixed;
    bottom: -1px;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    z-index: 9;
    animation: openBar 1s forwards;
}
.navBar__btn {
    width: 70px;
    height: 40px;
    background-color: transparent;
    border: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border-radius: var(--radius-standard);
    transform: scale(0.9);
}

.btn__icon {
    width: 18px;
    height: 18px;
}
.btn__name {
    color: var(--muted-text);
    font-weight: 700;
    letter-spacing: 1px;
    font-size: 80%;
    color: var(--blackColor);
}
.optionActive {
    background-color: var(--blackColor);
    color: var(--background-page);
    /* transform: scale(1); */
}

@keyframes openBar {
    0% {
        opacity: 0;
        transform: translateY(50px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>