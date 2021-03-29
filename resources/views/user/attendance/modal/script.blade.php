<script>
    function submitAttendance() {
        const overtimeOptionModal = document.getElementById('overtimeOption');
        const calendarStatus = '{{ $date->status }}';
        const shiftStarts = '{{ auth()->user()->time_setting->start_time }}';
        const shiftEnds = '{{ auth()->user()->time_setting->end_time }}';
        const currentTime = '{{ date('H:i:s', strtotime($currentDate)) }}'
        const modalBody = overtimeOptionModal.querySelector('.modal-body')

        if (calendarStatus === '1') {
            if (currentTime >= shiftStarts && currentTime <= shiftEnds) {
                $('#attendanceForm').submit();
            } else if (currentTime < shiftStarts) {
                openOption();
                modalBody.textContent = 'Your working shift is not started yet.'
                overtimeOptionModal.querySelector('.btn-dark').remove();
            } else if (currentTime > shiftEnds) {
                openOption();
                modalBody.textContent = 'Your working shift is finished. Do you want to create an overtime?'
            }
        } else if (calendarStatus === '2') {
            openOption();
            modalBody.textContent = 'You are trying to create an attendance in a non working day. Do you want to create an overtime?'
        } else if (calendarStatus === '3') {
            openOption();
            modalBody.textContent = 'You are trying to create an attendance in a holiday. Do you want to create an overtime?'
        }
        console.log(currentTime)
    }

    function openOption() {
        $('#overtimeOption').modal('show');
    }

    // function openOvertimeModal() {
    //     $('#overtimeOption').modal('hide');
    //     $('#createOvertime').modal('show');
    //     const overtimeStatus = document.getElementById('overtimeStatus').value = 1
    //     console.log(overtimeStatus)
    // }
</script>
