<?php
    /**
     * login.php
     *
     * Login form to the CMS
     *
     * @package    ViroCMS
     * @author     Alex White (https://github.com/ialexpw)
     * @copyright  2018 ViroCMS
     * @license    https://github.com/ialexpw/ViroCMS/blob/master/LICENSE  MIT License
     * @link       https://viro.app
     */

    # Logged in? Redirect
    if(Viro::LoggedIn()) {
        Viro::LoadPage('dashboard');
    }

    global $l;
    $Connect = Viro::Connect();

    # POSTing the login form
    if(isset($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
        # User
        $usr = $_POST['username'];

        # SELECT User
        $getUser = $Connect->prepare('SELECT * FROM users WHERE username = :username');
        $getUser->bindValue(':username', $usr);
        $getUserRes = $getUser->execute();

        # Get user data
        $getUserRes = $getUserRes->fetchArray(SQLITE3_ASSOC);

        # User does not exist (add log?)
        if(!$getUserRes) {
            Viro::LoadPage('login&error');
        }

        # Password/login
        if(password_verify($_POST['password'], $getUserRes['password'])) {
            $_SESSION['UserID'] = $getUserRes['id'];
            $_SESSION['Username'] = $getUserRes['username'];
            $_SESSION['UserEmail'] = $getUserRes['email'];
            $_SESSION['UserLevel'] = $getUserRes['u_level'];

            # Get time
            $ts = time();

            # SELECT User
            $updateUser = $Connect->prepare('UPDATE users SET last_login = :last_login WHERE username = :username');
            $updateUser->bindValue(':last_login', $ts);
            $updateUser->bindValue(':username', $usr);
            $updateUserRes = $updateUser->execute();

            # Redirect
            Viro::LoadPage('dashboard');
        }else{
            Viro::LoadPage('login&error');
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
        <title>ViroCMS - <?php Viro::Translate('Login', $l); ?></title>

        <!-- Styles -->
        <link rel="stylesheet" href="app/tpl/css/siimple.css">
        <link rel="stylesheet" href="app/tpl/css/all.css">
        <link rel="stylesheet" href="app/tpl/css/viro.css">
    </head>

    <body>
        <div class="siimple-navbar siimple-navbar--extra-large siimple-navbar--dark">
            <div class="siimple-navbar-title">ViroCMS</div>
            <div class="siimple--float-right">
            </div>
        </div>

        <div class="siimple-jumbotron siimple-jumbotron--extra-large siimple-jumbotron--light">
            <div class="siimple-jumbotron-title"><?php Viro::Translate('Login', $l); ?></div>
            <div class="siimple-jumbotron-detail">
                <?php Viro::Translate('LognI', $l); ?>
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
                        <!-- Breadcrumb menu -->
                        <div class="siimple-breadcrumb">
                            <div class="siimple-breadcrumb-item"><?php Viro::Translate('Dashboard', $l); ?></div>
                            <div class="siimple-breadcrumb-item"><?php Viro::Translate('Login', $l); ?></div>
                        </div>

                        <!-- Break line -->
                        <div class="siimple-rule"></div>

                        <form action="?page=login" method="post">
                            <div class="siimple-field">
                                <div class="siimple-field-label">Username</div>
                                <input type="text" class="siimple-input" style="width:375px;" name="username" placeholder="username" required>
                            </div>
                            <div class="siimple-field">
                                <div class="siimple-field-label">Password</div>
                                <input type="password" class="siimple-input" style="width:375px;" name="password" placeholder="password" required>
                            </div>
                            <div class="siimple-field">
                                <button type="submit" class="siimple-btn siimple-btn--blue" value="Create group">Login</button>
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