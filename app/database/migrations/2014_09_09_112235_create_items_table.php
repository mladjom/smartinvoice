<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('items', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id');
            $table->integer('tax_rate_id')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0.00)->nullable();
            $table->decimal('quantity', 10, 2)->default(0.00)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('items');
    }

}
