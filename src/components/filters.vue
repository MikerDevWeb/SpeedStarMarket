<script setup>
import { ref } from 'vue'
import { useVehciles } from '@/stores/home/useVehciles';

const filters = [
  {
    name: 'Todo',
    val: 'all'
  },
  {
    name: 'Autos',
    val: 'car'
  },
  {
    name: 'Motocicletas',
    val: 'bike'
  },
];

const actualFilter = ref('all');
const vehiclesStore = useVehciles();

function filterCards(type) {
  vehiclesStore.filterForType(type);
  actualFilter.value = type;
}
</script>

<template>
    <div class="filters__container show">
      <button class="filters__btn glass" v-for="fil in filters" :class="{filters__btn_active: actualFilter === fil.val}" @click="filterCards(fil.val)">{{ fil.name }}</button>
    </div>
  </template>

<style scoped>
.filters__container {
  width: 100%;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 5px;
}
.filters__btn {
  flex: 1;
  height: 30px;
  font-size: 80%;
}

@media (min-width: 1025px) {
  .filters__container {
    width: 60%;
    gap: 10px;
  }
}

/* @media (min-width: 1025px) {
  .filters__container {
      width: 90%;
      height: 50px;
      margin: 1rem auto;
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 4rem;
  }
  .filters__btn {
      width: 40%;
      height: 40px;
      border: none;
      border-radius: 0.5rem;
      font-size: 1.5rem;
      padding: 1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      letter-spacing: 1px;
      cursor: pointer;
      transition: all .2s ease;
  }
  .filters__btn:hover {
      background-color: black;
      color: white;
  }
}
@media (max-width: 480px) {
    .filters__container {
      width: 100%;
      height: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px 0;
      gap: 10px;
    }
    .filters__btn {
      flex: 1;
      height: 40px;
      border-radius: 5px;
      border: none;
      font-size: 100%;
      letter-spacing: 1px;
    }
} */


.filters__btn_active {
  background-color: black;
  color: white;
}
.filters__btn:active {
  transform: scale(0.9);
}
</style>