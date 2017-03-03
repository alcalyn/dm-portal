Darkmira Portal API
===================

Portal API for Darkmira.


## Installation

``` bash
# Clone project
git clone git@github.com:Darkmira/dm-portal.git
cd dm-portal/

# Install dependencies
composer install

# Install database
php bin/console doctrine:database:create
php bin/console doctrine:schema:create

# Load dev fixtures
php bin/console khepin:yamlfixtures:load
```


### With Docker

It uses Docker and Docker Compose.

``` bash
# Clone project
git clone git@github.com:Darkmira/dm-portal.git
cd dm-portal/

# Mount application
bin/docker.sh install
```

Then go to:

 - http://127.0.0.1:8000/app_dev.php for RestApi endpoint
 - http://127.0.0.1:8000/app_dev.php/doc for RestApi documentation
 - http://127.0.0.1:8001/ for PHPMyAdmin instance


## Usage

### Documentation

There is a Swagger documentation. Go to:

```
/doc
```


### OAuth authentication

Get an access token for an user:

```
# Example for the admin user from fixtures
/oauth/v2/token?grant_type=password&client_id=1_2i01pqc5pdc0oowk0kogc48cggk800sscos0cgk84wg4kg4wo8&client_secret=2sax9l393l4wos0ogo8ccoco0g4040o4c880cg008w8wo8gw80&username=admin&password=admin
```

Then provide the access token in the header of your authenticated API calls:

```
# Request
GET /api/me
Authorization: Bearer ZmJhZjFmZGIxOWYyYWExMzM0NzBiM2MyMTczZTdhZDc4OWEwOWMyOWMwOWI5MDkzMTJmY2ExNTU0MDUwNzVlNQ

# Response
{
  "id": 1,
  "username": "admin",
  "is_active": true
}
```


## License

This project is under [GNU GPLv3 License](LICENSE).
