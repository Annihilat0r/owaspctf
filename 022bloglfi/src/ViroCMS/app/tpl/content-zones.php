<?php
    /**
     * content-zones.php
     *
     * Listing of the zones within a group
     *
     * @package    ViroCMS
     * @author     Alex White (https://github.com/ialexpw)
     * @copyright  2018 ViroCMS
     * @license    https://github.com/ialexpw/ViroCMS/blob/master/LICENSE  MIT License
     * @link       https://viro.app
     */

    # Permissions
    if(!Viro::Permission('read')) {
        Viro::LoadPage('access');
    }

    global $l;
    $Connect = Viro::Connect();

    # Do we have a group?
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $grpId = $_GET['id'];
    }else{
        Viro::LoadPage('content');
    }

    # SELECT Zones
    $getZones = $Connect->prepare('SELECT * FROM zones WHERE g_id = :g_id');
    $getZones->bindValue(':g_id', $grpId);
    $getZonesRes = $getZones->execute();

    # Deleting a zone
    if(isset($_GET['del']) && !empty($_GET['del'])) {
        # Zone hash
        $rmId = $_GET['del'];

        # Remove the zone
        $rmZne = $Connect->prepare('DELETE FROM zones WHERE id = :id');
        $rmZne->bindValue(':id', $rmId);
        $rmZne->execute();

        # Remove the content
        $rmZne = $Connect->prepare('DELETE FROM content WHERE z_id = :z_id');
        $rmZne->bindValue(':z_id', $rmId);
        $rmZne->execute();

        Viro::LoadPage('content-zones&id=' . $grpId);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="index, follow">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>ViroCMS - <?php Viro::Translate('ContZne', $l); ?></title>

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
            <div class="siimple-jumbotron-title"><?php Viro::Translate('ContZne', $l); ?></div>
            <div class="siimple-jumbotron-detail">
                <?php Viro::Translate('ContZneI', $l); ?>
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
                            <div class="siimple-breadcrumb-item"><?php Viro::Translate('Content', $l); ?></div>
                            <div class="siimple-breadcrumb-item"><?php Viro::Translate('Zones', $l); ?></div>
                        </div>

                        <!-- Break line -->
                        <div class="siimple-rule"></div>
                        <div class="siimple-field">
                            <a href="?page=create-zone&amp;id=<?php echo $_GET['id']; ?>"><div class="siimple-btn siimple-btn--primary">Create Zone</div></a>
                        </div>
                        <div class="siimple-table siimple-table--striped">
                            <div class="siimple-table-header">
                                <div class="siimple-table-row">
                                    <div class="siimple-table-cell">Name</div>
                                    <div class="siimple-table-cell">Slug</div>
                                    <div class="siimple-table-cell">Owner</div>
                                    <div class="siimple-table-cell">Options</div>
                                </div>
                            </div>
                            <div class="siimple-table-body">
                                <?php
                                    while($aZone = $getZonesRes->fetchArray(SQLITE3_ASSOC)) {
                                        # Lookup the owner
                                        $getZoneOwner = $Connect->prepare('SELECT * FROM "users" WHERE id = :userid LIMIT 1');
                                        $getZoneOwner->bindValue(':userid', $aZone['z_owner']);
                                        $getOwnerRes = $getZoneOwner->execute();

                                        # Fetch the array
                                        $getOwnerRes = $getOwnerRes->fetchArray(SQLITE3_ASSOC);

                                        echo '<div class="siimple-table-row">';
                                        echo '<div class="siimple-table-cell">' . $aZone['z_name'] . '</div>';
                                        echo '<div class="siimple-table-cell">' . $aZone['z_slug'] . '</div>';
                                        echo '<div class="siimple-table-cell">' . $getOwnerRes['username'] . '</div>';
                                        echo '<div class="siimple-table-cell"><a href="?page=content-edit&id=' . $aZone['id'] . '">Edit</a> | <a href="?page=content-zones&id=' . $aZone['g_id'] . '&del=' . $aZone['id'] . '">Delete</a></div>';
                                        echo '</div>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="siimple-footer siimple-footer--extra-large">
            &copy; 2018 ViroCMS - <?php echo Viro::Version(); ?>.
        </div>
    </body>
</html>