@extends('layouts.app')

@section('content')
<?php $permissao_usuario = Auth::user()->permissao;?>
@include('componentes.dashboard', [$permissao_usuario])
@endsection
