<?php

namespace Database\Seeders;

use App\Models\AssetStatus;
use Illuminate\Database\Seeder;

class AssetStatusTableSeeder extends Seeder
{
    public function run()
    {
        $assetStatuses = [
            [
                'id'         => 1,
                'name'       => 'Available',
                'created_at' => '2024-08-27 08:42:25',
                'updated_at' => '2024-08-27 08:42:25',
            ],
            [
                'id'         => 2,
                'name'       => 'Not Available',
                'created_at' => '2024-08-27 08:42:25',
                'updated_at' => '2024-08-27 08:42:25',
            ],
            [
                'id'         => 3,
                'name'       => 'Broken',
                'created_at' => '2024-08-27 08:42:25',
                'updated_at' => '2024-08-27 08:42:25',
            ],
            [
                'id'         => 4,
                'name'       => 'Out for Repair',
                'created_at' => '2024-08-27 08:42:25',
                'updated_at' => '2024-08-27 08:42:25',
            ],
        ];

        AssetStatus::insert($assetStatuses);
    }
}
