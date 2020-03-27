/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 *
 */
/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 *
 */
var $ = jQuery.noConflict();
var total_pages = 0;
var search_text;
function list_markers(page, search_text) {
    var filter = [];
    $('.checkbox input:checked').each(function() {
        filter.push(this.value);
    });
    var params = {
        "page": page,
        "action": "list-markers",
        "search_text": search_text,
        "filter": filter,
    }
    $.getJSON(HTTP_APP_PATH + "/exec.php",
        params,
        function (data) {
            var items = [];
            if(data.count_num_rows > 0) {
                $.each(data.rows, function (key, val) {
                    items.push("" +
                    "<div style='display: table; width:100%;'><a style='display: table; width:100%;' href='#' class='list-group-item' onclick='nxIK.findMarker(" + val.lat + ", " + val.lng + "); " +
                    "return false;' id='" + key + "'>" +

                    "<div class='pull-right text-right col-md-9 col-xs-8' style='margin-bottom:5px;'>" +
                    "<h4>" + val.title + "</h4></div></a>" +
                    "</div>");
                });
                $("#markers-list").html(items.join(""));
                if (0 === data.count_num_rows) {
                    $("#markers-list").html('<li class="list-group-item">Data not found</li>');
                }
                total_pages = Math.ceil(data.count_num_rows / LIST_MARKERS_PER_PAGE);
                if (total_pages > 0) {
                    $("#pager-info").html("Page: " + (page + 1) + " of " + total_pages);
                }
                else {
                    $("#pager-info").html("Results not found.");
                }
            }
            else {
                $("#pager-info").html("Results not found.");
                $("#markers-list").html('');
            }
            var column_height = $("#list-column").height();
            if(column_height >= 1000) {
                $('#nxIK_map').css('height', column_height - 20);
                $('.checkbox').css('height', column_height - 140);
            }
        });

}
function checkboxClicked() {
    nxIK.mymap.events.getBounds(true);
    if($("#check_all").is(":checked") && ($('.checkbox input:checked').length != $('.checkbox input').length)) {
        $("#check_all").removeAttr('checked');
    }
    if(!$("#check_all").is(":checked") && ($('.checkbox input:checked').length == $('.checkbox input').length)) {
        //$("#check_all").attr('checked', 'checked');
        $("#check_all").prop('checked', 'checked');
    }
    list_markers(0, $("#search").val());
}
$(document).ready(function () {
    var current_page = 0;
    list_markers(current_page, "");
    $("#list-markers-next").click(function () {
        if (total_pages > (current_page + 1)) {
            current_page++;
            list_markers(current_page, $("#search").val());
        }
        return false;
    });
    $("#list-markers-prev").click(function () {
        if (current_page > 0) {
            current_page--;
            list_markers(current_page, $("#search").val());
        }
        return false;
    });
    $("#search").keyup(function () {
        if (this.value.length >= 3) {
            current_page = 0;
            list_markers(current_page, $("#search").val());
        }
    });
    $("#clear-search-btn").click(function () {
        $("#search").val('');
        list_markers(current_page, "");
    });
    $(window).bind('resize load', function() {
        if ($(this).width() < 1000) {
            if($("#list-column").length > 0) {
                $('#nxIK_map').css('height', $("#list-column").height() - 500);
            }
            $('.collapse').removeClass('in');
            $('.collapse').addClass('out');
        } else {
            $('.collapse').removeClass('out');
            $('.collapse').addClass('in');
        }
    });
    var sidebar = $('#sidebar').sidebar();
});

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};