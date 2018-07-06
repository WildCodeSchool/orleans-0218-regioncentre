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
var reqlycee = document.getElementsByName('appbundle_user[lycee]');
$(admin).attr('required', '');
$(departments).hide();
$(lycees).hide();
var dep = document.getElementsByName('appbundle_user[departments][]');
var i;


admin.addEventListener('change', function () {
    if (this.checked) {
        emop.checked = false;
        lycee.checked = false;
        $(departments).hide();
        $(lycees).hide();
        $(reqlycee).attr('required', false);
        unDepReq();
    }
});
emop.addEventListener('change', function () {
    if (this.checked) {
        lycee.checked = false;
        admin.checked = false;
        $(departments).show();
        $(lycees).hide();
        $(admin).attr('required', false);
        $(reqlycee).attr('required', false);
        var y;
        for (y = 0; y < dep.length; y++) {
            $(dep[y]).click(function () {
                $(dep[y]).click(reqDep());
            });
        }
        reqDep();
    }
});
lycee.addEventListener('change', function () {
    if (this.checked) {
        emop.checked = false;
        admin.checked = false;
        $(lycees).show();
        $(departments).hide();
        $(admin).attr('required', false);
        $(reqlycee).attr('required', true);
        unDepReq();
    }
});


function reqDep() {
    var dep = document.getElementsByName('appbundle_user[departments][]');
    var one = false;//at least one cb is checked
    var i;
    for (i = 0; i < dep.length; i++) {
        if (dep[i].checked === true) {
            one = true;
        }
    }

    if (one === true) {
        for (i = 0; i < dep.length; i++) {
            $(dep[i]).attr('required', false);
        }
    } else {
        for (i = 0; i < dep.length; i++) {
            $(dep[i]).attr('required', true);
        }
    }
}

function unDepReq() {
    for (i = 0; i < dep.length; i++) {
        $(dep[i]).attr('required', false);
    }
}





