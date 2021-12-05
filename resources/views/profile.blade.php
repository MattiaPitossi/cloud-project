@extends('layouts.master')
@section('content')
    @foreach ($user_data as $user)
        <div class="container">
            <div class="main-body">

                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="main-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/index">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                    </ol>
                </nav>
                <!-- /Breadcrumb -->

                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    @if (Auth::user()->image)
                                        <img class="rounded-circle"
                                            src="{{ asset('storage/images/' . Auth::user()->image) }}" alt="profile_image"
                                            width="150">
                                    @endif
                                    <div class="mt-3">
                                        <h4>{{ $user->name }}</h4>
                                        {{-- <p class="text-secondary mb-1">Basic Account</p> --}}
                                        <p class="text-muted font-size-sm">{{ $user->address }}</p>
                                        <form action="/profile/upload" method="POST" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <label style="margin-bottom:5px" class="btn btn-primary">
                                                Update Photo <input type="file" id="file" name="image" onchange="this.form.submit();" hidden />
                                            </label>
                                        </form>
                                        <button class="btn btn-outline-primary" data-toggle="modal"
                                            data-target="#modalAccountDelete{{ $user->id }}">Delete Account</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user->name }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user->email }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user->phone }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Mobile</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user->mobile }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user->address }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a class="btn btn-primary "
                                        href=""" data-toggle="modal" data-target="#ModalProfileEdit{{$user->id}}">Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('edit_profile_modal')



                    </div>
                </div>

                @include('delete_modal')

            </div>
        </div>
    @endforeach
@endsection('content')
