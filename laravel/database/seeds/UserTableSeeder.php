<?php

use App\Team;
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
        User::updateOrCreate([
            "id"    => 1,
            'name' => 'terryye',
            'email'   => "hi@terryye.org",
            'password'    => '$2y$10$TuehhjYdCus/06AIRqhLB.UIjEUoJRDrq4ScPaQbQSZ9duKxo4lU6'
        ]);
        for($i=2; $i<40; $i++){
            User::updateOrCreate([
                "id"    => $i,
                'name' => '--用户--' . $i,
                'email'   => "hi{$i}@terryye.org",
                'password'    => '$2y$10$TuehhjYdCus/06AIRqhLB.UIjEUoJRDrq4ScPaQbQSZ9duKxo4lU6'
            ]);

        }

    }
}
