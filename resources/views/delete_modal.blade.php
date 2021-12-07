{{-- !-- Delete Warning Modal --> --}}
<form action="{{ route('user.delete') }}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('DELETE')
    <div class="modal fade" id="modalAccountDelete{{  $user->id  }}" tabindex="-1"
        aria-labelledby="ModalAccountDeleteLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Edit profile') }}</h5>

                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">

                        </button>
                    </div>

                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
                        <h5 class="text-center">Are you sure you want to delete your account? </h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete permanently my account</button>
                    </div>


                </div>
            </div>

        </div>

    </div>

</form>
