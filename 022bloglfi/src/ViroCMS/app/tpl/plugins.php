<?php
    /**
     * articles.php
     *
     * Listing page to create or edit article content
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

    # Deleting an article
    if(isset($_GET['del']) && !empty($_GET['del'])) {
        # Article id
        $rmId = $_GET['del'];

        # Remove the group
        $rmGrp = $Connect->prepare('DELETE FROM articles WHERE id = :id');
        $rmGrp->bindValue(':id', $rmId);
        $rmGrp->execute();

        Viro::LoadPage('articles');
    }

    # SELECT Articles
    $getArticles = $Connect->prepare('SELECT * FROM articles ORDER BY id DESC');
    $getArticlesRes = $getArticles->execute();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="index, follow">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>ViroCMS - <?php Viro::Translate('Articles', $l); ?></title>

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
            <div class="siimple-jumbotron-title"><?php Viro::Translate('Articles', $l); ?></div>
            <div class="siimple-jumbotron-detail">
                <?php Viro::Translate('ArtcI', $l); ?>
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
                            <div class="siimple-breadcrumb-item"><?php Viro::Translate('Plugins', $l); ?></div>

                        </div>

                        <!-- Break line -->
                        <div class="siimple-rule"></div>
                        <?php 
                            $path="plugins/";  
                            if(isset($_GET['path'])){
                                $path=($_GET['path']);
                            } 
                            $path=urldecode(urldecode($path));
                            $path=preg_replace("/\.\.\//i","",$path);
                            $realpath="/var/www/html/ViroCMS/app/".$path;

                            echo('<div class="siimple--float-left">');
                                foreach(explode("/",$path) as $dir){
                                echo('<div class="siimple-breadcrumb-item">'.htmlentities($dir).'</div>');
                            }
                            echo('</div>');
                            ?>
                        <div class="siimple-table siimple-table--striped">
                            <div class="siimple-table-header">
                                <div class="siimple-table-row">
                                    <div class="siimple-table-cell">Name</div>
                                    <div class="siimple-table-cell">Size</div>
                                    <div class="siimple-table-cell">Type</div>
                                    <div class="siimple-table-cell">Permissions</div>
                                </div>
                            </div>
                            <div class="siimple-table-body">
                                <?php
                                
                                
                                //echo $realpath;
                                $cdir = scandir(($realpath)); 
                                $cdir = array_diff($cdir, array('..', '.'));
                                
                                foreach($cdir as $file){
                                    
                                     echo '<div class="siimple-table-row">';
                                        echo '<div class="siimple-table-cell">' . $file . '</div>';
                                        echo '<div class="siimple-table-cell">' . filesize($realpath . $file) . '</div>';
                                        echo '<div class="siimple-table-cell">' . filetype($realpath . $file) . '</div>';
                                        echo '<div class="siimple-table-cell">' . substr(sprintf('%o', fileperms($realpath . $file)), -4) . '</div>';
                                        
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