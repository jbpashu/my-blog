Symfony Demo Application
========================

The "Blog Demo Application" is a blog application.

Requirements
------------

  * PHP 5.5.9 or higher;
  * PDO-SQLite PHP extension enabled;
  * and the [usual Symfony application requirements](https://symfony.com/doc/current/reference/requirements.html).

If unsure about meeting these requirements, download the demo application and
browse the `http://localhost:8000/config.php` script to get more detailed
information.

Installation
------------

Clone this application on you local using following command:

```bash
$ mkdir blog_demo
$ cd blog_demo
$ git clone https://github.com/jbpashu/my-blog.git
$ composer install --no-interaction

```

Usage
-----

There is no need to configure a virtual host in your web server to access the application.
Just use the built-in web server:

```bash
$ cd blog_demo/
$ php bin/console server:run
```

This command will start a web server for the Symfony application. Now you can
access the application in your browser at <http://localhost:8000>. You can
stop the built-in web server by pressing `Ctrl + C` while you're in the
terminal.

> **NOTE**
>
> If you want to use a fully-featured web server (like Nginx or Apache) to run
> Symfony Demo application, configure it to point at the `web/` directory of the project.
> For more details, see:
> https://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html

Accessing API
---------------
There are two API endpoints have been created to check API documents please check <http://127.0.0.1:8000/api/doc> or <http://localhost:8000>.
1. GET /{_locale}/api/blogs/list.{_format} -  This will give you a list of all the blog created.
2. GET /{_locale}/api/blogs/posts/{id} - This will give you a detailed view of the blog you just need to pass the blog id.

Use API Doc Sandbox to test these APIs in browser.

You can use curl also to hit above REST APIs:
1. Get list of all blogs:
curl -X "GET" -H "Content-type:\ application/x-www-form-urlencoded" http://127.0.0.1:8000/en/api/blogs/list.json

2. Get info of specific blog by ID:
curl -X "GET" -H "Content-type:\ application/x-www-form-urlencoded" http://127.0.0.1:8000/en/api/blogs/posts/3/info.json

Unit Testing
---------------
You can perform unit testing also on this project using following commands:

Linux or Mac OS
---------------
```bash
$ cd blog_demo/
$ ./vendor/bin/simple-phpunit
```

Windows
---------------
```bash
$ cd blog_demo/
$ vendor\bin\simple-phpunit
```