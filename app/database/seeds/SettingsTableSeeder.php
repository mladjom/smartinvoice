<?php

// Composer: "fzaninotto/faker": "v1.4.0"

class SettingsTableSeeder extends Seeder {

    public function run() {

        Setting::truncate();

        $settings = array(
            array(
                'user_id' => 1,
                'currency_id' => 752,
                'language' => 'en',
            ),
            array(
                'user_id' => 2,
                'currency_id' => 752,
                'language' => 'sv',
            ),
            array(
                'user_id' => 3,
                'currency_id' => 752,
                'language' => 'sv',
            ),
        );

        DB::table('settings')->insert($settings);
    }

}
