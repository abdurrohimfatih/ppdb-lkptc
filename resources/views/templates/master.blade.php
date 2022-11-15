<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - Administrator</title>
    <link rel="icon" href="{{ asset('Logo-LKPTC-32x32.png') }}" sizes="32x32">
    <link rel="icon" href="{{ asset('Logo-LKPTC-192x192.png') }}" sizes="192x192">
    <link rel="apple-touch-icon" href="{{ asset('Logo-LKPTC-180x180.png') }}">
    <!-- plugin css -->
    <link href="{{ asset('css/iconfont.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <!-- end plugin css -->
    <link href="{{ asset('css/prism.css') }}" rel="stylesheet" />
    <!-- common css -->
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
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
    <script src="{{ asset('js/html2canvas.min.js') }}"></script>
    <script src="{{ asset('js/inputmask.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <script>
        @if (\Illuminate\Support\Facades\Auth::user()->level >= 2 && Request::url() === route('dashboard'))
            var style = {
                primary: "#6571ff",
                secondary: "#7987a1",
                success: "#05a34a",
                success2: "#00e396",
                info: "#66d1d1",
                warning: "#fbbc06",
                danger: "#ff3366",
                light: "#e9ecef",
                dark: "#060c17",
                muted: "#7987a1",
                muted2: "#a19c8a",
                gridBorder: "rgba(77, 138, 240, .15)",
                bodyColor: "#000",
                cardBg: "#fff",
                fontSize: '12px'
            };

            const ctxJurusanBar = $('#jurusanBarChart')[0].getContext('2d');
            const ctxjkPie = $('#jkPieChart')[0].getContext('2d');
            const ctxKelulusanDoughnut = $('#kelulusanDoughnutChart')[0].getContext('2d');

            const dataJurusanBar = {
                labels: <?= json_encode($namaJurusan) ?>,
                datasets: [{
                        label: 'Pilihan 1',
                        data: [
                            <?= $jurusan11 ?>,
                            <?= $jurusan21 ?>,
                            <?= $jurusan31 ?>
                        ],
                        backgroundColor: style.primary
                    },
                    {
                        label: 'Pilihan 2',
                        data: [
                            <?= $jurusan12 ?>,
                            <?= $jurusan22 ?>,
                            <?= $jurusan32 ?>
                        ],
                        backgroundColor: style.danger

                    }
                ]
            };

            const dataJkPie = {
                labels: ['Laki-Laki', 'Perempuan', 'Belum Diisi'],
                datasets: [{
                    label: '',
                    data: [
                        <?= $jkL ?>,
                        <?= $jkP ?>,
                        <?= count($user) - $jkL - $jkP ?>
                    ],
                    backgroundColor: [
                        style.info,
                        style.success2,
                        style.secondary
                    ]
                }]
            };

            const dataKelulusanDoughnut = {
                labels: ['Lulus', 'Tidak Lulus', 'Belum Diisi'],
                datasets: [{
                    label: '',
                    data: [
                        <?= $kelulusan0 ?>,
                        <?= $kelulusan1 ?>,
                        <?= count($user) - $kelulusan0 - $kelulusan1 ?>
                    ],
                    backgroundColor: [
                        style.warning,
                        style.danger,
                        style.muted2
                    ]
                }]
            };

            const jurusanBarChart = new Chart(ctxJurusanBar, {
                type: 'bar',
                data: dataJurusanBar,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                color: style.muted,
                                font: {
                                    size: style.fontSize
                                }
                            }
                        }
                    }
                }
            });

            const jkPieChart = new Chart(ctxjkPie, {
                type: 'pie',
                data: dataJkPie,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                color: style.muted,
                                font: {
                                    size: style.fontSize
                                }
                            }
                        }
                    }
                }
            });

            const kelulusanDoughnutChart = new Chart(ctxKelulusanDoughnut, {
                type: 'doughnut',
                data: dataKelulusanDoughnut,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                color: style.muted,
                                font: {
                                    size: style.fontSize
                                }
                            }
                        }
                    }
                }
            });
        @endif
    </script>

</body>

</html>
