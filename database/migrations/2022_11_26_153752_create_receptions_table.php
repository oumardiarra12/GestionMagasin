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
        Schema::create('receptions', function (Blueprint $table) {
            $table->id();
            $table->string("NumRecept")->unique();
            $table->double("TotalRecept", 10, 0);
            $table->mediumText("DescriptionRecept", 255)->nullable();
            $table->enum("StatusReception", ["Facturer", "Non Facturer"])->default("Non Facturer");
            $table->foreignId("commandeachat_id")->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('receptions', function (Blueprint $table) {
            $table->dropColumn(["commandeachat_id"]);
        });
        Schema::dropIfExists('receptions');
    }
};
