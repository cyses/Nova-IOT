<?php
/**
 * @package Google Map server side Markers clustering v2.2
 * @author Igor Karpov <mail@noxls.net>
 *
 */
include_once("includes/config.php");
include_once(APP_PATH . "/exec.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Log in Google Map server side Markers clustering Management">
    <title>Login - Google Map server side Markers clustering Management</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo HTTP_APP_PATH ?>/static/css/style.css" />
</head>
<body>
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
    <div class="container-fluid">
        <form class="form-signin" action="<?php echo HTTP_APP_PATH ?>login.php" method="post">
            <h2 class="form-signin-heading">Please sign in</h2>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="text" name="login" id="inputEmail" class="form-control" placeholder="User name" value="<?php echo NXIK_GMC_USER_NAME == 'admin'?NXIK_GMC_USER_NAME:''; ?>" required autofocus><br>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" value="<?php echo NXIK_GMC_USER_PASSWORD == 'admin'?NXIK_GMC_USER_PASSWORD:'';?>" required>
            <input type="hidden" name="action" value="login">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        </form>
    </div>
    <?php include_once(APP_PATH . "/blocks/footer.php"); ?>
</body>
</html>