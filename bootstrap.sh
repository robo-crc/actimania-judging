#!/usr/bin/env bash

###
# Vagrant Bootstrap for the CRC Nemolition 2014 Judging
# 
# @author Michael Sanford
# @description This script is run within with Vagrant virtual machine and configures
#              the server for use. It can be kept up to date with new configurations
#              and packages.
###

# Like 'use strict'; for bash
#set -u

# Force apt & dpkg to behave in unattended mode.
export DEBIAN_FRONTEND=noninteractive

function log {

	local message=${1:-MESSAGE}
	local error=${2:-0}

	if [ $error -eq 1 ]; then
		echo -e "ERROR: ${FUNCNAME[0]}"
		echo -e "${MESSAGE}" >> /home/vagrant/error.log || return 1;
	else
		echo -e "NOTICE: ${MESSAGE}" >> /home/vagrant/error.log;
	fi
}

# Add "dev.local" to VM's host file
sed -i.bak '/^127.0.0.1/ s/$/ judging.robo-crc.ca/' /etc/hosts

###
# Update the system (but DO NOT dist-upgrade !)
###
apt-get update
apt-get upgrade
apt-get -y install build-essential

###
# Handy client tools
###
sudo apt-get -y install vim

###
# Install libraries
###
#apt-get -y install libtidy-dev curl libcurl4-openssl-dev libcurl3 libcurl3-gnutls zlib1g zlib1g-dev libxslt1-dev libzip-dev libzip2 libxml2 libsnmp-base libsnmp15 libxml2-dev libsnmp-dev libjpeg62 libjpeg62-dev libpng12-0 libpng12-dev zlib1g zlib1g-dev libfreetype6 libfreetype6-dev libbz2-dev libmcrypt-dev libmcrypt4 libtool openssl courier-imap courier-authlib courier-authlib-dev libc-client2007e libedit2 libedit-dev
#apt-get -y install postgresql-9.1 postgresql-plpython-9.1 libsqlite3-0 libsqlite3-dev sqlite3

###
# Install server packages
#
# YES I KNOW THIS VERSION OF CODEIGNITER REQUIRES PHP5-MYSQLND WHICH USES MYSQL_CONNECT WHICH SUCKS AND IS DANGEROUS
# SO PLEASE ACCEPT MY APOLOGIES AND COMPLAIN TO THE ORIGINAL MAINTAINERS 2 YEARS AGO IF YOU'RE REALLY SORE ABOUT IT.
###
apt-get -y install apache2 apache2-mpm-prefork memcached mysql-client mysql-server
apt-get -y install php5 php5-cgi php5-cli php5-dev php-pear spawn-fcgi libapache2-mod-php5
apt-get -y install php-apc php5-memcached php5-sqlite php5-xdebug php5-mcrypt php5-intl php5-xmlrpc php5-mysqlnd

# Apache needs mod-rewrite
ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled

cat << EOVHOST > /etc/apache2/sites-available/nemolition
<VirtualHost *:80>
	ServerName judging.robo-crc.ca
	ServerAlias localhost
	DocumentRoot "/var/www"

	ErrorLog "/var/log/apache2/crc_judging_error_log"
	CustomLog "/var/log/apache2/crc_judging_log" common

	<Directory "/var/www/">
		Options Indexes FollowSymLinks MultiViews
		AllowOverride All
		Order allow,deny
		Allow from all

		RewriteEngine On
		RewriteBase /
		RewriteRule (.*) index.php [qsa]

		FileETag all
	</Directory>
</VirtualHost>
EOVHOST

mysql -u root < /home/vagrant/judging/innstall.sql

# Make sherpa the default virtual host
unlink /etc/apache2/sites-enabled/000-default
ln -s /etc/apache2/sites-available/nemolition /etc/apache2/sites-enabled/000-default

sed -i.bak -e 's/;date.timezone =/date.timezone = "America\/Montreal"/' /etc/php5/cli/php.ini
sed -i.bak -e 's/;date.timezone =/date.timezone = "America\/Montreal"/' /etc/php5/cgi/php.ini

cat <<EOMEMCACHED >> /etc/php5/conf.d/memcached.ini
session.save_handler = memcached
session.save_path = "127.0.0.1:11211"
EOMEMCACHED

# Restart affected services
service memcached restart
service apache2 restart

###
# Clean up
###
echo ">> Cleaning up"

apt-get -y autoremove
apt-get -y autoclean

# User space
updatedb
