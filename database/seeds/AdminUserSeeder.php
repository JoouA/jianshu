<?php

use Illuminate\Database\Seeder;
use App\AdminUser;
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'admin',
            'password' => bcrypt('admin'),
            'remember_token' => str_random(100),
        ];

        AdminUser::create($data);
    }
}
