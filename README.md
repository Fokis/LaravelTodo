First of all don’t judge me too harshly. This project was made in one weekend, basically with zero knowledge of Laravel and I have quite big mess in my head after it :)

So this is a simple todo application with few features:
1. It is user based, so each user will have own todo list
2. It have preset of categories to help you arrange your todos better

What was used:
Laravel - version 8.10
Laradock - easy to go with docker
Laravel ui - auth and easy to start with vue and bootrap
Vue - front end js framework
Bootsrap - front end css framework

You wouldn’t find history of commits, because I was working locally doing a lot of experiments and trying different stuff.

Installation
- open terminal
- navigate to project root
- cp .env.example .env 
- git submodule init 
- git submodule update
- cd laradock
- cp env-example .env 
- docker-compose up -d nginx mysql
- composer install
- npm install
- npm run dev
- php artisan migrate

You also can run composer and npm locally if you want.


Notes:
- I’ve was sort of confused that Laravel doing same things with dependency injections, Facades, Contracts and even sometimes with helpers. I was trying different approaches here and there, so it is not unified. Overall I would prefer more dependency injection style.
- I’ve didn’t use localisation - was to busy with all other stuff
- I’ve didn’t use seeds or model factories, this might improve my tests
- I’ve cleaned up my code from my experiments, but it is still possible that something was forgotten