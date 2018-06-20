import $ from "jquery"

$('#myAlert').on('closed.bs.alert', function () {
    $(".alert").alert('close')
});

