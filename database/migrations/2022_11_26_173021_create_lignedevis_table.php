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
        Schema::create('lignedevis', function (Blueprint $table) {
            $table->id();
            $table->string("ReferenceDevis", 50);
            $table->string("DesignationDevis", 50);
            $table->double("PrixVenteDevis", 10, 0);
            $table->integer("quantiteDevis")->default(1);
            $table->double("soustotalDevis");
            $table->foreignId("devis_id")->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('lignedevis', function (Blueprint $table) {
            $table->dropColumn(["devis_id", "article_id"]);
        });
        Schema::dropIfExists('lignedevis');
    }
};
