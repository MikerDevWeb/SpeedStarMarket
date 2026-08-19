import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import Router from '/router/router.js'

const app = createApp(App)

app.use(createPinia());
app.use(Router)
app.provide('apilink', 'http://localhost/api/endpoint/');
app.provide('vehicleImg', 'http://localhost/api/vehiclesImgs/');
app.mount('#app')
