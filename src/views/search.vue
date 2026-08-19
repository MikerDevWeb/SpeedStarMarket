<script setup>
import { useVehciles } from '@/stores/home/useVehciles';
import filters from '@/components/filters.vue';
import vehicleCard from '@/components/vehicleCard.vue';
import axios from 'axios';
import { inject, onMounted, ref, watch } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { storeToRefs } from 'pinia';

const router = useRouter();
const route = useRoute();
const vehiclesStore = useVehciles();
const {vehiclesInScreen} = storeToRefs(vehiclesStore);

const api = inject('apilink');
const searchTerm = ref(route.query.search || '');

const loading = ref(true);
const items = ref([]);
const message = ref('');

const excecuteSearch = async() => {
    loading.value = true;
    message.value = '';
    if(searchTerm.value.length < 1) {
      await getRecentPublications();
      return;
    }

    try {
      const response = await axios.get(`${api}/search.php?search=${searchTerm.value}`);

      if(response.data.success) {
        items.value = response.data.items;
        if(items.value.length > 0) {
          vehiclesStore.setVehicles(items.value);
        } else {
          message.value = `Sin resultados para "${searchTerm.value}"`;
          showMessage.value = true;
          await getRecentPublications();
        }
      } else {
        message.value = response.data.message;
      }

    } catch {
      message.value = 'Error al procesar tu búsqueda';
      showMessage.value = true;
    } finally {
      loading.value = false;
    }
}

const showMessage = ref(false);

const getRecentPublications = async() => {
  loading.value = true;
  const vehiclesLocal = JSON.parse(localStorage.getItem('recentPublications')) || [];
  if(vehiclesLocal.length > 0) {
    items.value = vehiclesLocal;
    vehiclesStore.setVehicles(vehiclesLocal);
    loading.value = false;
    return;
  }

  try {
    const response = await axios.get(`${api}recentPublication.php`);

    items.value = response.data.items;
    vehiclesStore.setVehicles(items.value);
  } catch {
    message.value = 'Error inesperado';
  } finally {
    loading.value = false;
  }
}

onMounted(()=>{
  excecuteSearch();
});

let debounceTimer = null;

watch(searchTerm, (newVal) => {
  clearTimeout(debounceTimer);

  debounceTimer = setTimeout(() => {
    if(newVal === '') {
      getRecentPublications();
      showMessage.value = false;
    } else {
      excecuteSearch();
    }
  }, 500);
}, {immediate: true});

watch(vehiclesInScreen, (newVal) => {
  items.value = newVal;
})

</script>

<template>
  <div class="pageContent">
      <input type="text" class="search__term glass" v-model="searchTerm" :class="{desabledElement: loading}" placeholder="¿Que tienes en mente?">
      <filters v-if="items.length > 0 && !loading"/>
      <div class="itemsContainer" v-if="loading">
        <vehicleCard v-for="n in 6" :key="n"/>
      </div>
      <div class="itemsContainer" v-else>
        <template v-if="message">
          <span class="emptyMessage show" v-show="showMessage">{{ message }}</span>
          <span class="othersVehicles" v-if="items.length > 0">Vehículos que podrían interesarte</span>
          <vehicleCard v-for="item in items" :key="item.id" :vehicleParam="item"/>
        </template>
        <template v-else>
          <vehicleCard v-for="item in items" :key="item.id" :vehicleParam="item" v-if="items.length > 0"/>
          <span class="emptyMessage show" v-else>Sin resultados para "{{ searchTerm }}"</span>
        </template>
      </div>
  </div>
</template>

<style scoped>
.search__term {
  width: 100%;
  height: 40px;
  padding: 0 10px;
  font-size: 100%;
  outline: none;
  font-weight: 500;
  letter-spacing: 1px;
}
.itemsContainer {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 10px;
  width: 100%;
}
.emptyMessage {
  grid-column: span 2;
  font-size: 1.3rem;
  margin-top: 1rem;
  text-align: center;
  border-bottom: 1px solid var(--muted-text);
}
.desabledElement {
  pointer-events: none;
}
.othersVehicles {
  grid-column: span 2;
  font-size: 1.1rem;
  color: var(--muted-text);
  padding: 10px 0;
}
@media (min-width: 1025px) {
  .search__term {
    width: 70%;
    height: 50px;
  }
  .othersVehicles {
    font-size: 1.1rem;
    font-weight: 500;
    padding-top: 1rem;
    grid-column: span 6;
  }
  .emptyMessage {
    grid-column: span 6;
    padding: 1rem 0;
  }
  .itemsContainer {
    grid-template-columns: repeat(6, 1fr);
  }
}
</style>