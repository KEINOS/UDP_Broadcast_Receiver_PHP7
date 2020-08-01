FROM php:7-cli-alpine

USER root

# Install the "sockets" PHP extension module since the base image doesn't
# include this extension.
RUN php -m | grep sockets || docker-php-ext-install sockets

ARG port_udp_broadcast=5963
ARG name_host_self='receiver_php7'
ARG time_interval_send=5

ENV NAME_HOST_SELF=$name_host_self\
    PORT_UDP_BROADCAST=$port_udp_broadcast \
    TIME_INTERVAL_SEND=$time_interval_send

COPY ./receiver.php /app/receiver.php

ENTRYPOINT [ "/usr/local/bin/php", "/app/receiver.php" ]
