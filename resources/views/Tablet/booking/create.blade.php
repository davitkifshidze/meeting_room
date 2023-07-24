@extends('tablet.layouts.main_template')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/tablet/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tablet/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tablet/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tablet/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('css/tablet/booking/index.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/tablet/app.js') }}"></script>
    <script src="{{ asset('js/tablet/main.js') }}"></script>
    <script src="{{ asset('js/tablet/booking/index.js') }}"></script>
@endsection

@section('content')

    <div class="page__container">

        <div class="form__container">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="" method="POST" class="index__form"  enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="room_id" id="curent__room" value="{{ $room_id }}">

                <div class="full_container">

                    <div class="form__group row " id="calendar__container">

                        <div class="input__group full" id="calendar__box">
                            <div class="booking__calendar__container">
                                <input type="text" id="booking_room_calendar" class="booking_room_calendar skip skipped"/>
                            </div>
                        </div>

                        <div class="input__group h-100 hide" id="time__container">
                            <div class="time__container w-100" id="time__list">
                            </div>
                        </div>

                    </div>


                    <div class="submit__container hide" id="create__container">

                        <a id="create__booking" href="javascript:void(0)"  class="create__btn">
                            {{ __('admin.make_booking') }}
                        </a>

                        <a href="{{ route('tablet_index',$room_id) }}" class="cancel__btn">
                            {{ __('admin.cancel') }}
                        </a>
                    </div>

                </div>


            </form>
        </div>


        <div id="hidden__modal" class="hidden__modal" style="display: none;">

            <div class="close__container">
                <span id="close__modal" class="close__modal">
                    <i class="fa-solid fa-xmark"></i>
                </span>
            </div>

            <form id="user__form">
                @csrf
                <div class="modal__input__group">
                    <label for="number">მომხმარებელი</label>
                    <input type="text" id="username" name="username">
                </div>

                <div class="modal__input__group">
                    <label for="password">პაროლი</label>
                    <input type="password" id="password" name="password">
                </div>


                <div class="btn__container">
                    <input class="check__user__btn" type="submit" value="ავტორიზაცია" >
                </div>
            </form>
        </div>


    </div>

@endsection