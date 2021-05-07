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
        <th scope="col">Type</th>
        <th scope="col">Total</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <strong>Attendance</strong>
        </td>
        <td>
            <strong>{{ $attendance }} {{ $attendance > 1 ? 'Days' : 'Day' }}</strong>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Overtime</strong>
        </td>
        <td>
            <strong>{{ $overtime }} {{ $overtime > 1 ? 'Hours' : 'Hour' }}</strong>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Absent</strong>
        </td>
        <td>
            <strong>{{ $absent }} {{ $absent > 1 ? 'Days' : 'Day' }}</strong>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Leave</strong>
        </td>
        <td>
            <strong>{{ $leave }} {{ $leave > 1 ? 'Days' : 'Day' }}</strong>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
