/*****************************
map.js
*****************************/

/*****************************
VARIABLES
*****************************/
var updating = false;
var update_interval = 2000;
var first = true;
var bounce = true;

var marker;
var markers = [];
var hidden_markers = [];
var new_markers_hold = [];
var infowindows = [];
var map;

var user_center = true;
var user_position;

/*****************************
DOCUMENT READY
*****************************/
$(document).ready(function(){
    //load the map
    loadMap();

    //toggle legend
    $('#show-legend').click(function(){
        $('#map-legend ').toggle();
        $('#show-legend i').toggle();
    });
});

/*****************************
Load the map
*****************************/
function loadMap() {
    google.maps.event.addDomListener(window, 'load', initialize);
}

/*****************************
Initialize
*****************************/
function initialize() {
    statusBarAnimate('Finding your location..',false);

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(success_fix, error);
    } else {
        statusBar('GPS unavailable.');
    }

    function success_fix(position) {
        user_position = position;
        initiateMap();
    }

    function error(msg) {
        user_center = false;
        initiateMap();
    }

    function initiateMap(){

        //wait for map to show untill fix is found
        showContent();

        //define map options
        var mapOptions = {
            zoom: zoom_level,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.SATELLITE
        };

        //create map
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

        //make map full height
        $('#map-canvas').height($(window).height() - $('.navbar-fixed').height());

        //direct keyboard controls for google maps
        google.maps.event.addListener(map, 'tilesloaded', function() {
            $("#map-canvas").children().children().first().children().trigger('click');
        });

        //center the map on user
        if(user_center){
            //get GPS position of user
            var lat = user_position.coords.latitude;
            var lon = user_position.coords.longitude;
            centerMap(lat,lon);
            statusBar('Location found. Looking for spots..');
        } else {
            statusBar('Location services disabled. Looking for spots..');
        }

        //look for spots
        hideStatusBarTime(5000);

        //first run pullUpdates
        pullUpdates();

        //run pullUpdates at interval
        setInterval(function(){
            pullUpdates();
        }, update_interval);
    }
}

/*****************************
Add marker to map
*****************************/
function addMarker(marker_container, drop, image) {

    //get variables from marker_container
    var marker_id = marker_container['id'];
    var lat = marker_container['lat'];
    var lon = marker_container['lon'];
    var content = marker_container['content'];
    var title = marker_container['title'];
    var track_id = marker_container['track_id'];

    //get position in google.map format
    var position_for_maps = new google.maps.LatLng(lat, lon);

    //do we want the animation
    if(drop){
      drop = google.maps.Animation.DROP;
    }

    //fix size
    var icon_image = new google.maps.MarkerImage(
        image,
        null,
        null,
        null,
        new google.maps.Size(32,32)
    );

    //FUTURE TODO :: IE FALLBACK :: IE DOESN'T CORRECTLY LOAD SVG IN MAPS API
    /*if(detectIE() != false){
        icon_image = {
        };
    }*/

    //add markers to map
    var infowindow = new google.maps.InfoWindow({
        content: content
    });

    //set up marker
    marker = new google.maps.Marker({
        position: position_for_maps,
        map: map,
        animation: drop,
        icon: icon_image,
        title: title,
        infowindow: infowindow,
        track_id: track_id
    });

    //add marker to markers array
    markers[marker_id] = marker;

    //listen to marker click for infoWindow
    google.maps.event.addListener(marker, 'click', function() {

        //hide all marker windows
        markers.forEach(function(element, index, array){
            element.infowindow.close(map);
        });

        //open marker window
        this.infowindow.open(map,this);
    });
}

/*****************************
Center map on specified location
*****************************/
function centerMap(lat,lon){
    map.setCenter(new google.maps.LatLng(lat, lon));
}

/*****************************
Push markers that are on hold
*****************************/
function pushMarkersHold(){
    //don't bounce on the first!
    var bounce_marker = bounce;
    if(first)
        bounce_marker = false;

    //iterate over new markers
    for(var i = 0; i < new_markers_hold.length; i++){

        //get icon image
        var image = image_root + new_markers_hold[i]['icon'];
        if(new_markers_hold[i]['icon'] == ''){
            image = image_root + 'default.svg';
        }

        //hide marker with current track_id -> only show the last of each track
        markers.forEach(function(element, index, array){
            if(new_markers_hold[i]['track_id'] == element.track_id){
               hideMarker(element);
            }
        });

        //add marker
        addMarker(new_markers_hold[i], bounce_marker, image);

        //center on the last updated. Don't if first time (then on user)
        if(i == new_markers_hold.length - 1 && !user_center){
            centerMap(new_markers_hold[i]['lat'],new_markers_hold[i]['lon']);
        }
    }

    //clear holding array
    new_markers_hold = [];

    //done updating and disable first tag
    updating = false;
    first = false;

    //show statusbar
    if(markers.length > 0){
        if(user_center)
            statusBar('Displaying latest spots near you..');
        else
            statusBar('Displaying latest spots..');
    } else
        statusBar('No spots found');
    hideStatusBarTime(5000);

    //no longer need for user center
    user_center = false;
}

/*****************************
Ajax call to get new spots. Uses $_SESSION['last_update']!
*****************************/
function pullUpdates() {
    //if pulling, just skip
    if(updating)
        return;

    updating = true;
    var msg = {
    };

    $.post('php/ajax/admin/pull_updates.php',msg,function(data){
        //convert to JSON and reverse for center purposes
        var new_markers = $.parseJSON(data).reverse();

        //add all markers to hold
        for(var i = 0; i < new_markers.length; i++){
            new_markers_hold.push(new_markers[i]);
        }

        //if first -> show; And show the user what's happening
        //not first -> place in hold
        if(first){
            statusBar(new_markers_hold.length + ' spot(s) found.');
            hideStatusBarTime(5000);
            pushMarkersHold();
        } else {
            if(new_markers_hold.length > 0){
                statusBar(new_markers_hold.length + ' new spot(s). <span class="show-new">Show</span>');
                $('.show-new').click(function(){
                    hideStatusBar();
                    pushMarkersHold();
                });
            }
            updating = false;
        }

    });
}

/*****************************
Hide specific marker
*****************************/
function hideMarker(marker){
    marker.setMap(null);
    hidden_markers.push(marker);
}
