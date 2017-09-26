#!/usr/bin/env bash
#this need to use LF !! NOT CR/LF!!

pushd /resume-web

case $1 in
        "other")
                ;;
        "other-2")
                ;;
        *)
                ;;
esac

git checkout .
git pull
yarn install --unsafe-perm
composer update --no-interaction
bower update --allow-root
php cli.php mpdf
phpunit
grunt
chown -R www-data:www-data /resume-web
/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
popd
