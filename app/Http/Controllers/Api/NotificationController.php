<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Mes notifications
    public function index(Request $request)
    {
        $notifications = Notification::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->take(50)
            ->get();

        return response()->json($notifications);
    }

    // Notifications non lues
    public function nonLues(Request $request)
    {
        $count = Notification::where('user_id', $request->user()->id)
            ->where('lu', false)
            ->count();

        return response()->json(['non_lues' => $count]);
    }

    // Marquer comme lue
    public function marquerLue($id, Request $request)
    {
        $notif = Notification::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$notif) {
            return response()->json(['message' => 'Notification non trouvée'], 404);
        }

        $notif->update(['lu' => true]);

        return response()->json(['message' => 'Notification marquée comme lue']);
    }

    // Marquer tout comme lu
    public function toutMarquerLu(Request $request)
    {
        Notification::where('user_id', $request->user()->id)
            ->where('lu', false)
            ->update(['lu' => true]);

        return response()->json(['message' => 'Toutes les notifications marquées comme lues']);
    }
}