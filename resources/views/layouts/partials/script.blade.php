{{--coreui Bundle Script--}}
<script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.bundle.min.js"></script>

{{--Bootstrap 5 Bundle Script--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>

{{--Datatables Script--}}
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap5.min.js" defer></script>

<script>
    //select2 multiple dropdown
    $('.select2-dropdown-multiple').select2();

    $(document).ready(function () {
        $('#dataTable').DataTable({
            columnDefs: [
                {
                    orderable: false,
                    targets: [0, 6]
                }
            ],
            order: []
        });
    });
</script>
