import $ from "jquery"

$('[id ^= appbundle_user_roles_').click(function (e) {
    $('#appbundle_user_roles_0').prop("checked", false);
    $('#appbundle_user_roles_1').prop("checked", false);
    $('#appbundle_user_roles_2').prop("checked", false);
    $(this).prop("checked", true);

    $('.lycee').hide();
    $('.department').hide();

    if ($('#appbundle_user_roles_0').prop("checked")) {
        $('.lycee select').val('');
        $('[id ^= appbundle_user_departments_').prop("checked", false);
    }

    if ($('#appbundle_user_roles_1').prop("checked")) {
        $('.department').show();
        $('.lycee select').val('');
    }
    if ($('#appbundle_user_roles_2').prop("checked")) {
        $('.lycee').show();
        let checkboxes = $('.department input[type="checkbox"]');
        $('[id ^= appbundle_user_departments_').prop("checked", false);
    }
});