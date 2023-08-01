@extends('admin.layouts.main_template')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/room/create.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/admin/main.js') }}"></script>
    <script src="{{ asset('js/admin/room/create.js') }}"></script>





@endsection

@section('content')

    <div class="create__page__container">
        <div class="create__page__header">
            <p class="create__title">
                {{ __('admin.room_create') }}
            </p>

            <div class="lang__tabs">
                <a class="lang__tab active__lang" data-lang="ka" href="javascript:void(0)">Ka</a>
                <a class="lang__tab" data-lang="en" href="javascript:void(0)">En</a>
            </div>
        </div>

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

            <form action="{{ route('room_store') }}" method="POST" class="create__form"  enctype="multipart/form-data">

                @csrf

                @foreach (LaravelLocalization::getSupportedLocales() as $locale_code => $local)

                    <div class="translatable hide" data-lang-container="{{ $locale_code }}">

                        {{-- Name --}}
                        <div class="form__group row">
                            <div class="input__group full">
                                <label for="name" class="label">
                                    <p>{{ __('admin.name') }}</p>
                                    <span><i class="fa-solid fa-snowflake"></i></span>
                                </label>
                                <input type="text"  name="name[{{ $locale_code }}]" data-lang="{{ $locale_code }}" value="{{ old('name') }}">
                            </div>
                        </div>

                    </div>

                @endforeach

                <div class="non__translatable">

                    {{-- Start Date & End Date & Status--}}
                    <div class="form__group column">

                        <div class="input__group full px-0">
                            <label for="email" class="label">
                                <p>{{ __('admin.start_date') }}</p>
                            </label>
                            <input type="text" id="start_date" name="start_date" onkeypress="return false" required autocomplete="off"/>
                        </div>

                        <div class="input__group  full px-0">
                            <label for="facebook" class="label">
                                <p>{{ __('admin.end_date') }}</p>
                            </label>
                            <input type="text" id="end_date" name="end_date" onkeypress="return false" required autocomplete="off"/>
                        </div>


                        <div class="input__group full">
                            <div class="switch__container">
                                <label class="switch">
                                    <input type="checkbox" name="status" id="status" checked>
                                    <span class="slider round"></span>
                                </label>
                                <p>{{ __('admin.status') }}</p>
                            </div>
                        </div>

                    </div>


                    <div class="create__submit__container">
                        <input type="submit" value="{{ __('admin.save') }}" class="create__btn">

                        <a href="{{ route('room_list') }}" class="cancel__btn">
                            {{ __('admin.cancel') }}
                        </a>
                    </div>

                </div>

            </form>
        </div>

    </div>

@endsection





