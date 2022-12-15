<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string("NomClient", 100);
            $table->string("EmailClient")->nullable();
            $table->string("TelephoneClient", 12)->unique();
            $table->string("MobileClient", 12)->unique();
            $table->string("AdresseClient", 100)->nullable();
            $table->mediumText("RemarqueClient", 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};
