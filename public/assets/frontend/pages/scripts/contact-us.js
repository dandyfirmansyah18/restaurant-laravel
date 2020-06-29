var ContactUs = function () {

    return {
        //main function to initiate the module
        init: function () {
			var map;
			$(document).ready(function(){
			  map = new GMaps({
				div: '#map',
	            lat: -6.149921,
				lng: 106.887844,
			  });
			   var marker = map.addMarker({
		            lat: -6.149921,
					lng: 106.887844,
		            title: 'PT. EDI Indonesia',
		            infoWindow: {
		                content: "<b>PT. EDI Indonesia</b><br>\
		                Wisma SMR Lt. 1, 3 & 10<br>\
		                Jl. Yos Sudarso, Kav. 89<br>\
		                Sunter - Jakarta Utara 14350"
		            }
		        });

			   marker.infoWindow.open(map, marker);
			});
        }
    };

}();