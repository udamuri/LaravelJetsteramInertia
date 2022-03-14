<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Village;

class VellageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayData = [
			[
				'kelurahan' => 'Pandeyan',
				'kecamatan' => 'Umbulharjo',
				'kota' => 'Yogyakarta',
			],
			[
				'kelurahan' => 'Semaki',
				'kecamatan' => 'Umbulharjo',
				'kota' => 'Yogyakarta',
			]
		];

		foreach($arrayData as $value) {
			Village::create($value);
		}
    }
}
