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
        Schema::create('commandeachats', function (Blueprint $table) {
            $table->id();
            $table->string("NumCommandeAchat")->unique();
            $table->double("TotalCommandeAchat", 10, 0);
            $table->mediumText("DescriptionCommandeAchat", 255)->nullable();
            $table->enum("StatusCommandeAchat", ["Receptionner", "Non Receptionner"])->default("Non Receptionner");
            $table->foreignId("fournisseur_id")->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('commandeachats', function (Blueprint $table) {
            $table->dropColumn(["fournisseur_id"]);
        });
        Schema::dropIfExists('commandeachats');
    }
};
