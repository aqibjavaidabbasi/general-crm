<?php

namespace Database\Seeders;

use App\Models\ShareOption;
use Illuminate\Database\Seeder;

class ShareOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            'Facebook', 'LinkedIn', 'Digg', 'Pinterest', 'Twitter', 'Gmail',
            'Whatsapp', 'Reddit', 'Telegram', 'Email', 'Tumblr', 'VKontakte',
        ];

        foreach ($options as $option) {
            ShareOption::create([
                'name' => $option,
                'status' => true,
            ]);
        }
    }
}
