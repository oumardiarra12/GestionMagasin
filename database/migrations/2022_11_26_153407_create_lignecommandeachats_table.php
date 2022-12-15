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
        Schema::create('lignecommandeachats', function (Blueprint $table) {
            $table->id();
            $table->string("Referencecmdf", 50);
            $table->string("Designationcmdf", 50);
            $table->double("PrixAchatcmdf", 10, 0);
            $table->integer("quantitecmdf")->default(1);
            $table->double("soustotalcmdf", 10, 0);
            $table->foreignId("commandeachat_id")->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('lignecommandeachats', function (Blueprint $table) {
            $table->dropColumn(["commandeachat_id", "article_id"]);
        });
        Schema::dropIfExists('lignecommandeachats');
    }
};
