{{--UPDATE OVERTIME PROGRESS MODAL--}}
<div class="modal fade" id="updateOvertimeProgress" data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1" aria-labelledby="updateOvertimeProgressLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('web.employee.overtimes.update-progress', $overtime->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="updateOvertimeProgressLabel">
                        Update Overtime Progress
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="modal_task_report">Task Report</label>
                        <input type="text" name="modal_task_report" id="modal_task_report" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
{{--END UPDATE OVERTIME PROGRESS MODAL--}}
