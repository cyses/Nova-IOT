/**
 * Created by igor on 14.12.15.
 *//**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 *
 */
var iframe_content;
function calc_iframe_code() {
    iframe_content = '<iframe frameborder="0" src="' +  HTTP_APP_PATH + '?iframe" width="' + $("#input_frame_width").val() + '" height="' + $("#input_frame_height").val() + '"><\/iframe>';
    $("textarea#iframe_insert_code").val(iframe_content);
}
$(function () {
    $('[data-toggle="popover"]').popover({"trigger": "focus"});
    $('[data-toggle="popover-info"]').popover({"trigger": "hover"});
})
$(document).ready(function () {
    calc_iframe_code();

    $(".input_frame").change(function() {
        calc_iframe_code();
    });
    $(".input_frame").keyup(function() {
        calc_iframe_code();
    });

    if ($("#input_enable_cache").is(":checked")) {
        $(".l1_l2_cache").show();
    }
    else {
        $(".l1_l2_cache").hide();
    }
    if ($("#input_autodetect_map_center").is(":checked")) {
        $(".ipstackkey").show();
    }
    else {
        $(".ipstackkey").hide();
    }
    $("#input_autodetect_map_center").click(function () {
        $(".ipstackkey").toggle('slow');
    });

    $("#input_enable_cache").click(function () {
        $(".l1_l2_cache").toggle('slow');
    });
    $("#input_show_makers_search").click(function () {
        $("#togle_search_results_per_page").toggle('slow');
    });

    if($("#input_show_makers_search").is(":checked")) {
        $("#togle_search_results_per_page").show();
    }
    else {
        $("#togle_search_results_per_page").hide();
    }
    $(".toggle-navigation").click(function() {
        if($("#input_show_makers_filter").is(":checked") || $("#input_show_makers_search").is(":checked")) {
            $("#filter-placement").show('slow');
        }
        else {
            $("#filter-placement").hide('slow');
        }
    });
    if($("#input_show_makers_filter").is(":checked") || $("#input_show_makers_search").is(":checked")) {
        $("#filter-placement").show();
    }
    else {
        $("#filter-placement").hide();
    }
});
