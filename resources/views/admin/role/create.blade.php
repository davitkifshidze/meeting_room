
@extends('admin.layouts.main_template')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/role/create.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/admin/main.js') }}"></script>
    <script src="{{ asset('js/admin/role/create.js') }}"></script>

@endsection

@section('content')

    <div class="create__page__container">

        <div class="create__page__header">
            <p class="create__title">
                {{ __('admin.role_create') }}
            </p>
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

            <form action="{{ route('role_store') }}" method="POST" class="create__form"  enctype="multipart/form-data">
                @csrf

                <div class="full_container">

                    <div class="form__group row">
                        <div class="input__group full">
                            <label for="name" class="label">
                                <p>{{ __('admin.role_name') }}</p>
                                <span><i class="fa-solid fa-snowflake"></i></span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="create__submit__container">
                        <input type="submit" value="{{ __('admin.save') }}" class="create__btn">

                        <a href="{{ route('role_list') }}" class="cancel__btn">
                            {{ __('admin.cancel') }}
                        </a>
                    </div>

                </div>


            </form>
        </div>

    </div>


@endsection





