/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 * 
 */

function saveData() {
    var options = {
        success: checkResponse  // post-submit callback 
    };
    $("#update-form").ajaxSubmit(options);
}
function checkResponse(responseText, statusText) {
    var resp = jQuery.parseJSON(responseText);
	console.log(resp);
    if (resp.msg.code == 0) {
        alert(resp.msg.text);
    }
    else {
        alert("Something went wrong.");
    }
    window.location.reload();

}


$(document).ready(function () {
    $(".edit-button").click(function () {
        var marker_id = $(this).attr("data-id");
        $("#inputMarkerTitle").val($("#marker-type-name-" + marker_id).text());
        $("#inputImageWidth").val($("#marker-image-width-" + marker_id).text());
        $("#inputImageHeght").val($("#marker-image-height-" + marker_id).text());
        $("#marker_id").val(marker_id);
        $("#marker_it_title").text(marker_id);
        var image = $("#marker-image-" + marker_id).attr('src');
        $("#inputMarkerIcon").html('<img src="' + image + '">');
        $("#action").val('update-marker-type');
        $('#myModal').modal('show');
//        alert("You can't use this button in Demo mode.");
        return false;
    });

    $("#btnAdd").click(function() {
        var marker_id = 0;
        $("#inputMarkerTitle").val('');
        $("#inputImageWidth").val('');
        $("#inputImageHeght").val('');
        $("#marker_id").val(marker_id);
        $("#marker_it_title").text('New');
        $("#inputMarkerIcon").html('');
        $("#action").val('add-marker-type');
        $('#myModal').modal('show');
//        alert("You can't use this button in Demo mode.");
        return false;
    });

});