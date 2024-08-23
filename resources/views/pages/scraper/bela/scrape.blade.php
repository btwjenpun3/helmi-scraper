@extends('app.master')

@section('header')
    <div class="page-header d-print-none text-white">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Overview
                    </div>
                    <h2 class="page-title">
                        Scraper Bela
                    </h2>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @livewire('scraper.bela')
@endsection
