<script setup>
import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'
import skeleton_loading from './skeleton_loading.vue';
import { capitalize } from '@/utils/capitalize.js';
import { formatPrice } from '@/utils/formatPrice.js';

const props = defineProps({
  vehicleParam: {
    type: Object,
    default: {}
  }
})

const vehicle = ref(props.vehicleParam);
const imageLink = inject('vehicleImg');
const router = useRouter()

function goToView() {
  router.push({ name: 'vehicleView', query: { id: vehicle.value.id } })
}
</script>

<template>
  <div class="vehicle__Card show" v-if="Object.keys(vehicle).length < 1">
    <skeleton_loading/>
    <skeleton_loading h="160px"/>
    <skeleton_loading/>
    <skeleton_loading/>
    <skeleton_loading/>
  </div>
  <div class="vehicle__Card show glass" @click="goToView" :data-card-type="vehicle.type" v-else>
    <img :src="`${imageLink}/${vehicle.image}`" :alt="vehicle.model" class="vehicle__Card-img" loading="lazy"/>
    <span class="vehicle__Card--info">
      <span class="vehicle__Card-title">{{ capitalize(vehicle.brand) }} {{ capitalize(vehicle.model) }} - {{ vehicle.year }}</span>
      <span class="vehicle__card-price">{{ formatPrice(vehicle.price) }} • {{ vehicle.mileage }}Km</span>
      <span class="vehicle__card--id">ID: {{ vehicle.id }}</span>
      <span class="vehicle__card-location">{{ capitalize(vehicle.location) }}</span>
    </span>
  </div>
</template>

<style scoped>
.vehicle__Card {
  height: 290px;
  border-radius: var(--radius-standard);
  background-color: var(--card-background);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  padding: 10px;
  gap: 10px;
  cursor: pointer;
}
.vehicle__Card-title {
  width: 100%;
  font-size: clamp(0.5rem, 0.9rem, 1rem);
  font-weight: bold;
}
.vehicle__Card-img {
  width: 100%;
  height: 200px;
  border-radius: var(--radius-standard);
  object-fit: cover;
  filter: contrast(1);
}
.vehicle__Card--info {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  padding: 0 5px;
  gap: 3px;
}

.vehicle__card-price {
  width: 100%;
  font-size: 90%;
  font-weight: 500;
}

.vehicle__card-location, .vehicle__card--id  {
  font-size: clamp(60%, 75%, 80%);
  font-weight: 500;
  color: var(--muted-text);
}

@media (min-width: 1025px) {
  .vehicle__Card {
    width: 200px;
  }
}

@media (max-width: 480px) {
  .vehicle__Card {
    flex: 1;
  }
}

/* @media (min-width: 1025px) {
  .vehicle__Card {
    border: none;
    background-color: buttonface;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    width: 250px;
    height: 310px;
    gap: 10px;
    border-radius: 10px;
    transition: all .2s ease;
    padding: 5px;
    transform: scale(0.9);
    cursor: pointer;
  }
  .vehicle__Card-img {
    width: 240px;
    height: 160px;
    border-radius: 5px;
    object-fit: contain;
  }
  .vehicle__Card-title {
    font-size: 110%;
    width: 100%;
    font-weight: 600;
  }
  .vehicle__Card:hover {
    box-shadow: 0 0 1rem black;
    transform: scale(1);
  }
  .vehicle__Card-title-e404 {
    font-size: 20px;
  }
  .vehicle__card-price {
    width: 100%;
    font-size: 102%;
    font-weight: bold;
    margin-left: 15px;
  }
  .vehicle__card-mileage {
    width: 100%;
    font-size: 100%;
    font-weight: 600;
    margin-left: 15px;
  }
  .vehicle__card-location {
    width: 100%;
    font-size: 90%;
    font-weight: 500;
    letter-spacing: 1px;
    margin-left: 15px;
  }
}
@media (max-width: 480px) {
  .vehicle__Card {
    min-width: 150px;
    height: 260px;
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
    background-color: buttonface;
    border-radius: 5px;
    padding: 10px;
    gap: 5px;
  }
  .vehicle__Card-img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 5px;
  }
  .vehicle__Card-title {
    font-size: 90%;
    width: 100%;
    font-weight: 600;
  }
  .vehicle__card-price {
    width: 100%;
    font-size: 102%;
    font-weight: bold;
  }
  .vehicle__card-mileage {
    width: 100%;
    font-size: 100%;
    font-weight: 600;
  }
  .vehicle__card-location {
    width: 100%;
    font-size: 90%;
    font-weight: 500;
    letter-spacing: 1px;
  }
} */
</style>