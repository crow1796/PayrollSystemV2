<?php

use Illuminate\Database\Seeder;
use App\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('bmpc_users')->delete();

        $users = [
        	[
                'permission_id' => 1,
                'username' => '2014-F0089', 
                'password' => bcrypt('admin'), 
                'first_name' => 'Joshua', 
                'middle_name' => 'Agagdan', 
                'last_name' => 'Tundag', 
                'email' => 'joshuatundag@gmail.com',
                'slug' => 'admin',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
        ];

        DB::table('bmpc_users')->insert($users);
    }
}
