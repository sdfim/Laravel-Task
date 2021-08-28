@extends('adminlte::page')

@section('title', 'Dashboard')

{{--
@section('content_header')
    <h1>Dashboard</h1>
@stop
--}}


@section('content')

<div class="container">
    <br>
    <h2>Welcome</h2>
    <br>
    <div class="col-6" >
        <div class="card">
            <div class="m-4">
                <h3> Test Task</h3>
                <ul>
                    <li>Laravel 6 LTS / 8+</li>
                    <li>AdminLTE</li>
                    <li>Laravel DataTables</li>
                    <li>MySQL</li>
                    <li>PHP 7.4+</li>
                <ul>
            </div>
        </div>
    </div>
    <div class="col-6" >
        <div class="card">
            <div class="m-4">
                <h3> Used </h3>
                <ul>
                    <li><a href="https://github.com/jeroennoten/Laravel-AdminLTE">https://github.com/jeroennoten/Laravel-AdminLTE</a></li>
                    <li><a href="https://github.com/yajra/laravel-datatables">https://github.com/yajra/laravel-datatables</a></li>
                <ul>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{ mix('js/all.min.js') }}"></script>

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>

@stack('scripts')

<script  type="text/javascript">
    $(function () {
        $( "#id-employees" ).find( "span" ).text( "{{\App\Models\Employee::count()}}" );
        $( "#id-positions" ).find( "span" ).text( "{{\App\Models\Position::count()}}" );
    });
    $(document).ready(function($){ $('.main-sidebar').height($(document).outerHeight()); });
</script>

@stop


