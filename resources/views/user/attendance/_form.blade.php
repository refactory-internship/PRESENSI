<form action="{{ route('web.employee.attendances.store') }}" method="POST" id="attendanceForm">
    @csrf
    <div class="form-group row mb-3">
        <label for="task_plan" class="col-form-label col-md-3">Task Plan</label>
        <div class="col-md-9">
            <input type="text" name="task_plan" id="task_plan" class="form-control">
        </div>
    </div>

    <div class="form-group row mb-3">
        <label class="col-form-label col-md-3" for="note">Attendance Note</label>
        <div class="col-md-9">
            <textarea class="form-control" id="note" name="note" style="resize: none" cols="30" rows="5"></textarea>
            <small class="text-muted">
                If you're <strong>clocking-in late</strong> or planning to <strong>clock-out earlier</strong> than your work schedule, please make sure to inform us
            </small>
        </div>
    </div>

    <div class="form-group">
        <button type="button" class="btn btn-primary" onclick="submitAttendance()">
            Submit Attendance
        </button>
        <a href="{{ route('web.employee.attendances.index') }}" class="btn btn-dark">
            Cancel
        </a>
    </div>
</form>
