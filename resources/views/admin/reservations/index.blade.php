@extends('layouts.app')

@section('content')
<h2>Бронирования</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Пользователь</th>
            <th>ФИО</th>
            <th>Телефон</th>
            <th>Часы</th>
            <th>Коньки</th>
            <th>Дата</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reservations as $res)
            <tr>
                <td>{{ $res->id }}</td>
                <td>{{ $res->user->name }}</td>
                <td>{{ $res->full_name }}</td>
                <td>{{ $res->phone }}</td>
                <td>{{ $res->hours }}</td>
                <td>{{ $res->skate ? $res->skate->model.' ('.$res->skate->size.')' : 'Свои' }}</td>
                <td>{{ $res->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection