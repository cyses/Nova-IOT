/**
 * @package Google Map server side Markers clustering v2.2
 *
 * @author Igor Karpov <mail@noxls.net>
 * 
 */

function saveData() {
    var options = {
        success: checkResponse  // post-submit callback 
    };
    CKupdate();
    $("#update-form").ajaxSubmit(options);
}
function checkResponse(responseText, statusText) {
    var resp = jQuery.parseJSON(responseText);

    if (resp.msg.code == 0) {
        $.get(HTTP_APP_PATH + "/exec.php?action=generate-cache&no_redirect=1");
        alert(resp.msg.text);
    }
    else {
        alert("Something went wrong.");
    }
    window.location.reload();
}
function deleteImage(id) {
        $.get(HTTP_APP_PATH + "/exec.php", { action: "delete-marker-image", id: id } );
        $("#inputMarkerImage").html('');
}
function CKupdate(){
    for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();
}

$(document).ready(function () {
    var map;
    var marker_id;
    $(".edit-button").click(function () {
        marker_id = $(this).attr("data-id");
        var params = {
                        "action": "get-marker",
                        "id": marker_id
        }
        $.getJSON(HTTP_APP_PATH +  "/exec.php",
            params,
            function (data) {
                $("#inputMarkerTitle").val(data.title);

                var marker_type = $("#marker-type-" + marker_id).attr("data-marker-type-" + marker_id);
                var dropdown_marker_type = "<select name='marker_type' id='marker_type'>";
                for (i in MAP_SETTINGS.pinImage) {
                    dropdown_marker_type += "<option " + ((i == data.marker_type) ? "selected" : "") + " value='" + i + "'>" + MAP_SETTINGS.pinImage[i].type_name + "</option>";
                }
                dropdown_marker_type += "</select>";
                $("#inputMarkerType").html(dropdown_marker_type);
                $("#inputMarkerDescription").val(data.description);
                $("#inputMarkerLatitude").val(data.lat);
                $("#inputMarkerLongitude").val(data.lng);
                $("#marker_id").val(data.id);

                if(data.disabled == "1") {
                    $("#disable").prop('checked', true);
                }
                var editor = CKEDITOR.instances.inputMarkerDescription;
                if (editor) {
                    editor.destroy(true);
                }
                CKEDITOR.replace( 'inputMarkerDescription' );
                $('#myModal').modal('show');
            }
        );
        return false;
    });
    var map;
    var marker;
    google.maps.event.addDomListener(window, 'load', initialize);
    google.maps.event.addDomListener(window, "resize", resizingMap());
    function initialize() {
        var mapProp = {
            zoom: 17,
            draggable: true,
            scrollwheel: false,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        map=new google.maps.Map(document.getElementById("map-canvas"),mapProp);
    };
    function resizeMap() {
        if(typeof map =="undefined") return;
        setTimeout( function(){resizingMap();} , 400);
    }
    function resizingMap() {
        if(typeof map =="undefined") return;

        var center = new google.maps.LatLng($("#inputMarkerLatitude").val(), $("#inputMarkerLongitude").val());
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
        if(marker) {
            marker.setPosition(center);
        }
        else {
            marker = new google.maps.Marker({
                position:center,
                draggable: true,
                map: map
            });
        }
        google.maps.event.addListener(marker, "dragend", function() {
            var latlng = marker.getPosition();
            $("#inputMarkerLatitude").val(latlng.lat());
            $("#inputMarkerLongitude").val(latlng.lng());
        });
    }
    $('#myModal').on('show.bs.modal', function() {
        resizeMap();
    })
});