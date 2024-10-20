FROM composer:latest AS build
WORKDIR /app
COPY ./ .
COPY ./docker/build.sh .
RUN pwd
RUN ls -al
# Make the script executable
RUN chmod +x build.sh
RUN ./build.sh
