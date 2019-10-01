<?php
    /**
     * create-zone.php
     *
     * Zone creation
     *
     * @package    ViroCMS
     * @author     Alex White (https://github.com/ialexpw)
     * @copyright  2018 ViroCMS
     * @license    https://github.com/ialexpw/ViroCMS/blob/master/LICENSE  MIT License
     * @link       https://viro.app
     */

    # Permissions
    if(!Viro::Permission('read') || !Viro::Permission('write')) {
        Viro::LoadPage('access');
    }

    global $l;
    $Connect = Viro::Connect();

    # POSTing the form
    if(!empty($_POST) && !empty($_POST['zone'])) {
        # New zone
        $zne = $_POST['zone'];

        # Get the group id
        $grp = $_GET['id'];

        # Create a slug
        $slg = Viro::Clean(strtolower(str_replace(" ", "-", $_POST['zone'])));

        # Time stamp
        $ts = time();

        # Create a zone hash
        $zneh = substr(sha1($ts . $zne . $slg), 0, 10);

        # Create a content hash
        $conh = substr(sha1($ts . $zne . $slg . "content"), 0, 10);

        # Begin the query
        $Connect->exec('BEGIN');

        # Insert the zone
        $stmt = $Connect->prepare('INSERT INTO zones ("z_name", "z_slug", "z_hash", "g_id", "z_owner", "created")
                    VALUES (:zone, :slug, "' . $zneh . '", "' . $grp . '", :z_owner, "' . $ts . '")');
        
        $stmt->bindValue(':zone', $zne);
        $stmt->bindValue(':slug', $slg);
        $stmt->bindValue(':z_owner', $_SESSION['UserID']);
        $stmt->execute();

        $nZone = $Connect->lastInsertRowID();

        # Insert the content
        $stmt = $Connect->prepare('INSERT INTO content ("content", "c_hash", "z_id", "edit_by", "created", "updated")
                    VALUES ("Example content", "' . $conh . '", "' . $nZone . '", :edit_by, "' . $ts . '", "' . $ts . '")');

        $stmt->bindValue(':edit_by', $_SESSION['UserID']);
        $stmt->execute();

        # End the query
        $Connect->exec('COMMIT');

        Viro::LoadPage('content-zones&id=' . $grp);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="index, follow">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>ViroCMS - <?php Viro::Translate('CretZne', $l); ?></title>

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
            <div class="siimple-jumbotron-title"><?php Viro::Translate('CretZne', $l); ?></div>
            <div class="siimple-jumbotron-detail">
                <?php Viro::Translate('CretZneI', $l); ?>  
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
                            <div class="siimple-breadcrumb-item"><?php Viro::Translate('Content', $l); ?></div>
                            <div class="siimple-breadcrumb-item"><?php Viro::Translate('Zones', $l); ?></div>
                            <div class="siimple-breadcrumb-item"><?php Viro::Translate('Create', $l); ?></div>
                        </div>

                        <!-- Break line -->
                        <div class="siimple-rule"></div>

                        <form action="?page=create-zone&amp;id=<?php echo $_GET['id']; ?>" method="post">
                            <div class="siimple-field">
                                <div class="siimple-field-label">Zone name</div>
                                <input type="text" class="siimple-input" style="width:375px;" name="zone" placeholder="Example zone">
                                <div class="siimple-field-helper">This field cannot be empty or contain special characters</div>
                            </div>
                            <div class="siimple-field">
                                <button type="submit" class="siimple-btn siimple-btn--blue" value="Create zone"><?php Viro::Translate('CretZne', $l); ?></button>
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