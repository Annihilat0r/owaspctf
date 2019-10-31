<?php
    /**
     * example.php
     *
     * Example file to show how ViroCMS can be used
     *
     * @package    ViroCMS
     * @author     Alex White (https://github.com/ialexpw)
     * @copyright  2018 ViroCMS
     * @license    https://github.com/ialexpw/ViroCMS/blob/master/LICENSE  MIT License
     * @link       https://viro.app
     */
    include 'app/viro.app.php';

    /**
     * Will return the latest article in JSON format
     */
    echo Viro::Article(1);

    /**
     * Will override the default entry, below will return the article with ID 2 in JSON format
     */
    echo Viro::Article(2, 1);

    /**
     * Will override the default entry, below will return the title of article ID 7
     * Possible objects are - id, title, author, content, created, updated
     */
    echo Viro::Article(7, 1, 'title');

    /**
     * Create a backup of the SQLite database
     */
    Viro::Backup();
?>