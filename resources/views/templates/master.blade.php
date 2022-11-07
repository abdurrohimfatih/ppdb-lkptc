<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Administrator</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <!-- plugin css -->
    <link href="{{ asset('css/iconfont.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <!-- end plugin css -->
    <link href="{{ asset('css/prism.css') }}" rel="stylesheet" />
    <!-- common css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet" />
    <!-- end common css -->
</head>

<body data-base-url="/">
    <script src="{{ asset('js/spinner.js') }}"></script>
    <div class="main-wrapper" id="app">
        <nav class="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('dashboard') }}" class="sidebar-brand">
                    PPDB<span>LKP TC</span>
                </a>
                <div class="sidebar-toggler not-active">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="sidebar-body">
                @include('templates.left_menu')
            </div>
        </nav>

        <div class="page-wrapper">
            <nav class="navbar">
                <a href="#" class="sidebar-toggler">
                    <i data-feather="menu"></i>
                </a>
                <div class="navbar-content">
                    @include('templates.top_menu')
                </div>
            </nav>
            <div class="page-content">
                @yield('content')
            </div>


            <footer
                class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
                <p class="text-muted mb-1 mb-md-0">Copyright © {{ now()->format('Y') }} <a
                        href="javascript:void(0);">PPDB LKP TC</a>.</p>
                <p class="text-muted">Handcrafted With <i class="mb-1 text-primary ms-1 icon-sm"
                        data-feather="heart"></i></p>
            </footer>
        </div>
    </div>


    <!-- base js -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <script src="{{ asset('js/perfect-scrollbar.min.js') }}"></script>
    {{-- <script src="{{asset('js/table2excel.js')}}"></script> --}}
    <!-- end base js -->

    <!-- plugin js -->
    <script src="{{ asset('js/prism.js') }}"></script>
    <script src="{{ asset('js/clipboard.min.js') }}"></script>
    <!-- end plugin js -->

    <!-- common js -->
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/buttons.print.min.js') }}"></script>

    <script>
        var table = $('#table');
        var fileName = table.attr("data-fileName");

        $(document).ready(function() {
            var tabel = $('#table').DataTable({
                dom: "<'row'<'col-md-4'l><'col-md-4'B><'col-md-4'f>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row'<'col-md-5'i><'col-md-7'p>>",
                lengthMenu: [
                    [5, 10, 20, 50, -1],
                    ['5', '10', '20', '50', 'Semua']
                ],
                buttons: [{
                        extend: 'excelHtml5',
                        title: fileName + ' PPDB LKP TC'
                    },
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        title: fileName + ' PPDB LKP TC',
                        exportOptions: {
                            columns: [0, 1, 2, 4, 6, 7, 8, 9]
                        }
                    },
                    {
                        extend: 'print',
                        title: fileName + ' PPDB LKP TC'
                    }
                ]
            });

        });
    </script>

</body>

</html>
