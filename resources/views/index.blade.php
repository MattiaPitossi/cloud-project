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
                        <button class="btn btn-outline-primary" data-toggle="modal"
                                            data-target="#ModalFileUpload">Upload</button>
                    </li>

                    <li class="nav-item" style="margin-left: 15px">
                        <button class="btn btn-primary delete_all" data-url="{{ url('/files/delete') }}">Delete
                            All Selected</button>
                    </li>

                </ul>
                <form class="d-flex" action="/files/search" method="GET" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="term"
                        id="term">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>

                <form class="d-flex" action="/index" method="GET" role="search">
                    <button style="margin-left:5px;" class="btn btn-secondary" type="submit">Reset</button>
                </form>
            </div>
        </div>

    </nav>
    @include('dropzone')
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
                                    <div class="col col-lg-2" style="margin-right:5px">
                                        <a href="{{ route('downloadfile', $file->name) }}" style="font-size:25px">
                                            <i class="bi bi-download" style="font-size: 1.3rem"></i>
                                        </a>
                                    </div>
                                    <div class="col col-lg-2">
                                        <a href="" style="font-size:25px" data-toggle="modal"
                                            data-target="#ModalEdit{{ $file->id }}">
                                            <i class="bi bi-pencil" style="font-size: 1.2rem"></i>
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
                    <td colspan="2">No files have been uploaded, add new files with the upload button</td>
                </tr>

            @endif
        </tbody>
    </table>

    <style>
        @media screen and (max-width: 992px) {

            .navbar-collapse>ul>.nav-item,
            .navbar-collapse>form,
            .navbar-collapse>form>button {
                margin-left: 0 !important;
                padding-top: 5px;
            }

            .container> .justify-content-md-center> .col-lg-2 {
                margin-right: 0 !important;
            }
        }

        .modal,
        .modal-backdrop {
            display: none;
        }

        .modal.open,
        .modal-backdrop.open {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        .modal {
            display: none;
            /* Hidden by default */
            padding-top: 100px;
            /* Location of the box */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        .modal-dialog {
            margin: auto;
        }

        .modal-content {
            position: relative;
            margin: auto;
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        @keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }

            to {
                top: 0;
                opacity: 1
            }
        }

    </style>

@endsection('content')
