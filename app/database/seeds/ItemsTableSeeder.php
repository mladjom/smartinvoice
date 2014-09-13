<?php

// Composer: "fzaninotto/faker": "v1.4.0"

class ItemsTableSeeder extends Seeder {
 
    public function run()
    {
        $faker = Faker\Factory::create();
        
        Item::truncate();
 
        foreach(range(1,10) as $index)
        {
            Item::create([

                ]);
        }
 
    }
 
}
