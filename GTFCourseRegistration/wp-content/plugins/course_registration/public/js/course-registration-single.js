// Load Google Map
function initialize() {
	var mapCanvas = document.getElementById('map-course-location');
	var mapOptions = {
		center: new google.maps.LatLng(Number(course_params.lat), Number(course_params.lng)),
		zoom: 16,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	var map = new google.maps.Map(mapCanvas, mapOptions);
	marker = new google.maps.Marker({
	    map: map,
	    draggable: false,
	    animation: google.maps.Animation.DROP,
	    position: {lat: Number(course_params.lat), lng: Number(course_params.lng)}
	});
	if (window.addtocalendar)if(typeof window.addtocalendar.start == "function")return;
    if (window.ifaddtocalendar == undefined) { 
    	window.ifaddtocalendar = 1;
        var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
        s.type = 'text/javascript';
        s.charset = 'UTF-8';
        s.async = true;
        s.src = ('https:' == window.location.protocol ? 'https' : 'http')+'://addtocalendar.com/atc/1.5/atc.min.js';
        var h = d[g]('body')[0];
        h.appendChild(s); 
    }
}
google.maps.event.addDomListener(window, 'load', initialize);
