import $ from "jquery"

$('[id ^= appbundle_user_roles_').click(function(e) {
    $('#appbundle_user_roles_0').prop("checked", false);
    $('#appbundle_user_roles_1').prop("checked", false);
    $('#appbundle_user_roles_2').prop("checked", false);
    $(this).prop("checked", true);

    $('.lycee').hide();
    $('.department').hide();

    if ($('#appbundle_user_roles_1').prop("checked")) {
        $('.department').show();
    }
    if ($('#appbundle_user_roles_2').prop("checked")) {
        $('.lycee').show();
    }
});