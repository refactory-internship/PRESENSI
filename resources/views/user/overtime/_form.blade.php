<form action="{{ route('web.employee.overtimes.store') }}" method="POST">
    @csrf
    <div class="form-group row mb-3">
        <label for="overtime_duration" class="col-form-label col-md-3">Overtime Duration</label>
        <div class="col-md-9">
            <select name="duration" id="overtime_duration" class="form-select form-select-sm">
                <option value="1">1 Hour</option>
                <option value="2">2 Hour</option>
                <option value="3">3 Hour</option>
            </select>
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="task_plan" class="col-form-label col-md-3">Task Plan</label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="task_plan" id="task_plan">
        </div>
    </div>
    <div class="form-group row mb-3">
        <label for="note" class="col-form-label col-md-3">Overtime Note</label>
        <div class="col-md-9">
            <textarea class="form-control" name="note" id="note" cols="30" rows="5"
                      style="resize: none;"></textarea>
            <small class="text-muted">Provide more information about your overtime if necessary</small>
        </div>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Submit Overtime">
        <a href="{{ route('web.employee.overtimes.index') }}" class="btn btn-dark">
            Cancel
        </a>
    </div>
</form>
