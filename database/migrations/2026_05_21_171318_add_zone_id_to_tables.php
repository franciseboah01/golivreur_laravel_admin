<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = ['users', 'commercants', 'livreurs', 'commandes', 'colis', 'admins'];

        foreach ($tables as $table) {
            if (!Schema::hasColumn($table, 'zone_id')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->foreignId('zone_id')->nullable()->after('id')->constrained('zones')->onDelete('set null');
                });
            }
        }
    }

    public function down(): void
    {
        $tables = ['admins', 'colis', 'commandes', 'livreurs', 'commercants', 'users'];

        foreach ($tables as $table) {
            if (Schema::hasColumn($table, 'zone_id')) {
                Schema::table($table, function (Blueprint $table) {
                    $table->dropForeign(['zone_id']);
                    $table->dropColumn('zone_id');
                });
            }
        }
    }
};