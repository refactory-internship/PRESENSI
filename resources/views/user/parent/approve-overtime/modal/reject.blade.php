{{--REJECT OVERTIME MODAL--}}
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="staticBackdropLabel">
                    Reject Confirmation
                </h5>
            </div>
            <form id="permanentDelete" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="rejectionNote">Reason of Rejection</label>
                        <textarea name="rejectionNote" id="rejectionNote" class="form-control"
                                  style="resize: none" cols="30" rows="5"></textarea>
                        <small class="text-muted">
                            Please provide more information regarding your rejection to this overtime
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-outline-danger">
                        Yes, Reject This Overtime
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--END REJECT OVERTIME MODAL--}}
