#!/usr/bin/env bash

usage="Usage:
  bin/docker.sh [command]

Available commands:
  install               Installation (or re-installation)
  start                 Start docker containers
  stop                  Stop docker containers
  reset                 Reset the project (composer, cache, database)
  composer              Composer
  console               Symfony console
  php                   Launch command in php container
  bash                  Open a bash console in php container
"
docker="docker"
docker_exec="docker exec -ti"
docker_compose="docker-compose"
php_container=portal-php

if [ $# == 0 ] || [ $1 == "--help" ]; then
    echo "$usage"
    exit 1;
fi

function reset_project
{
    ${docker_exec} ${php_container} /bin/bash -c "composer install --prefer-dist"
    ${docker_exec} ${php_container} /bin/bash -c "bin/console doctrine:database:drop --force"
    ${docker_exec} ${php_container} /bin/bash -c "bin/console doctrine:database:create"
    ${docker_exec} ${php_container} /bin/bash -c "bin/console doctrine:schema:create"
}

function install_fixtures
{
    ${docker_exec} ${php_container} /bin/bash -c "bin/console khepin:yamlfixtures:load"
}

function start
{
    ${docker_compose} up -d
}

function stop
{
    ${docker_compose} stop
}

function change_mod
{
    ${docker_exec} ${php_container} /bin/bash -c "chmod -R 777 var/*"
}

function bash
{
    ${docker_exec} ${php_container} /bin/bash
}

if [ $1 == "install" ]; then
    start
    reset_project
    change_mod
    install_fixtures
elif [ $1 == "start" ]; then
    start
    change_mod
elif [ $1 == "stop" ]; then
    stop
elif [ $1 == "reset" ]; then
    reset_project
elif [ $1 == "php" ]; then
    ${docker_exec} ${php_container} /bin/bash -c "php ${@:2}"
elif [ $1 == "console" ]; then
    ${docker_exec} ${php_container} /bin/bash -c "php bin/console ${@:2}"
elif [ $1 == "bash" ]; then
    ${docker_exec} ${php_container} /bin/bash
elif [ $1 == "composer" ]; then
    ${docker_exec} ${php_container} /bin/bash -c "composer ${@:2}"
else
    echo "argument error"
    echo "$usage"
    exit 1;
fi
