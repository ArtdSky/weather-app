<template>
    <div v-if="data">
        <h2>Погода в {{ data.name }}</h2>
        <img :src="weatherIconUrl" alt="Погодная иконка" />
        <p>Температура: {{ data.main.temp }}°C</p>
        <p>Описание: {{ data.weather[0].description }}</p>
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
    }

}
</script>
