<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_categories_id')->comment('package_categories:id');
            $table->string('name');
            $table->string('type');
            $table->string('image');
            $table->json('recommended_for');
            $table->text('overview');
            $table->json('cbc_test');
            $table->json('includes_pack');
            $table->foreign('package_categories_id')->references('id')->on('package_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropForeign('packages_package_categories_id_foreign');
        });
        Schema::dropIfExists('packages');
    }
};
