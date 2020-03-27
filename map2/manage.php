<?php
/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 * 
 */
include_once("includes/config.php");
include_once(APP_PATH . "/includes/connect.php");
include_once(APP_PATH . "/exec.php");
include_once(APP_PATH . "/includes/classes/pagination/pagination.class.php");


$sql_where = "";
$pagination = (new Pagination());

$current_page = (isset($_GET['page']) && $_GET['page'] > 0) ? (int) $_GET["page"] : 1;

$input_search_text = $search_text = isset($_GET['search_text']) ? trim($_GET['search_text']) : '';

//record per Page($per_page)
$markers_per_page = isset($_GET['markers_per_page']) && in_array((int) $_GET['markers_per_page'], $config_markers_per_page) ? $_GET['markers_per_page'] : $config_markers_per_page[0];

$offset = $markers_per_page * ($current_page - 1);
$markers_data = $marker->get_markers($markers_per_page, $offset, $search_text);

$pagination->setCurrent($current_page);
$pagination->setTotal($markers_data['count_num_rows']);
$pagination->setRPP($markers_per_page);
$pagination_html = $pagination->parse();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Manage markers for Google Maps API v3</title>
        <meta charset="utf-8">
        <script lang="javascript">
            var SITE_DOMAIN = '<?php echo SITE_DOMAIN?>';
            var HTTP_APP_PATH = '<?php echo HTTP_APP_PATH?>';
            var MAP_SETTINGS = <?php echo json_encode($config_marker_types) ?>;
            var ZOOM = <?php echo $map_settings['config_zoom'] ?>;
            var MAP_CENTER_LAT = <?php echo $map_settings['config_map_center_latitude'] ?>;
            var MAP_CENTER_LNG = <?php echo $map_settings['config_map_center_longitude'] ?>;
            var MAP_API_KEY = '<?php echo $map_settings['config_api_key']; ?>';
        </script>
        <?php include_once("blocks/scripts.php")?>
    </head>
    <body>

    <nav class="navbar navbar-inverse navbar-static-top mb0" role="navigation">
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
                <form class="navbar-form navbar-left" role="search" action="<?php echo HTTP_APP_PATH ?>manage.php">
                    <div class="form-group">
                        <input type="search" class="form-control" id="search" name="search_text" value="<?php echo $input_search_text ?>" placeholder="Search text">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                    <a href="<?php echo HTTP_APP_PATH ?>manage.php" class="btn btn-default">Reset</a>
                    <select class="form-control" name="markers_per_page" id="markers_per_page" onchange="this.form.submit();">
                        <?php foreach ($config_markers_per_page as $per_page): ?>
                            <option value="<?php echo $per_page; ?>" <?php echo ($per_page == $markers_per_page) ? ' selected="selected" ' : ''; ?>><?php echo $per_page; ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <?php include_once("blocks/user_menu.php");?>
                </ul>
            </div>

        </div>
    </nav>
            <!-- Modal -->
    <div class="container-fluid">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Marker #<span id="marker_it_title"></span></h4>
                        </div>
                        <form class="form-horizontal" method="post" id="update-form" enctype="multipart/form-data" action="<?php echo HTTP_APP_PATH ?>exec.php">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="inputMarkerTitle" class="col-sm-3 control-label">Title *</label>
                                    <div class="col-sm-8">
                                        <input name="title" required="" value="" type="text" class="form-control" id="inputMarkerTitle">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMarkerTitle" class="col-sm-3 control-label">Type</label>
                                    <div class="col-sm-8" id="inputMarkerType">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMarkerDescription" class="col-sm-3 control-label">Description</label>
                                    <div class="col-sm-8">
                                        <textarea name="description" id='inputMarkerDescription' class="form-control" rows="8"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMarkerImage" class="col-sm-3 control-label">Image</label>
                                    <div class="col-sm-8">
                                        <span id="inputMarkerImage" style="float: left"></span>
                                        <input type="file" name="marker_image">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMarkerLatitude" class="col-sm-3 control-label">Latitude *</label>
                                    <div class="col-sm-4">
                                        <input name="lat" required="" value="" type="text" class="form-control" id="inputMarkerLatitude">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMarkerLongitude" class="col-sm-3 control-label">Longitude *</label>
                                    <div class="col-sm-4">
                                        <input name="lng" required="" value="" type="text" class="form-control" id="inputMarkerLongitude">
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div id="map-canvas" class=""></div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <input type='hidden' name='action' id='action' value='update-marker'>
                                <input type='hidden' name='marker_id' id='marker_id' value=''>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" onclick='saveData();' class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php if (isset($_GET["msg"]) && $_GET['msg'] == "marker_deleted"): ?>
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    Marker deleted successfully.
                </div>
            <?php endif; ?>
            <div class="text-center">
                <?php echo $pagination_html ?>
            </div>

            <div class="clearfix"></div>
            <?php if ($markers_data['rows']): ?>
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th width="50">Type</th>
                        <th width="250">Title</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Image</th>
                        <th width="200">Date Add</th>
                        <th width="120">Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php foreach ($markers_data['rows'] as $data): ?>
                        <tr>
                            <td id="marker-id-<?php echo $data["id"] ?>"><?php echo $data["id"] ?></td>
                            <td id="marker-type-<?php echo $data["id"] ?>" data-marker-type-<?php echo $data["id"] ?>="<?php echo $data["marker_type"] ?>">
                                <?php if(isset($config_marker_types['pinImage']{$data["marker_type"]}['src'])):?>
                                    <img src="<?php echo $config_marker_types['pinImage']{$data["marker_type"]}['src'] ?>" alt="<?php echo $config_marker_types['pinImage']{$data["marker_type"]}['type_name'] ?>" title="<?php echo $config_marker_types['pinImage']{$data["marker_type"]}['type_name'] ?>">
                                <?php else:?>
                                    Undefined
                                <?php endif;?>
                            </td>
                            <td id="marker-title-<?php echo $data["id"] ?>"><?php echo $data["title"] ?></td>
                            <td id="marker-lat-<?php echo $data["id"] ?>"><?php echo $data["lat"] ?></td>
                            <td id="marker-lng-<?php echo $data["id"] ?>"><?php echo $data["lng"] ?></td>
                            <td>
                                <?php if(isset($data["image_type"]) && $data["image_type"] != ""):?>

                                <a id="marker-img-<?php echo $data["id"] ?>" href="<?php echo HTTP_IMG_PATH . ($data['id'] % 10) . '/' . $data['id'] . '.' . $data['image_type'];?>" target="_blank">
                                    <i class="far fa-image fa-2"></i>
                                </a>
                                <?php endif;?>
                            </td>

                            <td><?php
                                $data["date_add"] = new DateTime($data["date_add"]);
                                echo  $data["date_add"]->format("d M Y H:m:i"); ?></td>
                            <td>
                                <a onclick="return confirm('Are you sure?');" href="<?php echo HTTP_APP_PATH ?>exec.php?action=delete-marker&id=<?php echo $data["id"] ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                <button class="btn btn-success edit-button" data-id="<?php echo $data["id"] ?>"><i class="glyphicon glyphicon-pencil"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div>
            Results not found.
            </div>
            <?php endif; ?>
            <div class="clearfix"></div>
            <div class="text-center">
                <?php echo $pagination_html ?>
            </div>
            <?php if ($markers_data['rows']): ?>

            <a href="<?php echo HTTP_APP_PATH ?>/exec.php?action=download-csv" class="btn btn-default"><i class="glyphicon glyphicon-save-file"></i> Download CSV</a>
            <?php endif; ?>
        </div>
        <!--script type='text/javascript' src="//maps.googleapis.com/maps/api/js?sensor=false&extension=.js&output=embed"></script-->
        <script type="text/javascript"
                src="//maps.google.com/maps/api/js?key=<?php echo $map_settings['config_api_key']; ?>&libraries=places&language=<?php echo $map_settings['config_map_language']; ?>"></script>
        <script src="<?php echo HTTP_APP_PATH ?>/static/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="<?php echo HTTP_APP_PATH ?>/static/js/update-marker-normal.js" type="text/javascript"></script>
        <?php include_once(APP_PATH . "/blocks/footer.php"); ?>
    </body>
</html>