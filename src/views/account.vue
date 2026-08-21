<script setup>
import { onMounted, ref } from 'vue';
import { getToken } from '@/composables/useAuthToken';
import logo from '../../public/logo.svg';
import login from '@/components/forms/login.vue';
import register from '@/components/forms/register.vue';
import { useRouter } from 'vue-router';

const headerSubtitle = ref('Ingresa tus credenciales para continuar');
const headerTitle = ref('¡Hola de nuevo!');
const showLogin = ref(true);

const formQuestion = ref('¿No tienes una cuenta?');
const toggleBtnTxt = ref('Registrate');

const toggleForms = () => {
  if(showLogin.value === true) {
    showLogin.value = false;
    formQuestion.value = '¿Ya tienes una cuenta?';
    toggleBtnTxt.value = 'Inicia sesión';
    headerSubtitle.value = 'Ingresa los siguientes datos para continuar';
    headerTitle.value = 'Bienvenido';
  } else {
    showLogin.value = true;
    formQuestion.value = '¿No tienes una cuenta?';
    toggleBtnTxt.value = 'Registrate';
    headerSubtitle.value = 'Ingresa tus credenciales para continuar';
    headerTitle.value = '¡Hola de nuevo!';
  }
}

const router = useRouter();

onMounted(()=>{
    const findToken = getToken();
    if(findToken) {
      router.push('/dashboard');
    }
})
</script>

<template>
  <div class="pageContent">
    <div class="accountHeader">
      <img :src="logo" alt="Logotipo" class="accountHeader__icon">
      <h1>{{ headerTitle }}</h1>
      <h2 class="headerSubtitle">{{ headerSubtitle }}</h2>
    </div>
    <div class="account__forms glass">
      <login v-show="showLogin"/>
      <register v-show="!showLogin"/>
      <div class="formsToggle">
        <span class="formsToggle__question">{{ formQuestion }}</span>
        <span class="formsToggle__btn" @click="toggleForms">{{ toggleBtnTxt }}</span>
      </div>
    </div>
  </div>
</template>

<style scoped>
.accountHeader {
  width: 100%;
  height: 200px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  gap: 5px;
}
.accountHeader__icon {
  width: 90px;
  height: 90px;
}
.headerSubtitle {
  width: 90%;
  font-size: 90%;
  text-align: center;
  color: var(--muted-text);
}
.account__forms {
  width: 95%;
  min-height: 100px;
  padding: 10px;
}
.formsToggle {
  width: 100%;
  height: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 5px;
}
.formsToggle__question,  .formsToggle__btn {
  font-size: 85%;
  font-weight: 500;
}
.formsToggle__btn {
  text-decoration: underline;
  font-weight: 600;
  cursor: pointer;
}
</style>