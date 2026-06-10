<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            'Colombia' => ['Bogotá', 'Medellín', 'Cali', 'Barranquilla', 'Cartagena'],
            'México' => ['Ciudad de México', 'Guadalajara', 'Monterrey', 'Puebla', 'Cancún'],
            'Argentina' => ['Buenos Aires', 'Córdoba', 'Rosario', 'Mendoza', 'La Plata'],
            'Brasil' => ['São Paulo', 'Río de Janeiro', 'Brasilia', 'Salvador', 'Fortaleza'],
            'Chile' => ['Santiago', 'Valparaíso', 'Concepción', 'Antofagasta', 'Viña del Mar'],
            'Perú' => ['Lima', 'Arequipa', 'Cusco', 'Trujillo', 'Chiclayo'],
            'España' => ['Madrid', 'Barcelona', 'Valencia', 'Sevilla', 'Bilbao'],
            'Estados Unidos' => ['Nueva York', 'Los Ángeles', 'Chicago', 'Houston', 'Miami'],
            'Canadá' => ['Toronto', 'Vancouver', 'Montreal', 'Ottawa', 'Calgary'],
            'Ecuador' => ['Quito', 'Guayaquil', 'Cuenca', 'Ambato', 'Manta'],
        ];

        foreach ($cities as $countryName => $cityNames) {
            $country = Country::where('name', $countryName)->first();
            if ($country) {
                foreach ($cityNames as $cityName) {
                    City::create([
                        'name' => $cityName,
                        'country_id' => $country->id,
                    ]);
                }
            }
        }
    }
}
