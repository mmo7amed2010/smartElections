<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>




@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            @foreach (\Session::get('success') as $error)
                <li>{{ $error }}</li>
            @endforeach
                    </ul>
    </div>
@endif

<form action="fileUpload" method="post" enctype="multipart/form-data" '>
    <div class="row cancel">
        <div class="col-md-4">
            <input type="file" class="image" name="image">
        </div>
        {{csrf_field()}}
        <input type="hidden" name="_method" value="post">
        <div class="col-md-4">
            <button type="submit" class="btn btn-success">Create</button>
        </div>
    </div>
</form>

