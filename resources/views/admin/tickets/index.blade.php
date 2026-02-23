@extends('layouts.app')

@section('content')
<h2>Оплаченные билеты</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Пользователь</th>
            <th>Дата</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->user->name }}</td>
                <td>{{ $ticket->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection