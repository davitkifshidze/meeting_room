
@extends('admin.layouts.main_template')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/role/edit.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/admin/main.js') }}"></script>
    <script src="{{ asset('js/admin/role/edit.js') }}"></script>

@endsection

@section('content')

    @if(session('update'))
        <script>
            showMessage('success', '{{ __('admin.role_edit_success') }}' , 1000, 'top-end');
        </script>
    @endif

    <div class="edit__page__container">

        <div class="edit__page__header">
            <p class="edit__title">
                {{ __('admin.edit_role') }}
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

            <form action="{{ route('role_update', $role->id) }}" method="POST" class="edit__form"  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="full_container">

                    <div class="form__group row">
                        <div class="input__group full">
                            <label for="name" class="label">
                                <p>{{ __('admin.role_name') }}</p>
                                <span><i class="fa-solid fa-snowflake"></i></span>
                            </label>
                            <input type="text" name="name" value="{{ $role->name }}">
                        </div>
                    </div>

                    <div class="permission__list">
                        @foreach($permissions as $permission)
                            <div class="permission__box">
                                <div class="switch__container">
                                    <label class="switch" for="{{ $permission->name }}">
                                        <input type="checkbox" name="permission[{{ $permission->name }}]" id="{{ $permission->name }}" {{ in_array($permission->name, $role_permissions) ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                    <label class="switcher__label" for="{{ $permission->name }}">{{ $permission->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="edit__submit__container">
                        <input type="submit" value="{{ __('admin.edit') }}" class="edit__btn">

                        <a href="{{ route('role_list') }}" class="cancel__btn">
                            {{ __('admin.cancel') }}
                        </a>
                    </div>

                </div>


            </form>
        </div>

    </div>


@endsection





