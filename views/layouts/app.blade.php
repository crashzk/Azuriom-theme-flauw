@extends('layouts.base')

@section('app')
    <div class="home-background d-flex align-items-center justify-content-end flex-column text-white pb-md-15 pb-3 " style="background: rgb(87,110,247);background: radial-gradient(circle, rgba(87,110,247,0) 6%, rgba(var(--bs-black-rgb),0.6) 98%),linear-gradient(rgba(18,23,37,0.79), rgba(var(--bs-light-rgb),0.8)),url('{{ setting('background') ? image_url(setting('background')) : 'https://via.placeholder.com/2000x500' }}') no-repeat center; background-size: cover">

        <div class="container d-flex flex-column flex-md-row justify-content-center align-items-center gap-md-4">
			<a href="https://cs2.zkservidores.com" target="_blank" class="hero-small-box d-flex align-items-center gap-3 bg-dark bg-opacity-25 text-white text-decoration-none">
                <div>
                    <h2 class="m-0 fs-5"><span>Skin Changer</span></h2>
					<p class="m-0"><a href="https://cs2.zkservidores.com" target="_blank" class="hero-small-box d-flex align-items-center gap-3 bg-dark bg-opacity-25 text-white text-decoration-none">cs2.zkservidores.com</a></p>
                </div>
				<i class="{{theme_config('hero.discord.icon') ?? 'bi bi-crosshair'}} fs-1"></i>
            </a>
			
            <a class="navbar-brand" href="{{ route('home') }}">
                @if(setting('logo'))
                    <img width="200" height="200" style="object-fit: contain;" src="{{ image_url(setting('logo')) }}" alt="Logo">
                @else
                    {{ site_name() }}
                @endif
            </a>
			
            <a href="{{theme_config('hero.discord.url') ?? 'https://discord.gg/Gh2ddyBxUWvV'}}" target="_blank" class="hero-small-box d-flex align-items-center gap-3 bg-dark bg-opacity-25 p-3 text-white text-decoration-none">
                <i class="{{theme_config('hero.discord.icon') ?? 'bi bi-discord'}} fs-1"></i>
                <div>
                    <h2 class="m-0 fs-5 discord-list_count"><span>{{theme_config('hero.discord.text') ?? 'UTILISATEURS EN LIGNE'}}</span></h2>
                    <p class="m-0">{{theme_config('hero.discord.url') ? str_replace(['https://', 'http://', 'discord.gg'], ['','','DISCORD.GG'], theme_config('hero.discord.url')):'DISCORD.GG/Gh2yBxUWvV'}}</p>
                </div>
            </a>

        </div>
    </div>
    @push('footer-scripts')
        @include('components.general.discordAPI', ['onlyCounter' => true])
    @endpush
    </div>
    <main class="content bg-body">
        <div id="{{str_contains(request()->route()->uri, 'cps') ? '':(request()->route()->uri)}}" class="container py-10">
            @include('elements.session-alerts')

            @yield('content')
        </div>
    </main>
@endsection
