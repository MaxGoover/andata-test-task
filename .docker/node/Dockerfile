ARG NODE_VERSION

FROM node:${NODE_VERSION}-alpine as base
WORKDIR /home/node/app
RUN yarn global add @quasar/cli
COPY . .

FROM base as build-stage
RUN yarn install
RUN yarn quasar build

FROM base as development
CMD ["/bin/sh", "-c", "yarn && yarn quasar dev"]

# FROM nginx:alpine as production
# COPY --from=build-stage /home/node/app/dist/spa /usr/share/nginx/html
# COPY .docker/default.conf /etc/nginx/conf.d/default.conf
# EXPOSE 80
# CMD ["nginx", "-g", "daemon off;"]
