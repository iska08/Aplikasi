@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    @parent
    <ul>
        <li class="active">Dashboard</li>
    </ul>
@endsection

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-body text-center">
                <h3>Selamat Datang</h3>
                <h1>
                    <p>{{ auth()->user()->name }}</p>
                </h1>
            </div>
        </div>
    </div>
</div>
<!-- /.row (main row) -->
@endsection