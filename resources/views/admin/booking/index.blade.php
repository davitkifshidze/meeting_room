@extends('admin.layouts.main_template')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/responsive.css') }}">

    <link rel="stylesheet" href="{{ asset('css/admin/booking/index.css') }}">
@endsection

@section('script')
    <script src="{{ asset('js/admin/main.js') }}"></script>
    <script src="{{ asset('js/admin/booking/index.js') }}"></script>
@endsection

@section('content')

    @if(session('delete'))
        <script>
            showMessage('success', '{{ __('admin.booking_delete_success') }}' , 1000, 'top-end');
        </script>
    @endif

    <div class="booking">

        <div class="page__header">
            <div class="page__title">
                <p>
                    {{ __('admin.booking') }}
                </p>
            </div>

            @if($user->hasPermissionTo('Booking Create', 'admin'))
                <div class="new__booking">
                    <a href="{{ route('booking_create') }}">
                        {{ __('admin.new_booking') }}
                    </a>
                </div>
            @endif

        </div>



        <div class="filter__container">

            <form action="{{ route('booking_list') }}" class="form__container" method="GET" enctype="multipart/form-data">

                <div class="form__group row w-100">

                    @if ($user->hasRole('Super Admin'))
                        <div class="input__group third">
                            <select name="user" id="user__select" multiple>
                                <option value=""></option>
                                @foreach($users as $key => $user)
                                    <option value="<?= $user->id ?>" @if(Request::get('user') == $user->id) selected @endif ><?= $user->username ?></option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @php
                        $user = auth()->guard('admin')->user();
                        $isAdmin = $user->hasRole('Super Admin');
                    @endphp

                    <div class="input__group  @if ($isAdmin) third @else half @endif ">
                        <select name="room" id="room__select" multiple>
                            <option value=""></option>

                            @foreach($rooms as $key => $room)
                                <option value="<?= $room->id ?>" @if(Request::get('room') == $room->id) selected @endif ><?= $room->name ?></option>
                            @endforeach

                        </select>
                    </div>

                    <div class="btn__container @if ($isAdmin) third @else half @endif ">
                        <input class="filter__btn" type="submit" value="{{ __('admin.filter') }}">
                        <a href="{{ route('booking_list') }}" class="clear__btn">{{ __('admin.clear') }}</a>
                    </div>

                </div>

            </form>

        </div>


        <div class="booking__table__container">

            <div class="table__container">
                <table class="booking__table">
                    <thead>
                    <tr class="table__head">
                        <th>#</th>
                        <th>{{ __('admin.room_name') }}</th>
                        <th>{{ __('admin.username') }}</th>
                        <th>{{ __('admin.start_date') }}</th>
                        <th>{{ __('admin.end_date') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="table__body">

                    @foreach($bookings as $key => $booking)

                        <tr>

                            <td class="tbody__td">{{ $booking->id }}</td>
                            <td class="tbody__td">{{ $booking->room_name }}</td>
                            <td class="tbody__td">{{ $booking->username }}</td>
                            <td class="tbody__td">{{ $booking->start_date }}</td>
                            <td class="tbody__td">{{ $booking->end_date }}</td>

                            <td>
                                <form action="{{ route('booking_delete', $booking->id) }}" method="POST" class="delete__form">
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

                <div>
                    {{ $bookings->links('admin.pagination.full') }}
                </div>

            </div>
        </div>

    </div>
@endsection
