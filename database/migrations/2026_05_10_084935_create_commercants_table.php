<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commercants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nom_boutique');
            $table->text('description')->nullable();
            $table->string('adresse');
            $table->string('telephone_boutique')->nullable();
            $table->string('photo_boutique')->nullable();
            $table->string('categorie')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('horaires')->nullable();
            $table->boolean('ouvert')->default(true);
            $table->enum('statut', ['en_attente', 'actif', 'inactif'])->default('en_attente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commercants');
    }
};