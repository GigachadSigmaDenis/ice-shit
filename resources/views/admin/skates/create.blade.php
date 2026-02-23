@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Добавить коньки</h2>
        <form method="POST" action="{{ route('admin.skates.store') }}">
            @csrf
            <div class="mb-3">
                <label>Модель</label>
                <input type="text" class="form-control" name="model" required>
            </div>
            <div class="mb-3">
                <label>Размер</label>
                <input type="number" class="form-control" name="size" required>
            </div>
            <div class="mb-3">
                <label>Количество</label>
                <input type="number" class="form-control" name="quantity" required min="0">
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>
</div>
@endsection