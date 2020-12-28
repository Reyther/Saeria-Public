@extends('layouts.layout')

@section('title', 'Magies')

@section('content')
    
    <h1> Magies </h1>
    <div class="row">
    <div class="col-10 offset-1">
    <ul class="row magic__container">
    @foreach ($magics as $key => $circle )
        <li class="col-md-6 magic__block">
            <h2 class="magic__circle-name"> {{$key}} </h2>
            <ul class="magic__circle">
            @foreach ($circle as $magic)
                <li class="magic">
                    <h3 class="magic__title"> {{$magic->name}} </h3>
                    <p class="magic__desc"> {{$magic->description}} </p>
                 </li>
                @endforeach
             </ul>
         </li>
    @endforeach
    </ul>
    </div>
    </div>
    
@endsection

