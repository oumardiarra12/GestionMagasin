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
        Schema::create('facturefournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string("NumFactures")->unique();
            $table->double("TotalFacture");
            $table->mediumText("DescriptionFacture")->nullable();
            $table->enum("StatusFacture", ["Regler", "Non Regler"])->default("Non Regler");
            $table->foreignId("reception_id")->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facturefournisseurs', function (Blueprint $table) {
            $table->dropColumn(["reception_id"]);
        });
        Schema::dropIfExists('facturefournisseurs');
    }
};
