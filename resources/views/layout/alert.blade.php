@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $errors)
                <li>{{$errors}}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">
        <i class="fa-solid fa-circle-exclamation"></i> {{ Session::get('error')  }}
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success">
        <i class="fa-solid fa-circle-check"></i> {{ Session::get('success')  }}
    </div>
@endif