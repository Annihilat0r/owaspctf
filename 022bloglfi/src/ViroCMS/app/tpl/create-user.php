<?php
    /**
     * create-user.php
     *
     * User creation
     *
     * @package    ViroCMS
     * @author     Alex White (https://github.com/ialexpw)
     * @copyright  2018 ViroCMS
     * @license    https://github.com/ialexpw/ViroCMS/blob/master/LICENSE  MIT License
     * @link       https://viro.app
     */

    # Permissions
    if(!Viro::Permission('users')) {
        Viro::LoadPage('access');
    }

    global $l;
    $Connect = Viro::Connect();

    # Permissions
    if(!Viro::Permission('users')) {
        Viro::LoadPage('access');
    }

    # POSTing the form
    if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        # New user details
        $usr = $_POST['username'];
        $eml = $_POST['email'];
        $psw = password_hash($_POST['password'], PASSWORD_DEFAULT);

        # Current time
        $ts = time();

        # Insert the user
        $stmt = $Connect->prepare('INSERT INTO users ("username", "email", "password", "read", "write", "users", "tools", "last_login", "active")
                    VALUES (:username, :email, :password, "on", "off", "off", "off", "' . $ts . '", "1")');

        # Bind
        $stmt->bindValue(':username', $usr);
        $stmt->bindValue(':email', $eml);
        $stmt->bindValue(':password', $psw);
        $stmt->execute();

        Viro::LoadPage('users');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="index, follow">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>ViroCMS - <?php Viro::Translate('CretUsr', $l); ?></title>

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
            <div class="siimple-jumbotron-title"><?php Viro::Translate('CretUsr', $l); ?></div>
            <div class="siimple-jumbotron-detail">
                <?php Viro::Translate('CretUsrI', $l); ?>
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
                                <a href="?page=plugins">
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
                            <div class="siimple-breadcrumb-item"><?php Viro::Translate('Users', $l); ?></div>
                            <div class="siimple-breadcrumb-item"><?php Viro::Translate('Create', $l); ?></div>
                        </div>

                        <!-- Break line -->
                        <div class="siimple-rule"></div>

                        <form action="?page=create-user" method="post">
                            <div class="siimple-field">
                                <div class="siimple-field-label">Username</div>
                                <input type="text" class="siimple-input" style="width:375px;" name="username" placeholder="jdoe1">
                                <!--<div class="siimple-field-helper">This field cannot be empty or contain special characters</div>-->
                            </div>
                            <div class="siimple-field">
                                <div class="siimple-field-label">Email</div>
                                <input type="email" class="siimple-input" style="width:375px;" name="email" placeholder="jdoe@example.com">
                                <!--<div class="siimple-field-helper">This field cannot be empty or contain special characters</div>-->
                            </div>
                            <div class="siimple-field">
                                <div class="siimple-field-label">Password</div>
                                <input type="password" class="siimple-input" style="width:375px;" name="password" placeholder="jdoe123">
                                <!--<div class="siimple-field-helper">This field cannot be empty or contain special characters</div>-->
                            </div>
                            <div class="siimple-field">
                                <button type="submit" class="siimple-btn siimple-btn--blue" value="Create group"><?php Viro::Translate('CretUsr', $l); ?></button>
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