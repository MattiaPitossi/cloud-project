@extends('layouts.master')
@section('content')



    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <button style="margin-left: 10px" class="btn btn-primary delete_all"
                            data-url="{{ url('/files/delete_definitely') }}">Permanently Delete Selected</button>
                    </li>

                </ul>
                <form class="d-flex" action="/files/search_deleted" method="GET" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="term"
                        id="term">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>

                <form class="d-flex" action="/deleted/files" method="GET" role="search">
                    <button style="margin-left:5px;" class="btn btn-secondary" type="submit">Reset</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="alert alert-primary" role="alert">
        Your files will remain here until you decide to delete them permanently
    </div>

    @if (session()->has('message'))
        <div class="alert alert-primary">
            {{ session()->get('message') }}
        </div>
    @endif

    <table class="table table-hover" id="all-files">
        <thead>
            <tr>
                <th width="50px"><input type="checkbox" id="master" title="Select all items"></th>
                <th scope="col" class="text-center" onclick="sortTable(0)">File Name</th>
                <th scope="col" class="text-center" onclick="sortTable(0)">Added</th>
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
                                        <a href="{{ route('restorefile', $file->id) }}" style="font-size:25px">
                                            <i class="bi bi-bootstrap-reboot" style="font-size: 1.1rem"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @include('edit_modal')
                        </td>
                    </tr>
                @endforeach
            @else

                <tr>
                    <td colspan="2">No file has been deleted</td>
                </tr>

            @endif
        </tbody>
    </table>

    <style>
        @media screen and (max-width: 992px) {
         .navbar-collapse>ul>.nav-item, .navbar-collapse>form, .navbar-collapse>form>button {
             margin-left: 0!important;
             padding-top:10px;
         }

         .navbar-collapse>ul>.nav-item>button {
             margin-left: 0!important;
         }
     }
    </style>


@endsection('content')
