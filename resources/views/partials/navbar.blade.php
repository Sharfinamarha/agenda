<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <div class="container">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="{{ Storage::url('logo.png') }}" alt="" width="50" height="50"
                    class="d-inline-block">
                    AGENDA PUSAT DATA DAN SISTEM INFORMASI
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav">
                <a class="nav-link {{ Request::is('/') ? 'active fw-bold' : '' }}" href="/">Home</a>
                <a class="nav-link {{ Request::is('list') ? 'active fw-bold' : '' }}" href="/list">Agenda</a>
                @auth
                <a class="nav-link {{ Request::is('Agenda') ? 'active fw-bold' : '' }}" href="/Agenda">Kalender</a>
                @endauth
                <li class="nav-item dropdown ms-4">
                    <a class="nav-link active" style="width: 50px;" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fa-solid fa-bell"></span> {{ $upcoming->count() }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu">
                        @forelse ($upcoming as $event)
                        <li class="dropdown-item">
                            Reminder
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li class="dropdown-item">
                            <a class="nav-link text-dark" href="/Agenda/{{ $event->id }}"><span class="fas fa-calendar"></span> {{ \Carbon\Carbon::parse($event->start)->format('H:i') }} {{ $event->title }} - {{ $event->location }}</a>
                        </li>
                        @empty
                        <li><a class="dropdown-item">Belum Ada Agenda</a></li>
                        @endforelse
                    </ul>
                </li>
                @auth
                    <li class="nav-item dropdown ms-4">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Halo, {{ strtok(Auth::user()->name, ' ') }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu">
                            <li><a class="dropdown-item" href="/logout">Logout</a></li>
                        </ul>
                    </li>
                @endauth
                @guest
                    <a class="nav-link {{ Request::is('login') ? 'active fw-bold' : '' }}" href="/login">Login</a>
                @endguest
            </ul>
        </div>
    </div>
</nav>
