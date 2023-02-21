<div class="container">
    <div class="row justify-content-center">
        @if($errors)
        @foreach ($errors->all() as $message)
        <div class="col-6">
            <div class="alert alert-danger m-4 alert-dismissible fade show" role="alert">

                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
        </div>
        @endforeach
        @endif

        @if(Session::has('ok'))
        <div class="col-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('ok') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif

        @if(Session::has('not'))
        <div class="col-6">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('not') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif

    </div>
</div>
