# Task outline

1. Using Java, or PHP, create an application exposing a RESTful API - it will be the "server part" of your solution.
It should have some layer of persistency - a PostgreSQL or H2 database is a good example.

2. Provide a library (a small SDK of sort) that will help future developers integrate with your application. 
_(A good example of such is https://aws.amazon.com/sdk-for-php/ or https://aws.amazon.com/sdk-for-java/ - you don't have to make the HTTP calls yourself to use Amazon Web Services API)_
Make sure all server part functionality can be accessed through the client library.

3. Provide both the server app and the client library code in a private GitHub repository. 

4. Deploy the server application somewhere public, where we can access it and provide the URL. 
_If you don't have your own hosting, no worries - AWS and GCP have their free tier accounts you can use to run your application for a while._

# Important general aspects

* You don't have to reinvent the wheel - you can use any open-source frameworks and libraries you like.
* Use a dependency manager, like Maven/Gradle for Java, and Composer for PHP.
* Make sure the application can be run easily.
* Provide a README.md file in the root of the repository, with an outline of your solution and instructions on how to run it.
* Write both unit and end-to-end tests, testing both modules of code, as well as your REST API.
* Make sure your application is easy to debug. Proper logging will come in handy.
* Use object-oriented design and proper separation of layers. Patterns like MVC are a good first step.

$\pagebreak$

# Server-side task - RESTful API

A courier company, Tiny Parcel Inc., has asked you to design a microservice to store parcel quote requests and calculate estimated delivery prices for its customers.

## Pricing models

Tiny Parcel Inc. has three different pricing models:

* $5 per each kilogram of weight,
* $1000 per each cubic metre of volume,
* or 3% of the declared parcel value.

Selection of pricing model should be done when the user submits a new quote - automatically picking *the optimal* (maximum) pricing model for each case. As an example:


| Item name | Weight | Volume | Declared value | Chosen model | Quote |
| --------- | ------ | ------ | -------------- | ------------ | ----- |
| New smartphone | 0.4kg ($2 quote by weight) | 0.00079m³ volume ($0.79 quote by volume) | $1300 ($39 quote by value) | By value | $39 |
| Steel cylinder | 7.86kg ($39.3 quote by weight) | 0.001m³ volume ($1 quote by volume) | $4 ($0.12 quote by value) | By weight | $39.30 |
| Bag of styrofoam granules | 2kg ($10 quote by weight) | 0.1m³ volume ($100 quote by volume) | $5 ($0.15 quote by value) | By volume | $100 |
              

* A box with a new smartphone, weighing 0.4kg ($2 by weight), 0.00079m^3 volume ($0.79 by volume), declared value $1300 ($39 by value): Quote: $39.

* A steel cylinder, weighing 7.86kg ($39.3 by weight), 0.001m^3 volume ($1 by volume), declared value $4 ($0.12 by value): Quote: $39.3.

* A bag of styrofoam granules, weighing 2kg ($10 by weight), 0.1m^3 volume ($100 by volume), declared value $5 ($0.15 by value): Quote: $100.


Each of these parameters ($5, $1000, 3%) changes from time to time - so it should be stored as an application property to allow easy change.
Store chosen pricing model type (by weight, by volume, by value) with the parcel information. Prices change from time to time, so you'll have to update quotes given!

## API

* Design an endpoint that allows Create, Read, Update and Delete for each parcel. 

```
GET /parcels/{id}
POST /parcels/
PUT /parcels/{id}
DELETE /parcels/{id}
```

* Design an endpoint that allows to GET delivery price of *one or up to twenty* parcels - some customers add many parcels and then request a single bulk price for all of them.

```
GET /prices/?parcelIds=11,13,20,29,45,22,55,99
```

* Secure the API. HTTP Basic Authentication is fine, but Token Bearer is even better.

# Client library

* Allow configuration of base URLs - different environments might have different URLs after all
* Use a HTTP client
* Handle exceptions properly
* Create proper tests for the client

# Closing remarks

While elegance of the solutions is definitely a plus, we believe that code which is readable works the best for teamwork.
Feel free to contact us at interview-questions@cartoncloud.com.au with any questions.

Good luck!
