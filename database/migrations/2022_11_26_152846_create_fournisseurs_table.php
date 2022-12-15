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
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string("NomFournisseur", 100);
            $table->string("TelephoneFournisseur", 12);
            $table->string("MobileFournisseur", 12)->nullable();
            $table->string("AdresseFournisseur", 100)->nullable();
            $table->string("EmailFournisseur")->unique();
            $table->mediumText("RemarqueFournisseur")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fournisseurs');
    }
};
