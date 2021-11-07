<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use App\Models\Truck;
use Illuminate\Http\Request;
use Validator;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request, Truck $truck)
    {
        $transports = Transport::sortable()->get();
        $trucks = Truck::all();
        
    $input = $request->all();
    $direction = 'asc';
    if(isset($input['sort']) && $input['sort'] == "model_name"){
        $sort = $input['sort'];
        $order = ($input['direction']);
        $transports = Transport::join('trucks', 'transports.model_id', '=', 'trucks.id')
          ->orderBy('trucks.model_name', $order)
          ->select('transports.*')
          ->paginate();
    }
    if(isset($input['sort']) && $input['sort'] == "manufacturer_name"){
        $sort = $input['sort'];
        $order = ($input['direction']);
        $transports = Transport::join('trucks', 'transports.model_id', '=', 'trucks.id')
          ->orderBy('trucks.manufacturer_name', $order)
          ->select('transports.*')
          ->paginate();
    }  
    if(isset($input['sort']) && $input['sort'] == "plates"){
        $sort = $input['sort'];
        $order = ($input['direction']);
        $transports = Transport::join('trucks', 'transports.model_id', '=', 'trucks.id')
          ->orderBy('transports.plates', $order)
          ->select('transports.*')
          ->paginate();
    }  
        return view('transport.index',compact('transports'), ['trucks' => $trucks, 'request' => $request]);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trucks = Truck::all();
        return view('transport.create', ['trucks' => $trucks]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'plates' => ['required', 'min:1', 'max:10'],
                'fuel_tank_volume' => ['required', 'min:2', 'max:4'],
                'avarenge_fuel_consumption' => ['required', 'min:1', 'max:2'],
            ],
            [
                'plates.min' => 'Automobilio valstybiniai numeriai per trumpi',
                'plates.max' => 'Automobilio valstybiniai numeriai per ilgi',
                'plates.required' => 'Automobilio valstybiniai numeriai nenurodyti',
                'fuel_tank_volume.min' => 'Automobilio kuro bako talpa per maža',
                'fuel_tank_volume.max' => 'Automobilio kuro bako talpa per didelė',
                'fuel_tank_volume.required' => 'Automobilio kuro bako talpa nenurodytas',
                'avarenge_fuel_consumption.min' => 'Automobilio vid. kuro sąnaudos per trumpas mažos',
                'avarenge_fuel_consumption.max' => 'Automobilio vid. kuro sąnaudos per didelės',
                'avarenge_fuel_consumption.required' => 'Automobilio vid. kuro sąnaudos nenurodytos',
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $transport = new Transport;
        $transport->plates = $request->plates;
        $transport->fuel_tank_volume = $request->fuel_tank_volume;
        $transport->avarenge_fuel_consumption = $request->avarenge_fuel_consumption;
        $transport->model_id = $request->model_id;
        $transport->save();
        return redirect()->route('transport.index')->with('success_message', 'Sekmingai įrašytas.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function show(Transport $transport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function edit(Transport $transport)
    {
        $trucks = Truck::all();
        return view('transport.edit', ['transport' => $transport, 'trucks' => $trucks]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transport $transport)
    {
        $validator = Validator::make($request->all(),
            [
                'plates' => ['required', 'min:1', 'max:10'],
                'fuel_tank_volume' => ['required', 'min:2', 'max:4'],
                'avarenge_fuel_consumption' => ['required', 'min:1', 'max:3'],
            ],
            [
                'plates.min' => 'Automobilio valstybiniai numeriai per trumpi',
                'plates.max' => 'Automobilio valstybiniai numeriai per ilgi',
                'plates.required' => 'Automobilio valstybiniai numeriai nenurodyti',
                'fuel_tank_volume.min' => 'Automobilio kuro bako talpa per maža',
                'fuel_tank_volume.max' => 'Automobilio kuro bako talpa per didelė',
                'fuel_tank_volume.required' => 'Automobilio kuro bako talpa nenurodytas',
                'avarenge_fuel_consumption.min' => 'Automobilio vid. kuro sąnaudos per trumpas mažos',
                'avarenge_fuel_consumption.max' => 'Automobilio vid. kuro sąnaudos per didelės',
                'avarenge_fuel_consumption.required' => 'Automobilio vid. kuro sąnaudos nenurodytos',
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $transport->plates = $request->plates;
        $transport->fuel_tank_volume = $request->fuel_tank_volume;
        $transport->avarenge_fuel_consumption = $request->avarenge_fuel_consumption;
        $transport->model_id = $request->model_id;
        $transport->save();
        return redirect()->route('transport.index')->with('success_message', 'Sėkmingai pakeistas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transport $transport)
    {
        $transport->delete();
        return redirect()->route('transport.index')->with('success_message', 'Sekmingai ištrintas.');
    }
}
