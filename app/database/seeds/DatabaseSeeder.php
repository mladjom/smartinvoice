<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Eloquent::unguard();
        DB::statement("SET foreign_key_checks = 0");
        $this->call('UsersTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('SettingsTableSeeder');
        $this->call('BillersTableSeeder');
        $this->call('ClientsTableSeeder');
        $this->call('TaxRatesTableSeeder');
        $this->call('CountriesSeeder');
    }

}
