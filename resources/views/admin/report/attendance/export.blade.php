<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendance Report</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 10pt;
        }

        p.text {
            margin: 0;
        }

        table.content {
            width: 100%;
            border: 0.1mm solid black;
            border-collapse: collapse;
        }

        .content td {
            border: 0.1mm solid black;
            padding: 3px;
        }

        table thead th {
            background-color: #EEEEEE;
            text-align: center;
            border: 0.1mm solid #000000;
        }
    </style>

</head>
<body>
<p class="text">Employee Name: {{ $user->getFullNameAttribute() }}</p>
<p class="text">Position: {{ $user->role->name }}</p>
<p class="text">Division: {{ $user->division_office->division->name }}</p>
<p class="text">Office: {{ $user->division_office->office->name }}</p>
<p class="text">Report Month: <strong>{{ $month }}</strong></p>

<br>
<strong>Monthly Attendance Count</strong>
<p class="text">
    Attendance: {{$attendanceCounter['attendanceCount']}} {{$attendanceCounter['attendanceCount'] > 1 ? 'Days' : 'Day'}}</p>
<p class="text">
    Absent: {{$attendanceCounter['absentCount']}} {{$attendanceCounter['absentCount'] > 1 ? 'Days' : 'Day'}}</p>
<p class="text">
    Overtime: {{$attendanceCounter['overtimeDuration']}} {{$attendanceCounter['overtimeDuration'] > 1 ? 'Hours' : 'Hour'}}</p>
<p class="text">
    Leave: {{$attendanceCounter['leaveCount']}} {{$attendanceCounter['leaveCount'] > 1 ? 'Days' : 'Day'}}</p>

<br>
<strong>Attendance Report</strong>
<table class="content" aria-label="attendancePDF" style="font-size: 12px;">
    <thead>
    <tr>
        <th scope="col">No</th>
        <th scope="col">Date</th>
        <th scope="col">Task Plan</th>
        <th scope="col">Note</th>
{{--        <th scope="col">Type</th>--}}
    </tr>
    </thead>
    <tbody>
    @foreach($report as $data)
        <tr>
            <td style="width: 4%; text-align: center;">
                {{$loop->index + 1}}
            </td>
            @if($data->description === 'WEEK_END' || $data->description === 'HOLIDAY')
                <td style="width: 15%; color: red;">
                    {{ date('l', strtotime($data->date)) }}
                </td>
            @else
                <td style="width: 15%;">
                    {{ date('D, d-m-Y', strtotime($data->date)) }}
                </td>
            @endif
            @if($data->task_plan !== null)
                <td style="width: 40%;">
                    @foreach($data->task_plan as $task_plan)
                        {{ $task_plan }} <br>
                    @endforeach
                </td>
            @else
                <td></td>
            @endif
            @if($data->note !== null)
                <td style="width: 30%;">{{$data->note}}</td>
            @else
                <td></td>
            @endif

{{--            @if($data->attendanceType !== null)--}}
{{--                <td style="width: 10%;">{{$data->attendanceType}}</td>--}}
{{--            @else--}}
{{--                <td></td>--}}
{{--            @endif--}}
        </tr>
    @endforeach
    </tbody>
</table>

<br>
<strong>Overtimes Report</strong>
<table class="content" aria-label="attendancePDF" style="font-size: 12px;">
    <thead>
    <tr>
        <th scope="col">No</th>
        <th scope="col">Date</th>
        <th scope="col">Task Plan</th>
        <th scope="col">Start Time</th>
        <th scope="col">End Time</th>
        <th scope="col">Duration (Hours)</th>
    </tr>
    </thead>
    <tbody>
    @forelse($overtimes as $overtime)
        <tr>
            <td style="width: 4%; text-align: center;">{{$loop->index + 1}}</td>
            <td style="width: 15%;">{{ date('D, d-m-Y', strtotime($overtime->date)) }}</td>
            <td>{{$overtime->task_plan}}</td>
            <td style="width: 15%; text-align: center;">{{$overtime->start_time}}</td>
            <td style="width: 15%; text-align: center;">{{$overtime->end_time}}</td>
            <td style="width: 10%; text-align: center;">{{$overtime->duration}}</td>
        </tr>
    @empty
        <tr>
            <td style="width: 4%; text-align: center;">No Data</td>
            <td style="width: 15%;">No Data</td>
            <td>No Data</td>
            <td style="width: 15%; text-align: center;">No Data</td>
            <td style="width: 15%; text-align: center;">No Data</td>
            <td style="width: 10%; text-align: center;">No Data</td>
        </tr>
    @endforelse
    </tbody>
</table>

</body>
</html>
