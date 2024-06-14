ARG NODE_VERSION

FROM node:${NODE_VERSION} as build-stage
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY ./ .
RUN npm run build

FROM nginx as production-stage
EXPOSE 3000
RUN mkdir /app
COPY nginx/nginx.conf /etc/nginx/conf.d/default.conf
COPY --from=build-stage /app/dist/spa /app
