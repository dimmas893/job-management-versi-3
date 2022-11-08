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
        $user = new User();
        $user->name = "anggota";
        $user->jabatan = "anggota";
        $user->email = "anggota@mail.com";
        $user->password = bcrypt('password'); 
        $user->save();
    }
}
