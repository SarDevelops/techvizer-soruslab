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
        Schema::create('role_permission_modules', function (Blueprint $table) {
            $table->id();
            $table->string('module_name')->comment('To show the front-end side, which admin can change');
            $table->string('module_type')->comment('To precess in back-end');
            $table->json('permissions');
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permission_modules');
    }
};
