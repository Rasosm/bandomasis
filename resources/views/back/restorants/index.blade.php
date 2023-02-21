@extends('layouts.app')

@section('content')
@section('title', 'Restorant List')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3>All Restorants</h3>
                </div>
                <div class="card-body flex">
                    <ul class="list-group">
                        @forelse($restorants as $restorant)
                        <li class="list-group-item">

                            <div id="{{ $restorant['id'] }}" class="list-table d-flex" style="justify-content: space-between">

                                <div>
                                    <h5>{{$restorant->title}}</h5>
                                    <p>{{$restorant->townt}}</p>
                                    <p>{{$restorant->address}}</p>
                                    <p>{{$restorant->time}}</p>


                                </div>
                                @if(Auth::user()?->role == 'admin')

                                <div class="buttons mt-3" style="align-items: baseline">
                                    <a href="{{route('restorants-edit', $restorant)}}" class="btn btn-outline-success">Edit</a>
                                    <form action="{{route('restorants-delete', $restorant)}}" method="post">
                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        @csrf
                                        @method('delete')
                                    </form>
                                </div>
                                @endif
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No restorants yet</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
