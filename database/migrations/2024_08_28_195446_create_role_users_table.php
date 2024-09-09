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
        Schema::create('role_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('user_id');

            $table->timestamps();

            $table->index('role_id', 'role_user_role_idx');
            $table->index('user_id', 'role_user_user_idx');


            $table->foreign('role_id', 'role_user_role_fk')->on('roles')->references('id')->onDelete('cascade');
            $table->foreign('user_id', 'role_user_user_fk')->on('users')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_users');
    }
};
