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
        Schema::create('lignefacturefournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string("ReferenceLigneFacture", 50);
            $table->string("DesignationLigneFacture", 50);
            $table->double("PrixAchatLigneFacture", 10, 0);
            $table->integer("quantiteLigneFacture")->default(1);
            $table->double("soustotalLigneFacture", 10, 0);
            $table->foreignId("facturefournisseur_id")->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId("article_id")->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('lignefacturefournisseurs', function (Blueprint $table) {
            $table->dropColumn(["facturefournisseur_id", "article_id"]);
        });
        Schema::dropIfExists('lignefacturefournisseurs');
    }
};
