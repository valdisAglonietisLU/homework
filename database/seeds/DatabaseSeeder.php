<?php

use Illuminate\Database\Seeder;
use App\User as User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserTableSeeder::class);
    }
}


class UserTableSeeder extends Seeder {

    public function run() {
        User::truncate();

        User::create( [
            'email' => 'admin@admin.com' ,
            'password' => Hash::make( 'admin' ) ,
            'name' => 'admin' ,
            'admin' => '1',
        ] );
    }
}
