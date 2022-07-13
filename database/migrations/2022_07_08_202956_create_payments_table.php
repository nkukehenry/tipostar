<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id'); //user
            $table->foreignId('tipster_id');
            $table->foreignId('plan_id');
            $table->float('amount');
            $table->float('provider_share')->default(0);
            $table->float('tipster_share')->default(0);
            $table->string('tran_reference')->nullable()->unique('tran_reference_unique');
            $table->string('customer_no')->nullable();
            $table->string('status')->default('PENDING');
            $table->string('payment_method')->default('CARD');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
