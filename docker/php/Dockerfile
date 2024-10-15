FROM composer:2.7 AS composer
FROM spiralscout/roadrunner:2024.2 AS roadrunner
FROM mlocati/php-extension-installer:2.4 AS php-extension-installer
FROM php:8.3-cli-bookworm AS dev-php

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=roadrunner /usr/bin/rr /usr/bin/rr
COPY --from=php-extension-installer /usr/bin/install-php-extensions /usr/bin/install-php-extensions

ARG UID=10001
ARG GID=10001

RUN <<EOF
  groupmod --gid=${GID} www-data
  usermod --uid=${UID} --gid=${GID} www-data
EOF

RUN <<EOF
  apt-get update
  apt-get install --no-install-recommends --no-install-suggests -q -y \
          unzip
EOF

RUN <<EOF
  install-php-extensions opcache intl pcntl sockets protobuf
  apt-get remove -q -y \
          ${PHPIZE_DEPS} \
          ${BUILD_DEPENDS}
EOF

WORKDIR /app

RUN chown www-data:www-data /app

USER www-data

FROM dev-php AS prod-php

ENV COMPOSER_CACHE_DIR=/tmp/composer/cache

COPY ./composer.json ./composer.lock ./symfony.lock ./

RUN \
    --mount=type=cache,uid=${UID},gid=${GID},target=/tmp/composer/cache \
    composer install --no-dev --no-scripts --no-autoloader --prefer-dist --no-progress --no-interaction

COPY --chown=www-data:www-data ./ ./

RUN \
    --mount=type=cache,uid=${UID},gid=${GID},target=/tmp/composer/cache \
    composer dump-autoload --classmap-authoritative --no-dev
