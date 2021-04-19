{{--EDIT DATE STATUS MODAL--}}
<div class="modal fade" id="editDateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="editDateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDateModalLabel">
                    Edit Date Status
                </h5>
            </div>
            <form id="editDateModalForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group row mb-3">
                        <label for="status" class="col-form-label col-md-3">Status</label>
                        <div class="col-md-9">
                            <select class="form-control" name="status" id="status">
                                <option value="1">WEEK DAY</option>
                                <option value="2">WEEK END</option>
                                <option value="3">HOLIDAY</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                                  style="resize: none"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--END EDIT DATE STATUS MODAL--}}
