<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function buy(Request $request)
    {
        $user = Auth::user();

        // Проверим, есть ли уже билет
        $ticket = Ticket::firstOrCreate(
            ['user_id' => $user->id],
            ['paid' => true]
        );

        if ($ticket->paid) {
            return response()->json([
                'success' => true,
                'message' => 'Билет куплен'
            ]);
        }

        $ticket->paid = true;
        $ticket->save();

        return response()->json([
            'success' => true,
            'message' => 'Билет куплен'
        ]);
    }
}