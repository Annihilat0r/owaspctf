# ViroCMS
ViroCMS is an easy to use PHP CMS which uses SQLite as a back-end. ViroCMS was created to easily integrate into existing websites that have no easy way to edit content. With support for both static content and a simplistic, but powerful article/blog engine, ViroCMS makes it easy to control your content.

## Features
* Beautiful interface to the CMS using siimple CSS framework
* 1-click install of the SQLite database and tables
* Simple content creation and editing using the WYSIWYG editor
* User authentication and capability, control access to individual users
* Article management, create a blog easily using the built-in tools
* Backup/restore with a single click inside the interface
* Easy to translate using a single file

## Installing
1. Create the database folder under app/db and allow read and write access to this folder.
1. Run the installer by navigating to the /install.php file. This will generate the needed database structure.
1. Remove the install.php file from the server.
1. Visit /index.php on your system and login with the default credentials admin:password

Ensure to add a new user once logged in for the first time and disable access for the admin user.

## Screenshots
![ViroCMS Dashboard](https://viro.app/Viro.png)

## Notes
* Using the default install method, the app/db/viro.db file will be accessible via HTTP. It is recommended to configure your web server of choice to block public access to this file. Examples of this will be given in the Wiki in time.

A quick example in nginx would be similar to the below;

~~~~
location = /app/db/viro.db {
        internal;
}
~~~~
