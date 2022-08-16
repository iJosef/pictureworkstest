# Pictureworks Laravel Coding Test

## Introduction

Migration of a non-OO legacy application, including all logic, behavior and workflows, into a Laravel/Eloquent framework with working data persistency with a database.


## Table of Contents
1. <a href="#how-it-works">How it works</a>
2. <a href="#technology-stack">Technology Stack</a>
3. <a href="#functionalities">Functionalities</a>
4. <a href="#routes">Routes</a>
5. <a href="#setup">Setup</a>


## Technology Stack
  - [PHP](https://www.php.net)
  - [Laravel](https://laravel.com)
  - [PostgreSQL](https://www.postgresql.org/)
  ### Testing tools
  - [PHPUnit](https://phpunit.de) 

## Functionalities
* GET user's comment based on URL params
* POST user's comment from form fields to append to existing comment by same user
* POST user's comment through JSON object to append to existing comment by same user
* Command line execution to append comment to user's existing comment.

## Routes

### Base URL = http://127.0.0.1/:8000/
Available routes and guide
Method | Route | Description | Payload
--- | --- | ---|---
`GET` | `/user/add-comment` | form view to append comment to existing comment | 
`POST` | `/user/comment/form` | append comment to existing comment through form view | id, password and comment
`GET` | `/user/{id}` | view appended comments on a single user card | 
`POST` | `/api/user/comment/json` | Submit request to append comment to existing comment a user through jSON object | id, password and comment
`ARTISAN COMMAND` | `append:comments {id} {comments}` | append comment to existing comment through artisan command | id and comment (eg php artisan append:comments 1 "Hello World")

## Setup
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

  #### Getting Started
  - Open terminal and run the following commands
    ```
    $ git clone https://github.com/iJosef/pictureworkstest
    $ cd pictureworkstest
    $ composer install
    ```
    - copy .env.example and paste in .env file

    ```
    $ php artisan key:generate
    $ php artisan migrate --seed
    $ php artisan serve
    ```
    If all goes well 
  - Visit http://127.0.0.1/:8000 on your browser to view laravel home
  
  if Seeding goes well, you should also get an email in your mailHog for testing purpose
  ### User Static Password Value
        720DF6C2482218518FA20FDC52D4DED7ECC043AB
  ### Testing
  ```
  $ php artisan test
  ```
  If correctly setup, all tests should pass
  
