<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCount = $this->command->ask('How many users need create?',5);
        $elseUsers = User::factory()->count($usersCount)->create();
        $nastya = User::factory()->NastyaGorobets()->create();

        $users = $elseUsers->concat([$nastya]);
    }
}
