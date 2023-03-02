@extends('layouts.app')

@section('content')
@section('title', 'dish list')


<div class="container">
    <div class="row justify-content-center">

        {{-- <form action="{{route('dishes-index')}}" method="get">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-2">
                    <div class="mb-3">
                        <label class="form-label"></label>
                        <input type="text" class="form-control" name="s" value="{{$s}}">


                    </div>
                </div>
                <div class=" col-1">
                    <div class="head-buttons">
                        <button type="submit" class="btn btn-outline-primary mt-4">Search</button>
                    </div>
                </div>
            </div>
        </div>
        </form> --}}




        {{-- <form action="{{route('customers-index')}}" method="get">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-2">
                    <div class="mb-3">
                        <label class="form-label">Rūšiuoti</label>
                        <select class="form-select" name="sort">
                            {{-- <option>default</option> --}}
                            {{-- @foreach($sortSelect as $value => $name)
                            <option value="{{$value}}" @if($sortShow==$value) selected @endif>{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-2">
                    <div class="mb-3">
                        <label class="form-label">Rodyti</label>
                        <select class="form-select" name="per_page">
                            {{-- <option>default</option> --}}
                            {{-- @foreach($perPageSelect as $value)
                            <option value="{{$value}}" @if($perPageShow==$value) selected @endif>{{$value}}</option>
                            @endforeach --}}
                            {{-- </select>
                    </div>
                </div>
                <div class="col-2 ">
                    <div class=" head-buttons">
                        <button type="submit" class="btn btn-outline-primary mt-3" style="margin-right: 5px">Rodyti</button>
                        <a href="{{route('customers-index')}}" class="btn btn-outline-primary mt-3" style="color: #0dcaf0">Atnaujinti</a>
                    </div>
                </div>
            </div>
        </div> --}}


        {{-- </form> --}}




        {{-- @if($errors)
        @foreach ($errors->all() as $message)
        <div class="col-6">
            <div class="alert alert-danger m-4" role="alert">
                {{ $message }}
    </div>
</div>
@endforeach
@endif --}}
<div class="container">
    <div class="row justify-content-center">
        {{-- <div class="col-3">
            @include('back.common.cats')
        </div> --}}


        <div class="col-10">
            <div class="card">

                <div class="card-header card-header-cats">
                    <h3><a href="{{route('dishes-index')}}">
                            All dishes</a></h3>
                </div>


                @forelse($dishes as $dish)
                <div class="container">
                    <div class="row justify-content-center">

                        <div id="{{ $dish['id'] }}" class="card card-list">
                            <div class="card-body card-body-list">

                                <div class="col-3">

                                    {{-- <div class="card-header-list"> --}}
                                    <p class="card-title card-title-bold">{{$dish->title}}</p>
                                    {{-- </div> --}}
                                </div>


                                <div class="col-3">

                                    <p class="card-title">{{$dish->dishRestorant->title}}</p>
                                </div>


                                <div class="col-2">

                                    <p style="font-weight: bold"> Price: {{$dish->price}} eur</p>
                                </div>
                                <div class="col-1">

                                    <div class="smallimg">
                                        @if($dish->photo)
                                        <img src="{{asset($dish->photo)}}">
                                        @else
                                        <img src="{{asset('/dishes/no.jpg')}}">

                                        @endif
                                    </div>
                                </div>
                                <div class="col-2">

                                    <div class="buttons">


                                        <a class="btn btn-outline-success" href="{{route('dishes-edit', $dish)}}">Edit</a>
                                        @if(Auth::user()?->role == 'admin')

                                        <form action="{{route('dishes-delete', $dish)}}" method="post">
                                            <button type="submit" class="btn btn-outline-danger btn-delete">Delete</button>

                                            @csrf
                                            @method('delete')
                                        </form>
                                        @endif
                                    </div>
                                </div>


                            </div>
                        </div>


                        @empty
                        <div class="list-group-item">No types yet</div>
                    </div>
                </div>

                @endforelse


            </div>
            {{-- @if($perPageShow != 'visi')
        <div class="m-2">
            {{$customers->links()}}
            {{-- </div>
    @endif --}}
        </div>

    </div>

</div>



@endsection
