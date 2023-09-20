@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Форма ввода города -->
        <form action="{{ route('fetch.weather') }}" method="post">
            @csrf
            <input type="text" name="city" placeholder="Введите город">
            <button type="submit">Получить погоду</button>
        </form>

        <!-- Отображение погоды -->
        @if (isset($weatherData))
            <div id="weatherDisplay">
                <h2>Погода в {{ $weatherData['name'] }}</h2>
                <p>Температура: {{ $weatherData['main']['temp'] }}°C</p>
                <p>Описание: {{ $weatherData['weather'][0]['description'] }}</p>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>

    </script>
@endsection
