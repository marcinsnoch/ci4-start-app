# CI4-App

## Installation & updates

```shell
gh repo clone marcinsnoch/ci4-app  app-name
```

## Setup

Create new .env file

```shell
cp env .env
```

Set Environment to Development

```shell
php spark env development
```

Set encryption key

```shell
php spark key:generate
```

New key is stored in .env file.
Main place of stored key is: `app/Config/Encryption.php`

Edit .env file

```c
#--------------------------------------------------------------------
# ENVIRONMENT
#--------------------------------------------------------------------

CI_ENVIRONMENT = development

#--------------------------------------------------------------------
# APP
#--------------------------------------------------------------------

app.baseURL = 'http://127.0.0.1:8080/'

#--------------------------------------------------------------------
# DATABASE
#--------------------------------------------------------------------

database.default.hostname = localhost
database.default.database = ci4_app
database.default.username = root
database.default.password = root
database.default.DBDriver = MySQLi
# database.default.DBPrefix =
# database.default.port = 3306

#--------------------------------------------------------------------
# SESSION
#--------------------------------------------------------------------

app.sessionDriver = 'CodeIgniter\Session\Handlers\DatabaseHandler'
app.sessionCookieName = 'ci_session'
app.sessionExpiration = 7200
app.sessionSavePath = 'ci_sessions'
app.sessionMatchIP = true
app.sessionTimeToUpdate = 300
app.sessionRegenerateDestroy = true
```

## Database

Create database e.g. ci4_app

```shell
mysql -u root -p
```

```shell
CREATE DATABASE `ci4_app`;
```

```shell
exit;
```

Then run

```shell
php spark migrate
```

```shell
php spark db:seed RunAll
```
