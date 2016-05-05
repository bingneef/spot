function loadGps() {
	statusBar('Fixing location..');

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(success_fix, error);
    } else {
        alert("Not Supported!");
    }

    function success_fix(position) {
        console.log(position.coords.latitude);
        console.log(position.coords.longitude);

        statusBar('Found fix! Lat:' + position.coords.latitude + ', Long:' + position.coords.longitude);
    }

    function error(msg) {
        console.log(typeof msg == 'string' ? msg : "error");
    }
}