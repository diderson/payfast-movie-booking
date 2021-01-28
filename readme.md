# Movie Booking Application

Built using Laravel Framework in order to speed up the development. Simple booking system for movie ticket

## Local Development

### Requirements for Docker setup

- Docker CE v17.12.0+, installation guides for [Ubuntu](https://docs.docker.com/engine/installation/linux/docker-ce/ubuntu/) and [Mac](https://docs.docker.com/docker-for-mac/install/)
- Docker compose [installation guide](https://docs.docker.com/compose/install/)

#### Setup

Copy the contents of `src/.env.example` to `src/.env`. change the values accordingly

From the root directory boot the application. If you get a **permissions** error you will have to run the commands with `sudo`.

```sh
docker-compose up -d or docker-compose up to monitor the containers
```
** for the firsy setup on local u may want to seed data so ssh the apache container then poit to www and run the necessary codes

`docker exec -it apache bash` and `cd www`

```sh
php artisan migrate:fresh --seed
```

### Requirements for non docker environment

- php >=7.3
- composer
- mysql >= 5.7
- npm
- node

### Setup 

Copy the contents of `src/.env.example` to `src/.env`. and change the values accordingly

run the app from `src` folder: php artisan serve 

### fisrt run after setup

always run artisan command from src folder:

- npm install
- npm run dev
- install dummy data: `php artisan migrate:fresh --seed`

