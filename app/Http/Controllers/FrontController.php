<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restorant;
use App\Models\Dish;
use App\Services\CartService;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class FrontController extends Controller
{
    public function home(Request $request)
    {

    // $dishRate = Dish::where('id','=', $request->product)->first();
    // $rate=json_decode($dishRate->rating_json,1);
    // $request->user_id = Auth::user()->id;
    // if($rate){
        // $rate[$request->user_id]=$request->rate;
    // }else{
    //     $rate = [$request->user_id=> $request->rate];
    // }
    // $rating=array_sum($rate)/count($rate);
    // $counts=count($rate);
    // $rate=json_encode($rate);
    // DB::table('dish')->where('id', $request->product) ->update([ 'rating_json' => $rate]);
    // DB::table('dish')->where('id', $request->product) ->update([ 'rating' => $rating]);
    // DB::table('dish')->where('id', $request->product) ->update([ 'counts' => $counts]);




    
       $perPageShow = in_array($request->per_page, Dish::PER_PAGE) ? $request->per_page : '8';
       if(!$request->s) {
            if($request->restorant_id && $request->restorant_id != 'all'){
                $dishes = Dish::where('restorant_id', $request->restorant_id);
            }
            else {
                $dishes = Dish::where('id', '>', 0);
            }
                
          
            
            $dishes = match($request->sort ?? '') {
                    'asc_title' => $dishes->orderBy('title'),
                    'desc_title' => $dishes->orderBy('title', 'desc'),
                    'asc_price' => $dishes->orderBy('price'),
                    'desc_price' => $dishes->orderBy('price', 'desc'),
                    default => $dishes
            };

            if( $perPageShow == 'all'){
                    $dishes = $dishes->get();
                }else{
                    $dishes = $dishes->paginate($perPageShow)->withQueryString();
                }
        }
        else{
            $s = explode(' ', $request->s);

            if ( count($s) == 1) {
                $dishes = Dish::where('title', 'like', '%'.$request->s.'%')->paginate($perPageShow)->withQueryString();
            }
            else {
                $dishes = Dish::where('title', 'like', '%'.$s[0].'%'.$s[1].'%')
                ->orWhere('title', 'like', '%'.$s[1].'%'.$s[0].'%')
                ->paginate($perPageShow)->withQueryString();
            }
        }

            $restorants = Restorant::all();

        return view('front.home', [
            'dishes' => $dishes,
            'sortSelect' => Dish::SORT,
            'sortShow' => isset(Dish::SORT[$request->sort]) ? $request->sort : '',
            'perPageSelect' => Dish::PER_PAGE,
            'perPageShow' => $perPageShow,
            'restorants' => $restorants,
            'restorantShow' => $request->restorant_id ? $request->restorant_id : '',
            's' => $request->s ?? ''
            
        ]);
          
              
    }

    public function addToCart(Request $request, CartService $cart)
    {
        $id = (int) $request->product;
        $count = (int) $request->count;
        $cart->add($id, $count);
        return redirect()->back();
    }

    public function cart(CartService $cart)
    {
        return view('front.cart', [
            'cartList' => $cart->list
        ]);
    }
    public function updateCart(Request $request, CartService $cart)
    {
       if ($request->delete) {
            $cart->delete($request->delete);
        } else {
        $updatedCart = array_combine($request->ids ?? [], $request->count ?? []);
        $cart->update($updatedCart);
        }
        return redirect()->back();
    }
    public function makeOrder(CartService $cart)
    {
        $order = new Order;

        $order->user_id = Auth::user()->id;

        $order->order_json = json_encode($cart->order());

        $order->save();

        $cart->empty();

        return redirect()->route('start');
    }

}
