<template>
    <div class="app-container">

        <form @submit.prevent="fetchWeather" class="weather-form">
            <input v-model="city" placeholder="Введите город" class="weather-input">
            <button type="submit" class="weather-button">Узнать погоду</button>
        </form>

        <WeatherDisplay :data="weatherData"/>
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


<style src="../../css/WeatherComponentStyles.css"></style>
