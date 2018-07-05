import $ from "jquery"

$(document).ready(function () {
    $('input[type="checkbox"]').addClass('toggles').wrap('<label class="switch mr-4"></label>').after('<span class="slider round"></span>');
    $("#formMessage").hide();

});

$('input[type="checkbox"]').prop("checked", false).change(function () {
    $("#formMessage").slideToggle(300);

});

var departments = document.getElementById('departments');
var lycees = document.getElementById("lycees");
var admin = document.getElementById("appbundle_user_roles_0");
var emop = document.getElementById("appbundle_user_roles_1");
var lycee = document.getElementById("appbundle_user_roles_2");
$(admin).attr('required', '');
$(departments).hide();
$(lycees).hide();

admin.addEventListener('change', function () {
    if (this.checked) {
        emop.checked = false;
        lycee.checked = false;
        $(departments).hide();
        $(lycees).hide();
    }
});
emop.addEventListener('change', function () {
    if (this.checked) {
        lycee.checked = false;
        admin.checked = false;
        $(departments).show();
        $(lycees).hide();
        $(admin).attr('required', false);
    }
});
lycee.addEventListener('change', function () {
    if (this.checked) {
        emop.checked = false;
        admin.checked = false;
        $(lycees).show();
        $(departments).hide();
        $(admin).attr('required', false);
    }
});
