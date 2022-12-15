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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string("ReferenceArticle", 50)->unique();
            $table->string("CodeBarre", 13)->unique();
            $table->string("NomArticle", 50);
            $table->string("ImageArticle");
            $table->double("PrixAchat", 10, 0);
            $table->double("PrixVente", 10, 0);
            $table->integer("StockActuel")->default(0);
            $table->integer("StockMin");
            $table->mediumText("DescriptionArticle", 255)->nullable();
            $table->foreignId('categorie_id')->constrained('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('unite_id')->constrained('unites')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(["categorie_id", "unite_id"]);
        });
        Schema::dropIfExists('articles');
    }
};
