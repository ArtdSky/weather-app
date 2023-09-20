export async function fetchWeatherData(city) {
    const response = await fetch('/fetch-weather', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ city })
    });
    return await response.json();
}
