ARG PHP_VERSION=""
FROM php:${PHP_VERSION}-apache

ENV APACHE_CONF_DIR=/etc/apache2

RUN apt-get update  -yqq && \
  apt-get upgrade -y && \
  apt-get install -y --no-install-recommends \
	vim \
  	nano \
  	git \
    curl \
    libmemcached-dev \
    libz-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libssl-dev \
    libmcrypt-dev \
    libicu-dev \
    libxml2-dev \
  && rm -rf /var/lib/apt/lists/*

# Install intl
RUN docker-php-ext-install intl

# Install SOAP
RUN docker-php-ext-install soap

# Install the PHP pdo_mysql extention
RUN docker-php-ext-install pdo_mysql \
  # Install the PHP pdo_pgsql extention
  && docker-php-ext-install pdo_pgsql \
  # Install the PHP gd library
  && docker-php-ext-configure gd \
    --with-jpeg-dir=/usr/lib \
    --with-freetype-dir=/usr/include/freetype2 && \
    docker-php-ext-install gd


# Install OPCache
RUN docker-php-ext-install opcache
COPY .cloud/docker/php/conf/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

# Install Imagick extension
# imagick

ARG INSTALL_IMAGEMAGICK=false

RUN if [ ${INSTALL_IMAGEMAGICK} = true ]; then \
    apt-get update \
	&& apt-get install -y \
		libmagickwand-dev --no-install-recommends \
		ghostscript --no-install-recommends \
	&& pecl install \
		imagick \
	&& docker-php-ext-enable \
		imagick \
	&& apt-get purge -y \
		libmagickwand-dev \
;fi

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Apache
RUN a2enmod rewrite remoteip headers
COPY .cloud/docker/php/conf/vhost.conf ${APACHE_CONF_DIR}/sites-enabled/app.conf
RUN a2dissite 000-default

# SSL

ARG APP_HOST=""
ARG INSTALL_SSL=false

RUN if [ ${INSTALL_SSL} = true ]; then \
    mkdir ${APACHE_CONF_DIR}/ssl \
        && openssl req -new -newkey rsa:4096 -days 3650 -nodes -x509 -subj \
                "/C=FR/ST=Loire/L=Saint-Étienne/O=Webqam/CN=${APP_HOST}" \
                -keyout ${APACHE_CONF_DIR}/ssl/ssl.key -out ${APACHE_CONF_DIR}/ssl/ssl.crt \
        && a2enmod ssl \
;fi

# Clean repos
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

ARG APP_CODE_PATH_CONTAINER=/var/www

WORKDIR ${APP_CODE_PATH_CONTAINER}