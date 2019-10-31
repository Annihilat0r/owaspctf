<?php
    /**
     * create-article.php
     *
     * Article creation page
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

    if(!empty($_POST) && !empty($_POST['title']) && !empty($_POST['editor'])) {
        # Title
        $arTitle = $_POST['title'];

        # Content
        $arEdit = $_POST['editor'];

        # Current time
        $ct = time();

        # Create an article hash
        $arth = substr(sha1($ct . $arTitle), 0, 10);

        # Article published?
        if(isset($_POST['publish']) && $_POST['publish'] == 'on') {
            $pub = 1;
        }else{
            $pub = 0;
        }

        # Insert the group
        $stmt = $Connect->prepare('INSERT INTO articles ("title", "u_id", "content", "a_hash", "created", "updated", "published")
                    VALUES (:title, :u_id, :content, "' . $arth . '", "' . $ct . '", "' . $ct . '", "' . $pub . '")');

        # Bind
        $stmt->bindValue(':title', $arTitle);
        $stmt->bindValue(':u_id', $_SESSION['UserID']);
        $stmt->bindValue(':content', $arEdit);
        $stmt->execute();

        Viro::LoadPage('articles');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="index, follow">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>ViroCMS - <?php Viro::Translate('CreArt', $l); ?></title>

        <!-- Styles -->
        <link rel="stylesheet" href="app/tpl/css/siimple.css">
        <link rel="stylesheet" href="app/tpl/css/all.css">
        <link rel="stylesheet" href="app/tpl/css/viro.css">
        <link rel="stylesheet" href="app/tpl/css/trumbowyg.min.css">

        <!-- Javascript -->
        <script src="app/tpl/js/jquery-3.2.1.min.js"></script>
        <script src="app/tpl/js/trumbowyg.min.js"></script>
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
            <div class="siimple-jumbotron-title"><?php Viro::Translate('CreArt', $l); ?></div>
            <div class="siimple-jumbotron-detail">
                <?php Viro::Translate('CretArtI', $l); ?>
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
                                <a href="?page=articles">
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
                            <div class="siimple-breadcrumb-item"><?php Viro::Translate('Articles', $l); ?></div>
                            <div class="siimple-breadcrumb-item"><?php Viro::Translate('Create', $l); ?></div>
                        </div>

                        <!-- Break line -->
                        <div class="siimple-rule"></div>

                        <!-- WYSIWYG -->
                        <form action="?page=create-article" method="post">
                            <div class="siimple-field">
                                <div class="siimple-field-label">Article title</div>
                                <input type="text" style="width:50%;" class="siimple-input" name="title" value="">
                            </div>

                            <div class="siimple-field">
                                <div class="siimple-field-label">Article content</div>
                                <textarea id="virowyg" name="editor"></textarea>
                            </div>

                            <div class="siimple-field">
                                <button type="submit" class="siimple-btn siimple-btn--blue" value="Save article">Save article</button>

                                <label class="siimple-label siimple--float-right">Publish 
                                <div class="siimple-switch">
                                    <input type="checkbox" id="publish" name="publish">
                                    <label for="publish"></label>
                                    <div></div>
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
        <script>
            $('#virowyg').trumbowyg();
        </script>
    </body>
</html>