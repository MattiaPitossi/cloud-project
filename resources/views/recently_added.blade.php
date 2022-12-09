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



                </ul>
                <form class="d-flex" action="/files/search/recently_added" method="GET" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="term"
                           id="term">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>

                <form class="d-flex" action="/recently" method="GET" role="search">
                    <button style="margin-left:5px;" class="btn btn-secondary" type="submit">Reset</button>
                </form>
            </div>
        </div>
    </nav>



    <table class="table table-hover">
        <thead>
            <tr>
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
                                </div>
                            </div>
                            @include('edit_modal')
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
