@extends('admin.layouts.main_template')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/role/index.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/admin/main.js') }}"></script>
    <script src="{{ asset('js/admin/role/index.js') }}"></script>
@endsection

@section('content')

    @if(session('delete'))
        <script>
            showMessage('success', '{{ __('admin.role_delete_success') }}' , 1000, 'top-end');
        </script>
    @endif

    <div class="role">

        <div class="page__header">
            <div class="page__title">
                <p>
                    {{ __('admin.role') }}
                </p>
            </div>

            @if($user->hasPermissionTo('Role Create', 'admin'))
                <div class="new__role">
                    <a href="{{ route('role_create') }}">
                        {{ __('admin.new_role') }}
                    </a>
                </div>
            @endif

        </div>

        <div class="role__table__container">

            <div class="table__container">
                <table class="role__table">
                    <thead>
                    <tr class="table__head">
                        <th>#</th>
                        <th>{{ __('admin.role_name') }}</th>
                        <th>{{ __('admin.edit') }}</th>
                        <th>{{ __('admin.delete') }}</th>
                    </tr>
                    </thead>
                    <tbody class="table__body">

                    @foreach($roles as $key => $role)

                        <tr>

                            <td class="tbody__td">{{ $role->id }}</td>
                            <td class="tbody__td">{{ $role->name }}</td>
                            <td>
                                <a href="role/{{ $role->id }}/edit" class="edit__link">
                                    <i class="pen__icon fa-solid fa-pen"></i>
                                    <p>{{ __('admin.edit') }}</p>
                                </a>
                            </td>

                            <td>
                                <form action="{{ route('role_delete', $role->id) }}" method="POST" class="delete__form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="confirm_delete(event)" class="delete__link border__none background__none">
                                        <i class="delete__icon fa-solid fa-trash-can"></i>
                                        <p>{{ __('admin.delete') }}</p>
                                    </button>
                                </form>
                            </td>

                        </tr>

                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>

    </div>
@endsection
