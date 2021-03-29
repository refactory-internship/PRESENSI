{{--CLOCK_OUT MODAL--}}
<div class="modal fade" id="clockOutModal" data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1" aria-labelledby="clockOutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('web.employee.attendances.submit-clock-out', $attendance->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="mb-3">
                        You are trying to clock-out earlier than your work schedule
                    </h5>
                    <div class="form-group mb-3">
                        <label for="modal_task_report">Task Report</label>
                        <input type="text" class="form-control" name="task_report" id="modal_task_report">
                    </div>
                    <div class="form-group mb-3">
                        <label for="note">Early Clock-Out Note</label>
                        <textarea name="note" id="note" style="resize: none;" cols="30" rows="5" class="form-control" autofocus></textarea>
                        <small class="text-muted">Provide details about your early clock-out</small>
                    </div>
                    <input type="hidden" name="overtimeStatus" id="overtimeStatus" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-warning">
                        Submit Clock-Out
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
{{--END CLOCK_OUT MODAL--}}
