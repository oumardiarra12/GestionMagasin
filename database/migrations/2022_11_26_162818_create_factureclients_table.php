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
        Schema::create('factureclients', function (Blueprint $table) {
            $table->id();
            $table->string("NumFactureClient")->unique();
            $table->double("TotalFactureClient");
            $table->mediumText("DescriptionFactureClient", 255)->nullable();
            $table->enum("StatusFactureClient", ["Payer", "Non Payer"])->default("Non Payer");
            $table->foreignId("livraison_id")->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('factureclients', function (Blueprint $table) {
            $table->dropColumn(["livraison_id"]);
        });
        Schema::dropIfExists('factureclients');
    }
};
