<?php
    /**
     * profile.php
     *
     * Profile page to update passwords
     *
     * @package    ViroCMS
     * @author     Alex White (https://github.com/ialexpw)
     * @copyright  2018 ViroCMS
     * @license    https://github.com/ialexpw/ViroCMS/blob/master/LICENSE  MIT License
     * @link       https://viro.app
     */

    global $l;
    $Connect = Viro::Connect();

    $ctf="";
    if(isset($_GET['success'])){
        $ctf="Bro, do not break our CTF please";
    }
    # POSTing the form
    if(!empty($_POST) && !empty($_POST['password']) && !empty($_POST['npassword']) && !empty($_POST['rpassword'])) {
        # Get the current details
        $getUser = $Connect->prepare('SELECT * FROM users WHERE id = :id');
        $getUser->bindValue(':id', $_SESSION['UserID']);
        $getUserRes = $getUser->execute();

        # Get user data
        $getUserRes = $getUserRes->fetchArray(SQLITE3_ASSOC);

        # If current password is correct..
        if(password_verify($_POST['password'], $getUserRes['password']) && $_POST['npassword'] == $_POST['rpassword']) {
            $ctf="Bro, do not break our CTF please";
            //echo(1337);
            # Hash new password
            #$nPass = password_hash($_POST['npassword'], PASSWORD_DEFAULT);

            # Update the password field
            #$updateContent = $Connect->prepare('UPDATE users SET password = :password WHERE id = :id');
            #$updateContent->bindValue(':password', $nPass);
            #$updateContent->bindValue(':id', $_SESSION['UserID']);
            #$updateContentRes = $updateContent->execute();

            Viro::LoadPage('profile&success');
        }else{
            Viro::LoadPage('profile&error');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="index, follow">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>ViroCMS - <?php Viro::Translate('Profile', $l); ?></title>

        <!-- Styles -->
        <link rel="stylesheet" href="app/tpl/css/siimple.css">
        <link rel="stylesheet" href="app/tpl/css/all.css">
        <link rel="stylesheet" href="app/tpl/css/viro.css">
    </head>

    <body>
        <div class="siimple-navbar siimple-navbar--extra-large siimple-navbar--dark">
            <div class="siimple-navbar-title">ViroCMS</div>
            <div class="siimple--float-right">
                <a href="?page=profile"><div class="siimple-navbar-item"><?php Viro::Translate('Profile', $l); ?></div></a>
                <a href="?logout"><div class="siimple-navbar-item"><?php Viro::Translate('Logout', $l); ?></div></a>
            </div>
        </div>

        <div class="siimple-jumbotron siimple-jumbotron--extra-large siimple-jumbotron--light">
            <div class="siimple-jumbotron-title"><?php Viro::Translate('Profile', $l); ?></div>
            <div class="siimple-jumbotron-detail">
                <?php Viro::Translate('ProfI', $l); ?>
            </div>
        </div>

        <div class="siimple-content siimple-content--extra-large">
            <div class="siimple-grid">
                <div class="siimple-grid-row">
                    <div class="siimple-grid-col siimple-grid-col--3">
                        <div class="siimple-list siimple-list--hover">
                            <div class="siimple-list-item">
                                <a href="?page=dashboard">
                                    <div class="siimple-list-title"><?php Viro::Translate('Dashboard', $l); ?> <div class="siimple--float-right"><i class="fas fa-home"></i></div></div>
                                </a>
                            </div>
                            <div class="siimple-list-item">
                                <a href="?page=content">
                                    <div class="siimple-list-title"><?php Viro::Translate('Content', $l); ?> <div class="siimple--float-right"><i class="fas fa-align-left"></i></div></div>
                                </a>
                            </div>
                            <div class="siimple-list-item">
                                <a href="?page=articles">
                                    <div class="siimple-list-title"><?php Viro::Translate('Articles', $l); ?> <div class="siimple--float-right"><i class="far fa-newspaper"></i></div></div>
                                </a>
                            </div>
                            <div class="siimple-list-item">
                                <a href="?page=plugins&path=plugins/">
                                    <div class="siimple-list-title"><?php Viro::Translate('Plugins', $l); ?> <div class="siimple--float-right"><i class="far fa-newspaper"></i></div></div>
                                </a>
                            </div>
                            <div class="siimple-list-item">
                                <a href="?page=users">
                                    <div class="siimple-list-title"><?php Viro::Translate('UserMgn', $l); ?> <div class="siimple--float-right"><i class="far fa-user-circle"></i></div></div>
                                </a>
                            </div>
                            <div class="siimple-list-item">
                                <a href="?page=tools">
                                    <div class="siimple-list-title"><?php Viro::Translate('Backup', $l); ?> <div class="siimple--float-right"><i class="fas fa-sync-alt"></i></div></div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="siimple-grid-col siimple-grid-col--9">
                        <div class="siimple-breadcrumb">
                            <div class="siimple-breadcrumb-item"><?php Viro::Translate('Dashboard', $l); ?></div>
                            <div class="siimple-breadcrumb-item"><?php Viro::Translate('Profile', $l); ?></div>
                        </div>

                        <!-- Break line -->
                        <div class="siimple-rule"></div>

                        <form action="?page=profile" method="post">
                            <div class="siimple-field">
                                <div class="siimple-field-label">Current password</div>
                                <input type="password" class="siimple-input" style="width:375px;" name="password" placeholder="">
                                <!--<div class="siimple-field-helper">This field cannot be empty or contain special characters</div>-->
                            </div>
                            <div class="siimple-field">
                                <div class="siimple-field-label">New password</div>
                                <input type="password" class="siimple-input" style="width:375px;" name="npassword" placeholder="">
                                <!--<div class="siimple-field-helper">This field cannot be empty or contain special characters</div>-->
                            </div>
                            <div class="siimple-field">
                                <div class="siimple-field-label">Repeat password</div>
                                <input type="password" class="siimple-input" style="width:375px;" name="rpassword" placeholder="">
                                <!--<div class="siimple-field-helper">This field cannot be empty or contain special characters</div>-->
                            </div>
                            <?php echo($ctf); ?>
                            <div class="siimple-field">
                                <button type="submit" class="siimple-btn siimple-btn--blue" value="Create group">Update password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="siimple-footer siimple-footer--extra-large">
            &copy; 2018 ViroCMS - <?php echo Viro::Version(); ?>.
        </div>
    </body>
</html>