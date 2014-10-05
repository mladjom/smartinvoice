<?php


class TaxRatesTableSeeder extends Seeder {
 
    public function run()
    {
        
        TaxRate::truncate();
 
        $tax_rates = array(
            array(
                'name' => 'VAT 15%',
                'user_id' => 2,
                'rate' => 15,

            ),
            array(
                'name' => 'MOMS 25%',
                'user_id' => 2,
                'rate' => 25,
            )
        );

        DB::table('tax_rates')->insert($tax_rates);
 
    }
 
}
