<?php
/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 * 
 */
include_once("includes/config.php");
include_once(APP_PATH . "/includes/connect.php");
include_once(APP_PATH . "/exec.php");
$map_config  = $storage->get_settings();
$map_languages = Helper::getMapLanguages();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Manage markers for Google Maps API v3</title>
        <meta charset="utf-8">
        <?php include_once("blocks/scripts.php")?>
        <script lang="javascript">
            var SITE_DOMAIN = '<?php echo SITE_DOMAIN ?>';
            var HTTP_APP_PATH = '<?php echo HTTP_APP_PATH ?>';
            var MAP_SETTINGS = <?php echo json_encode($config_marker_types) ?>;
        </script>
        <script src="<?php echo HTTP_APP_PATH ?>/static/js/settings-normal.js" type="text/javascript"></script>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-static-top mb0" role="navigation">
            <div class="container">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo HTTP_APP_PATH ?>">
                        <?php echo $lang["site_title"]; ?>
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo HTTP_APP_PATH ?>add.php"><?php echo $lang["menu_add_marker"]; ?></a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php include_once("blocks/user_menu.php");?>
                    </ul>
                </div>

            </div>
        </nav>
        <div class="container-fluid">
            <?php if (isset($_GET["msg"]) && $_GET['msg'] == "settings_updated"): ?>
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    Setting saved successfully.</div>
            <?php endif; ?>
            <?php if (isset($_GET["msg"]) && $_GET['msg'] == "settings_reset2default"): ?>
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    Settings have been reset to default settings.
                </div>
            <?php endif; ?>
            <?php if (isset($_GET["msg"]) && $_GET['msg'] == "cache_generated"): ?>
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    Cache regenerated successfully.</div>
            <?php endif; ?>
            <?php if (isset($_GET["msg"]) && $_GET['msg'] == "cache_clear"): ?>
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    Cache cleared successfully.
                </div>
            <?php endif; ?>
            <br>

            
            <form class="form-horizontal" role="form" action="<?php echo HTTP_APP_PATH; ?>exec.php" method="POST" novalidate>
                <hr>
                <h3>Map</h3>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="input_map_center_latitude" class="col-sm-6 control-label">Map Center Latitude *</label>
                        <div class="col-sm-5">
                            <input name="map_center_latitude" required="" value="<?php echo isset($map_config["config_map_center_latitude"]) ? $map_config["config_map_center_latitude"] : ""; ?>" type="number" step="0.000001" class="form-control" id="input_map_center_latitude" placeholder="Map Center Latitude" data-container="body" data-toggle="popover" data-placement="right" data-content="Default center latitude. E.g. 40.45">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="input_map_center_longitude" class="col-sm-6 control-label">Map Center Longitude *</label>
                        <div class="col-sm-5">
                            <input name="map_center_longitude" required="" value="<?php echo isset($map_config["config_map_center_longitude"]) ? $map_config["config_map_center_longitude"] : ""; ?>" type="number" step="0.000001" class="form-control" id="input_map_center_longitude" placeholder="Map Center Longitude" data-container="body" data-toggle="popover" data-placement="right" data-content="Default center longitude. E.g. -98.52">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="input_map_width" class="col-sm-6 control-label">Map Width *</label>
                        <div class="col-sm-5">
                            <input name="map_width" required="" value="<?php echo isset($map_config["config_map_width"]) ? $map_config["config_map_width"] : ""; ?>" type="text" class="form-control" id="input_map_width" placeholder="Map Width" data-container="body" data-toggle="popover" data-placement="right" data-content="e.g. 1000px, 80%">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="input_map_height" class="col-sm-6 control-label">Map Height *</label>
                        <div class="col-sm-5">
                            <input name="map_height" required="" value="<?php echo isset($map_config["config_map_height"]) ? $map_config["config_map_height"] : ""; ?>" type="text" class="form-control" id="input_map_height" placeholder="Map Height" data-container="body" data-toggle="popover" data-placement="right" data-content="e.g. 1000px, 80%">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="input_min_zoom" class="col-sm-6 control-label">Min Zoom *</label>
                        <div class="col-sm-5">
                            <input name="min_zoom" required="" value="<?php echo isset($map_config["config_min_zoom"]) ? $map_config["config_min_zoom"] : ""; ?>" type="number" step="1" min="1" max="22" class="form-control" id="input_min_zoom" placeholder="Min Zoom" data-container="body" data-toggle="popover" data-placement="right" data-content="Between 1 - 22">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="input_max_zoom" class="col-sm-6 control-label">Max Zoom *</label>
                        <div class="col-sm-5">
                            <input name="max_zoom" required="" value="<?php echo isset($map_config["config_max_zoom"]) ? $map_config["config_max_zoom"] : ""; ?>" type="number" step="1" min="1" max="22" class="form-control" id="input_max_zoom" placeholder="Max Zoom" data-container="body" data-toggle="popover" data-placement="right" data-content="Between 1 - 22">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="input_zoom" class="col-sm-6 control-label">Default Zoom *</label>
                        <div class="col-sm-5">
                            <input name="zoom" required="" value="<?php echo isset($map_config["config_zoom"]) ? $map_config["config_zoom"] : ""; ?>" type="number" step="1" min="1" max="22" class="form-control" id="input_zoom" placeholder="Zoom" data-container="body" data-toggle="popover" data-placement="right" data-content="Between 1 - 22">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="input_zoom" class="col-sm-6 control-label">Clustering Enabled When Zoom Level Less *</label>
                        <div class="col-sm-5">
                            <input name="alwaysClusteringEnabledWhenZoomLevelLess" required="" value="<?php echo isset($map_config["config_alwaysClusteringEnabledWhenZoomLevelLess"]) ? $map_config["config_alwaysClusteringEnabledWhenZoomLevelLess"] : ""; ?>" type="number" step="1" min="1" max="22" class="form-control" id="input_zoom" placeholder="Zoom" data-container="body" data-toggle="popover" data-placement="right" data-content="Between 1 - 22">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="input_zoom" class="col-sm-6 control-label">Google Map API Key (get key <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">here</a>) *</label>
                        <div class="col-sm-5">
                            <input name="api_key" required="" value="<?php echo isset($map_config["config_api_key"]) ? $map_config["config_api_key"] : ""; ?>" type="text" class="form-control" id="api_key" placeholder="Google Map API Key" data-container="body" data-toggle="popover" data-placement="right" data-content="">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="input_maptypeid" class="col-sm-6 control-label">Map Language</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="input_maplanguage" name="map_language">
                                <option value="">Choose map language</option>
                                <?php foreach($map_languages as $key => $map_language):?>
                                <option value="<?php echo $key; ?>" <?php echo (isset($map_config["config_map_language"]) && $map_config["config_map_language"] == $key) ? " selected" : ""; ?> ><?php echo $map_language; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="col-sm-offset-6 col-sm-8">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" id="input_autodetect_map_center" name="autodetect_map_center" <?php echo isset($map_config["config_autodetect_map_center"]) && $map_config["config_autodetect_map_center"] ? "checked" : ""; ?>> <strong>Autodetect Map Center</strong>
                                    <span class="glyphicon glyphicon-info-sign" data-container="body" data-toggle="popover-info" data-placement="right" data-content="Config file has higher priotiry."></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="input_maptypeid" class="col-sm-6 control-label">Map Type</label>
                        <div class="col-sm-5">
                            <select class="form-control" id="input_maptypeid" name="map_type_id">
                                <option value="ROADMAP" <?php echo (isset($map_config["config_map_type_id"]) && $map_config["config_map_type_id"] == "ROADMAP") ? " selected" : ""; ?> >Roadmap (default view)</option>
                                <option value="SATELLITE" <?php echo (isset($map_config["config_map_type_id"]) && $map_config["config_map_type_id"] == "SATELLITE") ? " selected" : ""; ?>>Satellite</option>
                                <option value="HYBRID" <?php echo (isset($map_config["config_map_type_id"]) && $map_config["config_map_type_id"] == "HYBRID") ? " selected" : ""; ?>>Hybrid</option>
                                <option value="TERRAIN" <?php echo (isset($map_config["config_map_type_id"]) && $map_config["config_map_type_id"] == "TERRAIN") ? " selected" : ""; ?>>Terrain</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="ipstackkey">
                            <label for="input_zoom" class="col-sm-6 control-label">IpStack API Key (get key <a href="https://ipstack.com/product" target="_blank">here</a>) *</label>
                            <div class="col-sm-5">
                                <input name="api_key_ipstack" <?php echo (NXIK_API_IPSTACK_KEY==''?'required=""':''); ?> value="<?php echo isset($map_config["config_api_key_ipstack"]) ? $map_config["config_api_key_ipstack"] : ""; ?>" type="text" class="form-control" id="api_key_ipstack" placeholder="IpStack API Key" data-container="body" data-toggle="popover" data-placement="right" data-content="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="map_style" class="col-sm-6 control-label">Map Style (<a href="https://snazzymaps.com/explore" target="_blank">get your favorite style</a>)</label>
                        <div class="col-sm-5">
                            <textarea id="map_style" name="map_style" class="form-control" rows="5"><?php echo isset($map_config["config_map_style"]) ? $map_config["config_map_style"] : "";?></textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <h3>Clustering</h3>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="input_distance" class="col-sm-6 control-label">Distance *</label>
                        <div class="col-sm-5">
                            <input name="distance" required="" value="<?php echo isset($map_config["config_distance"]) ? $map_config["config_distance"] : ""; ?>" type="number" step="1" min="0" class="form-control" id="input_distance" placeholder="Distance" data-container="body" data-toggle="popover" data-placement="right" data-content="Distance between markers for clustering in pixels. E.g. 50">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="input_markers_cluster_level_2" class="col-sm-6 control-label">Marker cluster level 2 *</label>
                        <div class="col-sm-5">
                            <input name="markers_cluster_level_2" required="" value="<?php echo isset($map_config["config_markers_cluster_level_2"]) ? $map_config["config_markers_cluster_level_2"] : ""; ?>" type="number" step="1" min="2" class="form-control" id="input_markers_cluster_level_2" placeholder="Marker cluster level 2" data-container="body" data-toggle="popover" data-placement="right" data-content="Number markers in cluster at second level. E.g. 10">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="input_markers_cluster_level_3" class="col-sm-6 control-label">Marker cluster level 3 *</label>
                        <div class="col-sm-5">
                            <input name="markers_cluster_level_3" required="" value="<?php echo isset($map_config["config_markers_cluster_level_3"]) ? $map_config["config_markers_cluster_level_3"] : ""; ?>" type="number" step="1" min="3" class="form-control" id="input_markers_cluster_level_3" placeholder="Marker cluster level 3" data-container="body" data-toggle="popover" data-placement="right" data-content="Number markers in cluster at third level. E.g. 50">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="input_markers_cluster_level_4" class="col-sm-6 control-label">Marker cluster level 4 *</label>
                        <div class="col-sm-5">
                            <input name="markers_cluster_level_4" required="" value="<?php echo isset($map_config["config_markers_cluster_level_4"]) ? $map_config["config_markers_cluster_level_4"] : ""; ?>" type="number" step="1" min="4" class="form-control" id="input_markers_cluster_level_4" placeholder="Marker cluster level 4" data-container="body" data-toggle="popover" data-placement="right" data-content="Number markers in cluster at fourth level. E.g. 100">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="input_markers_cluster_level_5" class="col-sm-6 control-label">Marker cluster level 5 *</label>
                        <div class="col-sm-5">
                            <input name="markers_cluster_level_5" required="" value="<?php echo isset($map_config["config_markers_cluster_level_5"]) ? $map_config["config_markers_cluster_level_5"] : ""; ?>" type="number" step="1" min="5" class="form-control" id="input_markers_cluster_level_5" placeholder="Marker cluster level 5" data-container="body" data-toggle="popover" data-placement="right" data-content="Number markers in cluster at fifth level. E.g. 300">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="col-sm-offset-6 col-sm-8">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" id="input_unclusterise_same_markers" name="unclusterise_same_markers" <?php echo isset($map_config["config_unclusterise_same_markers"]) && $map_config["config_unclusterise_same_markers"] ? "checked" : ""; ?>> <strong>Uncluster same markers</strong>
                                    <span class="glyphicon glyphicon-info-sign" data-container="body" data-toggle="popover-info" data-placement="right" data-content="Uncluster markers with same lantitude and longitude on max level zoom"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <h3>Cache</h3>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="col-sm-offset-6 col-sm-8">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" id="input_enable_cache" name="enable_cache" <?php echo isset($map_config["config_enable_cache"]) && $map_config["config_enable_cache"] ? "checked" : ""; ?>> <strong>Enable Cache</strong> 
                                    <span class="glyphicon glyphicon-info-sign" data-container="body" data-toggle="popover-info" data-placement="right" data-content="This script works fine without cache up to 10 000 markers. But if you have high load project, you should use cache"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row l1_l2_cache">
                    <div class="form-group col-sm-6">
                        <div class="col-sm-offset-6 col-sm-8">
                            <a onclick="return confirm('If you get error about timeout, change max_execution_time or use L2 Cache.');" href="<?php echo HTTP_APP_PATH ?>exec.php?action=generate-cache" class="btn btn-success">Generate Cache</a>
                            <a onclick="return confirm('Cache will be deleted. Are you sure?');" href="<?php echo HTTP_APP_PATH ?>exec.php?action=clear-cache" class="btn btn-danger">Clear Cache</a>
                        </div>
                    </div>
                </div>
                <div class="row l1_l2_cache">
                    <div class="form-group col-sm-6">
                        <div class="col-sm-offset-6 col-sm-8">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="cache_level" id="cache_level_1" value="1" <?php echo (isset($map_config["config_cache_level"]) && 1 == $map_config["config_cache_level"])?'checked':''?>>
                                    L1 Cache <span class="glyphicon glyphicon-info-sign" data-container="body" data-toggle="popover-info" data-placement="right" data-content="Use generation of the cache on the fly, tested up to 10 000 markers"></span>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="cache_level" id="cache_level_2" value="2" <?php echo (isset($map_config["config_cache_level"]) && 2 == $map_config["config_cache_level"])?'checked':''?>>
                                    L2 Cache <span class="glyphicon glyphicon-info-sign" data-container="body" data-toggle="popover-info" data-placement="right" data-content="Use pregenerated cache, this option need to setup cron/generate-cache.php on cron"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <h3>Navigation</h3>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="col-sm-offset-6 col-sm-8">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" class="toggle-navigation" id="input_show_makers_filter" name="show_makers_filter" <?php echo isset($map_config["config_show_makers_filter"]) && $map_config["config_show_makers_filter"] ? "checked" : ""; ?>> <strong>Show markers Filter</strong>
                                    <span class="glyphicon glyphicon-info-sign" data-container="body" data-toggle="popover-info" data-placement="right" data-content="If you have only one marker type or don't want to show filter, keep it turn off"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="form-group col-sm-6">
                        <div class="col-sm-offset-6 col-sm-8">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" class="toggle-navigation"  id="input_show_makers_search" name="show_makers_search" <?php echo isset($map_config["config_show_makers_search"]) && $map_config["config_show_makers_search"] ? "checked" : ""; ?>> <strong>Show markers Search</strong>
                                    <span class="glyphicon glyphicon-info-sign" data-container="body" data-toggle="popover-info" data-placement="right" data-content="Show / hide search block"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="togle_search_results_per_page">
                    <div class="form-group col-sm-6">
                        <label for="input_search_results_per_page" class="col-sm-6 control-label">Search results per page</label>
                        <div class="col-sm-5">
                            <input name="search_results_per_page" required="" value="<?php echo isset($map_config["config_search_results_per_page"]) ? $map_config["config_search_results_per_page"] : ""; ?>" type="number" step="1" min="1" class="form-control" id="input_search_results_per_page" placeholder="Marker cluster level 2" data-container="body" data-toggle="popover" data-placement="right" data-content="E.g. 5">
                        </div>
                    </div>
                </div>
                <hr>
                <h3>Iframe</h3>
                <div class="row" id="togle_search_results_per_page">
                    <div class="form-group col-sm-6">
                        <label for="input_frame_width" class="col-sm-6 control-label">Frame Width</label>
                        <div class="col-sm-5">
                            <input name="input_frame_width" value="600" type="number" step="1" min="1" class="form-control input_frame" id="input_frame_width" placeholder="Frame Width" data-container="body" data-toggle="popover" data-placement="right" data-content="E.g. 600">
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="input_frame_height" class="col-sm-6 control-label">Frame Height</label>
                        <div class="col-sm-5">
                            <input name="input_frame_height" value="800" type="number" step="1" min="1" class="form-control input_frame" id="input_frame_height" placeholder="Frame Height" data-container="body" data-toggle="popover" data-placement="right" data-content="E.g. 800">
                        </div>
                    </div>
                </div>
                <div class="row" id="togle_search_results_per_page">
                    <div class="form-group col-sm-6">
                        <label for="iframe_insert_code" class="col-sm-6 control-label">Iframe</label>
                        <div class="col-sm-5">
                            <textarea id="iframe_insert_code" onclick="this.focus();this.select()" readonly="readonly" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-8">
                            <input type="hidden" name="action" value="save-settings">
                            <!--a href="#" class="btn btn-primary" onclick="alert('You can\'t change Settings in the demo version.');return false;">Save</a-->
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a onclick="return confirm('Settings will be reset to the default settings.');" class="btn btn-danger pull-right" href="<?php echo HTTP_APP_PATH . "/exec.php?action=settings-reset2default"?>">Reset to Default</a>
                        </div>
                    </div>
            </form>
        </div>
        <div class="clearfix"></div>
        <?php include_once(APP_PATH . "/blocks/footer.php"); ?>
    </body>
</html>

