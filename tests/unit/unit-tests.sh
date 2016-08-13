#!/bin/bash
# Script for preparing the unit tests

BASE="$1"

set -e

# Make sure all dev dependencies are installed
composer install

# Setup databases for testing
if [[ $TRAVIS_PHP_VERSION != hhvm ]]; then mysql -e 'create database joomla_ut;'; fi
if [[ $TRAVIS_PHP_VERSION != hhvm ]]; then mysql joomla_ut < tests/unit/schema/mysql.sql; fi
if [[ $TRAVIS_PHP_VERSION = hhvm ]]; then mysql -u root -e 'create database joomla_ut;'; fi
if [[ $TRAVIS_PHP_VERSION = hhvm ]]; then mysql -u root joomla_ut < tests/unit/schema/mysql.sql; fi
psql -c 'create database joomla_ut;' -U postgres
psql -d joomla_ut -a -f tests/unit/schema/postgresql.sql

# Set up Apache
# - ./build/travis/php-apache.sh
# Enable additional PHP extensions

if [[ $INSTALL_MEMCACHE == "yes" ]]; then phpenv config-add build/travis/phpenv/memcached.ini; fi
if [[ $INSTALL_MEMCACHED == "yes" ]]; then phpenv config-add build/travis/phpenv/memcached.ini; fi
if [[ $INSTALL_APC == "yes" ]]; then phpenv config-add build/travis/phpenv/apc-$TRAVIS_PHP_VERSION.ini; fi
if [[ $INSTALL_APCU == "yes" && $TRAVIS_PHP_VERSION = 5.* ]]; then printf "\n" | pecl install apcu-4.0.10 && phpenv config-add build/travis/phpenv/apcu-$TRAVIS_PHP_VERSION.ini; fi
if [[ $INSTALL_APCU == "yes" && $TRAVIS_PHP_VERSION = 7.* ]]; then printf "\n" | pecl install apcu-beta && phpenv config-add build/travis/phpenv/apcu-$TRAVIS_PHP_VERSION.ini; fi
if [[ $INSTALL_APCU_BC_BETA == "yes" ]]; then printf "\n" | pecl install apcu_bc-beta; fi
if [[ $INSTALL_REDIS == "yes" && $TRAVIS_PHP_VERSION != hhvm ]]; then phpenv config-add build/travis/phpenv/redis.ini; fi
if [[ $INSTALL_REDIS == "yes" && $TRAVIS_PHP_VERSION = hhvm ]]; then cat build/travis/phpenv/redis.ini >> /etc/hhvm/php.ini; fi
