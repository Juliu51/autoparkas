@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">Sukurti naują transporto priemonę</div>

            <div class="card-body">
               <form method="POST" action="{{route('truck.store')}}" >
                  <div class="form-group">
                      <label>Automobilio gamintojas</label>
                      <input type="text" name="manufacturer_name"  class="form-control">
                  </div>
                  <div class="form-group">
                      <label>Automobilio modelis</label>
                      <input type="text" name="model_name"  class="form-control">
                  </div>
                  @csrf
                  <button class="btn btn-warning" type="submit">Sukurti</button>
               </form>
            </div>
         </div>
      </div>
   </div>

</div>

@endsection
