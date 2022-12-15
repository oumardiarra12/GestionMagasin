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
        Schema::create('lignereceptions', function (Blueprint $table) {
            $table->id();
            $table->string("ReferenceLigneRecept", 50);
            $table->string("DesignationLigneRecept", 50);
            $table->double("PrixVenteLigneRecept", 10, 0);
            $table->integer("quantiteCMDLigneRecept");
            $table->integer("quantiteLigneRecept")->default(1);
            $table->double("soustotalLigneRecept", 10, 0);
            $table->foreignId("reception_id")->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('lignereceptions', function (Blueprint $table) {
            $table->dropColumn(["reception_id", "article_id"]);
        });
        Schema::dropIfExists('lignereceptions');
    }
};
