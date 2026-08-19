import { defineStore } from "pinia";
import { ref } from "vue";

export const useVehciles = defineStore('useVehicles', () => {
    const vehiclesInScreen = ref([]);
    const vehilesInStorage = JSON.parse(localStorage.getItem('vehiclesHome')) || [];

    function filterForType(type) {
        if(type === 'all') {
            vehiclesInScreen.value = vehilesInStorage;
        } else {
            const newVehicles = vehilesInStorage.filter(item => item.type === type);
            vehiclesInScreen.value = newVehicles;
        }
    }

    function setVehicles(items) {
        localStorage.setItem('vehiclesHome', JSON.stringify(items));
        vehiclesInScreen.value = items;
    }

    return {
        vehiclesInScreen,
        filterForType,
        setVehicles
    }

})