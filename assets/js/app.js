import $ from "jquery"

$('[id^= appbundle_user_roles_]').click(function (e) {
    $('#appbundle_user_roles_0').prop("checked", false);
    $('#appbundle_user_roles_1').prop("checked", false);
    $('#appbundle_user_roles_2').prop("checked", false);
    $(this).prop("checked", true);

    $('.lycee').hide();
    $('.department').hide();

    if ($('#appbundle_user_roles_0').prop("checked")) {
        $('.lycee select').val('');
        $('[id^=appbundle_user_departments_]').prop("checked", false);
    }

    if ($('#appbundle_user_roles_1').prop("checked")) {
        $('.department').show();
        $('.lycee select').val('');
    }
    if ($('#appbundle_user_roles_2').prop("checked")) {
        $('.lycee').show();
        let checkboxes = $('.department input[type="checkbox"]');
        $('[id^=appbundle_user_departments_]').prop("checked", false);
    }

});

$(document).ready(function () {
    $('input[type="checkbox"]').addClass('toggles').wrap('<label class="switch mr-4"></label>').after('<span class="slider round"></span>');
    $("#formMessage").hide();

});

$('input[type="checkbox"]').prop( "checked", false ).change(function(){
    $("#formMessage").slideToggle(300);

});