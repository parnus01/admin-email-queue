#  Demo system to send e-mail with queue

 - PHP 7.1
 - MySQL 5.7
 - Vue.js
 - Redis

## Run
Clone the repo
```sh
git clone hhttps://github.com/parnus01/admin-email-queue.git
cd admin-email-queue
```

Start everything with docker

Install [Docker](https://docs.docker.com/) and [Docker Compose](https://docs.docker.com/compose/)

** 
For the first compose it will take some time to install the image and install the required packages
```sh
docker-compose up -d
```

## Quickstart
After start all container 

**You need to setup your SMTP configuration in .ENV file**
- ladning to  http://localhost:8091/
- add email / title / recipients 
- submit to queue system

## Container

- `app` - For provide php application.
- `web` - For including nginx module .
- `node` - For install JS package and Compile all assets.
- `database` - For keep persist data of tasks.
- `composer` - For install php package and run all require command of laravel.
- `php-queue` - For process new jobs as they are pushed onto the queue. 
- `redis` - For queue driver.