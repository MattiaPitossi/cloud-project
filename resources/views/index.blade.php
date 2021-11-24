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
                <form class="d-flex" action="/files/search" method="GET" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="term"
                        id="term">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>

                <form class="d-flex" action="/index" method="GET" role="search">
                    <button style="margin:5px;" class="btn btn-outline-success" type="submit">Refresh</button>
                </form>
            </div>
        </div>
    </nav>

    <table class="table table-hover">
        <thead>
            <tr>
                <th width="50px"><input type="checkbox" id="master"></th>
                <th scope="col" class="text-center">File Name</th>
                <th scope="col" class="text-center">Added</th>
                <th scope="col" class="text-center">Size</th>
                <th scope="col" class="text-center"></th>
            </tr>
        </thead>
        <tbody>
            @if ($file_uploaded->count())
                @foreach ($file_uploaded as $file)
                    <tr>
                        <th scope="row" class="align-middle"><input type="checkbox" class="sub_chk"
                                data-id="{{ $file->id }}"></th>
                        <td class="align-middle text-center">{{ $file->name }}</td>
                        <td class="align-middle text-center">{{ $file->created_at }}</td>
                        <td class="align-middle text-center">{{ $file->size }}</td>
                        <td class="align-middle text-center">
                            <div class="container">
                                <div class="row justify-content-md-center">
                                    <div class="col col-lg-2">
                                        <a href="{{ route('downloadfile', $file->name) }}" style="font-size:25px">
                                            <i class="bi bi-download" style="font-size: 1.3rem"></i>
                                        </a>
                                    </div>
                                    <div class="col col-lg-2">
                                        <a href="{{ route('file.edit',$file->id) }}" style="font-size:25px">
                                            <i class="bi bi-pencil" style="font-size: 1.2rem"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>


                        </td>
                    </tr>
                @endforeach
            @else

                <tr>
                    <td colspan="2">No rows to show</td>
                </tr>

            @endif
        </tbody>
    </table>

@endsection('content')
