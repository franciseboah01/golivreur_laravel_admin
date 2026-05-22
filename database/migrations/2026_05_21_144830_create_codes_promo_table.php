<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('codes_promo', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', ['pourcentage', 'montant_fixe', 'livraison_gratuite']);
            $table->decimal('valeur', 10, 2);
            $table->decimal('montant_min', 10, 2)->default(0);
            $table->integer('max_utilisation')->nullable();
            $table->integer('utilisations')->default(0);
            $table->timestamp('expire_le')->nullable();
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('codes_promo');
    }
};