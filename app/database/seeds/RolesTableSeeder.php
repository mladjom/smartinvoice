<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
        Role::truncate();

        $adminRole = new Role;
        $adminRole->name = 'admin';
        $adminRole->save();

        $resellerRole = new Role;
        $resellerRole->name = 'reseller';
        $resellerRole->save();

        $clientRole = new Role;
        $clientRole->name = 'user';
        $clientRole->save();

        $subscriberRole = new Role;
        $subscriberRole->name = 'subscriber';
        $subscriberRole->save();        
				
        $user = User::where('username','=','admin')->first();
        $user->attachRole( $adminRole );
				
        $user = User::where('username','=','user')->first();
        $user->attachRole( $clientRole );
 
        $user = User::where('username','=','user2')->first();
        $user->attachRole( $clientRole );        
        
    }

}
