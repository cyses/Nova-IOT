<?php
/**
 * Project: dev.
 * User: Igor Karpov
 * Email: mail@noxls.net
 * Date: 05.11.16
 * Time: 8:11
 */
?>
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
    <title><?php echo $lang["menu_import"]; ?> | <?php echo $lang["site_title"]; ?></title>
    <meta charset="utf-8">
    <script lang="javascript">
        var SITE_DOMAIN = '<?php echo SITE_DOMAIN?>';
        var HTTP_APP_PATH = '<?php echo HTTP_APP_PATH?>';
        var MAP_SETTINGS = <?php echo json_encode($config_marker_types) ?>;
    </script>
</head>
<body>

<nav class="navbar navbar-inverse navbar-static-top mb0">
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
    <div class="page-header">
        <h1><?php echo $lang["Import"];?></h1>
    </div>
    <?php if (isset($_GET["msg"]) && $_GET['msg'] == "marker_deleted"): ?>
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            Marker Type deleted successfully.
        </div>
    <?php endif; ?>
    <?php if(!isset($current_step)):?>
        <form action="<?php echo HTTP_APP_PATH ?>import.php" class="form-inline" enctype="multipart/form-data" method="post">
            <div class="form-group">
                <label for="import_file"><?php echo $lang["Upload_XLS_or_CSV_file"];?></label>
                <input type="file" class="form-control" name="import_file" id="import_file">
            </div>
            <input type="submit" name="upload_button" value="Next" class="btn btn-primary">
            <input type="hidden" name="action" value="import_step_2">
        </form>
    <?php  elseif($current_step == 2):?>
    <form action="<?php echo HTTP_APP_PATH ?>import.php" class="form-inline" method="post">
        <div class="form-group">
            <label for="sheet_number"><?php echo $lang["Choose_sheet_to_import"];?></label>
            <select class="form-control" id="sheet_number" name="sheet_number">
                <?php
                foreach($xls_sheet_names as $sheet_index => $xls_sheet_name):
                ?>
                <option value="<?php echo $sheet_index;?>"><?php echo $xls_sheet_name;?></option>
                <?php
                endforeach;
                ?>
            </select>
        </div>
        <input type="submit" name="upload_button" value="Next" class="btn btn-primary">
        <input type="hidden" name="action" value="import_step_3">
    </form>
    <?php elseif($current_step == 3):?>
    <form action="<?php echo HTTP_APP_PATH ?>import.php" class="form-horizontal" method="post">
        <div class="col-md-6">
            <p><?php echo $lang["Associate_columns"];?></p>
            <div class="form-group">
                <label for="marker_title" class="col-sm-3 control-label"><?php echo $lang['Describe_Location']; ?></label>
                <div class="col-sm-2">
                    <select class="form-control" id="marker_title" name="marker_title">
                        <?php echo $drop_down_columns; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="marker_description" class="col-sm-3 control-label"><?php echo $lang['Describe_Description']; ?></label>
                <div class="col-md-2">
                    <select class="form-control" id="marker_description" name="marker_description">
                        <?php echo $drop_down_columns; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="marker_type" class="col-sm-3 control-label"><?php echo $lang['Marker_Type']; ?></label>
                <div class="col-md-2">
                    <select class="form-control" id="marker_type" name="marker_type">
                        <?php echo $drop_down_columns; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="marker_latitude" class="col-sm-3 control-label"><?php echo $lang["Latitude"]; ?></label>
                <div class="col-md-2">
                    <select class="form-control" id="marker_latitude" name="marker_latitude">
                        <?php echo $drop_down_columns; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="marker_longitude" class="col-sm-3 control-label"><?php echo $lang["Longitude"]; ?></label>
                <div class="col-md-2">
                    <select class="form-control" id="marker_longitude" name="marker_longitude">
                        <?php echo $drop_down_columns; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="start_import_from" class="col-sm-4 control-label"><?php echo $lang["Start_from_row"];?></label>
                <div class="col-md-3">
                    <input type="number" class="form-control" name="start_import_from" id="start_import_from" value="1" max="<?php echo ($row_and_column_range['totalRows'] - 1); ?>" min="1">
                </div>
            </div>
            <div class="form-group">
                <label for="start_import_to" class="col-sm-4 control-label"><?php echo $lang["to"];?></label>
                <div class="col-md-3">
                    <input type="number" class="form-control" id="start_import_to" name="start_import_to" value="<?php echo $row_and_column_range['totalRows']?>" max="<?php echo $row_and_column_range['totalRows']?>" min="2">
                </div>
            </div>
            <div class="form-group">
                <div class="radio-inline">
                    <label>
                        <input type="radio" name="overwrite_all_data" value="1" checked> <?php echo $lang['Add_to_existing_data'];?>
                    </label>
                </div>
                <div class="radio-inline">
                    <label>
                        <input type="radio" name="overwrite_all_data" value="2"> <?php echo $lang['Overwrite_all_data'];?>
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-10 col-sm-2">
                <input type="submit" name="next_button" value="Next" class="btn btn-primary">
                <input type="hidden" name="action" value="import_step_4">
            </div>
        </div>
    </form>
    <?php elseif($current_step == 4):?>
        <p><?php echo $lang["Import_completed"]; ?></p>
    <?php endif;?>
</div>
<?php include_once("blocks/scripts.php")?>
<script src="<?php echo HTTP_APP_PATH ?>/static/js/update-marker-type-normal.js" type="text/javascript"></script>
<?php include_once(APP_PATH . "/blocks/footer.php"); ?>
</body>
</html>