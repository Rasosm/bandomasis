<?php

namespace App\Http\Controllers;

use App\Models\Restorant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

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
        $restorants = $restorants->map(function($t) {
            $t->startNice = Carbon::parse($t->start)->format('H:i');
            $t->endNice = Carbon::parse($t->end)->format('H:i');
            return $t;
            
        });
                 
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
        
        $start = Carbon::parse($request->restorant_start);
        $end = Carbon::parse($request->restorant_end);
        
        $restorant = new Restorant;

        $restorant->title = $request->restorant_title;
        $restorant->town = $request->restorant_town;
        $restorant->address = $request->restorant_address;
        $restorant->start = $start;
        $restorant->end = $end;
        // $restorant->start = ($request->restorant_start);
        // $restorant->end = $request->restorant_end;
        
        $restorant->save();
        dump($restorant);

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
        $restorant->start = $request->restorant_start;
        $restorant->end = $request->restorant_end;
        
        $restorant->save();

        return redirect()->route('restorants-index', ['#'.$restorant->id])->with('ok', 'Restaurant was updated');
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
