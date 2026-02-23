@extends('layouts.app')

@section('content')
<div class="text-center">
    <h1>Добро пожаловать на каток!</h1>
    <p>Стоимость входа: 300₽</p>

    @auth
        @php
            $ticket = \App\Models\Ticket::where('user_id', auth()->id())->first();
        @endphp

        <button id="buyTicketBtn" class="btn btn-primary" 
            {{ $ticket && $ticket->paid ? 'disabled' : '' }}>
            {{ $ticket && $ticket->paid ? 'Билет куплен' : 'Купить билет' }}
        </button>
    @else
        <p><a href="{{ route('login') }}">Войдите</a> или <a href="{{ route('register') }}">зарегистрируйтесь</a>, чтобы купить билет.</p>
    @endauth
</div>

@auth
<script>
document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('buyTicketBtn');

    if(btn){
        btn.addEventListener('click', async function () {
            btn.disabled = true;  // сразу блокируем кнопку
            btn.textContent = 'Покупка...';

            const response = await fetch("{{ route('tickets.buy') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
            });

            const data = await response.json();

            if(data.success){
                btn.textContent = data.message; // "Билет куплен"
            } else {
                btn.disabled = false;
                btn.textContent = 'Купить билет';
                alert('Ошибка при покупке билета!');
            }
        });
    }
});
</script>
@endauth
@endsection