@extends('layouts.layout')

@section('title', 'Accueil')

@section('content')


<div class="container">
    <div class="row">
      <div class="col-sm-6  p-2">
        <div style="background-color: #F3EFE8; color: black; font-size: 20px; font-weight: bold; height: 100%; text-align:center;" class="p-2">
            <div style="border: 1px solid black" class="p-2">
                Actualité
            </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="row">
            <div class="col-12 p-2" style="height: 325px;">
                <div style="background-color: #F3EFE8; color: black; font-size: 20px; font-weight: bold; height: 100%; text-align:center;" class="p-2">
                    <div style="border: 1px solid black" class="p-2">
                    Galerie
                    </div>
                </div>
            </div>
          <div class="col-12 p-2" style="height: 325px;">
              <div style="background-color: #F3EFE8; color: black; font-size: 20px; font-weight: bold; height: 100%; text-align:center;" class="p-2">
                    <div style="border: 1px solid black" class="p-2">
                        Aides de jeu
                    </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
