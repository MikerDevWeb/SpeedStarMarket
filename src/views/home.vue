<script setup>
import { ref, onMounted, inject, watch } from 'vue'
import vehicleCard from '/src/components/vehicleCard.vue'
import searchBanner from '/src/components/searchBanner.vue'
import filters from '/src/components/filters.vue'
import skeleton_loading from '@/components/skeleton_loading.vue'
import { useVehciles } from '@/stores/home/useVehciles'
import axios from 'axios'
import { storeToRefs } from 'pinia'

const vehicles = ref([])
const error = ref(false);
const loading = ref(true)
const apilink = inject('apilink');


function insertShuffled(array) {
    const arr = [...array];

    for(let i = arr.length - 1; i > 0; i--) {
      const j = Math.floor(Math.random() * (i + 1));
      [arr[i], arr[j]] = [arr[j], arr[i]];
    }

    return arr;
}

const vehiclesStore = useVehciles();
const {vehiclesInScreen, vehilesInStorage} = storeToRefs(vehiclesStore);

const getVehicles = async() => {
  loading.value = true;
  error.value = false;
  vehicles.value = [];
  try {
    const response = await axios.get(`${apilink}/allContent.php`);
    if(response.data.success) {
      const preLoading = response.data.vehicles;
      vehicles.value = insertShuffled(preLoading);
      vehiclesStore.setVehicles(vehicles.value);
    } else {
      error.value = true;
    }

  } catch {
    error.value = true;
  } finally {
    loading.value = false;
  }
}

watch(vehiclesInScreen, (newArray) => {
  vehicles.value = newArray;
});


onMounted(() => {
  getVehicles()
});
</script>

<template>
 <div class="pageContent">
  <template v-if="loading">
    <skeleton_loading h="100px"/>
    <div class="cardsContainer">
      <vehicleCard v-for="n in 4" :key="n" w="100%" h="120px"/>
    </div>
  </template>
  <template v-else>
    <searchBanner/>
    <filters/>
    <span class="emptyVehicles show" v-if="vehicles.length < 1">Sin vehículos publicados actualmente</span>
     <div class="cardsContainer" v-else>
       <vehicleCard v-for="vehicle in vehicles" :key="vehicle.id" :vehicleParam="vehicle"/>
     </div>
  </template>
  </div>
</template>

<style scoped>
.pageContent {
  gap: 0.5rem;
}

.emptyVehicles {
  width: 100%;
  height: 100px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: clamp(80%, 100%, 100%);
  letter-spacing: 1px;
  text-align: center;
}


@media (min-width: 1025px) {
  .cardsContainer {
    width: 90%;
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    margin: 1rem auto;
  }
  .emptyVehicles {
    font-size: 1.5rem;
  }
}

@media (max-width: 480px) {
  .cardsContainer {
    width: 100%;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
  }
}
</style>