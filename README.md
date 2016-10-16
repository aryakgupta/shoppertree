# shoppertree

Setup shopperTree project::

    create config.php in root and admin folder and intilize it with config_sample.php file
    create logs directory under system folder and give write permission. Similarly create cache folder and give write permission.
    cd system; mkdir logs; mkdir cache; sudo chmod 777 logs; sudo chmod 777 cache
    create cache directory under image and give write permission

sudo apt-get install mysql-server sudo apt-get install nginx sudo apt-get install php5 sudo apt-get install php5-fpm sudo apt-get install php5-mysql sudo apt-get install php5-mysqlnd sudo apt-get install php5-gd sudo service php5-fpm restart

Setup nginx for php-fpm:: Set up NGINX section of https://support.rackspace.com/how-to/install-nginx-and-php-fpm-running-on-unix-file-sockets/
