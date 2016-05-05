/*****************************
tools.js
Tools for every page
*****************************/

//STANDARD VARIABLES
var timeout_status_bar_id;

/*****************************
Center an object
*****************************/
function centerContent(object_to_position) {
    var window_height = $(window).height();
    var window_width = $(window).width();
    var object_height = object_to_position.height();
    var object_width = object_to_position.width();
    var margin_height_needed = (window_height - object_height) / 2;
    var margin_width_needed = (window_width - object_width) / 2;

    object_to_position.css('margin-top', margin_height_needed).css('margin-left', margin_width_needed);
};

/*****************************
Vertically center an object
*****************************/
function verticalCenterContent(object_to_position) {
    var window_height = $(window).height();
    var object_height = object_to_position.height();
    var margin_height_needed = (window_height - object_height) / 2;

    //if for some reason window_height is zero, forget about it and just place it
    if(window_height > 0)
        object_to_position.css('margin-top', margin_height_needed);
};

/*****************************
Make object full page size
*****************************/
function fullSize(object_to_resize){
	var window_height = $(window).height();
	object_to_resize.css('height',window_height);
}

/*****************************
Show content, hide loader
*****************************/
function showContent(){
    $('#loader').hide();
    $('#content').show();
}

/*****************************
Hide content, show loader
*****************************/
function hideContent(){
    $('#loader').show();
    $('#content').hide();
}

/*****************************
Set content of status bar and show (if not already showing)
*****************************/
function statusBar(content){
    clearTimeout(timeout_status_bar_id);
    statusBarAnimate(content,true);
}

/*****************************
Animate status bar
*****************************/
function statusBarAnimate(content,animate){
    $('#status-bar').html(content);

    //find bottom offset from outer status bar padding
    var bottom_offset = parseInt($('#status-bar-outer').css('padding-bottom'));  

    //if no need to animate
    if(!animate){
         $('#status-bar-outer').css('bottom',bottom_offset);
         $('#status-bar-outer').show();
    } else {

        //check if statusbar is already on screen, else show it
        if(parseInt($('#status-bar-outer').css('bottom')) < 0 || !$('#status-bar-outer').is(":visible")){

            //center align ::> bring just under screen ::> show
            $('#status-bar-outer').css('bottom',-($('#status-bar').height() + bottom_offset));
            $('#status-bar-outer').show();
            $('#status-bar-outer').animate(
                {bottom: bottom_offset + "px"},
                400);
        }
    }
}

/*****************************
Hide the status bar
*****************************/
function hideStatusBar(){

    //get offset from bottom
    var bottom_offset = parseInt($('#status-bar-outer').css('padding-bottom'));
    $('#status-bar-outer').animate(
        {bottom: -($('#status-bar-outer').height() + bottom_offset) + "px"},
        400,
        function(){
            $('#status-bar-outer').hide();
        });
}

/*****************************
Hide the status bar with delay
*****************************/
function hideStatusBarTime(delay){
    timeout_status_bar_id = setTimeout(function(){
        hideStatusBar();
    },delay);
}

function style_status_bar_string(to_message_bar){
    var str = '';
    for(var i = 0; i < to_message_bar.length; i++){
        str = str.concat(to_message_bar[i]);
        if(i == to_message_bar.length - 2){
            str = str.concat(' and ');
        } else if(i < to_message_bar.length - 2){
            str = str.concat(', ');
        }
    }
    str = str.concat('.');

    return str;
}

/*****************************
Detects IE
*****************************/
function detectIE() {
    var ua = window.navigator.userAgent;

    var msie = ua.indexOf('MSIE ');
    if (msie > 0) {
        // IE 10 or older => return version number
        return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
    }

    var trident = ua.indexOf('Trident/');
    if (trident > 0) {
        // IE 11 => return version number
        var rv = ua.indexOf('rv:');
        return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
    }

    var edge = ua.indexOf('Edge/');
    if (edge > 0) {
       // IE 12 => return version number
       return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
    }

    // other browser
    return false;
}