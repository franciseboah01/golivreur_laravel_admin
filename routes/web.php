<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CommercantController;
use App\Http\Controllers\Admin\LivreurController;
use App\Http\Controllers\Admin\CommandeController;
use App\Http\Controllers\Admin\ColisController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\CodePromoController;
use App\Http\Controllers\Admin\ParametreController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\AvisController;
use App\Http\Controllers\Admin\SignalementController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\Admin\BanniereController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\RoleAdminController;
use App\Http\Middleware\AdminMiddleware;


// Auth admin (public)
Route::get('/admin/login', fn() => view('admin.auth.login'))->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin protégé
Route::middleware([AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('roles', RoleAdminController::class)->except(['show']);

    // Admins (accessible si permission 'admins')
    Route::get('/admins', [AdminController::class, 'index'])->name('admins.index');
    Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create');
    Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');
    Route::delete('/admins/{id}', [AdminController::class, 'destroy'])->name('admins.destroy');
    Route::put('/admins/{id}/toggle', [AdminController::class, 'toggle'])->name('admins.toggle');
    Route::get('/admins/{id}/edit', [AdminController::class, 'edit'])->name('admins.edit');
    Route::put('/admins/{id}', [AdminController::class, 'update'])->name('admins.update');
    Route::get('/admins/{id}', [AdminController::class, 'show'])->name('admins.show');
    Route::get('/admins/en-attente', [AdminController::class, 'enAttente'])->name('admins.attente');
    Route::put('/admins/{id}/valider', [AdminController::class, 'valider'])->name('admins.valider');
    Route::put('/admins/{id}/rejeter', [AdminController::class, 'rejeter'])->name('admins.rejeter');

    // Clients
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::put('/clients/{id}/toggle', [ClientController::class, 'toggle'])->name('clients.toggle');
    Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');
    Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');

    // Commerçants
    Route::get('/commercants', [CommercantController::class, 'index'])->name('commercants.index');
    Route::get('/commercants/en-attente', [CommercantController::class, 'enAttente'])->name('commercants.attente');
    Route::put('/commercants/{id}/valider', [CommercantController::class, 'valider'])->name('commercants.valider');
    Route::put('/commercants/{id}/toggle', [CommercantController::class, 'toggle'])->name('commercants.toggle');
    Route::get('/commercants/{id}', [CommercantController::class, 'show'])->name('commercants.show');
    Route::get('/commercants/{id}/edit', [CommercantController::class, 'edit'])->name('commercants.edit');
    Route::put('/commercants/{id}', [CommercantController::class, 'update'])->name('commercants.update');

    // Livreurs
    Route::get('/livreurs', [LivreurController::class, 'index'])->name('livreurs.index');
    Route::get('/livreurs/en-attente', [LivreurController::class, 'enAttente'])->name('livreurs.attente');
    Route::put('/livreurs/{id}/valider', [LivreurController::class, 'valider'])->name('livreurs.valider');
    Route::put('/livreurs/{id}/toggle', [LivreurController::class, 'toggle'])->name('livreurs.toggle');
    Route::get('/livreurs/{id}', [LivreurController::class, 'show'])->name('livreurs.show');
    Route::get('/livreurs/{id}/edit', [LivreurController::class, 'edit'])->name('livreurs.edit');
    Route::put('/livreurs/{id}', [LivreurController::class, 'update'])->name('livreurs.update');

    // Commandes
    Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');
    Route::get('/commandes/{id}', [CommandeController::class, 'show'])->name('commandes.show');
    Route::put('/commandes/{id}/statut', [CommandeController::class, 'changerStatut'])->name('commandes.statut');
    Route::put('/commandes/{id}/attribuer', [CommandeController::class, 'attribuer'])->name('commandes.attribuer');

    // Colis
    Route::get('/colis', [ColisController::class, 'index'])->name('colis.index');
    Route::get('/colis/{id}', [ColisController::class, 'show'])->name('colis.show');

    // Catégories
    Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategorieController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategorieController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategorieController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');

    // Codes promo
    Route::get('/codes-promo', [CodePromoController::class, 'index'])->name('codes-promo.index');
    Route::get('/codes-promo/create', [CodePromoController::class, 'create'])->name('codes-promo.create');
    Route::post('/codes-promo', [CodePromoController::class, 'store'])->name('codes-promo.store');
    Route::get('/codes-promo/{id}/edit', [CodePromoController::class, 'edit'])->name('codes-promo.edit');
    Route::put('/codes-promo/{id}', [CodePromoController::class, 'update'])->name('codes-promo.update');
    Route::delete('/codes-promo/{id}', [CodePromoController::class, 'destroy'])->name('codes-promo.destroy');

    // Paramètres
    Route::get('/parametres', [ParametreController::class, 'index'])->name('parametres.index');
    Route::post('/parametres', [ParametreController::class, 'update'])->name('parametres.update');

    // Transactions
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/retraits', [TransactionController::class, 'retraits'])->name('retraits.index');
    Route::put('/retraits/{id}/traiter', [TransactionController::class, 'traiterRetrait'])->name('retraits.traiter');

    // Avis
    Route::get('/avis', [AvisController::class, 'index'])->name('avis.index');
    Route::post('/avis/{id}/repondre', [AvisController::class, 'repondre'])->name('avis.repondre');
    Route::delete('/avis/{id}', [AvisController::class, 'destroy'])->name('avis.destroy');

    // Signalements
    Route::get('/signalements', [SignalementController::class, 'index'])->name('signalements.index');
    Route::put('/signalements/{id}/traiter', [SignalementController::class, 'traiter'])->name('signalements.traiter');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/envoyer', [NotificationController::class, 'envoyer'])->name('notifications.envoyer');

    // Zones
    Route::get('/zones', [ZoneController::class, 'index'])->name('zones.index');
    Route::get('/zones/create', [ZoneController::class, 'create'])->name('zones.create');
    Route::post('/zones', [ZoneController::class, 'store'])->name('zones.store');
    Route::get('/zones/{id}/edit', [ZoneController::class, 'edit'])->name('zones.edit');
    Route::put('/zones/{id}', [ZoneController::class, 'update'])->name('zones.update');
    Route::delete('/zones/{id}', [ZoneController::class, 'destroy'])->name('zones.destroy');

    // Bannières
    Route::get('/bannieres', [BanniereController::class, 'index'])->name('bannieres.index');
    Route::get('/bannieres/create', [BanniereController::class, 'create'])->name('bannieres.create');
    Route::post('/bannieres', [BanniereController::class, 'store'])->name('bannieres.store');
    Route::get('/bannieres/{id}/edit', [BanniereController::class, 'edit'])->name('bannieres.edit');
    Route::put('/bannieres/{id}', [BanniereController::class, 'update'])->name('bannieres.update');
    Route::delete('/bannieres/{id}', [BanniereController::class, 'destroy'])->name('bannieres.destroy');

    // Exports
    Route::get('/exports', [ExportController::class, 'index'])->name('exports.index');
    Route::get('/exports/commandes', [ExportController::class, 'commandes'])->name('exports.commandes');
    Route::get('/exports/transactions', [ExportController::class, 'transactions'])->name('exports.transactions');
    Route::get('/exports/utilisateurs', [ExportController::class, 'utilisateurs'])->name('exports.utilisateurs');
    Route::get('/exports/colis', [ExportController::class, 'colis'])->name('exports.colis');
    Route::get('/exports/livreurs', [ExportController::class, 'livreurs'])->name('exports.livreurs');
    Route::get('/exports/commercants', [ExportController::class, 'commercants'])->name('exports.commercants');

    // Logs
    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');
});