<?php
    /**
     * users.php
     *
     * User permissions page
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

    # POSTed form
    if(isset($_POST) && !empty($_POST)) {
        # Set all to off, before updating (needs to be changed really..)
        $disUser = $Connect->prepare('UPDATE "users" SET read = "off", write = "off", users = "off", tools = "off" ');
        $disUserRes = $disUser->execute();

        # Loop through changes
        foreach($_POST as $key => $value) {
            # Separate ID / value
            $upUsr = explode('-', $key);

            # Store the user ID & permission type
            $usID = $upUsr[0];
            $pmType = $upUsr[1];

            # Check which permission if/else if
            if($pmType == 'read') {                 // Read
                $updUser = $Connect->prepare('UPDATE "users" SET read = :read WHERE id = :id');
                $updUser->bindValue(':read', $value);
                $updUser->bindValue(':id', $usID);
                $updUserRes = $updUser->execute();
            }else if($pmType == 'write') {          // Write
                $updUser = $Connect->prepare('UPDATE "users" SET write = :write WHERE id = :id');
                $updUser->bindValue(':write', $value);
                $updUser->bindValue(':id', $usID);
                $updUserRes = $updUser->execute();
            }else if($pmType == 'users') {          // Users
                $updUser = $Connect->prepare('UPDATE "users" SET users = :users WHERE id = :id');
                $updUser->bindValue(':users', $value);
                $updUser->bindValue(':id', $usID);
                $updUserRes = $updUser->execute();
            }else if($pmType == 'tools') {          // Tools
                $updUser = $Connect->prepare('UPDATE "users" SET tools = :tools WHERE id = :id');
                $updUser->bindValue(':tools', $value);
                $updUser->bindValue(':id', $usID);
                $updUserRes = $updUser->execute();
            }
        }

        Viro::LoadPage('users');
    }

    # SELECT Users
    $getUsers = $Connect->prepare('SELECT * FROM users');
    $getUsersRes = $getUsers->execute();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="index, follow">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>ViroCMS - <?php Viro::Translate('Users', $l); ?></title>

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
            <div class="siimple-jumbotron-title">Users</div>
            <div class="siimple-jumbotron-detail">
                <?php Viro::Translate('UserI', $l); ?>
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
                            <div class="siimple-breadcrumb-item"><?php Viro::Translate('Users', $l); ?></div>
                        </div>

                        <!-- Break line -->
                        <div class="siimple-rule"></div>
                        <form action="?page=users" method="post">
                            <div class="siimple-field">
                                <button type="submit" class="siimple-btn siimple-btn--primary" value="Update Permissions"><?php Viro::Translate('UpdatePerms', $l); ?></button>
                                <a href="?page=create-user">
                                    <div class="siimple-btn siimple-btn--primary siimple--float-right"><?php Viro::Translate('CretUsr', $l); ?></div>
                                </a>
                            </div>
                            <div class="siimple-table siimple-table--striped siimple-table--border siimple-table--hover">
                                <div class="siimple-table-header">
                                    <div class="siimple-table-row">
                                        <div class="siimple-table-cell">Username</div>
                                        <div class="siimple-table-cell">Email</div>
                                        <div class="siimple-table-cell" align="center">Read</div>
                                        <div class="siimple-table-cell" align="center">Write</div>
                                        <div class="siimple-table-cell" align="center">Users</div>
                                        <div class="siimple-table-cell" align="center">Tools</div>
                                    </div>
                                </div>
                                <div class="siimple-table-body">
                                    <?php
                                        while($aUser = $getUsersRes->fetchArray(SQLITE3_ASSOC)) {
                                            echo '<div class="siimple-table-row">';
                                            echo '<div class="siimple-table-cell">' . $aUser['username'] . '</div>';
                                            echo '<div class="siimple-table-cell">' . $aUser['email'] . '</div>';

                                            echo '<div class="siimple-table-cell" align="center">';
                                            echo '<div class="siimple-switch" style="padding:0;margin:0;">';
                                            if($aUser['read'] == 'on') {
                                                echo '<input type="checkbox" id="' . $aUser['id'] . '-read" name="' . $aUser['id'] . '-read" checked>';
                                            }else{
                                                echo '<input type="checkbox" id="' . $aUser['id'] . '-read" name="' . $aUser['id'] . '-read">';
                                            }
                                            echo '<label for="' . $aUser['id'] . '-read"></label>';
                                            echo '<div></div>';
                                            echo '</div>';
                                            echo '</div>';

                                            echo '<div class="siimple-table-cell" align="center">';
                                            echo '<div class="siimple-switch" style="padding:0;margin:0;">';
                                            if($aUser['write'] == 'on') {
                                                echo '<input type="checkbox" id="' . $aUser['id'] . '-write" name="' . $aUser['id'] . '-write" checked>';
                                            }else{
                                                echo '<input type="checkbox" id="' . $aUser['id'] . '-write" name="' . $aUser['id'] . '-write">';
                                            }
                                            echo '<label for="' . $aUser['id'] . '-write"></label>';
                                            echo '<div></div>';
                                            echo '</div>';
                                            echo '</div>';

                                            echo '<div class="siimple-table-cell" align="center">';
                                            echo '<div class="siimple-switch" style="padding:0;margin:0;">';
                                            if($aUser['users'] == 'on') {
                                                echo '<input type="checkbox" id="' . $aUser['id'] . '-users" name="' . $aUser['id'] . '-users" checked>';
                                            }else{
                                                echo '<input type="checkbox" id="' . $aUser['id'] . '-users" name="' . $aUser['id'] . '-users">';
                                            }
                                            echo '<label for="' . $aUser['id'] . '-users"></label>';
                                            echo '<div></div>';
                                            echo '</div>';
                                            echo '</div>';

                                            echo '<div class="siimple-table-cell" align="center">';
                                            echo '<div class="siimple-switch" style="padding:0;margin:0;">';
                                            if($aUser['tools'] == 'on') {
                                                echo '<input type="checkbox" id="' . $aUser['id'] . '-tools" name="' . $aUser['id'] . '-tools" checked>';
                                            }else{
                                                echo '<input type="checkbox" id="' . $aUser['id'] . '-tools" name="' . $aUser['id'] . '-tools">';
                                            }
                                            echo '<label for="' . $aUser['id'] . '-tools"></label>';
                                            echo '<div></div>';
                                            echo '</div>';
                                            echo '</div>';

                                            echo '</div>';
                                        }
                                    ?>
                                </div>
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