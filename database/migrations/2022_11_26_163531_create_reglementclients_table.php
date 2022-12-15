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
        Schema::create('reglementclients', function (Blueprint $table) {
            $table->id();
            $table->string("ReferenceRegCl", 50)->unique();
            $table->double("MontantAPayerRegCl", 10, 0);
            $table->double("MontantPayerRgCl", 10, 0);
            $table->double("MontantRestant")->default(0);
            $table->foreignId("factureclient_id")->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('reglementclients', function (Blueprint $table) {
            $table->dropColumn(["factureclient_id"]);
        });
        Schema::dropIfExists('reglementclients');
    }
};
