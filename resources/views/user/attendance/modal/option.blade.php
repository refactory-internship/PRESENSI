{{--OVERTIME OPTION MODAL--}}
<div class="modal fade" id="overtimeOption" data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Overtime
                </h5>
            </div>
            <div class="modal-body" id="optionBody">
                Text will be overwritten by script
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Close
                </button>
{{--                <button type="button" class="btn btn-dark" onclick="openOvertimeModal()">--}}
{{--                    Yes, Create Overtime--}}
{{--                </button>--}}
                <a href="{{ route('web.employee.overtimes.create') }}" class="btn btn-dark">
                    Yes, Create Overtime
                </a>
            </div>
        </div>
    </div>
</div>
{{--END OVERTIME OPTION MODAL--}}
