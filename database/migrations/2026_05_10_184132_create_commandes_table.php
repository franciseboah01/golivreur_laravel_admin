<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('commercant_id')->constrained('commercants')->onDelete('cascade');
            $table->foreignId('livreur_id')->nullable()->constrained('livreurs')->onDelete('set null');
            $table->decimal('total', 10, 2);
            $table->decimal('frais_livraison', 10, 2)->default(0);
            $table->string('adresse_livraison');
            $table->enum('statut', ['en_attente', 'acceptee', 'en_preparation', 'en_livraison', 'livree', 'annulee'])->default('en_attente');
            $table->string('mode_paiement')->default('especes'); // especes, mobile_money
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};