<?php

class UsersTableSeeder extends Seeder {

    public function run() {
        
        User::truncate();
        
        $users = array(
            array(
                'username' => 'admin',
                'email' => 'admin@example.org',
                'password' => Hash::make('admin'),
                'confirmed' => 1,
                'confirmation_code' => md5(microtime() . Config::get('app.key')),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'username' => 'user',
                'email' => 'user@example.org',
                'password' => Hash::make('user'),
                'confirmed' => 1,
                'confirmation_code' => md5(microtime() . Config::get('app.key')),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'username' => 'user2',
                'email' => 'user2@example.org',
                'password' => Hash::make('user2'),
                'confirmed' => 1,
                'confirmation_code' => md5(microtime() . Config::get('app.key')),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            )
        );

        DB::table('users')->insert($users);
    }

}
