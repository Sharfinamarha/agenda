@extends('layouts.main')
@section('title', 'Home')
@section('container')
<style>
    .h1{
        font-family:'Tahoma'; 
        font-size: 48pt;
    }
</style>
    <div id="carouselExampleDark" class="carousel carousel-dark slide mb-3" data-bs-ride="carousel" style="height: 800px; width: 1200px;">
        <div class="carousel-indicators">
            @if ($totalAgenda == 0)
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            @else
                @php
                    $index = 0;
                @endphp
                @if ($todayEvent->count() == 0)
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $index }}"
                        aria-label="Slide {{ $index }}" @if($index==0) class="active" @endif></button>
                @else
                    @for ($i = 0; $i < $todayEvent->count(); $i++)
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $index }}"
                            aria-label="Slide {{ $index }}" @if($index==0) class="active" @endif></button>
                        @php
                            $index++;
                        @endphp
                    @endfor
                @endif
                @if ($upcomingEvent->count() == 0)
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $index }}"
                        aria-label="Slide {{ $index }}" @if($index==0) class="active" @endif></button>
                @else
                    @for ($i = 0; $i < $upcomingEvent->count(); $i++)
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $index }}"
                            aria-label="Slide {{ $index }}" @if($index==0) class="active" @endif></button>
                        @php
                            $index++;
                        @endphp
                    @endfor
                @endif
            @endif
        </div>
        <div class="carousel-inner">
            @forelse ($todayEvent as $event)
                <div class="carousel-item @if ($loop->iteration == 1) active @endif" data-bs-interval="6000">
                    <div class="d-block w-300">
                        <h1 style="font-family:'Tahoma'; font-size:64pt" class="text-center mb-5">Agenda Hari Ini</h1>
                        <!-- <div class="row"> -->
                            <div class="row d-flex justify-content-center">
                                <!-- <div class="col-9"> -->
                                    <!-- <div class="event overflow-auto bg-white"> -->
                                        <div class="desc">
                                            <div class="row h1">
                                                <div class="col-12 text-center">
                                                    <b>{{ $event->title }}</b>
                                                </div>
                                            </div>
                                            <div class="row h1">
                                                <div class="col-12 text-center">
                                                    {{ $event->location }}
                                                </div>
                                            </div>
                                            <div class="row h1">
                                                <div class="col-12 text-center">
                                                    {{ $event->penyelenggara }}
                                                </div>
                                            </div>
                                            <div class="row h1">
                                                <div class="col-12 text-center">
                                                @php
                                                    $tgl1 = \Carbon\Carbon::parse($event->start)->translatedFormat('l, d F Y');
                                                    $tgl2 = \Carbon\Carbon::parse($event->end)->translatedFormat('l, d F Y');
                                                @endphp
                                                    @if ($tgl1 == $tgl2)
                                                    {{ \Carbon\Carbon::parse($event->start)->translatedFormat('l, d F Y') }}<br/>
                                                    {{ \Carbon\Carbon::parse($event->start)->translatedFormat('H:i') }} WIB sampai
                                                    {{ \Carbon\Carbon::parse($event->end)->translatedFormat('H:i') }} WIB
                                                    @else
                                                    {{ \Carbon\Carbon::parse($event->start)->translatedFormat('l, d F Y') }}
                                                    {{ \Carbon\Carbon::parse($event->start)->translatedFormat('H:i') }} WIB sampai<br/>
                                                    {{ \Carbon\Carbon::parse($event->end)->translatedFormat('l, d F Y') }}
                                                    {{ \Carbon\Carbon::parse($event->end)->translatedFormat('H:i') }} WIB
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="date float-end">
                                            <div class="day">{{ \Carbon\Carbon::parse($event->start)->format('d') }}
                                            </div>
                                            <div class="month">
                                                {{ \Carbon\Carbon::parse($event->start)->translatedFormat('F') }}</div>
                                        </div> -->
                                    <!-- </div> -->
                                <!-- </div> -->
                            </div>
                        <!-- </div> -->
                    </div>
                </div>
            @empty
                <div class="carousel-item active" data-bs-interval="5000">
                    <div class="d-block w-100">
                        <h1 class="text-center mb-5" style="font-family:'Tahoma'; font-size:64pt">Agenda Hari Ini</h1>
                        <!-- <div class="row"> -->
                            <div class="row d-flex justify-content-center">
                                <!-- <div class="col-7"> -->
                                    <h1 class="text-center" style="font-family:'Tahoma'; font-size:60pt">Belum Ada Agenda</h1>
                                <!-- </div> -->
                            </div>
                        <!-- </div> -->
                    </div>
                </div>
            @endforelse
            @forelse ($upcomingEvent as $event)
                <div class="carousel-item" data-bs-interval="6000">
                    <div class="d-block w-100">
                        <h1 style="font-family:'Tahoma'; font-size:64pt" class="text-center mb-5">Agenda Akan Datang</h1>
                        <div class="row mt-5">
                            <div class="row d-flex justify-content-center">
                                <div class="desc" style="font-family:'Tahoma'; font-size:60pt">
                                    <div class="row h1">
                                        <div class="col-12 text-center">
                                            <b>{{ $event->title }}</b>
                                        </div>
                                    </div>
                                    <div class="row h1">
                                        <div class="col-12 text-center">
                                            {{ $event->location }}
                                        </div>
                                    </div>
                                    <div class="row h1">
                                        <div class="col-12 text-center">
                                            {{ $event->penyelenggara }}
                                        </div>
                                    </div>
                                    <div class="row h1">
                                        <div class="col-12 text-center">
                                        @php
                                            $tgl1 = \Carbon\Carbon::parse($event->start)->translatedFormat('l, d F Y');
                                            $tgl2 = \Carbon\Carbon::parse($event->end)->translatedFormat('l, d F Y');                                            
                                        @endphp
                                            @if ($tgl1 == $tgl2)
                                            {{ \Carbon\Carbon::parse($event->start)->translatedFormat('l, d F Y') }}<br/>
                                            {{ \Carbon\Carbon::parse($event->start)->translatedFormat('H:i') }} WIB sampai
                                            {{ \Carbon\Carbon::parse($event->end)->translatedFormat('H:i') }} WIB
                                            @else
                                            {{ \Carbon\Carbon::parse($event->start)->translatedFormat('l, d F Y') }}
                                            {{ \Carbon\Carbon::parse($event->start)->translatedFormat('H:i') }} WIB sampai<br/>
                                            {{ \Carbon\Carbon::parse($event->end)->translatedFormat('l, d F Y') }}
                                            {{ \Carbon\Carbon::parse($event->end)->translatedFormat('H:i') }} WIB
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-7">
                                    <div class="event overflow-auto bg-white"> -->
                                        <!-- <div class="desc">
                                            <h1>{{ $event->peserta }} - {{ $event->title }}</h1>
                                            <span class="fa fa-map-marker"></span> {{ $event->location }}
                                        </div> -->
                                        <!-- <div class="date float-end">
                                            <div class="day">{{ \Carbon\Carbon::parse($event->start)->format('d') }}
                                            </div>
                                            <div class="month">
                                                {{ \Carbon\Carbon::parse($event->start)->translatedFormat('F') }}</div>
                                        </div> -->
                                    <!-- </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="carousel-item" data-bs-interval="3000">
                    <div class="d-block w-100">
                        <h1 class="text-center mb-5" style="font-family:'Tahoma'; font-size:64pt">Agenda Akan Datang</h1>
                        <!-- <div class="row"> -->
                            <div class="row d-flex justify-content-center">
                                <!-- <div class="col-7"> -->
                                    <h1 class="text-center" style="font-family:'Tahoma'; font-size:60pt">Belum Ada Agenda</h1>
                                <!-- </div> -->
                            </div>
                        <!-- </div> -->
                    </div>
                </div>
            @endforelse
        </div>        
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button style="margin-top: 64px" class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
@endsection
