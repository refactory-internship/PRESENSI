<div class="accordion" id="dateAccordion">
    @foreach($calendars as $calendar)
        <div class="accordion-item">
            <div class="accordion-header" id="heading{{ $loop->index + 1 }}">
                <button class="accordion-button collapsed text-value {{ $calendar->day_name === 'Saturday' || $calendar->day_name === 'Sunday'? 'text-danger' : '' }}"
                        type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse{{ $loop->index + 1 }}"
                        aria-expanded="false"
                        aria-controls="collapse{{ $loop->index + 1 }}">
                    {{ date('l, d/m/Y', strtotime($calendar->date)) }}
                </button>
            </div>
            <div id="collapse{{ $loop->index + 1 }}" class="accordion-collapse collapse"
                 aria-labelledby="heading{{ $loop->index + 1 }}" data-bs-parent="#dateAccordion">
                <div class="accordion-body">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            Date Status
                        </div>
                        <div class="col-md-9">
                            @if($calendar->status === '1')
                                <div class="text-value-sm font-weight-bold">WEEK DAY</div>
                            @elseif($calendar->status === '2')
                                <div class="text-value-sm font-weight-bold text-warning">WEEK END</div>
                            @elseif($calendar->status === '3')
                                <div class="text-value-sm font-weight-bold text-warning">HOLIDAY</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            Description
                        </div>
                        <div class="col-md-7">
                            <div class="text-value-sm font-weight-bold {{ $calendar->status !== '1' ? 'text-warning' : '' }}">
                                {{ $calendar->description }}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button"
                                    class="btn btn-sm btn-block btn-primary float-right"
                                    id="editDateButton"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editDateModal"
                                    data-bs-status="{{ $calendar->status }}"
                                    data-bs-description="{{ $calendar->description }}"
                                    data-bs-url="{{ route('web.admin.calendars.update', $calendar->id) }}">
                                <i class="bi bi-pencil-square"></i>
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
