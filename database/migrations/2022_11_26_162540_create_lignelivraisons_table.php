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
        Schema::create('lignelivraisons', function (Blueprint $table) {
            $table->id();
            $table->string("ReferenceLigneLivraison", 50);
            $table->string("DesignationLigneLivraison", 50);
            $table->double("PrixVenteLigneLivraison", 10, 0);
            $table->integer("quantiteLigneLivraison");
            $table->integer("quantiteCMDCLLigneLivraison");
            $table->double("soustotalLigneLivraison", 10, 0);
            $table->foreignId("livraison_id")->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('lignelivraisons', function (Blueprint $table) {
            $table->dropColumn(["livraison_id", "article_id"]);
        });
        Schema::dropIfExists('lignelivraisons');
    }
};
