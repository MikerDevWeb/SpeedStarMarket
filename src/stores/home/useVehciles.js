import { defineStore } from "pinia";
import { ref } from "vue";

export const useVehciles = defineStore('useVehicles', () => {
    const vehiclesInScreen = ref([]);
    const vehilesInStorage = ref(JSON.parse(localStorage.getItem('vehiclesHome')) || []);

    function filterForType(type) {
        if(type === 'all') {
            vehiclesInScreen.value = JSON.parse(localStorage.getItem('vehiclesHome'));
        } else {
            const newVehicles = vehilesInStorage.value.filter(item => item.type === type);
            vehiclesInScreen.value = newVehicles;
        }
    }

    function setVehicles(items) {
        localStorage.setItem('vehiclesHome', JSON.stringify(items));
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