## Parcel API

#### Requirements
This API was built using the latest [Laravel Framework](https://laravel.com/).

#### Development Setup
- [Laravel Homestead](https://laravel.com/docs/8.x/homestead#introduction) is an official development environment in Laravel.
It might take a while to setup an environment using Laravel Homestead if this is your first time. 
But everything will become very handy and easy once you finish setting up your first project 
- Clone the code from github: `git clone git@github.com:paengski13/parcel-api.git`
- Create a database called parcel_api in Postgres
- Rename .env.example to .env. Update the DB credentials accordingly
- I have created a bash script that contains bunch of composer and laravel commands: `./deploy-dev.sh`
- Enter the IP address into your browser to try to access your local.
- In addition, you can also edit your /etc/hosts and mask your local IP to parcel-api.local
- Access https://parcel-api.local. Congrats!

#### Unit Test
- Run `php artisan test`. This cover the process of creating user, login and creating a parcel.

#### List of API's
 - Registration: `/api/register` This is to create your user before calling any API that requires valid bearer token.
 - Login: `/api/login` Use your email and password used to register to retrieve a token.
 - Create a Parcel: `/api/parcels`
 - Get Parcel affiliated to the user: `/api/parcels/<parcel_id>`
 - Update a specific Parcel: `/api/parcels/<parcel_id>`
 - Delete a specific Parcel: `/api/parcels/<parcel_id>`
 - Request for the total price of all parcel ID provided: `/api/parcels/prices`

#### Postman
You can use the postman collection and environment are available

#### Parcel Client
[Parcel Client Library](https://github.com/paengski13/parcel-client): A library written in PHP is also available to speed the integration.