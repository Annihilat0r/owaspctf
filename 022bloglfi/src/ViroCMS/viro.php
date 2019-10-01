<?php
    /**
     * viro.php
     *
     * File to be used by the CLI calls
     *
     * @package    ViroCMS
     * @author     Alex White (https://github.com/ialexpw)
     * @copyright  2018 ViroCMS
     * @license    https://github.com/ialexpw/ViroCMS/blob/master/LICENSE  MIT License
     * @link       https://viro.app
     */
    include 'app/viro.app.php';

    $db = new SQLite3('app/db/viro.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

    # Only from CLI
    if(php_sapi_name() === 'cli') {
        # No arguments
        if(empty($argv[1])) {
            die("Missing arguments.\n");
        }

        # Check command line - backup
        if(strtolower($argv[1]) == 'backup') {
            Viro::Backup();
            die("Backup created.\n");
        }

        # User management
        if(strtolower($argv[1]) == 'user') {
            # Add user
            if(strtolower($argv[2]) == 'add' && !empty($argv[3]) && !empty($argv[5])) {
                # Username
                $uName = $argv[3];
                
                # Gen password?
                if(empty($argv[4])) {
                    $uPass = NewPassword();
                }else{
                    $uPass = $argv[4];
                }

                # Hash
                $uPass = password_hash($uPass, PASSWORD_DEFAULT);

                # Valid email
                if(filter_var($argv[5], FILTER_VALIDATE_EMAIL)) {
                    $uEmail = $argv[5];
                }else{
                    die("Invalid email.\n");
                }

                # Current time
                $cTime = time();

                # Create user
                $db->query('INSERT INTO users ("username", "email", "password", "read", "write", "users", "tools", "last_login", "active")
                            VALUES ("' . $uName . '", "' . $uEmail . '", "' . $uPass . '", "", "", "", "", "' . $cTime . '", "1")');
                
                die("User created.\n");
            }

            # Delete user
            if(strtolower($argv[2]) == 'del' && !empty($argv[3])) {

            }
        }
    }else{
        die("CLI Only.\n");
    }

    function NewPassword() {

    }
?>