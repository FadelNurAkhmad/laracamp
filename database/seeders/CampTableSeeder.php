<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Camp;

class CampTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $camps = [
            [
                'title' => 'Gila Belajar',
                'slug' => 'gila-belajar',
                'price' => 280,
                'created_at' => date('Y-m-d H:i:s', time()), // time, waktu saat ini
                'updated_at' => date('Y-m-d H:i:s', time()),
            ],
            [
                'title' => 'Baru Mulai',
                'slug' => 'baru-mulai',
                'price' => 140,
                'created_at' => date('Y-m-d H:i:s', time()), // time, waktu saat ini
                'updated_at' => date('Y-m-d H:i:s', time()),
            ]
        ];

        // 1st method,  input ke db nanti diulang, created_at & updated_at tidak harus ditulis di seeder
        // foreach ($camps as $key => $camp) {
        //     Camp::create($camp);
        // }

        // 2nd method,   created_at & updated_at harus ditulis di seeder, kalau tidak nanti hasil null di db
        Camp::insert($camps);
    }
}
