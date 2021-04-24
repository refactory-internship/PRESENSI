@extends('layouts.app', ['pageTitle' => 'QR Code Attendance'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow p-4">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="timer">QR Code Duration</label>
                                <select name="timer" id="timer" class="form-control">
                                    <option value="10">10 Seconds</option>
                                    <option value="30">30 Seconds</option>
                                    <option value="60">60 Seconds</option>
                                </select>
                            </div>
{{--                            <a href="{{ route('web.admin.QRCode.generate') }}" class="btn btn-primary" target="_blank" onclick="startTimer()">--}}
{{--                                Start QR Code--}}
{{--                            </a>--}}
                            <button class="btn btn-success" onclick="startTimer()">Start QR Code</button>
                            <button class="btn btn-danger" id="stopTimer">Stop QR Code</button>

                            <div class="text-center mb-3">
                                <h5>Remaining Time</h5>
                                <h5 id="countdown">00:00</h5>
                            </div>

                            <div class="visible-print text-center mb-3">
                                <p id="qrCode"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        const countdownElement = document.getElementById('countdown');
        const text = document.getElementById('qrCode');

        function startTimer() {
            let duration = $('#timer').val();
            const timerInterval = setInterval(countdown, 1000);
            getQRCode();
            // text.innerHTML = Math.random();

            function countdown() {
                const minute = duration / 60;
                let formatMinute = Math.floor(minute);
                let seconds = duration % 60;

                seconds = seconds < 10 ? '0' + seconds : seconds;
                formatMinute = formatMinute < 10 ? '0' + formatMinute : formatMinute;

                countdownElement.innerHTML = `${formatMinute}:${seconds}`;
                duration--;

                if (duration < 0) {
                    clearInterval(timerInterval);
                    startTimer()
                }
            }

            $('#stopTimer').on('click', function () {
                clearInterval(timerInterval)
                countdownElement.innerHTML = '00:00';
                text.innerHTML = '';
            })
        }

        function getQRCode() {
            axios.get('/web/admin/QRCode/generate')
                .then(function (response) {
                    console.log(response)
                    text.innerHTML = response.data;
                });
        }
    </script>
@endsection
