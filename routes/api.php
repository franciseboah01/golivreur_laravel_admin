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
use App\Http\Controllers\Api\FavoriController;

// ============ PUBLIC ROUTES ============
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/categories', [CategorieController::class, 'index']);
Route::get('/zones', [ZoneController::class, 'index']);
Route::get('/commercants', [CommercantController::class, 'index']);
Route::get('/commercants/{id}', [CommercantController::class, 'show']);
Route::get('/commercants/{commercantId}/produits', [ProduitController::class, 'byCommercant']);
Route::get('/parametres/groupe/{groupe}', [ParametreController::class, 'byGroup']);

// ============ AUTHENTICATED ROUTES ============
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::get('/profil', [AuthController::class, 'profile']);
    Route::put('/profil', [AuthController::class, 'updateProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Notifications (all roles)
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::get('/notifications/non-lues', [NotificationController::class, 'unread']);
    Route::put('/notifications/{id}/lire', [NotificationController::class, 'markAsRead']);
    Route::put('/notifications/tout-lire', [NotificationController::class, 'markAllAsRead']);

    // Messages (all roles)
    Route::post('/messages', [MessageController::class, 'send']);
    Route::get('/messages/recents', [MessageController::class, 'recents']);
    Route::get('/messages/{userId}', [MessageController::class, 'conversation']);

    // ========== CLIENT ROUTES ==========
    Route::middleware('role:client')->group(function () {
        Route::post('/commandes', [CommandeController::class, 'store']);
        Route::get('/commandes', [CommandeController::class, 'index']);
        Route::get('/commandes/{id}', [CommandeController::class, 'show']);
        Route::get('/favoris', [FavoriController::class, 'index']);
        Route::post('/favoris/toggle', [FavoriController::class, 'toggle']);
    });

    // ========== COMMERCANT ROUTES ==========
    Route::middleware('role:commercant')->group(function () {
        Route::get('/commercant/profil', [CommercantController::class, 'profile']);
        Route::post('/commercant/profil', [CommercantController::class, 'updateProfile']);
        Route::get('/commercant/statut', [CommercantController::class, 'status']);
        Route::post('/produits', [ProduitController::class, 'store']);
        Route::get('/produits', [ProduitController::class, 'index']);
        Route::put('/produits/{id}', [ProduitController::class, 'update']);
        Route::delete('/produits/{id}', [ProduitController::class, 'destroy']);
        Route::get('/commandes-recues', [CommandeController::class, 'received']);
        Route::put('/commandes/{id}/statut', [CommandeController::class, 'updateStatus']);
    });

    // ========== LIVREUR ROUTES ==========
    Route::middleware('role:livreur')->group(function () {
        Route::get('/livreur/profil', [LivreurController::class, 'profile']);
        Route::post('/livreur/profil', [LivreurController::class, 'updateProfile']);
        Route::post('/livreur/disponibilite', [LivreurController::class, 'toggleAvailability']);
        Route::post('/livreur/position', [LivreurController::class, 'updatePosition']);
        Route::get('/livreur/{id}/position', [LivreurController::class, 'getPosition']);
        Route::get('/commandes-livreur', [CommandeController::class, 'availableForDelivery']);
        Route::post('/commandes/{id}/accepter', [CommandeController::class, 'acceptDelivery']);
        Route::get('/livreur/commandes', [CommandeController::class, 'myDeliveries']);
        Route::get('/colis-livreur/disponibles', [ColisController::class, 'availableForDelivery']);
        Route::post('/colis/{id}/accepter', [ColisController::class, 'accept']);
        Route::put('/colis/{id}/statut', [ColisController::class, 'updateStatus']);
    });

    // ========== ADMIN ROUTES ==========
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
        Route::get('/admin/utilisateurs', [AdminController::class, 'users']);
        Route::get('/admin/commercants-attente', [AdminController::class, 'pendingCommercants']);
        Route::put('/admin/commercants/{id}/valider', [AdminController::class, 'validateCommercant']);
        Route::get('/admin/livreurs-attente', [AdminController::class, 'pendingDeliverymen']);
        Route::put('/admin/livreurs/{id}/valider', [AdminController::class, 'validateDeliveryman']);
        Route::get('/admin/commandes', [AdminController::class, 'commandes']);
        Route::put('/admin/commandes/{id}/attribuer', [AdminController::class, 'assignDeliveryman']);
        Route::post('/admin/creer', [AdminController::class, 'createAdmin']);
        Route::post('/admin/attribution-auto', [AdminController::class, 'autoAssign']);
        Route::get('/admin/parametres', [ParametreController::class, 'index']);
        Route::post('/admin/parametres', [ParametreController::class, 'update']);
    });

    // ========== SHARED ROUTES ==========
    Route::put('/commandes/{id}/statut', [CommandeController::class, 'updateStatus']);
    Route::post('/colis', [ColisController::class, 'store']);
    Route::get('/colis/envois', [ColisController::class, 'mySendings']);
    Route::get('/colis/{id}', [ColisController::class, 'show']);
});
