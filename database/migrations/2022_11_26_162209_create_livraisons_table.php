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
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();
            $table->string("NumLivraison")->unique();
            $table->double("TotalLivraison", 10, 0);
            $table->mediumText("DescriptionLivraison")->nullable();
            $table->enum("StatusLivraison", ["Facturer", "Non Facturer"])->default("Non Facturer");
            $table->foreignId("commandeclient_id")->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('livraisons', function (Blueprint $table) {
            $table->dropColumn(["commandeclient_id"]);
        });
        Schema::dropIfExists('livraisons');
    }
};
