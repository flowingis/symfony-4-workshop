FROM node:10.15.0

RUN mkdir -p /home/node/app
WORKDIR /home/node/app

COPY ./app/package.json package.json
COPY ./app/yarn.lock yarn.lock

RUN yarn install