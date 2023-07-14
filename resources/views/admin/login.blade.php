@extends('admin.layouts.login_template')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/admin/login.js') }}"></script>
@endsection

@section('content')


    <div class="login__page">

        <div class="lang__switcher">
            <ul class="default__lang">
                <div class="icon">
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
                <li>
                    {{ LaravelLocalization::getCurrentLocalenative() }}
                </li>
            </ul>
            <ul class="lang__select__list">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li>
                        <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>


        <div class="login__page__container">

            <div class="login__left__container">
                <img src="{{ asset('assets/images/logo/todua.svg') }}" alt="">
            </div>

            <div class="login__container">

                <div class="login__form__container">

                    {!! Form::open(["route" => "login", "method" => "POST"]) !!}
                    @csrf

                    <div class="login__form__group">
                        <div class="input__with__icon__container">
                            <div class="input__icon__container">
                                <i class="input__icon fa-regular fa-envelope"></i>
                            </div>
                            {!! Form::email('email', '', ['class' => 'input__with__icon form__input', 'placeholder' => 'admin@gmail.com','id' => 'email', 'required' => 'required']) !!}
                        </div>
                    </div>
                    <div class="login__form__group">

                        <div class="input__with__icon__container">
                            <div class="input__icon__container">
                                <i class="input__icon fa-solid fa-lock"></i>
                            </div>
                            {!! Form::password('password', ['class' => 'input__with__icon form__input', 'placeholder' => 'password_example', 'id' => 'password', 'required' => 'required']) !!}
                        </div>
                        <i class="fa-solid fa-eye-slash" id="eye" onclick="show_hide_password()"></i>
                    </div>


                    <div class="login__error__container">
                        @if(session()->has('wrong_fields'))
                            <p class="login__error">
                                {{ session('wrong_fields') }}
                            </p>
                        @endif
                    </div>

                    <div class="login__form__group">
                        {!! Form::submit(__('admin.login'), ['class' => 'auth__btn', 'name' => 'auth', 'id' => 'auth']) !!}
                    </div>

                    {!! Form::close() !!}

                </div>

            </div>

        </div>


    </div>

@endsection




