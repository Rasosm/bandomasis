@extends('layouts.app')

@section('content')
@section('title', 'New Dish')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-7" style="margin-top: 0">
            <div class="card m-4">
                <div class="card-header create">
                    <h3>Create new dish</h3>

                </div>
                <div class=" card-body">
                    <form action="{{route('dishes-store')}}" method="post" enctype="multipart/form-data">


                        {{-- <div class="mb-3">
                            <label class="form-label">restorant</label>
                            <select class="form-select" name="restorant_id">
                                @foreach($restorants as $restorant)
                                <option value="{{$restorant->id}}">{{$restorant->title}}</option>
                        @endforeach
                        </select>
                </div> --}}

                <div class="mb-3">
                    <label class="form-label">restorant</label>
                    <select class="form-select" name="restorant_id">
                        @foreach($restorants as $restorant)
                        <option value="{{$restorant->id}}" @if($restorant->id == old('restorant_id')) selected @endif>{{$restorant->title}}</option>

                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">dish</label>
                    <input type="text" name="dish_title" class="form-control" placeholder="dish title" value="{{old('dish_title')}}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Price</label>
                    <input type="text" name="dish_price" class="form-control" placeholder="price" value="{{old('dish_price')}}">

                </div>
                <div class="col-5">
                    <div class="mb-3">
                        <label class="form-label">Dish Photo</label>
                        <input type="file" class="form-control" name="photo">
                    </div>
                </div>


                <div class="mb-3" style="justify-content: center; display: flex">
                    <button type="submit" class="btn btn-outline-warning mt-4">Save</button>

                </div>
                @csrf

                </form>
            </div>
        </div>
    </div>

</div>
</div>

@endsection
