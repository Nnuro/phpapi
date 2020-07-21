<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>NNURO - ADMIN</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Nnuro Admin Portal" name="description" />
        <meta content="Nnuro Admin Portal" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- App favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.ico">

        <script src="{{url('admin/assets/js/jquery.min.js')}}"></script>
        @yield('page-css')
        <link href="{{url('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet">

        <link href="{{url('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App css -->
        <link href="{{url('admin/assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('admin/assets/css/metisMenu.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('admin/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
        {{-- <link href="{{url('admin/assets/plugins/datatables/jquery.datatables.min.css')}}" rel="stylesheet" type="text/css" /> --}}
        <link href="{{url('admin/assets/plugins/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css" />
        <script src="{{url('admin/assets/js/sweetalert2.js')}}" ></script>
        <link href="{{url('admin/assets/css/sweetalert2.css')}}" rel="stylesheet" type="text/css" />



    </head>

    <body>