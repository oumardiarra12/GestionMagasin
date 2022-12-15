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
        Schema::create('lignefactureclients', function (Blueprint $table) {
            $table->id();
            $table->string("Referencefcl", 50);
            $table->string("Designationfcl", 50);
            $table->double("PrixVentefcl", 10, 0);
            $table->integer("quantitefcl")->default(1);
            $table->double("soustotalfcl", 10, 0);
            $table->foreignId("factureclient_id")->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('lignefactureclients', function (Blueprint $table) {
            $table->dropColumn(["factureclient_id", "article_id"]);
        });
        Schema::dropIfExists('lignefactureclients');
    }
};
