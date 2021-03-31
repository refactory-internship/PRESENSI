<fieldset>
    <legend>
        <span class="badge badge-warning">
            {{ strtoupper($dateStatus) }}
        </span>
    </legend>
    <div class="mt-3">
        <div class="form-group">
            <a href="{{ route('web.employee.attendances.index') }}" class="btn btn-primary">
                Go to your attendance
            </a>
            <a href="{{ route('web.employee.overtimes.index') }}" class="btn btn-dark">
                Cancel
            </a>
        </div>
    </div>
</fieldset>
