@if(count($errors))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Error!</h4>
        <ul>
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>Success: </strong>{{ Session::get('success')}}
    </div>
@endif
@if (Session::has('failed'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <strong>Error: </strong>{{ Session::get('failed')}}
    </div>
@endif