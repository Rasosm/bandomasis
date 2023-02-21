@extends('layouts.app')

@section('content')
@section('title', 'Edit dish')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-7" style="margin-top: 0">
            <div class="card m-4">
                <div class="card-header create">
                    <h3>Edit dish</h3>

                </div>
                <div class="card-body">
                    <form action="{{route('dishes-update', $dish)}}" method="post" enctype="multipart/form-data">


                        <div class="mb-3">
                            <label class="form-label">Restorant</label>
                            <select class="form-select" name="restorant_id">
                                @foreach($restorants as $restorant)
                                <option value="{{$restorant->id}}" @if($restorant->id == $dish->restorant_id) selected @endif>{{$restorant->title}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Dish</label>
                            <input type="text" name="dish_title" class="form-control" value="{{$dish->title}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="text" name="dish_price" class="form-control" value="{{$dish->price}}">
                        </div>

                        @if($dish->photo)
                        <div class="col-4">
                            <div class="mb-3 img">
                                <img src="{{asset($dish->photo)}}">
                            </div>
                        </div>
                        @endif
                        <div class="col-5">
                            <div class="mb-3">
                                <label class="form-label">Dish Photo</label>
                                <input type="file" class="form-control" name="photo">
                            </div>
                        </div>
                        @if($dish->photo)
                        <button type="submit" class="btn btn-outline-danger" name="delete_photo" value="1">Delete Photo</button>
                        @endif

                        <div class="mb-3" style="justify-content: center; display: flex">
                            <button type="submit" class="btn btn-outline-warning mt-4">Save</button>

                        </div>
                        @csrf
                        @method('put')

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
