/*****************************
spot.js
*****************************/

/*****************************
DOCUMENT READY
*****************************/
$(document).ready(function(){
    //initiate select
    $('select').material_select();

    //submit button handler
    $('#spot_submit').click(function(){

        //prevent double clicks
        $('#spot_submit').attr('disabled','disabled');

        //get form data
        var track_id = $('#spot_track_id').val();
        var description = $('#spot_description').val();

        //insert spot
        insertSpot(track_id,description);
    });

    //show content
    showContent();
});


/*****************************
Insert a spot
*****************************/
function insertSpot(track_id,description) {
	//show them fixing location
    statusBar('Fixing location..');

    //check if geolocation is set up
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(success_fix, error);
    } else {
        statusBar('GPS unavailable.');
    }

    //fix found, lets continue
    function success_fix(position) {
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;

        //show them succes
        statusBar('Found fix!');

        //ajax message
        var msg = {
            'track_id' :  track_id,
            'description' : description,
            'lat' : lat,
            'lon' : lon
        };

        //ajax call
        $.post('php/ajax/spotter/insert_spot.php',msg,function(data){
            //get json
            var status = $.parseJSON(data);
            if('succes' in status){
                statusBar(status['succes']);
                hideStatusBarTime(5000);

                //empty description form
                $('#spot_description').val('');

            } else {
                statusBar('<span class="red-text">Whoops something went wrong..</span>');
                hideStatusBarTime(5000);
            }

            //enable new entries
            $('#spot_submit').removeAttr('disabled');

            //reset select
            $('select').material_select('destroy');
            $('select').material_select();

        });
    }

    /*****************************
    Error handler for location fix
    *****************************/
    function error(msg) {
        statusBar('Location services disabled. Please enable.');
        console.log('Something went wrong');
    }
}