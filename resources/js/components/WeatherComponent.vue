<template>
    <div class="app-container">

        <form @submit.prevent="fetchWeather" class="weather-form">
            <input v-model="city" placeholder="Введите город" class="weather-input">
            <button type="submit" class="weather-button">Узнать погоду</button>
        </form>

        <div v-if="isLoading" class="loading-animation">Загрузка...</div>

        <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>

        <WeatherDisplay v-if="isValidWeatherData" :data="weatherData"/>
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
            weatherData: null,
            errorMessage: null,
            isLoading: false
        };
    },
    computed: {
        isValidWeatherData() {
            return this.weatherData && this.weatherData.main && this.weatherData.weather && this.weatherData.sys && this.weatherData.wind;
        }
    },
    methods: {
        async fetchWeather() {
            try {
                this.isLoading = true;
                const responseData = await fetchWeatherData(this.city);
                if (responseData.error) {
                    this.errorMessage = responseData.error;
                    this.weatherData = null;
                } else {
                    this.weatherData = responseData;
                    this.errorMessage = null;
                }
                this.isLoading = false;
            } catch (error) {
                this.weatherData = null;
                this.errorMessage = "Возникла непредвиденная ошибка, попробуйте позже";
                console.error("Ошибка при получении погоды:", error);
            }
        }

    }
}
</script>


<style src="../../css/WeatherComponentStyles.css"></style>

