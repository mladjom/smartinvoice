<?php

// Composer: "fzaninotto/faker": "v1.4.0"

class ClientsTableSeeder extends Seeder {

    public function run() {
        $faker = Faker\Factory::create();

        Client::truncate();

        foreach (range(1, 10) as $index) {
            Client::create([
                'user_id' => 2,
                'name' => $faker->name,
                'email' => $faker->email,
                'address_1' => $faker->streetAddress,
                'city' => $faker->city,
                'zip' => $faker->postcode,
                'country_id' => 840,
                'phone' => $faker->phoneNumber ,
                'web' => $faker->url,
            ]);
        }
    }

}
