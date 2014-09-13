<?php


class TaxRatesTableSeeder extends Seeder {
 
    public function run()
    {
        
        TaxRate::truncate();
 
        $tax_rates = array(
            array(
                'name' => 'VAT',
                'user_id' => 2,
                'tax_total' => 15,

            ),
            array(
                'name' => 'MOMS',
                'user_id' => 2,
                'tax_total' => 25,
            )
        );

        DB::table('tax_rates')->insert($tax_rates);
 
    }
 
}
