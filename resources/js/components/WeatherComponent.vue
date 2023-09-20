<template>
    <div>
        <form @submit.prevent="fetchWeather">
            <input v-model="city" placeholder="Введите город">
            <button type="submit">Получить погоду</button>
        </form>

        <WeatherDisplay :data="weatherData" />
    </div>
</template>

<script>
import {fetchWeatherData} from "../service/weatherService.js";
import WeatherDisplay from "./WeatherDisplay.vue";

export default {
    components: {
        WeatherDisplay
    },
    data() {
        return {
            city: '',
            weatherData: null
        };
    },
    methods: {
        async fetchWeather() {
            try {
                this.weatherData = await fetchWeatherData(this.city)
            } catch (error) {
                console.error("Ошибка при получении погоды:", error);
            }
        }
    }
}
</script>
