@if (Session::has('success'))
    <div class="alert alert-success text-center">
        {{ Session::get('success') }}
    </div>
@endif

@if (count($errors) > 0)
    <script type="text/javascript">
        $(document).ready(function() {
            $('#ModalProfileEdit{{ $user->id }}').modal('show');
        });
    </script>
@endif

<form action="{{ route('user.update', [$user->id]) }}" method="POST" enctype="multipart/form-data" novalidate>


    @csrf
    @method('PUT')
    <div class="modal fade" id="ModalProfileEdit{{ $user->id }}" tabindex="-1"
        aria-labelledby="ModalProfileEditLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Edit profile') }}</h5>

                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"
                            onclick="$('#ModalProfileEdit{{ $user->id }}').modal('hide');">

                        </button>
                    </div>
                    <div class="modal-body">



                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid

                                @enderror"
                                    value="{{ $user->name }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="email"
                                    class="form-control @error('email') is-invalid

                                @enderror"
                                    value="{{ $user->email }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phone</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">


                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Mobile</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="mobile" class="form-control" value="{{ $user->mobile }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="text" name="address" class="form-control"
                                    value="{{ $user->address }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9 text-secondary">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                        onclick="$('#ModalProfileEdit{{ $user->id }}').modal('hide');">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>

                    </div>



                </div>
            </div>

        </div>

    </div>
    </div>

</form>
