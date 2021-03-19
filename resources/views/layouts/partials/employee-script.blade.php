<script>
    function getEmail() {
        const name = document.getElementById('first_name').value;
        const email = document.getElementById('email');
        if (name) {
            email.value = name.toLowerCase() + '@company.mail';
        }
    }

    function getPassword() {
        const password = document.getElementById('password');
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghijklmnopqrstuvwxyz';
        const array = Array.from(chars);
        let random_string = '';
        for (i = 0; i < 12; i++) {
            const random_number = Math.floor(Math.random() * array.length);
            random_string += array[random_number];
        }
        password.value = random_string;
    }

    //on office-dropdown clicked
    $('#office').on('change', function () {
        //get officeID and division-dropdown
        const officeID = $(this).val();
        const division = $('#division');

        //get divisions of the office
        axios.get('/getDivision/' + officeID)
            .then(function (response) {
                division.empty();
                $.each(response.data, function (id, name) {
                    $('#division').append(new Option(name, id));
                });

                //get divisionID
                const divisionID = division.val();

                //get shifts of the division
                axios.get('/getShift/' + divisionID)
                    .then(function (response) {
                        $('#shift').empty();
                        $.each(response.data, function (id, name) {
                            $('#shift').append(new Option(name, id));
                        });
                    });

                //get users of the office and the division
                axios.get('/getParent/' + officeID + '/' + divisionID)
                    .then(function (response) {
                        $('#parent').empty();
                        $.each(response.data, function (id, name) {
                            $('#parent').append(new Option(name, id));
                        });
                    });
            });
    });

    //on division-dropdown clicked
    $('#division').on('change', function () {
        //get divisionID and officeID
        const divisionID = $(this).val();
        const officeID = $('#office').val()

        //get shifts of the division
        axios.get('/getShift/' + divisionID)
            .then(function (response) {
                $('#shift').empty();
                $.each(response.data, function (id, name) {
                    $('#shift').append(new Option(name, id));
                });
            });

        //get users of the office and the division
        axios.get('/getParent/' + officeID + '/' + divisionID)
            .then(function (response) {
                $('#parent').empty();
                $.each(response.data, function (id, name) {
                    $('#parent').append(new Option(name, id));
                })
            })
    });
</script>
