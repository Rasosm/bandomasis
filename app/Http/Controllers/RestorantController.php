<?php

namespace App\Http\Controllers;

use App\Models\Restorant;
use Illuminate\Http\Request;

class RestorantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $restorants = Restorant::all()->sortBy('title');
        return view('back.restorants.index', [
            'restorants' => $restorants
             ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('back.restorants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restorant = new Restorant;
        $restorant->title = $request->restorant_title;
        $restorant->town = $request->restorant_town;
        $restorant->address = $request->restorant_address;
        $restorant->time = $request->restorant_time;
        
        $restorant->save();

        return redirect()->route('restorants-index', ['#'.$restorant->id])->with('ok', 'Congradulations! You are created new restaurant');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restorant  $restorant
     * @return \Illuminate\Http\Response
     */
    public function show(Restorant $restorant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restorant  $restorant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restorant $restorant)
    {
        return view('back.restorants.edit',[
            'restorant' => $restorant
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Restorant  $restorant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restorant $restorant)
    {
        $restorant->title = $request->restorant_title;
        $restorant->town = $request->restorant_town;
        $restorant->address = $request->restorant_address;
        $restorant->time = $request->restorant_time;
        
        $restorant->save();

        return redirect()->route('restorants-index', ['#'.$restorant->id])->with('ok', 'Congradulations! You are created new restaurant');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restorant  $restorant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restorant $restorant)
    {
        if(!$restorant->restorantDishes()->count()){
            $restorant->delete();
            return redirect()->route('restorants-index');
        }
        return redirect()->back()->with('not', 'You can not delete this restorant, because it has some dishes');

    }
}
