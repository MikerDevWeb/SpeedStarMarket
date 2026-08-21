<script setup>
import { useRouter } from 'vue-router';
import publishIcon from '@/assets/icons/publish.svg';

const router = useRouter();

function goHome() {
    router.push({ name: 'Home' });
}

function goSell() {
    router.push({ name: 'sellMyVehicle' });
}
</script>

<template>
    <header class="glass">
        <a class="header__name" @click="goHome">
            <img src="/public/logo.svg" alt="logotipo" class="header__logo">
            <span class="header__title">SpeedStarMarket</span>
        </a>
            <a class="header__sale" @click.prevent="goSell">
                <img :src="publishIcon" alt="Publicar" class="header__sale--icon">
            </a>
    </header>
</template>

<style scoped>
header {
    width: 100%;
    height: 50px;
    border-radius: 0;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 10px;
    z-index: 9;
}
.header__name {
    width: max-content;
    height: 90%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 3px;
}
.header__logo {
    width: 20px;
    height: 20px;
}
.header__title {
    font-size: 85%;
    font-weight: 600;
}
.header__sale {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: var(--blackColor);
    border-radius: var(--radius-standard);
}

.header__sale--icon {
    width: 20px;
    height: 20px;
}
.glass {
  backdrop-filter: blur(20px);
}
</style>