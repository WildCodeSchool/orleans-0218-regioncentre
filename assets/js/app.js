import $ from "jquery"

$(document).ready(function () {
    $('input[type="checkbox"]').addClass('toggles').wrap('<label class="switch mr-4"></label>').after('<span class="slider round"></span>');
    $("#formMessage").hide();

});

$('input[type="checkbox"]').prop( "checked", false ).change(function(){
        $("#formMessage").slideToggle(300);

});

