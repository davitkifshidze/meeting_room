@extends('admin.layouts.main_template')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/booking/create.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/admin/main.js') }}"></script>
    <script src="{{ asset('js/admin/booking/create.js') }}"></script>
@endsection

@section('content')

    <div class="create__page__container">

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

            <form action="{{ route('booking_store') }}" method="POST" class="create__form"  enctype="multipart/form-data">
                @csrf

                <div class="full_container">

                    <div class="form__group row">

                        <div class="input__group half">
                            <label class="label">
                                <p>{{ __('admin.user') }}</p>
                                <span><i class="fa-solid fa-snowflake"></i></span>
                            </label>
                            <select name="user" id="user__select" multiple class="no__arrow">
                                <option value="<?= '3' ?>"><?= '4' ?></option>
                            </select>
                        </div>

                        <div class="input__group half">
                            <label class="label">
                                <p>{{ __('admin.room') }}</p>
                                <span><i class="fa-solid fa-snowflake"></i></span>
                            </label>
                            <select name="room" id="room__select" multiple>
                                <option value=""></option>
                                @foreach($rooms as $key => $room)
                                    <option value="<?= $room->id ?>"><?= $room->name ?></option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form__group row hide" id="calendar__container">

                        <div class="input__group half">
                            <label class="label">
                                <p>{{ __('admin.booking_calendar') }}</p>
                                <span><i class="fa-solid fa-snowflake"></i></span>
                            </label>

                            <div class="booking__calendar__container">
                                <input type="text" id="booking_room_calendar" class="booking_room_calendar skip skipped"/>
                            </div>
                        </div>

                        <div class="input__group h-100 hide" id="time__container">

                                <label class="label">
                                    <p>{{ __('admin.booking_time') }}</p>
                                    <span><i class="fa-solid fa-snowflake"></i></span>
                                </label>
                            <div class="time__container w-100" id="time__list">

                            </div>
                        </div>


                    </div>


                    <div class="create__submit__container">
                        <input type="submit" value="{{ __('admin.make_booking') }}" class="create__btn">

                        <a href="{{ route('booking_list') }}" class="cancel__btn">
                            {{ __('admin.cancel') }}
                        </a>
                    </div>

                </div>


            </form>
        </div>

    </div>

@endsection