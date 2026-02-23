<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Каток</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* --- Основные цвета --- */
        :root {
            --ice-blue: #ccefff;
            --ice-dark: #003366;
            --ice-light: #e0f7ff;
            --accent: #81d4fa;
            --hover-accent: #4fc3f7;
            --card-bg: rgba(255,255,255,0.85);
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom, var(--ice-light), var(--ice-blue));
            color: var(--ice-dark);
            margin: 0;
            padding: 0;
        }

        /* --- Navbar --- */
        .navbar {
            background-color: var(--ice-blue) !important;
            box-shadow: 0 4px 10px rgba(0,0,50,0.1);
            transition: background 0.3s;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .nav-link {
            color: var(--ice-dark) !important;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: var(--hover-accent) !important;
        }

        .btn-link.nav-link {
            color: var(--ice-dark) !important;
        }

        /* --- Container --- */
        .container {
            background-color: var(--card-bg);
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0,0,50,0.1);
            margin-bottom: 2rem;
        }

        /* --- Карточки --- */
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,50,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: var(--card-bg);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,50,0.2);
        }

        /* --- Формы и кнопки --- */
        input, select, textarea {
            border-radius: 8px;
            border: 1px solid var(--accent);
            padding: 8px;
            margin-bottom: 8px;
            transition: border 0.3s, box-shadow 0.3s;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--hover-accent);
            box-shadow: 0 0 5px var(--hover-accent);
            outline: none;
        }

        button, .btn {
            border-radius: 8px;
            transition: background 0.3s, transform 0.2s;
        }

        button:hover, .btn:hover {
            background-color: var(--hover-accent) !important;
            transform: translateY(-2px);
        }

        .alert-success {
            background-color: #b3e5fc;
            border-color: #81d4fa;
            color: #01579b;
        }

        footer {
            text-align: center;
            padding: 1rem;
            color: var(--ice-dark);
        }

        /* --- Сетка (8px) --- */
        .mb-1 { margin-bottom: 8px !important; }
        .mb-2 { margin-bottom: 16px !important; }
        .mt-1 { margin-top: 8px !important; }
        .mt-2 { margin-top: 16px !important; }
        .p-1 { padding: 8px !important; }
        .p-2 { padding: 16px !important; }

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Каток</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Войти</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Регистрация</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('reservations.create') }}">Бронирование коньков</a></li>

                    @if(auth()->user()->is_admin)
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.index') }}">Админка</a></li>
                    @endif

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-link nav-link" type="submit">Выход</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @yield('content')
</div>

<footer>
    &copy; {{ date('Y') }} Каток. Все права защищены ❄️⛸️
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>