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
            padding-left: 10px;
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
<p>
    <strong>Report Month: {{ $month }}</strong>
</p>
<table class="content" aria-label="attendancePDF">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Date</th>
        <th scope="col">Attendance Type</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $record)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ date('F jS Y', strtotime($record->created_at)) }}</td>
            @if($record->attendance_type === '1')
                <td>Attendance</td>
            @elseif($record->attendance_type === '2')
                <td>Overtime</td>
            @elseif($record->attendance_type === '3')
                <td>Absent</td>
            @elseif($record->attendance_type === '4')
                <td>Leave</td>
            @else
                <td>No Data</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
