How to install this outstanding project
=================

1 / Before we start
------------------------

First of all, you will need PHP 7.3.12. 

2 / Clone the project
------------------------

```bash
$ git clone https://github.com/AlexisBrgs/quackNet.git
```

2 / Go into the directory
------------------------

```bash
$ cd quackNet
```

3 / Install composer 
------------------------

```bash
$ composer install
$ composer --version
```

You should have **at least** the 1.10.1 version.

4 / Install npm 
-------------------

```bash
$ npm install
$ npm -v
```
You should have **at least** the 6.14.4 version.

5 / Execute the new symfony commands
-------------------

```bash
$ symfony check:requirements
```

If something is missing and the configuration is not OK, you can google it or you can go fry an egg ! 

6 / Database configuration
-------------------
Before we start, you will have to configure your database.
Go to your `.env` file and set your DATABASE_URL variable like this : 

`DATABASE_URL=mysql://<username>:<password>@127.0.0.1:3306/<database_name>`

You can call the database like mine : `quack_db` :)


7/ Execute some doctrine commands
-------------------

We will make three important steps here : 
1. Create the database
```bash
$ php bin/console d:d:c
```

2. Create the schema of it (i.e the relations between entities
```bash
$ php bin/console d:s:c
```

3. Load some fixtures, because Symfony provides a powerful tool which is "fake datas"
```bash
$ php bin/console d:s:c
```

Nota : You will have to user already registered with those fixtures :

A First user : `toto@toto.com` with the password : `toto`
<br> A second user : `tata@toto.com` with the password : `tata`

We will test this soon, be patient for god's sake ! 


8 / Last step
----------------------

The final step is to start our server, with this useful symfony command

```bash
$ symfony server:start
```

Now, you can have your project at `127.0.0.1:8000` and access to your database at `127.0.0.1/phpmyadmin/`


**ENJOY, QUACK QUACK !**
