<?php
    /**
     * tools.php
     *
     * Tools page for backup/restore
     *
     * @package    ViroCMS
     * @author     Alex White (https://github.com/ialexpw)
     * @copyright  2018 ViroCMS
     * @license    https://github.com/ialexpw/ViroCMS/blob/master/LICENSE  MIT License
     * @link       https://viro.app
     */

    # Permissions
    if(!Viro::Permission('tools')) {
        Viro::LoadPage('access');
    }

    global $l;
    $Connect = Viro::Connect();

    # SELECT Groups
    $getBackups = $Connect->prepare('SELECT * FROM backups ORDER BY id DESC');
    $getBackupsRes = $getBackups->execute();

    # Create backup
    if(isset($_GET['create'])) {
        Viro::Backup();

        Viro::LoadPage('tools');
    }

    # Restore backup
    if(isset($_GET['restore']) && !empty($_GET['restore'])) {
        $resId = $_GET['restore'];

        Viro::Restore($resId);

        Viro::LoadPage('tools');
    }

    # Deleting a backup
    if(isset($_GET['del']) && !empty($_GET['del'])) {
        # Backup id/date
        #$rmId = $_GET['del'];

        #Viro::RemoveBackup($rmId);

        #Viro::LoadPage('tools');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="index, follow">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>ViroCMS - <?php Viro::Translate('Tools', $l); ?></title>

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
            <div class="siimple-jumbotron-title"><?php Viro::Translate('Tools', $l); ?></div>
            <div class="siimple-jumbotron-detail">
                <?php Viro::Translate('ToolI', $l); ?>
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
                            <div class="siimple-breadcrumb-item"><?php Viro::Translate('Tools', $l); ?></div>
                        </div>

                        <!-- Break line -->
                        <div class="siimple-rule"></div>

                        <div class="siimple-field">
                            <a href="?page=tools&create"><div class="siimple-btn siimple-btn--primary"><?php Viro::Translate('CretBck', $l); ?></div></a>
                        </div>
                        <div class="siimple-table siimple-table--striped">
                            <div class="siimple-table-header">
                                <div class="siimple-table-row">
                                    <div class="siimple-table-cell">Name</div>
                                    <div class="siimple-table-cell">Backup Date</div>
                                    <div class="siimple-table-cell">Triggered By</div>
                                    <div class="siimple-table-cell">Options</div>
                                </div>
                            </div>
                            <div class="siimple-table-body">
                                <?php
                                    while($aBackup = $getBackupsRes->fetchArray(SQLITE3_ASSOC)) {
                                        if(empty($aBackup['u_id'])) {
                                            $trig = "Command Line (CLI)";
                                        }else{
                                            # Lookup the owner
                                            $getGroupOwner = $Connect->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
                                            $getGroupOwner->bindValue(':id', $aBackup['u_id']);
                                            $getOwnerRes = $getGroupOwner->execute();

                                            # Fetch the array
                                            $getOwnerRes = $getOwnerRes->fetchArray(SQLITE3_ASSOC);

                                            $trig = $getOwnerRes['username'];
                                        }

                                        echo '<div class="siimple-table-row">';
                                        echo '<div class="siimple-table-cell">' . $aBackup['title'] . '</div>';
                                        echo '<div class="siimple-table-cell">' . date("D M j Y @ G:i", $aBackup['created']) . '</div>';
                                        echo '<div class="siimple-table-cell">' . $trig . '</div>';
                                        echo '<div class="siimple-table-cell"><a href="?page=tools&restore=' . $aBackup['created'] . '">Restore</a> | <a href="?page=tools&del=' . $aBackup['created'] . '">Delete <!--Function Disabled For CTF reason --></a></div>';
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