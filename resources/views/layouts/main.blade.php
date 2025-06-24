<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- jQuery -->
        <script src=" https://code.jquery.com/jquery-3.7.1.min.js">
        </script>

        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />

        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    </head>

    <body class="bg-gray-50 text-gray-800">

        @include('components.header')

        <div class="container mx-auto mt-8">
            @yield('content')
        </div>

        @include('components.footer')

        <!-- Initialize DataTables -->
        <script>
            $(document).ready(function () {
                      $('#simpledataTable').DataTable({
                          paging: true,
                          searching: true,
                          info: false,
                          ordering: true
                      });
                    });
        </script> <!-- End Initialize DataTables -->

    </body>

</html>