@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">Redaguoti registrą</div>

            <div class="card-body">
               <form method="POST" action="{{route('transport.update',$transport)}}">
                  <div class="form-group">
                      <label>Automobilio valstybinis numeris</label>
                      <input type="text" name="plates" value="{{$transport->plates}}" class="form-control" >
                  </div>
                  <div class="form-group">
                      <label>Automobilio gamintojas ir modelis</label>
                      <select class="custom-select " name="model_id" required>
   @foreach ($trucks as $truck)
    <option value="{{$truck->id}}" @if($truck->id == $transport->model_id) selected @endif>
        {{$truck->manufacturer_name}} {{$truck->model_name}}</option>
     @endforeach
                    </select>
                    </div>
                  <div class="form-group">
                      <label>Kuro bako talpa (l)</label>
                      <input type="number" name="fuel_tank_volume" value="{{$transport->fuel_tank_volume}}" class="form-control" >
                  </div>
                  <div class="form-group">
                      <label>Vidutinės kuro sąnaudos (l/100km)</label>
                      <input type="number" name="avarenge_fuel_consumption" value="{{$transport->avarenge_fuel_consumption}}" class="form-control" >
                  </div>
                  @csrf
                  <button class="btn btn-success" type="submit">Atnaujint</button>
                </form>
                     </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
