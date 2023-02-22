@extends('layouts.app')

@section('content')
@section('title', 'Edit Restorant')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-7" style="margin-top: 0">
            <div class="card m-4">
                <div class="card-header create">
                    <h3>Edit Restorant</h3>

                </div>
                <div class="card-body">
                    <form action="{{route('restorants-update', $restorant)}}" method="post">
                        <div class="mb-3">
                            <label class="form-label">Restorant</label>
                            <input type="text" name="restorant_title" class="form-control" value="{{$restorant->title}}">

                        </div>
                        <div class="mb-3">
                            <label class="form-label">Town</label>
                            <input type="text" name="restorant_town" class="form-control" value="{{$restorant->town}}">


                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="restorant_address" class="form-control" value="{{$restorant->address}}">
                        </div>
                        {{-- <div class="mb-3">
                            <label class="form-label">Working hours</label>
                            <input type="time" name="restorant_start" class="form-control" value="{{$restorant->start}}">
                        <input type="time" name="restorant_end" class="form-control" value="{{$restorant->end}}">
                </div> --}}

                <div class="time-row d-flex">
                    <div class="col-4">
                        <div class="mb-3" style="margin-right:20px">

                            <label class="form-label">Open</label>
                            <input type="time" name="restorant_start" class="form-control" value="{{$restorant->start}}">

                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <label class="form-label">Close</label>

                            <input type="time" name="restorant_end" class="form-control" value="{{$restorant->end}}">

                        </div>
                    </div>
                </div>


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
