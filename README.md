# CI4-App

## Installation & updates

```shell
gh repo clone marcinsnoch/ci4-app AppName
```

```shell
composer install
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
# Example Environment Configuration file
#
# This file can be used as a starting point for your own
# custom .env files, and contains most of the possible settings
# available in a default install.
#
# By default, all of the settings are commented out. If you want
# to override the setting, you must un-comment it by removing the '#'
# at the beginning of the line.
#--------------------------------------------------------------------

#--------------------------------------------------------------------
# ENVIRONMENT
#--------------------------------------------------------------------

CI_ENVIRONMENT = development

#--------------------------------------------------------------------
# APP
#--------------------------------------------------------------------

app.baseURL = 'http://127.0.0.1:8080/'
# If you have trouble with `.`, you could also use `_`.
# app_baseURL = ''
# app.forceGlobalSecureRequests = false

app.sessionDriver = 'CodeIgniter\Session\Handlers\DatabaseHandler'
app.sessionCookieName = 'ci_session'
app.sessionExpiration = 7200
app.sessionSavePath = 'ci_sessions'
app.sessionMatchIP = true
app.sessionTimeToUpdate = 300
app.sessionRegenerateDestroy = true

# app.CSPEnabled = false

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

# database.tests.hostname = localhost
# database.tests.database = ci4_test
# database.tests.username = root
# database.tests.password = root
# database.tests.DBDriver = MySQLi
# database.tests.DBPrefix =
# database.tests.port = 3306

#--------------------------------------------------------------------
# CONTENT SECURITY POLICY
#--------------------------------------------------------------------

# contentsecuritypolicy.reportOnly = false
# contentsecuritypolicy.defaultSrc = 'none'
# contentsecuritypolicy.scriptSrc = 'self'
# contentsecuritypolicy.styleSrc = 'self'
# contentsecuritypolicy.imageSrc = 'self'
# contentsecuritypolicy.baseURI = null
# contentsecuritypolicy.childSrc = null
# contentsecuritypolicy.connectSrc = 'self'
# contentsecuritypolicy.fontSrc = null
# contentsecuritypolicy.formAction = null
# contentsecuritypolicy.frameAncestors = null
# contentsecuritypolicy.frameSrc = null
# contentsecuritypolicy.mediaSrc = null
# contentsecuritypolicy.objectSrc = null
# contentsecuritypolicy.pluginTypes = null
# contentsecuritypolicy.reportURI = null
# contentsecuritypolicy.sandbox = false
# contentsecuritypolicy.upgradeInsecureRequests = false
# contentsecuritypolicy.styleNonceTag = '{csp-style-nonce}'
# contentsecuritypolicy.scriptNonceTag = '{csp-script-nonce}'
# contentsecuritypolicy.autoNonce = true

#--------------------------------------------------------------------
# COOKIE
#--------------------------------------------------------------------

# cookie.prefix = ''
# cookie.expires = 0
# cookie.path = '/'
# cookie.domain = ''
# cookie.secure = false
# cookie.httponly = false
# cookie.samesite = 'Lax'
# cookie.raw = false

#--------------------------------------------------------------------
# ENCRYPTION
#--------------------------------------------------------------------

encryption.key = hex2bin:b2585f98b8f4fa7d7dd959e65d3c3c9386f0ebae3b7466e1f995a0846a0252c7
# encryption.driver = OpenSSL
# encryption.blockSize = 16
# encryption.digest = SHA512

#--------------------------------------------------------------------
# HONEYPOT
#--------------------------------------------------------------------

# honeypot.hidden = 'true'
# honeypot.label = 'Fill This Field'
# honeypot.name = 'honeypot'
# honeypot.template = '<label>{label}</label><input type="text" name="{name}" value=""/>'
# honeypot.container = '<div style="display:none">{template}</div>'

#--------------------------------------------------------------------
# SECURITY
#--------------------------------------------------------------------

# security.csrfProtection = 'cookie'
# security.tokenRandomize = false
# security.tokenName = 'csrf_token_name'
# security.headerName = 'X-CSRF-TOKEN'
# security.cookieName = 'csrf_cookie_name'
# security.expires = 7200
# security.regenerate = true
# security.redirect = true
# security.samesite = 'Lax'

#--------------------------------------------------------------------
# LOGGER
#--------------------------------------------------------------------

# logger.threshold = 4

#--------------------------------------------------------------------
# CURLRequest
#--------------------------------------------------------------------

# curlrequest.shareOptions = true
```

## Database

Set charset to 'utf8mb4'

`app/Config/Database.php`

```php
'charset'      => 'utf8mb4',
'DBCollat'     => 'utf8mb4_general_ci',
```



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
php spark migrate:refresh && php spark db:seed RunAll
```
