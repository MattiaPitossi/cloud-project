@extends('layouts.master')
@section('content')

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <form action="/files" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <label class="btn btn-primary">
                                Upload <input type="file" id="file" name="file" onchange="this.form.submit();" hidden />
                            </label>
                        </form>
                    </li>
                    <li class="nav-item">
                        <button style="margin-left: 15px" class="btn btn-primary delete_all"
                            data-url="{{ url('/files/delete') }}">Delete
                            All Selected</button>
                    </li>

                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <table class="table table-hover" id="file_table">
        <thead class="thead-light">
            <tr>
                <th width="50px"><input type="checkbox" id="master"></th>
                <th class="text-center">File Name</th>
                <th class="text-center">Added</th>
                <th class="text-center">Size</th>
                <th class="text-center"></th>
            </tr>
        </thead>
        <tbody>
            @if ($file_uploaded->count())
                @foreach ($file_uploaded as $file)
                    <tr>
                        <td><input type="checkbox" class="sub_chk" data-id="{{ $file->id }}"></td>
                        <td class="text-center">{{ $file->name }}</td>
                        <td class="text-center">{{ $file->created_at }}</td>
                        <td class="text-center">{{ $file->size }}</td>
                        <td class="text-center">
                            <a href="{{ route('downloadfile', $file->name) }}" style="font-size:25px">
                                <i class="bi bi-cloud-download"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

@endsection('content')
