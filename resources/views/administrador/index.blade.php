@extends('layouts.app')

@section('content')
    @include('layouts.header')
    @include('layouts.menu')

    <div class="content-wrapper">
        @yield('contenido')
    </div>

    @include('layouts.footer')

    <div class="control-sidebar-bg"></div>
@endsection