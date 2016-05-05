/*****************************
control_panel.js
*****************************/

/*****************************
DOCUMENT READY
*****************************/
$(document).ready(function(){
    showContent();

    //handle image marker click
    $('.control-panel-color').click(function(){
    	$('.control-panel-color').removeClass('selected');
    	$(this).addClass('selected');
    	$('#track_color_holder').val($(this).attr('rel'));
    })

    //fix height of switch to inner label
    $('.switch').height($('.switch').find('label').height() + 24);

    //handle add track form click
    $('#add-track').click(function(e){
    	e.preventDefault();

        //prevent double clicks
        $('#add-track').attr('disabled','disabled');

        //check if form is valid
    	if(validateTrackForm()){
    		submitTrackForm();
    	}
    });

    //handle add user form click
    $('#add-user').click(function(e){
        e.preventDefault();

        //prevent double clicks
        $('#add-user').attr('disabled','disabled');

        //check if form is valid
        if(validateUserForm()){
            submitUserForm();
        }
    });


    //enable first color for add track
    $('.control-panel-color').first().click();

    //handle privileges click
    $('input.priviliges').click(function(){

    	updatePrivileges($(this).attr('rel'),$(this).is(':checked'));
    });
});


/*****************************
Update Privileges of user
*****************************/
function updatePrivileges(user_id,viewer){
	//level is 0, unless viewer == true
    var level = 0;
	if(viewer)
		level = 1;

    //ajax message
	var msg = {
        'user_id' :  user_id,
        'user_level' : level
    };

    //ajax call, return json
    $.post('php/ajax/admin/update_privileges.php',msg,function(data){
    	var status = $.parseJSON(data);
    	if('succes' in status){
    		statusBar(status['succes'])
    		hideStatusBarTime(5000);
    	} else {
    		statusBar('Something went wrong. Please try again.');
    		hideStatusBarTime(5000);
    	}
    });
}

/*****************************
Validate add track form
*****************************/
function validateTrackForm(){
	//only check for trackname
	var valid = true;
	var to_message_bar = [];

	if($('#track_name').val().length == 0){
		//nothing filled in -> show them
		valid = false;

        //just empty in case
		$('#track_name').empty();
		$('#track_name').next().text('Fill in a trackname').css('color','#F00');

		to_message_bar.push('track name');
	}

	//generate user string for statusbar
	var str = '';
	if(valid){
		str = 'Adding track..';
	} else {
		str = 'Please fill in a value for the ';
		str = str.concat(style_status_bar_string(to_message_bar));

        //enable submit button
        $('#add-track').removeAttr('disabled');
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
Submit add track form
*****************************/
function submitTrackForm(){
	//ready colors
	var colors = $('#track_color_holder').val().split('_');

    //ajax message
	var msg = {
        'track_name' :  $('#track_name').val(),
        'track_primary_color' : colors[0],
        'track_secondary_color' : colors[1]
    };

    //ajax call
    $.post('php/ajax/admin/insert_track.php',msg,function(data){
    	var status = $.parseJSON(data);
    	if('succes' in status){
    		statusBar(status['succes'])
    		hideStatusBarTime(5000);
    	} else {
    		statusBar('Something went wrong. Please try again.');
    		hideStatusBarTime(5000);
    	}

        //enable submit button
        $('#add-track').removeAttr('disabled');
    });
}

/*****************************
Validate user form
*****************************/
function validateUserForm(){
    //only check for trackname
    var valid = true;
    var to_message_bar = [];

    if($('#new_user_username').val().length == 0){
        //nothing filled in -> show them
        valid = false;

        //empty in case
        $('#new_user_username').empty();
        $('#new_user_username').next().text('Fill in a username').css('color','#F00');

        to_message_bar.push('username');
    }

    if($('#new_user_password').val().length == 0){
        //nothing filled in -> show them
        valid = false;

        //empty in case
        $('#new_user_password').empty();
        $('#new_user_password').next().text('Fill in a password').css('color','#F00');

        to_message_bar.push('password');
    }

    if($('#new_user_nickname').val().length == 0){
        //nothing filled in -> show them
        valid = false;

        //empty in case
        $('#new_user_nickname').empty();
        $('#new_user_nickname').next().text('Fill in a nickname').css('color','#F00');

        to_message_bar.push('nickname');
    }

    //generate user string for statusbar
    var str = '';
    if(valid){
        str = 'Adding user..';
    } else {
        str = 'Please fill in a value for the ';
        str = str.concat(style_status_bar_string(to_message_bar));

        //enable submit button
        $('#add-user').removeAttr('disabled');
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
Submit user form
*****************************/
function submitUserForm(){
    //read checked
    var user_level = 0;
    if($('#new_user_level').is(':checked'))
        user_level = 1;

    //ajax message
    var msg = {
        'user_username' :  $('#new_user_username').val(),
        'user_password' :  $('#new_user_password').val(),
        'user_nickname' :  $('#new_user_nickname').val(),
        'user_level' :  user_level
    };

    //ajax call
    $.post('php/ajax/admin/insert_user.php',msg,function(data){
        //get json
        var status = $.parseJSON(data);
        if('succes' in status){
            statusBar(status['succes'])
            hideStatusBarTime(5000);

            //update set_user_privileges
            appendToSetUserPrivileges(status['user_id']);

        } else {
            //if user exists -> show them!
            if(status['new_user'][0] == 'taken'){
                $('#new_user_username').val('').focus();
                $('#new_user_username').next().text('Username already taken').css('color','#F00');
            }
            statusBar('<span class="red-text">' + status['new_user'][1] + '</span>');
            hideStatusBarTime(5000);
        }

        //enable submit button
        $('#add-user').removeAttr('disabled');
    });
}

/*****************************
When a new user is added, add it to the user privileges list
*****************************/
function appendToSetUserPrivileges(user_id){

    var msg = {
        'user_id' :  user_id,
    };

    $.post('php/ajax/admin/append_to_set_user_privileges.php',msg,function(data){
        //get json
        var json = $.parseJSON(data);

        //if succes -> append to set_user_privileges
        if('succes' in json){
            $('#set_user_privileges').append(json['content']);
        } else {
            console.log(data);
        }
    });
}