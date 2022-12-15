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
        Schema::create('devis', function (Blueprint $table) {
            $table->id();
            $table->string("NumDevis")->unique();
            $table->double("TotalDevis", 10, 0);
            $table->double("RemisDevis", 10, 0)->default(0);
            $table->mediumText("DescriptionDevis", 255)->nullable();
            $table->enum("StatusDevis", ["Accepter", "Non Accepter"])->default("Non Accepter");
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
        Schema::table('devis', function (Blueprint $table) {
            $table->dropColumn(["client_id"]);
        });
        Schema::dropIfExists('devis');
    }
};
