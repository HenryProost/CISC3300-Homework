// weather.js
document.addEventListener('DOMContentLoaded', function() {
    // API URL with parameters for NYC (latitude: 40.7128, longitude: -74.0060)
    const apiUrl = "https://api.open-meteo.com/v1/forecast?latitude=40.7128&longitude=-74.0060&current_weather=true&temperature_unit=fahrenheit";
    
    // Function to fetch and display weather
    async function fetchWeather() {
        try {
            const response = await fetch(apiUrl);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const data = await response.json();
            const temperature = data.current_weather.temperature;
            
            // Find weather display element and update it
            const weatherElement = document.getElementById('weather-display');
            if (weatherElement) {
                weatherElement.innerHTML = `
                    <div class="weather-info">
                        <p>Current Temperature: ${temperature}°F</p>
                    </div>
                `;
            }
        } catch (error) {
            console.error('Error fetching weather:', error);
            const weatherElement = document.getElementById('weather-display');
            if (weatherElement) {
                weatherElement.innerHTML = '<p>Weather data unavailable</p>';
            }
        }
    }

    // Initial fetch
    fetchWeather();
});