@extends('layouts.app')

@section('content')
<div class="text-center">
    <h2>Админ-панель</h2>
    <div class="list-group mt-4">
        <a href="{{ route('admin.skates.create') }}" class="list-group-item list-group-item-action">Добавить коньки</a>
        <a href="{{ route('admin.reservations') }}" class="list-group-item list-group-item-action">Просмотреть бронирования</a>
        <a href="{{ route('admin.tickets') }}" class="list-group-item list-group-item-action">Просмотреть оплаченные билеты</a>
    </div>
</div>
@endsection