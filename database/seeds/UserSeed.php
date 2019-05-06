<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'position' => null, 'email' => 'admin@admin.com', 'password' => '$2y$10$rZyy6vMXnELanTFqQAMw7O5ZUuH5BKkqA5MQ5N7uv8wqeqW1avi.2', 'phone' => null, 'id_number' => null, 'salary' => null, 'role_id' => 1, 'department_id' => null, 'mac_adress' => null, 'remember_token' => '',],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
