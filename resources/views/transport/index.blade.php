@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
          <h1 class="text-center mb-5">Autoparko Registras</h1>
      <div class="card">
         <div class="card-header text-uppercase card-aligment">Transporto priemonių sąrašas</div>
            <div class="card-body">
            <a class="btn btn-success mb-2"  href="{{ route('truck.create') }}" >Pridėti nauja transporto priemonę</a>
      <div id="wrapper">
         <table class="table table-striped lentele">
            <thead class="lenteles_thead">
            <tr class="tr">
              <th class="align-middle text-center lenteles_head">Gamintojas</th>
              <th class="align-middle text-center lenteles_head">Modelis</th>
              <th class="align-middle text-center lenteles_head">Veiksmai</th>
            </tr>
            </thead>
            <tbody class="lenteles_body">
            @foreach ($trucks as $truck)
            <tr>
              <td class="align-middle text-center lenteles_text">{{$truck->manufacturer_name}}</td>
              <td class="align-middle text-center lenteles_text">{{$truck->model_name}}</td>
              <td class="align-middle text-center lenteles_text">
                <a class="btn btn-primary" href="{{route('truck.edit',[$truck])}}">Redaguoti</a>
                <form style="display: inline-block" method="POST" action="{{route('truck.destroy', $truck)}}">
                    @csrf
                    <button class="btn btn-danger" type="submit">Ištrinti</button>
                  </form>
              </td>
            </tr>
            @endforeach
            </tbody>
         </table>
          </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5">
         <div class="card">
            <div class="card-header text-uppercase">Autoparko registų lentelė</div>
            <div class="card-body">
            <a class="btn btn-success mb-2"  href="{{ route('transport.create') }}" >Kurti naują įrašą registre</a>
            @if(isset($request->direction))
            <a class="btn btn-warning mb-2 ml-2" href="{{ route('transport.index')}}">Išvalyti filtrą</a>
            @endif
           <table class="table table-striped">
            <thead class="card-top">
            <tr>
              <th class="align-middle text-center">Valst. Nr.
                @if(isset($request->direction) && $request->direction == "desc" && $request->sort == "plates")
                <a class="arrow" href="{{ route('transport.index',['sort' => 'plates','direction' => 'asc']) }}">⬇</a>
                @else
              <a class="arrow" href="{{ route('transport.index',['sort' => 'plates','direction' => 'desc']) }}">⬆</a>
              @endif </th>
              <th class="align-middle text-center">Gamintojas
                @if(isset($request->direction) && $request->direction == "desc" && $request->sort == "manufacturer_name")
                <a class="arrow" href="{{ route('transport.index',['sort' => 'manufacturer_name','direction' => 'asc']) }}">⬇</a>
                @else
              <a class="arrow" href="{{ route('transport.index',['sort' => 'manufacturer_name','direction' => 'desc']) }}">⬆</a>
              @endif </th>
              <th class="align-middle text-center">Modelis
                @if(isset($request->direction) && $request->direction == "desc" && $request->sort == "model_name")
                <a class="arrow" href="{{ route('transport.index',['sort' => 'model_name','direction' => 'asc']) }}">⬇</a>
                @else
              <a class="arrow" href="{{ route('transport.index',['sort' => 'model_name','direction' => 'desc']) }}">⬆</a>
              @endif </th>
              <th class="align-middle text-center">Kuro bako talpa (l)</th>
              <th class="align-middle text-center">Vid. Kuro sąnaudos (l/100km)</th>
              <th class="align-middle text-center">Tikėtinas įveiktas atstumas</th>
              <th class="align-middle text-center">Veiksmai</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($transports as $transport)
            <tr>
            <td class="align-middle text-center">{{$transport->plates}}</td>
              <td class="align-middle text-center">{{$transport->transportTruck->manufacturer_name}}</td>
              <td class="align-middle text-center">{{$transport->transportTruck->model_name}}</td>
              <td class="align-middle text-center">{{$transport->fuel_tank_volume}}</td>
              <td class="align-middle text-center">{{$transport->avarenge_fuel_consumption}}</td>
              <td class="align-middle text-center">{{$transport->distance()}} km</td>
              <td class="align-middle text-center">
                <a class="btn btn-primary" href="{{route('transport.edit',[$transport])}}">Redaguoti</a>
                <form style="display: inline-block" method="POST" action="{{route('transport.destroy', $transport)}}">
                    @csrf
                    <button class="btn btn-danger" type="submit">Ištrinti</button>
                  </form>
              </td>
            </tr>
            @endforeach
            </tbody>
          </table>

        </div>
    </div>
    </div>
</div>
@endsection
