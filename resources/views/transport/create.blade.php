@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">Sukurti naują įrašą registre</div>

            <div class="card-body">
               <form method="POST" action="{{route('transport.store')}}" >
               <div class="form-group">
                      <label>Automobilio valstybinis numeris</label>
                      <input type="text" name="plates"  class="form-control" placeholder="XXXXXX" >
                  </div>
                  <div class="form-group">
                      <label>Automobilio gamintojas ir modelis</label>
                  <select class="custom-select " name="model_id" required>
   @foreach ($trucks as $truck)
    <option value="{{$truck->id}}">{{$truck->manufacturer_name}} {{$truck->model_name}}</option>
     @endforeach
                    </select>
                    </div>
                  <div class="form-group">
                      <label>Kuro bako talpa</label>
                      <input type="number" name="fuel_tank_volume"  class="form-control" placeholder="l" >
                  </div>
                  <div class="form-group">
                      <label>Vidutinės kuro sąnaudos</label>
                      <input type="number" name="avarenge_fuel_consumption"  class="form-control" placeholder="l/100km" >
                  </div>
                  @csrf
                  <button class="btn btn-warning" type="submit">Įtraukti</button>
               </form>
            </div>
         </div>
      </div>
   </div>

</div>

@endsection
