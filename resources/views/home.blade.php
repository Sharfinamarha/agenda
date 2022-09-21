@extends('layouts.main')
@section('title', 'Home')
@section('container')
    <div id="carouselExampleDark" class="carousel carousel-dark slide mb-3" data-bs-ride="carousel" style="height: 540px;">
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
                <div class="carousel-item @if ($loop->iteration == 1) active @endif" data-bs-interval="5000">
                    <div class="d-block w-300">
                        <h1 style="font-family:'Tahoma'" class="text-center mb-5">Agenda Hari Ini</h1>
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
                                                    {{ \Carbon\Carbon::parse($event->start)->translatedFormat('l, d F Y') }}<br/>
                                                    {{ \Carbon\Carbon::parse($event->start)->translatedFormat('h:i') }} WIB sampai
                                                    {{ \Carbon\Carbon::parse($event->end)->translatedFormat('h:i') }} WIB
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
                        <h3 class="text-center mb-5">Agenda Hari Ini</h3>
                        <!-- <div class="row"> -->
                            <div class="row d-flex justify-content-center">
                                <!-- <div class="col-7"> -->
                                    <h3 class="text-center">Belum Ada Agenda</h6>
                                <!-- </div> -->
                            </div>
                        <!-- </div> -->
                    </div>
                </div>
            @endforelse
            @forelse ($upcomingEvent as $event)
                <div class="carousel-item" data-bs-interval="3000">
                    <div class="d-block w-100">
                        <h1 style="font-family:'Tahoma'" class="text-center mb-5">Agenda Akan Datang</h1>
                        <div class="row mt-5">
                            <div class="row d-flex justify-content-center">
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
                                            {{ \Carbon\Carbon::parse($event->start)->translatedFormat('l, d F Y') }}<br/>
                                            {{ \Carbon\Carbon::parse($event->start)->translatedFormat('h:i') }} WIB sampai
                                            {{ \Carbon\Carbon::parse($event->end)->translatedFormat('h:i') }} WIB
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
                        <h3 class="text-center mb-5">Agenda Akan Datang</h3>
                        <!-- <div class="row"> -->
                            <div class="row d-flex justify-content-center">
                                <!-- <div class="col-7"> -->
                                    <h3 class="text-center">Belum Ada Agenda</h6>
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
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
@endsection
