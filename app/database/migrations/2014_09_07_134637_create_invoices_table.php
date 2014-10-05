<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvoicesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('invoices', function(Blueprint $table) {
            $table->increments('id');
            $table->string('number', 255);
            $table->integer('user_id')->index();
            $table->integer('biller_id')->index();
            $table->integer('client_id')->index();
            $table->integer('currency_id')->index();
            $table->date('date')->nullable();
            $table->date('due_date')->nullable();
            $table->boolean('is_recurring')->default(0);
            $table->decimal('subtotal', 10, 2)->default(0.00);
            $table->integer('tax_rate_id')->nullable();
            $table->decimal('tax_total', 10, 2)->default(0.00);
            $table->decimal('total', 10, 2)->default(0.00);
            $table->decimal('paid', 10, 2)->default(0.00);
            $table->decimal('balance', 10, 2)->default(0.00);
            $table->string('note')->nullable();
            $table->string('status')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('invoices');
    }

}
