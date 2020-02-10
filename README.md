# Simple books catalog

This is a simple catalog of books. Main goal is create a CRUD app, login module and use role system in the project (i.e. admin & user).

# How to start app

- Clone this project in directory (basic data already exists in the database)
```git exclude
git clone https://github.com/don-ostapenko/books_eloquent_docker.git
```
- Go to the project directory and execute command below (but you must have a docker on your machine)
```docker
docker-compose up -d
```
- Execute command
```docker
docker-compose run --rm web composer install
```
- Go to _http://127.0.0.1:8001/_ and use next data for the sign in (admin & user resp.)
```
email:      admin@gmail.com
password:   pass
```
```
email:      user@gmail.com
password:   pass
```