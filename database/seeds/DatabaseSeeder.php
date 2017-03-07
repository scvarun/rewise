<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
					'name' => 'Varun Chauhan',
					'username' => 'varun9509',
					'email' => 'varun9509@gmail.com',
					'password' => bcrypt('marciano'),
					'created_at' => new Datetime(),
					'updated_at' => new Datetime()
				]);
    }
}
