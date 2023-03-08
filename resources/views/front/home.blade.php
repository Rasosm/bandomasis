@extends('layouts.front')



@section('content')
@section('title', 'dish list')

<a href="#app" class="scroll-btn fa-solid fa-chevron-up show-btn" id="scroll-btn"></a>


<div class="container">
    <div class="row justify-content-center ">

        <form action="{{route('start')}}" method="get">
            <div class="container">
                <div class="row justify-content-start search">
                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-4 col-7">



                        <div class="wrapper">
                            <div class="label"></div>

                            <div class="searchBar">
                                <input class="searchQueryInput" type="text" name="s" placeholder="Search" value="{{$s}}" />

                                <button class="searchQuerySubmit" type="submit" name="searchQuerySubmit">
                                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">

                                        <path fill="#198753" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />

                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


        </form>

        <div>
            <form action="{{route('start')}}" method="get">
                <div class="container">
                    <div class="row header-sort">


                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-3 col-5">
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

                        <div class="col-xx-1 col-xl-1 col-lg-2 col-md-2 col-sm-3 col-5">


                            <div class="mb-3">
                                <label class="form-label">Show</label>
                                <select class="form-select" name="per_page">
                                    @foreach($perPageSelect as $value)
                                    <option value="{{$value}}" @if($perPageShow==$value) selected @endif>{{$value}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-3 col-sm-3 col-6">

                            <div class="mb-3">
                                <label class="form-label">Select Restaurant</label>
                                <select class="form-select" name="restorant_id">
                                    <option value="all">All</option>
                                    @foreach($restorants as $restorant)
                                    <option value="{{$restorant->id}}" @if($restorant->id == $restorantShow) selected @endif>{{$restorant->title}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-2 ">
                            <div class="head-buttons">
                                <button type="submit" class="btn btn-outline-success" style="margin-right: 5px; margin-top: 30px">Show</button>

                                <a href="{{route('start')}}" class="btn btn-outline-success" style="margin-top: 30px">Reset</a>
                            </div>
                        </div>

                    </div>
                </div>


            </form>

            <div>

                <div class="container">
                    <div class="row justify-content-center row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 ">
                        @forelse($dishes as $dish)
                        <div class="col-9 front-card">
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
                                        <div class="">

                                            <div>
                                                <div class="d-flex justify-content-between">
                                                    <p class="card-title-bold">{{$dish->title}}</p>
                                                    {{-- <p class="card-title-bold"> {{$dish->rating}}/5</p> --}}
                                                    <p class="card-title-bold"> Price: {{$dish->price}} eur</p>


                                                </div>
                                                <p class="card-title">{{$dish->dishRestorant->title}}</p>
                                                {{-- <p class="card-title-bold"> Price: {{$dish->price}} eur</p> --}}
                                                {{-- <p style="font-weight: bold"> Rating: {{$dish->rating}}/5</p>
                                                <p style="font-weight: bold"> Votes: {{$dish->counts}} </p> --}}




                                            </div>


                                            <div id={{$dish->id}} class="d-flex justify-content-between">


                                                <p style="font-weight: bold"> Rating: {{$dish->rating}}/5</p>

                                                <form action=" {{route('rate')}}" method="post">
                                                    <div class="d-flex buy-btn">
                                                        <input class="form-control input-buy me-2" type="number" min="1" max="5" name="rate" value="5">
                                                        <input type="hidden" name="productRate" value="{{$dish->id}}">
                                                        <input type="hidden" name="count" value="{{$dish->count}}">
                                                        <button type="submit" class="btn btn-outline-primary">Rate</button>
                                                    </div>
                                                    @csrf
                                                </form>
                                            </div>




                                            {{-- <p style="font-weight: bold"> Votes: {{$dish->counts}}
                                            </p> --}}
                                        </div>


                                    </div>
                                    <div class="d-flex">
                                        <div class="card-body">
                                            {{-- <p class="card-title-bold"> Price: {{$dish->price}} eur</p> --}}

                                            {{-- <p style="font-weight: bold"> Rating: {{$dish->rating}}/5</p>
                                            <p style="font-weight: bold"> Votes: {{$dish->counts}} </p> --}}
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
