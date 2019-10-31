# The twitter-blog
This project is a mix of a blog and a twitter feed. This is a coding challenge.

## Installation
To run this project you'll need to run the following commands that will clone the project, cd into it, 
install PHP dependencies and copy the example env file to put your own credentials in there.

```bash
git clone https://github.com/rraspo/twitter-blog
cd twitter-blog
composer install 
cp .env.example .env
```

Now, we'll open .env in any editor you like to set 2 important set of credentials: database and twitter keys (if you got em).

```bash
code .env
```

Now that we have a fresh database access and a `.env` file created, let's setup the app key, run the migrations 
and the app seeder.

```bash
php artisan key:generate
php artisan migrate
php artisan seed
```

Before we access our application, we need to run some commands to get the frontend running

```bash
npm install
npm run dev
```

This will install frontend dependencies and allow you to actually see the website the way it is supposed to look.

## Serving the site

Since this is a Laravel project, the easiest way to serve it is by running:

```bash
php artisan serve
```

This will spin up a single-threaded PHP web server that will allow you to access your application on 
`localhost` at port `8000` by default. 
