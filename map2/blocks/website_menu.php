<?php
/**
 * Project: dev.
 * User: Igor Karpov
 * Email: mail@noxls.net
 * Date: 31.07.16
 * Time: 17:33
 */
?>

<li <?php if(basename($_SERVER["SCRIPT_FILENAME"]) == "add.php"): echo "class=active"; endif;?>><a href="<?php echo HTTP_APP_PATH ?>add.php"><?php echo $lang["menu_add_marker"]; ?></a></li>
<?php
if(isset($menu_pages) && is_array($menu_pages)):
    foreach($menu_pages as $menu_page):
        ?>
        <li <?php if($menu_page["id"] == $page_id): echo "class=active"; endif;?> ><a href="<?php echo HTTP_APP_PATH ?>page.php?page_id=<?php echo $menu_page["id"];?>"><?php echo $menu_page["title_menu"]; ?></a></li>
    <?php
    endforeach;
endif;
?>