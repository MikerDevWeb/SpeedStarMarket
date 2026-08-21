<script setup>
import { useRoute, useRouter } from 'vue-router';
import { ref } from 'vue';

//icons
import homeOff from '@/assets/icons/navbar/home_off.svg';
import homeOn from '@/assets/icons/navbar/home_on.svg';
import searchOff from '@/assets/icons/navbar/search_off.svg';
import searchOn from '@/assets/icons/navbar/search_on.svg';
import accountOff from '@/assets/icons/navbar/account_off.svg';
import accountOn from '@/assets/icons/navbar/account_on.svg';

import menuIcon from '@/assets/icons/navbar/menu.svg';
import closeBtn from '@/assets/icons/close.svg';

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

const navBarOpen = ref(false);
const showBtnTxt = ref(false);
const router = useRouter();
const route = useRoute();

const toggleOpen = () => {
    if(navBarOpen.value === true) {
        navBarOpen.value = false;
        showBtnTxt.value = false;
    } else {
        navBarOpen.value = true;
        setTimeout(() => {
            showBtnTxt.value = true;
        }, 110);
    }
}

const goSection = (link) => {
    router.push(link);
}
</script>

<template>
  <div class="navBar glass" :class="{navBar__open: navBarOpen}">
    <button class="navBar__action" @click="toggleOpen" :class="{navBar__action__open: navBarOpen}">
        <img :src="menuIcon" alt="Abrir" v-if="!navBarOpen" class="navBar__action--icon">
        <img :src="closeBtn" alt="Cerrar" class="navBar__action--icon" v-else>
    </button>
    <button v-for="btn in nevSections" :class="{navBar__secAtive: route.path === btn.link, navBar__btn_open: navBarOpen, navBar__btn: !navBarOpen}" @click="goSection(btn.link)">
        <img :src="btn.icon_off" :alt="btn.name" class="navBar__btn--icon" v-if="route.path !== btn.link" loading="lazy">
        <img :src="btn.icon_on" :alt="btn.name" class="navBar__btn--icon" v-else loading="lazy">
        <span class="navBar__btn--name show" v-show="navBarOpen && showBtnTxt">{{ btn.name }}</span>
    </button>
  </div>
</template>

<style scoped>
.navBar {
    width: 3%;
    height: 100vh;
    position: fixed;
    top: 50px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    padding: 10px 0;
    gap: 1rem;
    box-shadow: none;
    border-radius: 0;
    z-index: 9;
    transition: all .1s ease-in-out;
}
.navBar__action {
    width: 30px;
    height: 30px;
    border: transparent;
    background-color: transparent;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}
.navBar__action--icon {
    width: 25px;
    height: 25px;
}
.navBar__btn {
    width: 80%;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: transparent;
    border: none;
    border-radius: var(--radius-standard);
    cursor: pointer;
}

.navBar__btn--icon {
    width: 25px;
    height: 25px;
}

.navBar__btn--name {
    color: var(--blackColor);
    font-size: 100%;
    font-weight: bold;
}

/* bar open */
.navBar__open {
    width: 10%;
}
.navBar__btn_open {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 0 10px;
    width: 90%;
    height: 45px;
    border-radius: var(--radius-standard);
    border: none;
    background-color: transparent;
    gap: 5px;
    cursor: pointer;
}
.navBar__secAtive {
    background-color: var(--blackColor);
}
.navBar__secAtive > span {
    color: var(--background-page);
}

.navBar__action__open {
    background-color: var( --error-color);
    width: 30px;
    height: 30px;
    margin-left: auto;
    margin-right: 10px;
    border-radius: 5px;
}
</style>