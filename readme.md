# Movie Booking Application

## Local Development

### Requirements for Docker setup

- Docker CE v17.12.0+, installation guides for [Ubuntu](https://docs.docker.com/engine/installation/linux/docker-ce/ubuntu/) and [Mac](https://docs.docker.com/docker-for-mac/install/)
- Docker compose [installation guide](https://docs.docker.com/compose/install/)

### Setup with docker

Copy the contents of `src/.env.example` to `src/.env`.

From the root directory boot the application. If you get a **permissions** error you will have to run the commands with `sudo`.
```sh
docker-compose up -d or docker-compose up to monitor the containers
```

### Requirements for non docker environment

- php >=7.3
- composer
- mysql >= 5.7

### Setup with docker
Copy the contents of `src/.env.example` to `src/.env`. and change the values accordingly

run the app from `src` folder: php artisan serve 

### fisrt setup

install dummy data

