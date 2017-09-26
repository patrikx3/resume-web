FROM ubuntu:latest
MAINTAINER patrikx3/resume - Patrik Laszlo
ENV COMPOSER_PROCESS_TIMEOUT=3600
# install
#RUN apt-get -y install git php7.0 php7.0-gd php7.0-mbstring php7.0-curl php7.0-fpm  php-xdebug nginx nodejs composer phpunit npm supervisor unzip zip telnet lynx mc nano inetutils-ping
RUN apt-get update
RUN apt-get install software-properties-common -y

RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get -y install git
RUN apt-get -y install php --allow-unauthenticated
RUN apt-get -y install php-gd --allow-unauthenticated
RUN apt-get -y install php-mbstring --allow-unauthenticated
RUN apt-get -y install php-curl --allow-unauthenticated
RUN apt-get -y install php-fpm --allow-unauthenticated
RUN apt-get -y install php-xml --allow-unauthenticated
RUN apt-get -y install php-xdebug --allow-unauthenticated
RUN apt-get -y install nginx
RUN apt-get -y install curl

# node
RUN curl -sL https://deb.nodesource.com/setup_8.x | bash -
RUN apt-get -y install nodejs
RUN nodejs -v

RUN curl -o /usr/bin/phpdoc -L https://github.com/phpDocumentor/phpDocumentor2/releases/download/v2.9.0/phpDocumentor.phar
RUN chmod 0777 /usr/bin/phpdoc

RUN apt-get -y install composer
RUN apt-get -y install supervisor
RUN apt-get -y install unzip
RUN apt-get -y install zip

RUN mkdir resume-web
RUN npm install --unsafe-perm bower -g
RUN npm install --unsafe-perm grunt -g
RUN npm install --unsafe-perm yarn -g
RUN git clone https://github.com/patrikx3/resume-web.git --progress
WORKDIR /resume-web

RUN apt-get install -y build-essential

RUN yarn install --unsafe-perm
RUN export COMPOSER_PROCESS_TIMEOUT=6000
RUN bower install --allow-root
RUN composer install

RUN grunt
RUN ln -s /resume-web/deployment/vendor/bin/phpunit /usr/bin/phpunit
RUN chmod +x /usr/bin/phpunit
RUN phpunit
RUN mkdir -p /run/php
RUN echo "cgi.fix_pathinfo = 0;" >> /etc/php/7.0/fpm/php.ini
RUN echo "max_input_vars = 10000;" >> /etc/php/7.0/fpm/php.ini
RUN echo "max_execution_time = 10000;" >> /etc/php/7.0/fpm/php.ini
RUN echo "date.timezone = Europe/Paris;" >> /etc/php/7.0/fpm/php.ini
RUN sed -i 's/;daemonize = yes/daemonize = no/g' /etc/php/7.0/fpm/php-fpm.conf
RUN apt-get autoremove
RUN apt-get autoclean
RUN apt-get clean
COPY artifacts/docker-files /
RUN chmod +x /run.sh
RUN chmod 0777 -R /resume-web
RUN chown -R www-data:www-data /resume-web
EXPOSE 80 8080 8443 443
CMD ["/run.sh"]

#docker login
#docker build -t patrikx3/resume .
#docker tag IMAGE_ID patrikx3/resume:latest
#docker push patrikx3/resume
#docker run -h docker-patrikx3-resume -p 8080:8080 -t -i patrikx3/resume
#docker images
#docker rmi -f IMAGE_ID

#php-cgi.exe -b 127.0.0.1:9000

