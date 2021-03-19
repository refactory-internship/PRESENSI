<fieldset>
    <legend>{{ $dateStatus }}</legend>
    {{ \Carbon\Carbon::parse($currentDate)->isoFormat('dddd, MMMM Do YYYY, kk:mm') }}
    <div class="mt-3">
        <div class="form-group">
            <button type="button" class="btn btn-primary" onclick="submitAttendance()">
                Create Attendance
            </button>
            <a href="{{ route('web.employee.attendances.index') }}" class="btn btn-dark">
                Cancel
            </a>
        </div>
    </div>
</fieldset>
