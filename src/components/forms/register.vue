<script setup>
import { inject, ref, watch } from 'vue';
import { useRouter } from 'vue-router';
import { setToken } from '@/composables/useAuthToken';
import { isValidUsername } from '@/utils/validUsername';
import axios from 'axios';

//icons
import arrobaIcon from '@/assets/icons/login/arroba.svg';
import lockIcon from '@/assets/icons/login/lock.svg';
import reLockIcon from '@/assets/icons/login/lock_reset.svg';
import loadingIco from '@/assets/icons/progress_activity.svg';

const formMsg = ref('');

const userName = ref('');
const userPassword = ref('');
const passwordConfirm = ref('');

const api = inject('apilink');
const loading = ref(false);
const router = useRouter();
const sendRegister = async() => {
    loading.value = true;
    formMsg.value = '';
    if(userPassword.value !== passwordConfirm.value) {
        formMsg.value = 'Las contraseñas deben coincidir';
        loading.value = false;
        return;
    }

    if(userPassword.value.length < 8) {
        formMsg.value = 'La contraseña debe contener al menos 8 caracteres';
        loading.value = false;
        return;
    }

    const dataBody = {
        user: userName.value,
        password: userPassword.value
    };

    try {
        const response = await axios.post(`${api}/login/register.php`, dataBody);


        if(response.data.success) {
            setToken(response.data.auth);
            router.push('/dashboard');
        } else {
            formMsg.value = response.data.message;
        }
    } catch {
        formMsg.value = 'Error al generar tu registro';
    } finally {
        loading.value = false;
    }
}

watch(userName, (newVal) => {
    if(newVal.length > 2) {
        const isValid = isValidUsername(newVal);
        if(!isValid) {
            formMsg.value = 'El nombre de usuario solo puede contener letras, números y guion bajo, sin espacios';
        } else {
            formMsg.value = '';
        }
    } else {
        formMsg.value = '';
    }
})
</script>

<template>
  <form class="form show" @submit.prevent="sendRegister">
    <div class="loadingForm glass show" v-show="loading">
        <img :src="loadingIco" alt="Cargando" class="loadingForm__icon roll">
    </div>
    <span class="formMsg show" v-if="formMsg">{{ formMsg }}</span>
    <div class="form__label">
        <img :src="arrobaIcon" alt="Nombre de usuario" loading="lazy" class="form__label--icon">
        <input type="text" class="form__label--input" placeholder="Nombre de usuario" requred v-model="userName">
    </div>
    <div class="form__label">
        <img :src="lockIcon" alt="Nombre de usuario" loading="lazy" class="form__label--icon">
        <input type="text" class="form__label--input" placeholder="Contraseña (Al menos 8 caracteres)" requred v-model="userPassword">
    </div>
    <div class="form__label">
        <img :src="reLockIcon" alt="Nombre de usuario" loading="lazy" class="form__label--icon">
        <input type="text" class="form__label--input" placeholder="Confirma tu contraseña" requred v-model="passwordConfirm">
    </div>
    <button class="form__submit" type="submit">Registrarme</button>
  </form>
</template>

<style scoped src="/src/styles/singUpForms.css">
</style>