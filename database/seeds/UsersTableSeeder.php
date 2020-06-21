<?php

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
        # Seed 1 Admin user
    	factory(App\User::class, 1)->create([
    		'email' => 'admin@gmail.com',
    		'password' => bcrypt('password'),
    		'role' => 'admin'
    	]);

        # Seed 25 normal users
        factory(App\User::class, 25)->create(['role'=>'user']);
    }
}
