<template>
    <div>
        <form @submit.prevent="fetchWeather">
            <input v-model="city" placeholder="Введите город">
            <button type="submit">Получить погоду</button>
        </form>

        <div v-if="weatherData">
            <h2>Погода в {{ weatherData.name }}</h2>
            <p>Температура: {{ weatherData.main.temp }}°C</p>
            <p>Описание: {{ weatherData.weather[0].description }}</p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            city: '',
            weatherData: null
        };
    },
    methods: {
        async fetchWeather() {
            try {
                const response = await fetch('/fetch-weather', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ city: this.city })
                });
                const responseData = await response.json();
                this.weatherData = responseData;
            } catch (error) {
                console.error("Ошибка при получении погоды:", error);
            }
        }
    }
}
</script>
