@extends('layouts.app', ['pageTitle' => 'Attendance Report'])
@section('content')
    <div class="container">
        <div class="fade-in">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @include('layouts.partials.message')
                    <div class="card shadow p-4">
                        <div class="card-body">
                            <small class="text-muted">
                                Click <strong>Generate</strong>, then filter date of the report, and choose whether you
                                want to export to PDF or XLSX
                            </small>
                            <table class="table table-hover" aria-label="attendance-report" id="attendanceReportTable">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">#</th>
                                    <th scope="col" style="width: 80%">Employee</th>
                                    <th scope="col" style="width: 15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $user->getFullNameAttribute() }}</td>
                                        <td>
                                            <button type="button"
                                                    class="btn btn-sm btn-block btn-dark float-right"
                                                    id="editDateButton"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#filterReportDateModal"
                                                    data-bs-url="{{ route('web.admin.attendance-report.export', $user->id) }}">
                                                Generate
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--FILTER REPORT DATE MODAL--}}
    <div class="modal fade" id="filterReportDateModal" data-bs-backdrop="static" tabindex="-1"
         aria-labelledby="filterReportDateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterReportDateModalLabel">
                        Filter Report Date
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="filterReportDateModalForm" action="" method="GET">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <label for="month" class="text-uppercase font-weight-bold small">
                                    Select Month
                                </label>
                                <select name="month" id="month" class="form-control">
                                    @foreach($months as $month => $month_name)
                                        <option value="{{ $month }}">{{ $month_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-5">
                                <label for="year" class="text-uppercase font-weight-bold small">
                                    Select Year
                                </label>
                                <select name="year" id="year" class="form-control">
                                    @foreach($years as $id => $year)
                                        <option value="{{ $id }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" name="action" value="pdf">
                            Export to PDF
                        </button>
                        <button type="submit" class="btn btn-success" name="action" value="xlsx">
                            Export to XLSX
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--END FILTER REPORT DATE MODAL--}}
@endsection
@section('script')
    <script>
        const filterReportDateModal = document.getElementById('filterReportDateModal');
        filterReportDateModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            filterReportDateModal.querySelector('#filterReportDateModalForm').action = button.getAttribute('data-bs-url');
        })
    </script>
@endsection
