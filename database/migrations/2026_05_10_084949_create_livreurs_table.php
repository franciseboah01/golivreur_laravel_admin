<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('livreurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('vehicule_type')->nullable(); // moto, vélo, voiture
            $table->string('vehicule_immatriculation')->nullable();
            $table->string('photo_vehicule')->nullable();
            $table->string('zone_couverture')->nullable();
            $table->decimal('latitude_actuelle', 10, 7)->nullable();
            $table->decimal('longitude_actuelle', 10, 7)->nullable();
            $table->boolean('disponible')->default(false);
            $table->enum('statut', ['en_attente', 'actif', 'inactif'])->default('en_attente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('livreurs');
    }
};