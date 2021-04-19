<form action="{{ route($calendarRoutes . '.store') }}" method="POST">
    @csrf
    <div class="form-group row mb-3">
        <label for="first_range" class="col-form-label col-md-3">First Date Range</label>
        <div class="col-md-9">
            <select class="form-control" name="first_range" id="first_range">
                @for($i = 0; $i < $yearInterval; $i++)
                    <option value="{{ $thisYear + $i }}">{{ $thisYear + $i }}</option>
                @endfor
            </select>
        </div>
    </div>

    <div class="form-group row mb-5">
        <label for="last_range" class="col-form-label col-md-3">Last Date Range</label>
        <div class="col-md-9">
            <select class="form-control" name="last_range" id="last_range">
                @for($i = 0; $i < $yearInterval; $i++)
                    <option value="{{ $thisYear + $i }}">{{ $thisYear + $i }}</option>
                @endfor
            </select>
        </div>
    </div>

    <div class="form-group float-right">
        <a href="{{ route($calendarRoutes . '.index') }}" class="btn btn-dark">Cancel</a>
        <input type="submit" value="Add New Calendar" class="btn btn-primary">
    </div>
</form>
