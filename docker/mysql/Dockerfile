FROM mysql:5.7

COPY docker/mysql/docker-healthcheck /usr/local/bin/

HEALTHCHECK CMD ["docker-healthcheck"]