import './bootstrap';
import { createApp } from 'vue';
import WeatherComponent from './components/WeatherComponent.vue';
import '../css/styles.css';


const app = createApp({});
app.component('weather-component', WeatherComponent);
app.mount('#app');
