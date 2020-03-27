/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 *
 */

var map, marker, gmarkers = [];
function CKupdate(){
    for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();
}
function validateForm(formData, jqForm, options) {
    var form = jqForm[0];
    var err_msg = "";

    if(typeof marker.getPosition() == 'undefined') {
        err_msg += "Please, place marker on the map.\n\n";
    }
    if (!form.title.value) {
        err_msg += "Title is requared.\n\n";
    }
    if (err_msg != '') {
        alert(err_msg);
        return false;
    }
    $("#upload-form").hide();
    $("#upload-message").show();
    return true;
}

function checkResponse(responseText, statusText) {
    var resp = jQuery.parseJSON(responseText);
	console.log(resp);

    if (resp.msg.code == 0) {
        $.get(HTTP_APP_PATH + "/exec.php?action=generate-cache&no_redirect=1");
        alert(resp.msg.text);
    }
    else {
        alert("Something went wrong");
    }
    window.location.replace(resp.msg.post_url);

}

function saveData() {
    var options = {
        beforeSubmit: validateForm, // pre-submit callback
        success: checkResponse  // post-submit callback
    };
    if(marker.getPosition()) {
        var latlng = marker.getPosition();
        $("#lat").val(latlng.lat());
        $("#lng").val(latlng.lng());
    }
    CKupdate();
    $("#add-form").ajaxSubmit(options);
}

function movemarker() {

    var latlng = new google.maps.LatLng($("#lat").val(), $("#lng").val());
    marker.setPosition(latlng);
    map.setCenter(latlng);

}

$('document').ready(function() {
    CKEDITOR.replace( 'description' );
    var myLatlng = new google.maps.LatLng(MAP_CENTER_LAT, MAP_CENTER_LNG);
    var myOptions = {
        zoom: ZOOM,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    var stylesArray = MAP_STYLE;
    var styledMap = new google.maps.StyledMapType(stylesArray, {name: ""});
    map.mapTypes.set('map_style', styledMap);
    map.setMapTypeId('map_style');
    var input = document.getElementById('searchTextField');
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    autocomplete.setTypes(['geocode']);
    marker = new google.maps.Marker({
        map: map,
        draggable: true,
    });

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
        }

        marker.setPosition(place.geometry.location);

        var address = '';
        if (place.address_components) {
            address = [(place.address_components[0] &&
                        place.address_components[0].short_name || ''),
                (place.address_components[1] &&
                        place.address_components[1].short_name || ''),
                (place.address_components[2] &&
                        place.address_components[2].short_name || '')
            ].join(' ');
        }
    });

    google.maps.event.addListener(map, "click", function(event) {
        if (marker) {
            marker.setPosition(event.latLng);
        }
        else {
            marker = new google.maps.Marker({
                position: event.latLng,
                draggable: true,
                map: map
            });
        }
        google.maps.event.addListener(marker, "dragend", function() {
            var latlng = marker.getPosition();
            $("#lat").val(latlng.lat());
            $("#lng").val(latlng.lng());
        });
    });
});