$(document).ready(function(){
    $('.activity-dropdown-btn').click(function (e) {
        e.preventDefault();
        if($('.activity-dropdown').hasClass('active')){
            $('.activity-dropdown').slideUp( "slow", function() {
            });
            $('.activity-dropdown').removeClass('active');


            
        }else{
            $('.activity-dropdown').slideDown( "slow", function() {
            });
            $('.activity-dropdown').addClass('active');
             $('.notification-dropdown').css('display', 'none');
             $('.profile-dropdown').css('display', 'none');
        }
    });
    $('.notification-dropdown-link').click(function () {
        if($('.notification-dropdown').hasClass('active')){
            $('.notification-dropdown').slideUp( "slow", function() {
            });
            $('.notification-dropdown').removeClass('active');

        }else{
            $('.notification-dropdown').slideDown( "slow", function() {
            });
            $('.notification-dropdown').addClass('active');
            $('.activity-dropdown').css('display','none');
            $('.profile-dropdown').css('display', 'none');


        }
    })

    $('.profile-dropdown-btn').click(function () {
        if($('.profile-dropdown').hasClass('active')){
            $('.profile-dropdown').slideUp( "slow", function() {
            });
            $('.profile-dropdown').removeClass('active');


        }else{
            $('.profile-dropdown').addClass('active');
            $('.profile-dropdown').slideDown( "slow", function() {

            });
            $('.activity-dropdown').css('display', 'none');
            $('.notification-dropdown').css('display','none');


        }
    })

    $("input:checkbox").on('click', function() {
        var $box = $(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });

});
