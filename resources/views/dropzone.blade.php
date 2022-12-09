@if (Session::has('success'))
    <div class="alert alert-success text-center">
        {{ Session::get('success') }}
    </div>
@endif

@if (count($errors) > 0)
    <script type="text/javascript">
        $(document).ready(function() {
            $('#ModalFileUpload').modal('show');
        });
    </script>
@endif


<div class="modal fade" id="ModalFileUpload" tabindex="-1" aria-labelledby="ModalFileUpload" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Upload file') }}</h5>

                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"
                        onclick="$('#ModalFileUpload').modal('hide');">

                    </button>
                </div>
                <div class="modal-body">
                    <form id="dropzone" action="/files" class="dropzone" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="fallback">
                            <input name="file" type="file"
                                class="form-control @error('file') is-invalid

                            @enderror"
                                multiple />
                            <br>
                            {!! $errors->first('file', '<span class="text-danger">:message</span>') !!}
                        </div>

                        <div>
                            <p>Only one file at once can be uploaded</p>
                            <p>supported files are: png, jpg, jpeg, csv, txt, xlx, xls, pdf, mp3</p>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                onclick="$('#ModalFileUpload').modal('hide');">Close</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>

                    </form>

                </div>



            </div>
        </div>

    </div>

</div>
