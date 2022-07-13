<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipstersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipsters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->boolean('is_enabled')->default(0);
            $table->string('nickname',25)->nullable();
            $table->text('profile_sumamry')->nullable();
            $table->string('special_notes',100)->nullable();
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
        Schema::dropIfExists('tipsters');
    }
}
