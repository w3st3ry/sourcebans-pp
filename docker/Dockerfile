FROM webdevops/php-nginx:alpine-php7

# Represents Sourcebans version
ENV SBPP_VERSION=1.6.3

# Reprents actions needed at container startup
ENV SBPP_INSTALL=false
ENV SBPP_UPDATE=false

RUN mkdir -p /opt/docker/sbpp

WORKDIR /opt/docker/sbpp

RUN curl -Ls https://github.com/sbpp/sourcebans-pp/releases/download/${SBPP_VERSION}/sourcebans-pp-${SBPP_VERSION}.webpanel-only.tar.gz -o sbpp.tar.gz && \
    tar -zxvf sbpp.tar.gz && \
    rm sbpp.tar.gz && \
    chown -R application:application .

WORKDIR /app

ADD ./nginx/php.ini /opt/docker/etc/php/php.ini
ADD ./nginx/vhost.conf /opt/docker/etc/nginx/vhost.conf
ADD ./sbpp-entrypoint.sh /opt/docker/provision/entrypoint.d/.

RUN chmod +x /opt/docker/provision/entrypoint.d/sbpp-entrypoint.sh

USER application
