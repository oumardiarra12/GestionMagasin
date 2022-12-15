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
        Schema::create('commandeclients', function (Blueprint $table) {
            $table->id();
            $table->string("NumCommandeClient")->unique();
            $table->double("TotalCommandeClient", 10, 0);
            $table->mediumText("DescriptionCommandeClient", 255)->nullable();
            $table->enum("StatusCommandeClient", ["Livrer", "Non Livrer"])->default("Non Livrer");
            $table->foreignId("client_id")->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('commandeclients', function (Blueprint $table) {
            $table->dropColumn(["client_id"]);
        });
        Schema::dropIfExists('commandeclients');
    }
};
