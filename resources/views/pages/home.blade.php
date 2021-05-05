@extends('layouts.layout')

@section('title', 'Accueil')

@section('content')

<h1> Saeria's Chronicles </h1>

<div class="row">
    <div class="col-12 col-md-5">
        <div class="showcase">
            <h2> Découvrez Saeria </h2>
        </div>
    </div>
    <div class="col-12 col-md-5 offset-md-2">
        <div class="showcase">
            <h2> Découvrez Alteva </h2>
        </div>
    </div>
    <div class="col-12 col-md-5 offset-md-4">
        <div class="showcase">
            <h2> <a class="showcase__link" href="/magies"> Découvrez les Magies </a> </h2>
        </div>
    </div>
</div>

<div class="row">
    <div id="graph"></div>
</div>

@endsection
