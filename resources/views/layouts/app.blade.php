<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        
        @include('common.header')

        @yield('content')

        @include('common.footer')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    {{--CKEditor--}}
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('editor1');
    </script>

    {{--CKFinder--}}
    <script src="/ckfinder/ckfinder.js"></script>
    <script>
        $(document).ready(function() {
            $('#ckFinder-popUp').on('click', function (e) {
                e.preventDefault();
                    CKFinder.popup( {
                    chooseFiles: true,
                    onInit: function( finder ) {
                        finder.on( 'files:choose', function( evt ) {
                            var file = evt.data.files.first();
                            document.getElementById( 'image_path' ).value = file.getUrl();
                            $('#image_path_text').attr('src', file.getUrl());
                        } );
                        finder.on( 'file:choose:resizedImage', function( evt ) {
                            document.getElementById( 'image_path' ).value = evt.data.resizedUrl;
                            $('#image_path_text').attr('src', evt.data.resizedUrl);
                        } );
                    }
                });
            });
        });
    </script>

</body>
</html>
