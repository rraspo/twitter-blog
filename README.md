# The twitter-blog
This project was implemented using Laravel with react scaffolding.
This project's functionality is a mix of a blog and a twitter feed. This is a coding challenge.

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
php artisan db:seed
```

Before we access our application, we need to run some commands to get the frontend running

```bash
npm install
npm run dev
```

This will install frontend dependencies and allow you to actually see the website the way it is supposed to look.

## Testing
This project uses Laravel Dusk to run its tests, so all you have to do is run the following commands:

```bash
php artisan dusk:install
rm tests/Browser/ExampleTest.php
php artisan dusk
```
These commands will install and run the automated browser tests. Should return no errors.

## Serving the site
Since this is a Laravel project, the easiest way to serve it is by running:
```bash
php artisan serve
```
This will spin up a single-threaded PHP web server that will allow you to access your application on 
`localhost` at port `8000` by default. 
In case you follow one of the two server setups that follow down below, make sure to edit your `etc/hosts` file to add a custom domain to point to your localhost.
```bash
sudo vi /etc/hosts
```
And write the following to the end of the file: `127.0.0.1 twitter-blog.local`

### Apache (untested)

In case you run apache, you can run the following commands to enable this app with apache:
```bash
cp .htaccess.example .htaccess
cp apache_twitter-blog.conf {path_to_apache}/sites-available/twitter-blog.local # example domain name, change it as you please
```
Make sure to restart apache before trying to access the site.

### Nginx

![Warning](https://static3.bigstockphoto.com/thumbs/3/0/5/small2/50398103.jpg) 
This nginx file config or setup has not yet been updated to protect you against latest [security vulnerabilities](https://thehackernews.com/2019/10/nginx-php-fpm-hacking.html). So make sure you don't use this setup directly to dev/staging/production environments.

For Nginx, which is the one I use, we'll do something pretty similar, assuming you already added the `/etc/hosts` entry for our domain name and a valid nginx running conf.
Let's copy the example conf file to nginx vhosts analog directory:
```bash
# Before copying remember to replace your real absolute path for the project root in this file
vi nginx_twitter-blog.conf
# assuming default nginx install dir
cp nginx_twitter-blog.conf /usr/local/etc/nginx/sites-available/twitter-blog.local
ln -s /usr/local/etc/nginx/sites-available/twitter-blog.local /usr/local/etc/nginx/sites-enabled
```
After running these commands above, restart nginx and you should be able to see the website working!
