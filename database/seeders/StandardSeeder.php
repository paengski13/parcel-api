<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

Use App\Models\Standard;

class StandardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'model' => 'weight',
                'measurement' => 'kilogram',
                'measurement_symbol' => 'kg',
                'unit' => 5.00,
                'description' => '$unit per each kilogram of weight'
            ],
            [
                'model' => 'volume',
                'measurement' => 'cubic metre',
                'measurement_symbol' => 'm³',
                'unit' => 1000.00,
                'description' => '$unit per each cubic metre of volume'
            ],
            [
                'model' => 'value',
                'measurement' => 'percentage',
                'measurement_symbol' => '%',
                'unit' => 3.00,
                'description' => '$unit% of the declared parcel value'
            ],
        ];

        foreach ($data as $row) {
            Standard::create($row);
        }
    }
}
