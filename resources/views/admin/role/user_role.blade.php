@extends('admin.layouts.main_template')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/role/user_role.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/admin/main.js') }}"></script>
    <script src="{{ asset('js/admin/role/user_role.js') }}"></script>
@endsection

@section('content')

    @if(session('update'))
        <script>
            showMessage('success', '{{ __('admin.add_user_role') }}' , 1000, 'top-end');
        </script>
    @endif

    <div class="edit__page__container">

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

            <form action="{{ route('user_role_add', $user->id) }}" method="POST" class="edit__form"  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="full_container">

                    <div class="form__group row">

                        <div class="input__group half">
                            <label class="label">
                                <p>{{ __('admin.user') }}</p>
                                <span><i class="fa-solid fa-snowflake"></i></span>
                            </label>
                            <select name="user" id="user__select" multiple class="no__arrow">
                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                            </select>
                        </div>

                        <div class="input__group half">
                            <label class="label">
                                <p>{{ __('admin.role') }}</p>
                                <span><i class="fa-solid fa-snowflake"></i></span>
                            </label>
                            <select name="role" id="role__select" multiple>
                                <option value=""></option>
                                @foreach($roles as $key => $role)

                                    <option value="{{ $role->id }}" @if($user->hasRole($role->name)) selected @endif>
                                        {{ $role->name }}
                                    </option>

                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="edit__submit__container">
                        <input type="submit" value="{{ __('admin.edit') }}" class="edit__btn">

                        <a href="{{ route('user_list') }}" class="cancel__btn">
                            {{ __('admin.cancel') }}
                        </a>
                    </div>


                </div>


            </form>
        </div>

    </div>

@endsection