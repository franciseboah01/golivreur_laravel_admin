<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('colis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expediteur_id')->constrained('users')->onDelete('cascade');
            $table->string('destinataire_nom');
            $table->string('destinataire_telephone');
            $table->string('adresse_ramassage');
            $table->string('adresse_livraison');
            $table->text('description')->nullable();
            $table->string('taille')->nullable(); // petit, moyen, grand
            $table->decimal('poids', 8, 2)->nullable(); // en kg
            $table->decimal('prix_livraison', 10, 2)->default(0);
            $table->foreignId('livreur_id')->nullable()->constrained('livreurs')->onDelete('set null');
            $table->enum('statut', ['en_attente', 'accepte', 'ramasse', 'en_livraison', 'livre', 'annule'])->default('en_attente');
            $table->string('mode_paiement')->default('especes');
            $table->string('code_confirmation')->nullable(); // code remis au destinataire
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('colis');
    }
};