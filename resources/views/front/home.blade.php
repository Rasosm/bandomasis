@extends('layouts.front')



@section('content')
@section('title', 'dish list')


<div class="container">
    <div class="row justify-content-center">

        <form action="{{route('start')}}" method="get">
            <div class="container">
                <div class="row justify-content-start">
                    <div class="col-2">
                        <div class="mb-3">
                            <label class="form-label"></label>
                            <input type="text" class="form-control" name="s" value="{{$s}}">
                        </div>
                    </div>
                    <div class=" col-4">
                        <div class="head-buttons">
                            <button type="submit" class="btn btn-outline-success" style="margin-top: 22px">Search</button>

                        </div>
                    </div>
                </div>
            </div>
        </form>
        <form action="{{route('start')}}" method="get">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-2">
                        <div class="mb-3">
                            <label class="form-label">Sort</label>
                            <select class="form-select" name="sort">
                                <option>default</option>
                                @foreach($sortSelect as $value => $name)
                                <option value="{{$value}}" @if($sortShow==$value) selected @endif>{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-1">
                        <div class="mb-3">
                            <label class="form-label">Show</label>
                            <select class="form-select" name="per_page">
                                @foreach($perPageSelect as $value)
                                <option value="{{$value}}" @if($perPageShow==$value) selected @endif>{{$value}}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="mb-3">
                            <label class="form-label">Select Restorant</label>
                            <select class="form-select" name="restorant_id">
                                <option value="all">All</option>
                                @foreach($restorants as $restorant)
                                <option value="{{$restorant->id}}" @if($restorant->id == $restorantShow) selected @endif>{{$restorant->title}}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-2 ">
                        <div class=" head-buttons">
                            <button type="submit" class="btn btn-outline-success" style="margin-right: 5px; margin-top: 30px">Show</button>

                            <a href="{{route('start')}}" class="btn btn-outline-success" style="margin-top: 30px">Reset</a>




                        </div>
                    </div>

                </div>
            </div>


        </form>

        <div>

            <div class="container">
                <div class="row justify-content-center">

                    @forelse($dishes as $dish)
                    <div class="col-3 one-card">


                        <div class="list-table">
                            <div class="">
                                <a href="{{route('show-dish', $dish)}}">

                                    <div class="smallimg">
                                        @if($dish->photo)
                                        <img src="{{asset($dish->photo)}}">
                                        @else
                                        <img src="{{asset('/dishes/no.jpg')}}">
                                        @endif
                                    </div>
                                </a>

                                <div class="card-header">
                                    <p class="card-title" style="font-size: 18px; font-weight: bold; line-height: 1.4">{{$dish->title}}</p>
                                    <p class="card-title">{{$dish->dishRestorant->title}}</p>
                                </div>
                                <div class="card-body">

                                    <p style="font-weight: bold"> Price: {{$dish->price}} eur</p>

                                </div>
                                <div class="buy">

                                    <form action="{{route('add-to-cart')}}" method="post">
                                        <div class="d-flex buy-btn">
                                            <input class="form-control input-buy" type="number" min="1" max="5" name="count" value="1">
                                            <input type="hidden" name="product" value="{{$dish->id}}">
                                            <button type="submit" class="btn btn-outline-primary">Buy</button>
                                        </div>

                                        @csrf
                                    </form>
                                </div>


                            </div>
                        </div>

                    </div>
                    @empty
                    <div class="list-group-item">No dishes yet</div>
                    @endforelse

                </div>
            </div>
        </div>
        @if($perPageShow != 'all')
        <div class="m-2">{{$dishes->links()}}
        </div>
        @endif

    </div>
</div>





@endsection
