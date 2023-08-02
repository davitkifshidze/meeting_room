<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    {{-- Font Awesome 6.3.0 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js"></script>

    {{-- Jquery CDN --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    {{-- Bootstrap CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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


<div class="main__template">

    @yield('content')

</div>


<!-- Custom Js -->
@yield('script')

</body>
</html>