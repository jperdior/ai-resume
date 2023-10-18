FROM node:18-alpine3.17 as build

# make the 'app' folder the current working directory
WORKDIR /app

USER root

# copy both 'package.json' and 'package-lock.json' (if available)
COPY package.json /app
COPY yarn.lock /app

RUN cat package.json > package_contents.log

# install project dependencies
RUN yarn cache clean
RUN yarn install

FROM node:18-alpine3.17
WORKDIR /app
COPY --from=build /app/node_modules ./node_modules
# copy project files and folders to the current working directory (i.e. 'app' folder)
COPY . .

# build app for production with minification
CMD [ "yarn", "devdocker" ]