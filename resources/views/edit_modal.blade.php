
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

<form action="{{ route('file.update', [$file->id, $file->name]) }}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('PUT')
    <div class="modal fade" id="ModalEdit{{$file->id}}" tabindex="-1" aria-labelledby="ModalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Edit file name') }}</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3>
                        <label for=" nameField" class="form-label">New
                            name</label>

                            <input type="text" name="name" value="{{ $file->name }}" class="form-control"
                                placeholder="Name" id="nameField" required>


                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                          </div>



                    </div>
                </div>

            </div>

        </div>
    </div>

</form>
