<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles_admin', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->json('permissions');
            $table->boolean('actif')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::table('admins', function (Blueprint $table) {
            if (!Schema::hasColumn('admins', 'role_admin_id')) {
                $table->foreignId('role_admin_id')->nullable()->after('role_admin')->constrained('roles_admin')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropForeign(['role_admin_id']);
            $table->dropColumn('role_admin_id');
        });
        Schema::dropIfExists('roles_admin');
    }
};