@extends('admin.layouts.main_template')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/admin/main.js') }}"></script>
@endsection

@section('content')

    <div class="dashboard">

        <div class="title">
            <p>{{ __('admin.dashboard') }}</p>
        </div>

        <div class="card__container">

            <div class="dash__card">
                <div class="icon__container room__card">
                    <i class="fa-regular fa-hospital"></i>
                </div>
                <div class="card__info">
                    <p class="info__number">{{ $room }}</p>
                    <p class="info__title">{{ __('admin.room') }}</p>
                </div>
            </div>
            <div class="dash__card">
                <div class="icon__container booking__card">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="card__info">
                    <p class="info__number">{{ $booking }}</p>
                    <p class="info__title">{{ __('admin.booking') }}</p>
                </div>
            </div>


        </div>

    </div>


@endsection




