<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Font Awesome 6.3.0 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js"></script>

    {{-- Jquery CDN --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    {{-- TinyMce --}}
    <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>

    {{-- Date Range Picker --}}
    <script type="text/javascript" src="{{ asset('assets/plugins/date-range-picker/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/date-range-picker/daterangepicker.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/date-range-picker/daterangepicker.css') }}"/>

    {{-- Tag Picker --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/tag-picker/tagify.css') }}">
    <script src="{{ asset('assets/plugins/tag-picker/tagify.js') }}"></script>
    <script src="{{ asset('assets/plugins/tag-picker/jQuery.tagify.min.js') }}"></script>

    {{-- Multiple Selector --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/multiple-select/css/mobiscroll.javascript.min.css') }}">
    <script src="{{ asset('assets/plugins/multiple-select/js/mobiscroll.javascript.min.js') }}"></script>

    {{-- Date Time Picker --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/date-time-picker-flatpickr/flatpickr.min.css') }}">
    <script src="{{ asset('assets/plugins/date-time-picker-flatpickr/flatpickr.js') }}"></script>

    {{-- Sweet Alert --}}
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>

    {{-- Select2 --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <script src="{{ asset('assets/plugins/select2/js/select2.js') }}"></script>

    {{--  Jquary Date Time Picker  --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/date-time-picker/jquery.datetimepicker.css') }}">
    <script src="{{ asset('assets/plugins/date-time-picker/php-date-formatter/js/php-date-formatter.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/date-time-picker/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('assets/plugins/date-time-picker/jquery.datetimepicker.js') }}"></script>

    {{--  Custom Style  --}}
    @yield('style')

    {{--  Custom Global Js  --}}
    <script src="{{ asset('js/admin/app.js') }}"></script>
    @yield('header-script')


</head>
<body>

<div class="panel__page__template" id="page__template">

    @include('admin.layouts.include.sidebar')

    <div class="main__container">

        @include('admin.layouts.include.header')

        <main class="main__content">
            @yield('content')
        </main>

    </div>

</div>

{{-- Custom Js --}}
@yield('script')

</body>
</html>
