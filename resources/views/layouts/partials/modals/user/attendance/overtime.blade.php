{{--CREATE OVERTIME MODAL--}}
<div class="modal fade" id="createOvertime" data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('web.employee.attendances.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="overtime_duration">Overtime Duration</label>
                        <select name="overtime_duration" id="overtime_duration" class="form-select form-select-sm">
                            <option value="1">1 Hour</option>
                            <option value="2">2 Hour</option>
                            <option value="3">3 Hour</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="task_plan">Task Plan</label>
                        <input type="text" name="task_plan" id="task_plan" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="task_report">Task Report</label>
                        <input type="text" name="task_report" id="task_report" class="form-control">
                    </div>
                    <input type="hidden" name="overtimeStatus" id="overtimeStatus" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Submit Overtime
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
{{--END CREATE OVERTIME MODAL--}}
