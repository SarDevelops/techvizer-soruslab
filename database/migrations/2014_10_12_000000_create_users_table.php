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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile')->default('default_user.png');
            $table->string('image_folder', 25)->nullable();
            $table->enum('role', ['1', '2'])->comment('1=admin, 2=user');
            $table->enum('is_administrator', ['1', '0'])->comment('1=Can access the admin panel, 0=can not access the admin panel');
            $table->unsignedBigInteger('created_by')->nullable()->comment('users:id');
            $table->unsignedBigInteger('updated_by')->nullable()->comment('users:id');
            $table->enum('is_test', [1, 0])->comment('1=Production | 0=Test')->default(1);
            $table->enum('is_active', ['1', '0'])->default('1')->comment('1=Active | 0=Deactive')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_created_by_foreign');
            $table->dropForeign('users_updated_by_foreign');
        });
        Schema::dropIfExists('users');
    }
};
