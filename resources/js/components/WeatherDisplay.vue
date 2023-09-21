<template>
    <div v-if="data" class="weather-container">
            <h2 class="weather-city">Погода в {{ data.name }}</h2>
            <img class="weather-icon" :src="weatherIconUrl" alt="Погодная иконка"/>
            <p class="weather-temperature">{{ data.main.temp }}°C</p>
            <p class="weather-description">{{ data.weather[0].description }}</p>

            <div class="details">
                <div class="detail-item">
                    <strong>Давление:</strong>
                    <p class="detail-item-pressure">{{ data.main.pressure }} hPa</p>
                </div>

                <div class="detail-item">
                    <strong>Влажность:</strong>
                    <p class="detail-item-humidity">{{ data.main.humidity }}%</p>
                </div>

                <div class="detail-item">
                    <strong>Ветер:</strong>
                    <p class="detail-item-speed">{{ data.wind.speed }} м/с, {{ data.wind.deg }}°</p>
                </div>

                <div class="detail-item">
                    <strong>Восход/Закат:</strong>
                    <p class="detail-item-sun">{{
                            new Date(data.sys.sunrise * 1000).toLocaleTimeString().slice(0, 5)
                        }} / {{ new Date(data.sys.sunset * 1000).toLocaleTimeString().slice(0, 5) }}</p>
                </div>
        </div>


    </div>
</template>

<script>
export default {
    props: {
        data: Object,
    },
    computed: {
        weatherIconUrl() {
            if (this.data && this.data.weather && this.data.weather[0].icon) {
                return `http://openweathermap.org/img/w/${this.data.weather[0].icon}.png`;
            }
            return '';
        }
    },
    methods: {
        convertToTime(timestamp) {
            const date = new Date(timestamp * 1000);
            return `${date.getHours()}:${date.getMinutes()}:${date.getSeconds()}`;
        }
    }
}
</script>


<style src="../../css/WeatherDisplayStyles.css"></style>
