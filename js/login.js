/*****************************
login.js
Specific JS for login.php
*****************************/

/*****************************
DOCUMENT READY
*****************************/
$(document).ready(function(){
	//center the login form
    verticalCenterContent($('#content'));

    //show the content
    showContent();

    //handle login button click
    $('#button-login').click(function(e){
    	e.preventDefault();

        //prevent double clicks
        $('#button-login').attr('disabled','disabled');

        //check if form is valid
        if(validateForm()){
        	submitForm();
        }
    });
});


/*****************************
Validate the content of the login form
*****************************/
function validateForm(){
	//only check for trackname
	var valid = true;
	var to_message_bar = [];

	if($('#username').val().length == 0){
		//nothing filled in -> show them
		valid = false;

		//empty in case
		$('#username').empty();
		$('#username').val('Fill in an username').css('color','#F00');

		to_message_bar.push('username');
	}

	if($('#password').val().length == 0){
		//nothing filled in -> show them
		valid = false;

		//empty in case
		$('#password').empty();
		$('#password').val('Fill in an password').css('color','#F00');

		to_message_bar.push('password');
	}

	//generate user string for statusbar
	var str = '';
	if(valid){
		str = 'Logging-in..';
	} else {
		str = 'Please fill in a value for the ';
		str = str.concat(style_status_bar_string(to_message_bar));

        //enable submit button
        $('#button-login').removeAttr('disabled');
	}

    //if there is statusbar content, show!
	if(str.length > 0){
		statusBar(str);
		hideStatusBarTime(5000);
	}

	//return value
	return valid;
}

/*****************************
submitForm and check if correct
*****************************/
function submitForm(){

	//ajax message
	var msg = {
        'username' : $('#username').val(),
        'password' : $('#password').val()
    };

    //ajax call
    $.post('php/ajax/check_login.php',msg,function(data){
    	var status = $.parseJSON(data);
    	if('succes' in status){
    		//reload sets up user and fired page controller
    		location.reload(true);
    	} else {
    		//show the error
    		statusBar(status['login']);
    		hideStatusBarTime(5000);
    	}

        //enable submit for new login attempt
        $('#button-login').removeAttr('disabled');
    });
}

