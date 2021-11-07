<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;
use Validator;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('truck.create');
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
                'manufacturer_name' => ['required', 'min:2', 'max:36'],
                'model_name' => ['required', 'min:1', 'max:36'],
            ],
            [
                'manufacturer_name.min' => 'Automobilio gamintojas per trumpas pavadinimas',
                'manufacturer_name.max' => 'Automobilio gamintojas per ilgas pavadinimas',
                'manufacturer_name.required' => 'Automobilio gamintojas nenurodytas',
                'model_name.min' => 'Automobilio modelis per trumpas pavadinimas',
                'model_name.max' => 'Automobilio modelis per ilgas pavadinimas',
                'model_name.required' => 'Automobilio modelis nenurodytas',
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $truck = new Truck;
        $truck->manufacturer_name = $request->manufacturer_name;
        $truck->model_name = $request->model_name;
        $truck->save();
        return redirect()->route('transport.index')->with('success_message', 'Sekmingai įrašytas.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function show(Truck $truck)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function edit(Truck $truck)
    {
        return view('truck.edit', ['truck' => $truck]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Truck $truck)
    {
        $validator = Validator::make($request->all(),
            [
                'manufacturer_name' => ['required', 'min:2', 'max:36'],
                'model_name' => ['required', 'min:1', 'max:36'],
            ],
            [
                'manufacturer_name.min' => 'Automobilio gamintojas per trumpas pavadinimas',
                'manufacturer_name.max' => 'Automobilio gamintojas per ilgas pavadinimas',
                'manufacturer_name.required' => 'Automobilio gamintojas nenurodytas',
                'model_name.min' => 'Automobilio modelis per trumpas pavadinimas',
                'model_name.max' => 'Automobilio modelis per ilgas pavadinimas',
                'model_name.required' => 'Automobilio modelis nenurodytas',
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $truck->manufacturer_name = $request->manufacturer_name;
        $truck->model_name = $request->model_name;
        $truck->save();
        return redirect()->route('transport.index')->with('success_message', 'Sėkmingai pakeistas.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Truck  $truck
     * @return \Illuminate\Http\Response
     */
    public function destroy(Truck $truck)
    {
        if ($truck->truckTransport->count()) {
            return redirect()->route('transport.index')->with('info_message', 'Trinti negalima, automobilis priskirtas registrui.');
        }
        $truck->delete();
        return redirect()->route('transport.index')->with('success_message', 'Sekmingai ištrintas.');

    }
}
