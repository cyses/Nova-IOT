<?php
/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 *
 */

include_once("includes/config.php");
include_once(APP_PATH . "/includes/connect.php");
include_once(APP_PATH . "/exec.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $lang["menu_add_marker"]; ?> | <?php echo $lang["site_title"]; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <script lang="javascript">
        var SITE_DOMAIN = '<?php echo SITE_DOMAIN?>';
        var HTTP_APP_PATH = '<?php echo HTTP_APP_PATH?>';
        var ZOOM = <?php echo $map_settings['config_zoom'] ?>;
        var MAP_CENTER_LAT = <?php echo $map_settings['config_map_center_latitude'] ?>;
        var MAP_CENTER_LNG = <?php echo $map_settings['config_map_center_longitude'] ?>;
        var MAP_SETTINGS = <?php echo json_encode($config_marker_types)?>;
        var MAP_STYLE = <?php echo strlen($map_settings['config_map_style'])?$map_settings['config_map_style']:"''";?>;
        var lang = [];
        lang["Describe_Location"] = "<?php echo $lang['Describe_Location']?>";
        lang["Describe_Description"] = "<?php echo $lang['Describe_Description']?>";
        lang["Marker_Type"] = "<?php echo $lang['Marker_Type']?>";
        lang["Latitude"] = "<?php echo $lang['Latitude']?>";
        lang["Longitude"] = "<?php echo $lang['Longitude']?>";
        lang["Move_Marker"] = "<?php echo $lang['Move_Marker']?>";
        lang["Save"] = "<?php echo $lang['Save']?>";
        lang["Saving_data"] = "<?php echo $lang["Saving_data"]?>";
        lang["Upload_Image"] = "<?php echo $lang["Image"]?>";
    </script>
    <link rel="shortcut icon" href="<?php echo HTTP_APP_PATH; ?>/static/img/favicon.ico" type="image/x-icon">
    <title><?php echo $lang["menu_add_marker"]; ?> - <?php echo $lang["site_title"]; ?></title>
    <?php include_once("blocks/scripts.php") ?>
    <link type="text/css" rel="stylesheet" href="<?php echo HTTP_APP_PATH ?>/static/plugins/select2/css/select2.min.css"/>
<style>
    html, body, .container-fluid { height: 100% }
</style>
</head>
<body>


<nav class="navbar navbar-inverse navbar-static-top mb0" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo HTTP_APP_PATH ?>">
                <?php echo $lang["site_title"]; ?>
            </a>
        </div>
        <form class="navbar-form navbar-left" role="search">
            <input id="searchTextField" class="form-control" value="" type="text" style="width:300px">
        </form>
        <div class="navbar-offcanvas offcanvas">
            <ul class="nav navbar-nav">
                <?php include_once("blocks/website_menu.php"); ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php include_once("blocks/user_menu.php"); ?>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>
<div class="container-fluid">
    <div class="row" style="height: 95%">
        <?php if(sizeof($config_marker_types['pinImage'])):?>
        <div class="col-md-8" id="primary" style='min-height: 100%; height: 100%; padding-left: 0px; padding-right: 0px;'>
            <div id="map_canvas" style="width: 100%; height: 100%; min-height: 100%;"></div>
            <div id="message"></div>
            <!-- #content -->
        </div>
        <!-- #primary -->
        <div class="col-md-4" id="list-column">
            <div class="panel-group">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <?php echo $lang["menu_add_marker"]; ?>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-success hidden" role="alert" id="upload-message"></div>
                        <form class="form-horizontal" enctype="multipart/form-data" method="post" id="add-form"
                              action="<?php echo HTTP_APP_PATH; ?>/exec.php">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="title" class="col-sm-3 control-label"><?php echo $lang["Describe_Location"];?>*</label>

                                    <div class="col-sm-8"><input aria-required="" name="title" required="" value=""
                                                                 type="text" class="form-control" id="title"
                                                                 maxlength="255"></div>
                                </div>
                                <div class="form-group">
                                    <label for="title" class="col-sm-3 control-label"><?php echo $lang["Describe_Description"];?></label>

                                    <div class="col-sm-8"><textarea name="description" class="form-control"
                                                                    id="description"/></textarea></div>
                                </div>
                                <div class="form-group">
                                    <label for="title" class="col-sm-3 control-label"><?php echo $lang["Upload_Image"];?></label>

                                    <div class="col-sm-8"><input type="file" name="marker_image"></div>
                                </div>
                                <div class="form-group">
                                    <label for="marker_type" class="col-sm-3 control-label"><?php echo $lang["Marker_Type"];?>*</label>
                                    <div class="col-sm-8">
                                        <select class='form-control' name='marker_type' id='marker_type'>
                                        <?php foreach($config_marker_types['pinImage'] as $marker_type_id => $marker_type_pinimage):?>
                                            <option value='<?php echo $marker_type_id;?>'><?php echo $marker_type_pinimage['type_name'];?></option>
                                        <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lat" class="col-sm-3 control-label"><?php echo $lang["Latitude"];?></label>

                                    <div class="col-sm-8"><input name="lat" required="" value="" type="text"
                                                                 class="form-control" id="lat"></div>
                                </div>
                                <div class="form-group">
                                    <label for="lng" class="col-sm-3 control-label"><?php echo $lang["Longitude"];?></label>

                                    <div class="col-sm-8"><input name="lng" required="" value="" type="text"
                                                                 class="form-control" id="lng"></div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-8">
                                        <input type="button" value="<?php echo $lang["Move_Marker"];?>" class="btn btn-default"
                                               onclick="movemarker();" id="moveMarker"/>
                                        <button type="reset" value="Reset" class="btn btn-danger">Reset</button>
                                        <input type="hidden" name="action" id="action" value="add-marker">
                                        <input type="button" class="btn btn-primary pull-right" value="<?php echo $lang["Save"];?>"
                                               onclick="saveData();" id="saveBtn"/>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <?php else:?>
        <h3>You don't have Maker type. Please <a href="<?php echo HTTP_APP_PATH; ?>/marker_type.php">add Marker Type.</a></h3>
        <?php endif;?>
    <!--/div-->
    <script type="text/javascript"
            src="//maps.google.com/maps/api/js?key=<?php echo $map_settings['config_api_key']; ?>&libraries=places&language=<?php echo $map_settings['config_map_language']; ?>"></script>
    <script src="<?php echo HTTP_APP_PATH ?>/static/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script src="<?php echo HTTP_APP_PATH ?>/static/plugins/select2/js/select2.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo HTTP_APP_PATH ?>/static/js/add-marker-normal.js"></script>
    <?php include_once(APP_PATH . "/blocks/footer.php"); ?>
</body>
</html>
