<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Skate;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function create()
    {
        $skates = Skate::all();
        $userReservation = Reservation::where('user_id', Auth::id())->first();

        return view('reservations.create', compact('skates', 'userReservation'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'hours' => 'required|integer|between:1,4',
            'skate_id' => 'nullable|exists:skates,id'
        ]);

        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'hours' => $request->hours,
            'skate_id' => $request->skate_id,
            'paid' => true // сразу считаем оплаченной
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Бронирование успешно!'
        ]);
    }
}