<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommercantController;
use App\Http\Controllers\Api\LivreurController;
use App\Http\Controllers\Api\ProduitController;
use App\Http\Controllers\Api\CommandeController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ColisController;
use App\Http\Controllers\Api\CategorieController;
use App\Http\Controllers\Api\ParametreController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ZoneController;


// Routes publiques
Route::post('/inscrire', [AuthController::class, 'inscrire']);
Route::post('/connecter', [AuthController::class, 'connecter']);
Route::get('/commercants', [CommercantController::class, 'liste']);
Route::get('/commercants/{id}', [CommercantController::class, 'detail']);
Route::get('/commercants/{commercantId}/produits', [ProduitController::class, 'produitsCommercant']);
Route::get('/categories', [CategorieController::class, 'liste']);
Route::get('/parametres/groupe/{groupe}', [ParametreController::class, 'groupe']);
Route::get('/zones', [ZoneController::class, 'liste']);

// Routes protégées
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    //Route::get('/profil', [AuthController::class, 'profil']);
    Route::put('/profil', [AuthController::class, 'updateProfil']);
    Route::post('/deconnecter', [AuthController::class, 'deconnecter']);
    

    // Admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/admin/utilisateurs', [AdminController::class, 'utilisateurs']);
    Route::get('/admin/commercants-attente', [AdminController::class, 'commercantsEnAttente']);
    Route::put('/admin/commercants/{id}/valider', [AdminController::class, 'validerCommercant']);
    Route::get('/admin/livreurs-attente', [AdminController::class, 'livreursEnAttente']);
    Route::put('/admin/livreurs/{id}/valider', [AdminController::class, 'validerLivreur']);
    Route::get('/admin/commandes', [AdminController::class, 'commandes']);
    Route::put('/admin/commandes/{id}/attribuer', [AdminController::class, 'attribuerLivreur']);
    Route::post('/admin/creer', [AdminController::class, 'creerAdmin']);
    Route::post('/admin/attribution-auto', [AdminController::class, 'attributionAuto']);
    Route::get('/admin/parametres', [ParametreController::class, 'liste']);
    Route::post('/admin/parametres', [ParametreController::class, 'mettreAJour']);

    // Commerçant
    Route::post('/commercant/profil', [CommercantController::class, 'profil']);
    Route::get('/commercant/profil', [CommercantController::class, 'voir']);
    Route::get('/commercants/recherche', [CommercantController::class, 'recherche']);
    Route::get('/commercant/statut', [CommercantController::class, 'statut']);

    // Livreur
    Route::post('/livreur/profil', [LivreurController::class, 'profil']);
    Route::get('/livreur/profil', [LivreurController::class, 'voir']);
    Route::post('/livreur/disponibilite', [LivreurController::class, 'disponibilite']);
    Route::post('/livreur/position', [LivreurController::class, 'updatePosition']);
    Route::get('/livreur/{id}/position', [LivreurController::class, 'getPosition']);
    

    // Produits (commerçant uniquement)
    Route::post('/produits', [ProduitController::class, 'ajouter']);
    Route::get('/produits', [ProduitController::class, 'mesProduits']);
    Route::put('/produits/{id}', [ProduitController::class, 'modifier']);
    Route::delete('/produits/{id}', [ProduitController::class, 'supprimer']);

    // Commandes
    Route::post('/commandes', [CommandeController::class, 'passer']);
    Route::get('/commandes', [CommandeController::class, 'mesCommandes']);
    Route::get('/commandes/{id}', [CommandeController::class, 'detail']);
    Route::get('/commandes-recues', [CommandeController::class, 'commandesRecues']);
    Route::put('/commandes/{id}/statut', [CommandeController::class, 'changerStatut']);
    Route::get('/commandes-livreur', [CommandeController::class, 'disponiblesLivreur']);
    Route::post('/commandes/{id}/accepter', [CommandeController::class, 'accepterLivraison']);
    Route::get('/livreur/commandes', [CommandeController::class, 'mesLivraisons']);

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::get('/notifications/non-lues', [NotificationController::class, 'nonLues']);
    Route::put('/notifications/{id}/lire', [NotificationController::class, 'marquerLue']);
    Route::put('/notifications/tout-lire', [NotificationController::class, 'toutMarquerLu']);

    // Colis
    Route::post('/colis', [ColisController::class, 'creer']);
    Route::get('/colis/envois', [ColisController::class, 'mesEnvois']);
    Route::get('/colis/{id}', [ColisController::class, 'detail']);
    Route::get('/colis-livreur/disponibles', [ColisController::class, 'disponiblesLivreur']);
    Route::post('/colis/{id}/accepter', [ColisController::class, 'accepter']);
    Route::put('/colis/{id}/statut', [ColisController::class, 'changerStatut']);

    Route::post('/messages', [MessageController::class, 'envoyer']);
    Route::get('/messages/{autre_id}', [MessageController::class, 'conversation']);

});