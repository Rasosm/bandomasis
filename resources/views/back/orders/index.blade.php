@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>All Orders</h3>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($orders as $order)
                        <li class="list-group-item">
                            <div class="list-table">
                                <div class="list-table__content">
                                    <h5># {{$order->id}}
                                        <b class="m-5">{{$order->user->name}}</b>
                                    </h5>


                                    <ul class="list-group">
                                        @foreach($order->dishes->dishes as $dish)
                                        <li class="list-group-item">
                                            Hotel: {{$dish->title}} - {{$dish->count}} {{$dish->price}} eur

                                        </li>
                                        @endforeach
                                    </ul>
                                    <i class="list-group-item order-total">Total price: {{$order->dishes->total}} eur</i>


                                </div>
                                <div class="order-btn">
                                    @if($order->status == 0)
                                    <form action="{{route('orders-update', $order)}}" method="post" class="mt-2">
                                        <button type="submit" class="btn btn-outline-primary">Finish Order</button>
                                        @csrf
                                        @method('put')
                                    </form>
                                    @endif
                                    <form action="{{route('orders-delete', $order)}}" method="post" class="mt-2">
                                        <button type="submit" class="btn btn-outline-danger">Delete Order</button>
                                        @csrf
                                        @method('delete')
                                    </form>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
