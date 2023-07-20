@extends('admin.layouts.main_template')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/role/user.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/admin/main.js') }}"></script>
    <script src="{{ asset('js/admin/role/user.js') }}"></script>
@endsection

@section('content')

    <div class="user">

        <div class="page__header">
            <div class="page__title">
                <p>
                    {{ __('admin.user') }}
                </p>
            </div>
        </div>

        <div class="user__table__container">

            <div class="table__container">
                <table class="user__table">
                    <thead>
                    <tr class="table__head">
                        <th>#</th>
                        <th>{{ __('admin.name') }}</th>
                        <th>{{ __('admin.email') }}</th>
                        <th>{{ __('admin.give_role') }}</th>
                    </tr>
                    </thead>
                    <tbody class="table__body">

                    @foreach($users as $key => $user)

                        <tr>

                            <td class="tbody__td">{{ $user->id }}</td>
                            <td class="tbody__td">{{ $user->name }}</td>
                            <td class="tbody__td">{{ $user->email }}</td>
                            <td>
                                <a href="{{ $user->id }}/user_role" class="edit__link">
                                    <i class="pen__icon fa-solid fa-pen"></i>
                                    <p>{{ __('admin.give_role') }}</p>
                                </a>
                            </td>

                        </tr>

                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>

    </div>
@endsection
