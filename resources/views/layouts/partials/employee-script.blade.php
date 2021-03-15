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

    //office-division dropdown
    $('#office').on('change', function () {
        const officeID = $(this).val();
        axios.get('/getDivision/' + officeID)
            .then(function (response) {
                $('#division').empty();
                $.each(response.data, function (id, name) {
                    $('#division').append(new Option(name, id));
                });
            });
    });

    //time-setting and parent dropdown
    $('#division').on('change', function () {
        const divisionID = $(this).val();
        const officeID = $('#office').val()
        console.log(officeID + ' office_id, ' + divisionID + ' division_id')
        axios.get('/getShift/' + divisionID)
            .then(function (response) {
                $('#shift').empty();
                $.each(response.data, function (id, name) {
                    $('#shift').append(new Option(name, id));
                });
            });
        axios.get('/getParent/' + officeID + '/' + divisionID)
            .then(function (response) {
                $('#parent').empty();
                $.each(response.data, function (id, name) {
                    $('#parent').append(new Option(name, id));
                })
            })
    });
</script>
