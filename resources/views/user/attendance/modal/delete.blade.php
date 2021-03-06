{{--DELETE ATTENDANCE MODAL--}}
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="staticBackdropLabel">
                    Delete Confirmation
                </h5>
            </div>
            <form id="permanentDelete" action="" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    Are you sure want to delete this attendance?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-outline-danger">
                        Yes, Delete This Attendance Permanently
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--END DELETE ATTENDANCE MODAL--}}
