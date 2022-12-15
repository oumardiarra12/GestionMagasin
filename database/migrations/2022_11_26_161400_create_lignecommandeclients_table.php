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
        Schema::create('lignecommandeclients', function (Blueprint $table) {
            $table->id();
            $table->string("Referencecmdc", 50);
            $table->string("Designationcmdc", 50);
            $table->double("PrixVentecmdc", 10, 0);
            $table->integer("quantitecmdc")->default(1);
            $table->double("soustotalcmdc", 10, 0);
            $table->foreignId("commandeclient_id")->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('lignecommandeclients', function (Blueprint $table) {
            $table->dropColumn(["commandeclient_id", "article_id"]);
        });
        Schema::dropIfExists('lignecommandeclients');
    }
};
