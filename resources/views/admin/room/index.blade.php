@extends('admin.layouts.main_template')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/room/index.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/admin/main.js') }}"></script>
    <script src="{{ asset('js/admin/room/index.js') }}"></script>
@endsection

@section('content')

    @if(session('delete'))
        <script>
            showMessage('success', '{{ __('admin.room_delete_succes') }}', 1000, 'top-end');
        </script>
    @endif

    <div class="room">

        <div class="page__header">
            <div class="page__title">
                <p>
                    {{ __('admin.room') }}
                </p>
            </div>

            @if($user->hasPermissionTo('Room Create', 'admin'))
                <div class="new__room">
                    <a href="{{ route('room_create') }}">
                        {{ __('admin.new_room') }}
                    </a>
                </div>
            @endif

        </div>

        <div class="room__table__container">

            <div class="table__container">
                <table class="room__table">
                    <thead>
                    <tr class="table__head">
                        <th>#</th>
                        <th>{{ __('admin.name') }}</th>
                        <th>{{ __('admin.status') }}</th>
                        <th>{{ __('admin.start_date') }}</th>
                        <th>{{ __('admin.end_date') }}</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="table__body">

                    @foreach($rooms as $key => $room)

                        <tr>

                            <td class="tbody__td">{{ $room->id }}</td>
                            <td class="tbody__td">{{ $room->name }}</td>
                            <td>
                                <p class="room__status">
                                    <i class="fa-regular {{ $room->status == 1 ? 'fa-circle-check approve' : 'fa-circle-xmark dismiss' }}"></i>
                                </p>
                            </td>
                            <td class="tbody__td">{{ $room->start_date }}</td>
                            <td class="tbody__td">{{ $room->end_date }}</td>

                            <td>
                                <a href="room/{{ $room->id }}/edit" class="edit__link">
                                    <i class="pen__icon fa-solid fa-pen"></i>
                                    <p>{{ __('admin.edit') }}</p>
                                </a>
                            </td>

                            <td>
                                <form action="{{ route('room_delete', $room->id) }}" method="POST"
                                      class="delete__form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="confirm_delete(event)"
                                            class="delete__link border__none background__none">
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
