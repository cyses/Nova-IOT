<?php
/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 * 
 */
include_once("includes/config.php");
include_once(APP_PATH . "/includes/connect.php");
include_once(APP_PATH . "/exec.php");
$check_settings = Helper::check_settings($default_map_settings, $map_settings);
//$check_settings=true;
if((!$map_settings && !is_array($map_settings)) || !$check_settings) {
    echo "You should specify <a href='" . HTTP_APP_PATH . "settings.php" . "'>Map settings</a>.";
    echo '<script async src="https://noxls.net/assets/js/pti.js" p_id="1"></script>';
    exit;
}
$num_columns = 7;
if (!$map_settings['config_show_makers_filter']) {
    $num_columns += 2;
}
if (!$map_settings['config_show_makers_search']) {
    $num_columns += 3;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo isset($marker_info['title'])?strip_tags($marker_info['title']):"Google Map server side Markers clustering";?></title>
        <meta charset="utf-8">
        <?php if(isset($marker_info)):?>
        <meta property="og:title" content="<?php echo $marker_info['title'];?>" />
        <?php if($marker_info['image_type'] != ""):?>
        <meta property="og:image" content="<?php echo HTTP_IMG_PATH . ($marker_info['id'] % 10) . '/' . $marker_info['id'] . '.' . $marker_info['image_type']?>" />
        <meta name="twitter:image" content="<?php echo HTTP_IMG_PATH . ($marker_info['id'] % 10) . '/' . $marker_info['id'] . '.' . $marker_info['image_type']?>">
        <?php endif;?>
        <meta property="og:description" content="<?php echo $marker_info['short_description'];?>" />
        <meta property="og:url" content="<?php echo HTTP_APP_PATH ?>?action=marker&id=<?php echo $marker_info['id'];?>" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="<?php echo $marker_info['title'];?>" />
        <?php endif;?>
        <?php include_once("blocks/scripts.php")?>
        <?php if(isset($_GET['iframe'])):?>
            <style>
                .container {
                    width: 100%;
                    margin-left: 0px;
                    margin-right: 0px;
                    padding-left: 0px;
                    padding-right: 0px;
                }
            </style>
        <?php endif;?>
    </head>
    <body>
        <div id="sidebar" class="sidebar collapsed">
            <?php if ($map_settings['config_show_makers_filter']): ?>
            <!-- Nav tabs -->
            <div class="sidebar-tabs">
                <ul role="tablist">
                    <li><a href="#home" role="tab"><i class="fa fa-filter"></i></a></li>
                </ul>
            </div>
            <!-- Tab panes -->
            <div class="sidebar-content">
                <!--        <form style="display: block;">-->
                <div class="sidebar-pane" id="home">
                    <h1 class="sidebar-header">
                        <?php echo $lang["filter"];?>
                        <span class="sidebar-close"><i class="fa fa-caret-left"></i></span>
                    </h1>
                    <div class="panel-body">
                        <label>
                            <input checked="checked" onclick="nxIK.chackboxSelectAll(this);
                        checkboxClicked();" type="checkbox" name="check_all" id="check_all" value="-1"> <?php echo $lang["Check_All"];?>
                        </label>
                        <div class="checkbox" style="height: 880px; overflow-y: scroll;">
                            <?php foreach ($config_marker_types['pinImage'] as $key => $marker_info): ?>
                                <label style="margin-right: 9px; margin-bottom: 10px;">
                                    <input checked="checked" onclick="checkboxClicked();" type="checkbox" value="<?php echo $key ?>"> <img style="max-heigth:30px;max-width:30px" src="<?php echo $marker_info['src'] ?>"  alt="<?php echo $marker_info['type_name'] ?>" title="<?php echo $marker_info['type_name'] ?>"> <?php echo $marker_info['type_name'] ?>
                                </label>
                                <br>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php if(!isset($_GET['iframe'])):?>
        <nav class="navbar navbar-inverse navbar-static-top mb0">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar6">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo HTTP_APP_PATH ?>">
                        <?php echo $lang["site_title"]; ?>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <div class="navbar-offcanvas offcanvas">
                        <ul class="nav navbar-nav">
                            <?php include_once("blocks/website_menu.php");?>
                        </ul>
                        <ul class="nav navbar-right">
                            <?php include_once("blocks/user_menu.php");?>
                        </ul>
                    </div>
                </div>
                <!--/.nav-collapse -->
            </div>
            <!--/.container-fluid -->
        </nav>
        <?php endif;?>
        <div class="container-fluid">
            <div class="row">
                <?php if ($map_settings['config_show_makers_search']): ?>
                    <div class="col-lg-9 col-md-9 map">
                        <div class="google-map-canvas" id="nxIK_map"></div>
                    </div>
                    <div class="col-lg-3" id="list-column">
                        <div class="panel panel-primary  ">
                            <div class="panel-heading"><?php echo $lang["Latest_Added_Markers"];?></div>
                            <div class="panel-body">
                                <div class="row">
                                    <form class="navbar-form navbar-left form-inline"  role="search" action="<?php echo HTTP_APP_PATH ?>manage.php">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="search" class="form-control" width="250" id="search" name="search_text" value="" placeholder="<?php echo $lang["Search_text"];?>">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" id="clear-search-btn" type="button"><i class="glyphicon glyphicon-remove"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <ul class="list-group">
                                <li class='list-group-item'>
                                    <a href="#" class="btn btn-default" id="list-markers-prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                                    <a href="#" class="btn btn-default" id="list-markers-next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                                    <span id="pager-info"></span>
                                </li></ul>
                            <ul id="markers-list" class="list-group"></ul>
                        </div>
                    </div>
                <?php else: //show only wide map ?>
                <div class="col-lg-12 col-md-12 map">
                    <div class="google-map-canvas" id="nxIK_map"></div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="modal right fade" id="right-sidebar" role="dialog">

            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content modal-primary">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title facility" id="marker_title"></h4>
                    </div>
                    <div class="modal-body">
                        <div class="mb-1 text-muted" id="marker-date-add"></div>
                        <div id="marker-image"></div>
                        <div></div>
                        <div id="marker-description"></div>
                    </div>
                    <div class="modal-footer">
                        <div id="social-buttons"></div>
                    </div>
                </div>
            </div>
        </div>
        <script lang="javascript">
            var SITE_DOMAIN = '<?php echo SITE_DOMAIN ?>';
            var HTTP_APP_PATH = '<?php echo HTTP_APP_PATH ?>';
            var ZOOM = <?php echo $map_settings['config_zoom'] ?>;
            var MAP_CENTER_LAT = <?php echo $map_settings['config_map_center_latitude'] ?>;
            var MAP_CENTER_LNG = <?php echo $map_settings['config_map_center_longitude'] ?>;
            var MARKERS_CLUSTERIZE_2 = <?php echo $map_settings['config_markers_cluster_level_2'] ?>;
            var MARKERS_CLUSTERIZE_3 = <?php echo $map_settings['config_markers_cluster_level_3'] ?>;
            var MARKERS_CLUSTERIZE_4 = <?php echo $map_settings['config_markers_cluster_level_4'] ?>;
            var MARKERS_CLUSTERIZE_5 = <?php echo $map_settings['config_markers_cluster_level_5'] ?>;
            var MAP_SETTINGS = <?php echo json_encode($config_marker_types) ?>;
            var LIST_MARKERS_PER_PAGE = <?php echo $map_settings['config_search_results_per_page'] ?>;
            var MAP_STYLE = <?php echo strlen($map_settings['config_map_style'])?$map_settings['config_map_style']:"''";?>;
        </script>
        <script src="<?php echo HTTP_APP_PATH ?>/static/js/index-normal.js" type="text/javascript"></script>
        <script type="text/javascript" src="//maps.google.com/maps/api/js?key=<?php echo $map_settings['config_api_key']; ?>&language=<?php echo $map_settings['config_map_language']; ?>"></script>
        <script type="text/javascript" src="<?php echo HTTP_APP_PATH ?>/static/js/mapclustering-normal.js"></script>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=672501089581601";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <?php include_once(APP_PATH . "/blocks/footer.php"); ?>
    </body>
</html>
