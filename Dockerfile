# PHPのバージョン指定
FROM php:8.1.1-apache

# 必要なパッケージをインストール
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libonig-dev \
        libzip-dev \
        zip \
        unzip \
        git \
        && docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql mbstring exif pcntl bcmath zip \
        && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# ドキュメントルートの設定
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# php.iniの設定をコピー
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

# 作業ディレクトリを設定
WORKDIR /var/www/html

# LaravelプロジェクトをDocker内にコピー
COPY . .

# パッケージのインストールとキャッシュのクリア
RUN composer install --no-interaction --optimize-autoloader --no-scripts \
        && composer clear-cache

# ストレージとキャッシュのパーミッション設定
RUN chmod -R 777 storage bootstrap/cache

# ポートの設定
EXPOSE 80


