Whats'up Project with Symfony 2.4
=================================

Welcome to the Whats'up project - a fully-functional Symfony2.

This document contains information on how to download, install, and start. 

1) Installing 
----------------------------------

First clone the projet

    git clone https://github.com/wallish/whatsup.git
    
If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command (in the project folder):

    curl -s http://getcomposer.org/installer | php

If you downloaded an archive "without vendors", you also need to install all
the necessary dependencies. Download composer (see above) and run the
following command:

    php composer.phar install

2) Generate database with doctrine
-----------------------------------

It will automatically create database and table

    php app/console doctrine:database:create
    php app/console doctrine:schema:update --force

3) Url without vhost
-----------------------------------

    http://localhost/whatsup/web/app_dev.php/whatsup/index/index/
