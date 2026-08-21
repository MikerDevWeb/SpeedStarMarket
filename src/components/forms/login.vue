<script setup>
import { inject, ref } from 'vue';
import { setToken } from '@/composables/useAuthToken';

//icons
import arrobaIcon from '@/assets/icons/login/arroba.svg';
import lockIcon from '@/assets/icons/login/lock.svg';
import visibilityOff from '@/assets/icons/login/visibility_off.svg';
import visibilityOn from '@/assets/icons/login/visibility_on.svg';
import loadingIco from '@/assets/icons/progress_activity.svg';
import axios from 'axios';
import { useRouter } from 'vue-router';

const paswordIcon = ref(visibilityOn);
const passwordType = ref('password');

const togglePassword = () => {
    if(paswordIcon.value === visibilityOn) {
        paswordIcon.value = visibilityOff;
        passwordType.value = 'text';
    } else {
        paswordIcon.value = visibilityOn;
        passwordType.value = 'password';
    }
}

const formMsg = ref('');

const username = ref('');
const password = ref('');

const loading = ref(false);
const api = inject('apilink');
const router = useRouter();

const sendLogin = async() => {
    formMsg.value = '';
    loading.value = true;

    if(password.value.length < 8) {
        formMsg.value = 'Usuario o contraseña incorrectos';
        loading.value = false;
        return;
    }

    const dataBody = {
        user: username.value,
        password: password.value
    }

    try {
        const response = await axios.post(`${api}/login/login.php`, dataBody);

        console.log(response.data);
        if(response.data.success) {
            setToken(response.data.auth);
            router.push('/dashboard');
        } else {
            formMsg.value = response.data.message;
        }

    } catch {
        formMsg.value = 'Error al iniciar sesión';
    } finally {
        loading.value = false;
    }

}
</script>

<template>
  <form class="form show" @submit.prevent="sendLogin">
    <div class="loadingForm glass show" v-show="loading">
        <img :src="loadingIco" alt="Cargando" class="loadingForm__icon roll">
    </div>
    <span class="formMsg show" v-if="formMsg">{{ formMsg }}</span>
    <div class="form__label">
        <img :src="arrobaIcon" alt="Nombre de usuario" loading="lazy" class="form__label--icon">
        <input type="text" class="form__label--input" placeholder="Nombre de usuario" requred v-model="username">
    </div>
    <div class="form__label">
        <img :src="lockIcon" alt="Nombre de usuario" loading="lazy" class="form__label--icon">
        <input :type="passwordType" class="form__label--input" placeholder="Contraseña" requred v-model="password">
        <img :src="paswordIcon" alt="Mostrar" @click="togglePassword" class="form__label--icon password">
    </div>
    <button class="form__submit" type="submit">Iniciar sesíon</button>
  </form>
</template>

<style scoped src="/src/styles/singUpForms.css">
</style>