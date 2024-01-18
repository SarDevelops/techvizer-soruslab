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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('user_id')->comment('users:id');
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('created_by')->nullable()->comment('users:id');
            $table->unsignedBigInteger('updated_by')->nullable()->comment('users:id');
            $table->enum('is_test', [1, 0])->comment('0=Production | 1=Test')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->dropForeign('user_details_user_id_foreign');
            $table->dropForeign('user_details_created_by_foreign');
            $table->dropForeign('user_details_updated_by_foreign');
        });
        Schema::dropIfExists('user_details');
    }
};
