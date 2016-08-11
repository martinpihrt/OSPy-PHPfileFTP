# OpenSprinkler Py (OSPy) PHP files  

This PHP (tested in PHP7) files is support files for OSPy plugin: [Remote_FTP_Control] (https://github.com/martinpihrt/OSPy-plugins-temp/tree/master/plugins/remote_ftp_control)  

If you have no public IP address for control your OSPy system, you can use this system (FTP plug-in in OSPy and this PHP code on your server).

* On the your Web server will place these files (after unpacking the zip file).  
* Download PHP for Remote FTP Control.zip files from github.  
* On the WEB server use .htaccess and .htpasswd files for secured login for your OSPy control.  

<b>Preview from my website control</b><br>  
<img src="index preview.png" width="100%">

# Setup (example for [wedos servers](https://hosting.wedos.com/cs/) and [access control](https://kb.wedos.com/cs/htaccess/zaheslovani-adresare.html) )  

On our web hosting can be an easy way to obtain a directory and its entire contents with a password, so it gets the visitor only after entering the correct username and password. In the following example password protection subdirectory secretly, ie what is accessible at http: // yourdomain / secret /.  

The relevant directory www / secret, create a .htaccess file with the following content:  

AuthUserFile /data/web/virtuals/2222/virtual/www/tajne/.htpasswd  
AuthGroupFile / dev / null  
AuthName "Title secret part"  
AuthType Basic  
Require valid-user  
Order deny, allow  

The path to the .htpasswd file, you must replace the number in 2222 number of your web host (this number is part of your logins to the FTP and databases). Then you need to create a file .htpasswd, which will create a list of users and their passwords. Says one user per line - on the line to indicate the login name and a colon followed by a password hashed form. To create a file content using htpasswd .htpasswd [generator](http://www.htaccesstools.com/htpasswd-generator/).  

Example .htpasswd file content:  
john: $ apr1 $ 5cK3b4YD $ qVGM7CbNIrjTScxrv2TdQ /  

This is done all while accessing the URL of the browser requests a username and password.  

If after this setting displays error 500, make sure that you have a .htaccess file, everything is entered correctly including the correct absolute path to the file .htpasswd.  

# License  

OpenSprinkler Py (OSPy) PHP files for plug-ins. Creative Commons Attribution-ShareAlike 3.0 license.
