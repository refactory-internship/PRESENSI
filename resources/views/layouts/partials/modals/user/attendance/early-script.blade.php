<script>
    function submitClockOut() {
        const currentTime = '{{ \Carbon\Carbon::parse($currentDate)->toTimeString() }}';
        //shift ends -15 minutes
        const shiftEnds = '{{ \Carbon\Carbon::parse(auth()->user()->time_setting->end_time)->subMinutes(15)->toTimeString() }}';
        const taskReport = $('#task_report').val();
        const note = document.getElementById('note');

        if (currentTime < shiftEnds) {
            note.value = 'EARLY CLOCK OUT REASON:\r\n'
            $('#modal_task_report').val(taskReport)
            openClockOutModal();
        } else {
            $('#clockOutForm').submit();
        }
    }

    function openClockOutModal() {
        $('#clockOutModal').modal('show');
    }
</script>
