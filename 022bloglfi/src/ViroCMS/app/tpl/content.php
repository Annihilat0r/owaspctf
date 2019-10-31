<?php
    /**
     * content.php
     *
     * Listing of the groups
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

    # SELECT Groups
    $getGroups = $Connect->prepare('SELECT * FROM groups');
    $getGroupsRes = $getGroups->execute();

    # Deleting a group
    if(isset($_GET['del']) && !empty($_GET['del'])) {
        # Group hash
        $rmId = $_GET['del'];

        # Remove the group
        $rmGrp = $Connect->prepare('DELETE FROM groups WHERE id = :id');
        $rmGrp->bindValue(':id', $rmId);
        $rmGrp->execute();

        Viro::LoadPage('content');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="index, follow">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>ViroCMS - <?php Viro::Translate('ContGrp', $l); ?></title>

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
            <div class="siimple-jumbotron-title"><?php Viro::Translate('ContGrp', $l); ?></div>
            <div class="siimple-jumbotron-detail">
                <?php Viro::Translate('ContGrpI', $l); ?>
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
                        </div>

                        <!-- Break line -->
                        <div class="siimple-rule"></div>
                        
                        <div class="siimple-field">
                            <a href="?page=create-group"><div class="siimple-btn siimple-btn--primary"><?php Viro::Translate('CretGrp', $l); ?></div></a>
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
                                    while($aGroup = $getGroupsRes->fetchArray(SQLITE3_ASSOC)) {
                                        # Lookup the owner
                                        $getGroupOwner = $Connect->prepare('SELECT * FROM "users" WHERE id = :id LIMIT 1');
                                        $getGroupOwner->bindValue(':id', $aGroup['u_id']);
                                        $getOwnerRes = $getGroupOwner->execute();

                                        # Fetch the array
                                        $getOwnerRes = $getOwnerRes->fetchArray(SQLITE3_ASSOC);

                                        echo '<div class="siimple-table-row">';
                                        echo '<div class="siimple-table-cell">' . $aGroup['g_name'] . '</div>';
                                        echo '<div class="siimple-table-cell">' . $aGroup['g_slug'] . '</div>';
                                        echo '<div class="siimple-table-cell">' . $getOwnerRes['username'] . '</div>';
                                        echo '<div class="siimple-table-cell"><a href="?page=content-zones&id=' . $aGroup['id'] . '">View Zones</a> | <a href="?page=content&del=' . $aGroup['id'] . '">Delete</a></div>';
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