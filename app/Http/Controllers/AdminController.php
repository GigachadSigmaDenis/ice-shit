<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skate;
use App\Models\Reservation;
use App\Models\Ticket;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    // Добавление коньков
    public function createSkate()
    {
        return view('admin.skates.create');
    }

    public function storeSkate(Request $request)
    {
        $request->validate([
            'model' => 'required|string|max:255',
            'size' => 'required|integer',
            'quantity' => 'required|integer|min:0'
        ]);

        Skate::create($request->only(['model','size','quantity']));

        return redirect()->route('admin.index')->with('success', 'Коньки добавлены');
    }

    // Просмотр бронирований
    public function reservations()
    {
        $reservations = Reservation::with('user','skate')->orderBy('created_at','desc')->get();
        return view('admin.reservations.index', compact('reservations'));
    }

    // Просмотр оплаченных билетов
    public function tickets()
    {
        $tickets = Ticket::with('user')->where('paid', true)->orderBy('created_at','desc')->get();
        return view('admin.tickets.index', compact('tickets'));
    }
}