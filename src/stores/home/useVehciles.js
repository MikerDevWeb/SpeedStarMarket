import { defineStore } from "pinia";
import { ref } from "vue";

export const useVehciles = defineStore('useVehicles', () => {
    const vehiclesInScreen = ref([]);
    const vehilesInStorage = ref(JSON.parse(localStorage.getItem('vehiclesStorage')) || []);

    function filterForType(type) {
        if(type === 'all') {
            vehiclesInScreen.value = JSON.parse(localStorage.getItem('vehiclesStorage'));
        } else {
            const newVehicles = vehilesInStorage.value.filter(item => item.type === type);
            vehiclesInScreen.value = newVehicles;
        }
    }

    function setVehicles(items) {
        localStorage.setItem('vehiclesStorage', JSON.stringify(items));
        vehilesInStorage.value = items;
        vehiclesInScreen.value = items;
    }

    return {
        vehiclesInScreen,
        filterForType,
        setVehicles,
        vehilesInStorage
    }

})