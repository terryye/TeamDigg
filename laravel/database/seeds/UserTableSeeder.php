<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->delete();
        User::create([
            "id"    => '1',
            'name' => 'terryye',
            'email'   => 'hi@terryye.org',
            'password'    => '$2y$10$TuehhjYdCus/06AIRqhLB.UIjEUoJRDrq4ScPaQbQSZ9duKxo4lU6'
        ]);
    }
}
