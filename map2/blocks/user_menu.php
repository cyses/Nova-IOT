<?php
/**
 * Project: dev.
 * User: Igor Karpov
 * Email: mail@noxls.net
 * Date: 23.07.16
 * Time: 15:58
 */
?>

<ul class="nav navbar-nav navbar-right">
<?php if(Auth::is_loggedin()):?>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> Admin <span class="caret"></span></a>
        <ul class="dropdown-menu">

            <li><a href="<?php echo HTTP_APP_PATH ?>manage.php"><i class="glyphicon glyphicon-map-marker"></i> <?php echo $lang["menu_manage_marker"]; ?></a></li>

            <li><a href="<?php echo HTTP_APP_PATH ?>marker_type.php"><i class="glyphicon glyphicon-list-alt"></i> <?php echo $lang["menu_marker_type"]; ?></a></li>
            <li><a href="<?php echo HTTP_APP_PATH ?>import.php"><i class="glyphicon glyphicon-import"></i> <?php echo $lang["menu_import"]?></a></li>

            <li><a href="<?php echo HTTP_APP_PATH ?>settings.php"><i class="glyphicon glyphicon-cog"></i> <?php echo $lang["menu_settings"]?></a></li>

            <li role="separator" class="divider"></li>
            <li><a href="<?php echo HTTP_APP_PATH ?>exec.php?action=logout"><i class="glyphicon glyphicon-log-out"></i> <?php echo $lang['logout'];?></a></li>
        </ul>
    </li>
<?php else: ?>
    <li <?php if(basename($_SERVER["SCRIPT_FILENAME"]) == "login.php"): echo "class=active"; endif;?>>
        <a href="<?php echo HTTP_APP_PATH ?>login.php"><?php echo $lang["login"];?></a></li>
<?php endif; ?>
</ul>

