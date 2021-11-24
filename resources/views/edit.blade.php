@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit file name</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There are some issues.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('file.update', $file_uploaded->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3>
            <label for="nameField" class="form-label">New name</label>

            <input type="text" name="name" value="{{ $file_uploaded->name }}" class="form-control" placeholder="Name"
                id="nameField" required>


        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>
@endsection
