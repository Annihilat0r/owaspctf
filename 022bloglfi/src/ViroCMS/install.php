<?php
    /**
     * install.php
     *
     * Installer for ViroCMS, creating the SQLite database and tables
     *
     * @package    ViroCMS
     * @author     Alex White (https://github.com/ialexpw)
     * @copyright  2018 ViroCMS
     * @license    https://github.com/ialexpw/ViroCMS/blob/master/LICENSE  MIT License
     * @link       https://viro.app
     */
    
    include 'app/viro.app.php';

    # If not installed
    if(!Viro::Installed()) {
        Viro::InstallDatabase();
        Viro::GenerateData();
    }
?>