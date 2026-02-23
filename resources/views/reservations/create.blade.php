@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Бронирование коньков</h2>
        <p>Стоимость: 150₽ / 1 час</p>

        @if($userReservation)
            <div class="alert alert-success">Вы уже забронировали: {{ $userReservation->hours }} час(ов)</div>
        @else
            <form id="reservationForm">
                @csrf
                <div class="mb-3">
                    <label>ФИО</label>
                    <input type="text" class="form-control" name="full_name" required>
                </div>
                <div class="mb-3">
                    <label>Телефон</label>
    <input type="text" class="form-control" name="phone" id="phoneInput" placeholder="+7 (___) ___-__-__" required>
                </div>
                <div class="mb-3">
                    <label>Количество часов</label>
                    <select class="form-select" name="hours" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Выбор коньков (необязательно)</label>
                    <select class="form-select" name="skate_id">
                        <option value="">Свои коньки</option>
                        @foreach($skates as $skate)
                            <option value="{{ $skate->id }}">{{ $skate->model }} ({{ $skate->size }})</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" id="reserveBtn" class="btn btn-primary">Забронировать</button>
            </form>
        @endif
    </div>
</div>

@if(!$userReservation)
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const phoneInput = document.getElementById('phoneInput');

    phoneInput.addEventListener('input', function(e) {
        let x = phoneInput.value.replace(/\D/g, ''); 
        if(x.startsWith('7')) x = x.substring(1); 
        x = x.substring(0, 10);

        let formatted = '+7 ';
        if(x.length > 0) formatted += '(' + x.substring(0, Math.min(3, x.length));
        if(x.length >= 4) formatted += ') ' + x.substring(3, Math.min(6, x.length));
        if(x.length >= 7) formatted += '-' + x.substring(6, Math.min(8, x.length));
        if(x.length >= 9) formatted += '-' + x.substring(8, 10);

        phoneInput.value = formatted;
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('reservationForm');
    const btn = document.getElementById('reserveBtn');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        btn.disabled = true;
        btn.textContent = 'Бронирование...';

        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        const response = await fetch("{{ route('reservations.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if(result.success){
            btn.textContent = result.message;
        } else {
            btn.disabled = false;
            btn.textContent = 'Забронировать';
            alert('Ошибка при бронировании!');
        }
    });
});
</script>
@endif
@endsection