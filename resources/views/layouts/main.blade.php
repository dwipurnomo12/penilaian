<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>SISTEM INFORMASI PENILAIN SISWA</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="/assets/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->

    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Datatable Jquery CDN-->
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        @include('partials.navbar')
        <!-- END HEADER-->

        <!-- START SIDEBAR-->
        @include('partials.sidebar')
        <!-- END SIDEBAR-->

        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            @yield('content')
            <!-- END PAGE CONTENT-->
            @include('partials.footer')
        </div>
    </div>

    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->
    <script src="/assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="/assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="/assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
    <script src="/assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="/assets/vendors/chart.js/dist/Chart.min.js" type="text/javascript"></script>
    <script src="/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
    <script src="/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <script src="/assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="/assets/js/app.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script src="/assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script>
    <!-- Datatable Jquery CDN -->
    <script src="//cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>


    <!-- Select2 Jquery -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Sweet Alert -->
    <script src="/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Sweet Alert -->
    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(".swal-confirm").click(function(e) {
            e.preventDefault();
            var form = $(this).attr('data-form');
            Swal.fire({
                title: 'Hapus Data Ini ',
                text: "Anda tidak akan dapat mengembalikan data yang dihapus !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#' + form).submit();
                }
            })
        });
    </script>
</body>

</html>
