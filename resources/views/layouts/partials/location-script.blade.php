<script type="text/javascript">
    $(document).ready(function () {
        //location dynamic dependent dropdown
        $('#provinces').on('change', function () {
            const provinceID = $(this).val();
            axios.get('/getCities/' + provinceID)
                .then(function (response) {
                    $('#cities').empty();
                    $.each(response.data, function (id, name) {
                        $('#cities').append(new Option(name, id));
                    });
                });
        });
        $('#cities').on('change', function () {
            const cityID = $(this).val();
            axios.get('/getDistricts/' + cityID)
                .then(function (response) {
                    $('#districts').empty();
                    $.each(response.data, function (id, name) {
                        $('#districts').append(new Option(name, id));
                    });
                });
        });
        $('#districts').on('change', function () {
            const districtID = $(this).val();
            axios.get('/getVillages/' + districtID)
                .then(function (response) {
                    $('#villages').empty();
                    $.each(response.data, function (id, name) {
                        $('#villages').append(new Option(name, id));
                    });
                });
        });
    });
</script>
