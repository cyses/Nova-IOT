<?php
/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 *
 */
include_once("includes/config.php");
include_once(APP_PATH . "/includes/connect.php");
include_once(APP_PATH . "/includes/classes/Marker_type.class.php");
include_once(APP_PATH . "/exec.php");
include_once(APP_PATH . "/includes/classes/pagination/pagination.class.php");
$marker_type = new Marker_type($dbh);
$marker_type_data = $marker_type->get();
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
    </script>
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
                <ul class="nav navbar-nav navbar-right">
                    <?php include_once("blocks/user_menu.php");?>
                </ul>
            </div>

        </div>
    </nav>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Marker #<span id="marker_it_title"></span></h4>
                </div>
                <form class="form-horizontal" method="post" enctype="multipart/form-data" id="update-form" action="<?php echo HTTP_APP_PATH ?>exec.php">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="inputMarkerTitle" class="col-sm-3 control-label">Type Name *</label>
                            <div class="col-sm-8">
                                <input name="marker_type_name" required="" value="" type="text" class="form-control" id="inputMarkerTitle">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputMarkerIcon" class="col-sm-3 control-label">Icon (<a href="http://mapicons.nicolasmollet.com/" target="_blank">Download</a>)</label>
                            <div class="col-sm-8">
                                <span id="inputMarkerIcon" style="float: left"></span>
                                <input type="file" name="marker_icon">
                                <input name="image_width" value="" type="hidden" class="form-control" id="inputImageWidth">
                                <input name="image_height" value="" type="hidden" class="form-control" id="inputImageHeght">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type='hidden' name='action' id='action' value='update-marker-type'>
                        <input type='hidden' name='marker_id' id='marker_id' value=''>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" onclick='saveData();' class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid">
    <?php if (isset($_GET["msg"]) && $_GET['msg'] == "marker_deleted"): ?>
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            Marker Type deleted successfully.
        </div>
    <?php endif; ?>
    <br>
    <div class="clearfix"></div>
    <?php if ($marker_type_data): ?>
        <table class="table" id="table">
            <thead>
            <tr>
                <th width="50">#</th>
                <th width="100">Icon</th>
                <th width="150">Type Name</th>
                <th>Icon Width</th>
                <th>Icon Height</th>
                <th width="120">Action</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($marker_type_data as $data): ?>
                <tr>
                    <td id="marker-id-<?php echo $data["id"] ?>"><?php echo $data["id"] ?></td>
                    <td>
                        <img id="marker-image-<?php echo $data["id"] ?>" src="<?php echo $marker_type->get_image($data['id'], $data['image_type']) ?>" alt="<?php echo $data["type_name"] ?>" title="<?php echo $data["type_name"] ?>">
                    </td>
                    <td id="marker-type-name-<?php echo $data["id"] ?>"><?php echo $data["type_name"] ?></td>
                    <td id="marker-image-width-<?php echo $data["id"] ?>"><?php echo $data["image_width"] ?></td>
                    <td id="marker-image-height-<?php echo $data["id"] ?>"><?php echo $data["image_height"] ?></td>
                    <td>
                        <!--a onclick="alert('You can\'t use this button in Demo mode.');" href="#" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a-->
                        <a onclick="return confirm('Are you sure? All markers related to this type will be deleted.');" href="<?php echo HTTP_APP_PATH ?>/exec.php?action=delete-marker-type&id=<?php echo $data["id"] ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
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
    <input type="button" name="btnAdd" id="btnAdd" value="Add New Type" class="btn btn-primary">
</div>
<?php include_once("blocks/scripts.php")?>
<script src="<?php echo HTTP_APP_PATH ?>/static/js/update-marker-type-normal.js" type="text/javascript"></script>
<?php include_once(APP_PATH . "/blocks/footer.php"); ?>
</body>
</html>