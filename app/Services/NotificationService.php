<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    public function envoyer($userId, $titre, $message, $type = 'info')
    {
        return Notification::create([
            'user_id' => $userId,
            'titre' => $titre,
            'message' => $message,
            'type' => $type,
        ]);
    }

    public function notifierCommercantNouvelleCommande($commercantUserId, $commandeId)
    {
        return $this->envoyer(
            $commercantUserId,
            'Nouvelle commande',
            "Vous avez reçu une nouvelle commande N°$commandeId.",
            'commande'
        );
    }

    public function notifierLivreurNouvelleCourse($livreurUserId, $commandeId)
    {
        return $this->envoyer(
            $livreurUserId,
            'Nouvelle livraison',
            "Une commande N°$commandeId vous a été attribuée.",
            'livraison'
        );
    }

    public function notifierClientChangementStatut($clientUserId, $commandeId, $statut)
    {
        $statuts = [
            'acceptee' => 'acceptée par le commerçant',
            'en_preparation' => 'en préparation',
            'en_livraison' => 'en cours de livraison',
            'livree' => 'livrée',
            'annulee' => 'annulée',
        ];

        $libelle = $statuts[$statut] ?? $statut;

        return $this->envoyer(
            $clientUserId,
            'Statut commande mis à jour',
            "Votre commande N°$commandeId est maintenant : $libelle.",
            'commande'
        );
    }
}