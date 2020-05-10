<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $users = [
           [
               'name' => 'Unknown author',
               'email' => 'unknown@m.m',
               'password' => bcrypt(md5(microtime())),
           ],
           [
               'name' => 'Author',
               'email' => 'author@m.m',
               'password' => bcrypt('password'),
           ],
       ];

       DB::table('users')->insert($users);
    }
}
