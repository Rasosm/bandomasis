<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;
use App\Models\Restorant;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::all();
        return view('back.dishes.index', [
            'dishes' => $dishes
]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $restorants = Restorant::all()->sortBy('title');;
        return view('back.dishes.create', [
            'restorants' => $restorants
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
        $request->all(),
        [
        
        'dish_title' => 'required|min:3|max:100|regex:/^([a-zA-ZąčęėįšųūžĄČĘĖĮŠŲŪŽ\s]+){3,}$/',
        'dish_price' => 'required|regex:/^[1-9]\d*(\.\d{1,2})?$/'

        ],
        [
            'dish_title.required' => 'Please enter dish title',
            'dish_title.min' => 'Please enter at least 3 characters',
            'dish_title.max' => 'Please enter correct dish title. Dish name has too many characters',
            'dish_title.regex' => 'Please enter correct dish title',
            'dish_price.required' => 'Please enter price',
            'dish_price.regex' => 'Please enter correct price',
        ]);
            
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        $dish = new Dish;

        if ($request->file('photo')) {
            $photo = $request->file('photo');

            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;
            
            // $Image = Image::make($photo)->pixelate(12);
            // $Image->save(public_path().'/trucks/'.$file);

            if ($dish->photo) {
                $dish->deletePhoto();
            }
            $photo->move(public_path().'/dishes', $file);
            $dish->photo = '/dishes/' . $file;
        }

        $dish->restorant_id = $request->restorant_id;
        $dish->title = $request->dish_title;
        $dish->price = $request->dish_price;

        $dish->save();
        return redirect()->route('dishes-index')->with('ok', 'The dish succesfully added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        $restorants = Restorant::all();
        return view('back.dishes.edit',[
            'dish' => $dish,
            'restorants' => $restorants
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        if ($request->file('photo')) {
            $photo = $request->file('photo');

            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name. '-' . rand(100000, 999999). '.' . $ext;
            
            // $Image = Image::make($photo)->pixelate(12);
            // $Image->save(public_path().'/trucks/'.$file);

            if ($dish->photo) {
                $dish->deletePhoto();
            }
            $photo->move(public_path().'/dishes', $file);
            $dish->photo = '/dishes/' . $file;
        }

        $dish->restorant_id = $request->restorant_id;
        $dish->title = $request->dish_title;
        $dish->price = $request->dish_price;

        $dish->save();
        return redirect()->route('dishes-index')->with('ok', 'The dish succesfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();
        return redirect()->back()->with('ok', 'Dish was deleted');
    }
}
