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
        Schema::create('reglementfournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string("ReferenceRegF", 50)->unique();
            $table->double("MontantAPayerRegF", 10, 0);
            $table->double("MontantPayerRgF", 10, 0);
            $table->double("MontantRestant")->default(0);
            $table->foreignId("facturefournisseur_id")->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('reglementfournisseurs', function (Blueprint $table) {
            $table->dropColumn(["facturefournisseur_id"]);
        });
        Schema::dropIfExists('reglementfournisseurs');
    }
};
