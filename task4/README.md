1. POST /api/v1/seller/lots

request:
````
{
  "lot_uuid": "5f01b49b-38c7-4d6c-a39b-28eb03ef86f9",
  "seller_id": 899,
  "title": "Red Dacca",
  "country_of_origin": "0c07adea-d3d2-464c-b299-19c9a57a27f0", //Costa Rica
  "harvested_at": "2018-07-27",
  "total_weight": "1500000" //in gramms
}
````
response

http code 201
````
{
  "lot_uuid": "5f01b49b-38c7-4d6c-a39b-28eb03ef86f9",
}
````

----
2. POST /api/v1/seller/lots

request:
````
{
  "lot_uuid": "5f01b49b-38c7-4d6c-a39b-28eb03ef86f9",
  "seller_id": 899,
  "title": "Red Dacca",
  "country_of_origin": "0c07adea-d3d2-464c-b299-19c9a57a27f0", //Costa Rica
  "harvested_at": "2018-07-27",
  "total_weight": "500000" //in gramms
}
````

response:

http code 400

````
{
  "errors": [
    {
      "error_code": "123asd",
      "error_message": "Wrong wieght",
      "error_label": "wieght_validation_error"
      "path": "total_weight"
    }
  ]
}
````

-----

3. PUT /api/v1/seller/lots/{uuid} (PUT /api/v1/lots/5f01b49b-38c7-4d6c-a39b-28eb03ef86f9)

request:

````
{
  "seller_id": 899,
  "title": "Red Dacca",
  "country_of_origin": "0c07adea-d3d2-464c-b299-19c9a57a27f0", //Costa Rica
  "harvested_at": "2018-06-14",
  "total_weight": "1500000" //in gramms
}
````

response 

HTTP code 204
````
{
  "lot_uuid": "5f01b49b-38c7-4d6c-a39b-28eb03ef86f9",
  "seller_id": 899,
  "title": "Red Dacca",
  "country_of_origin": "0c07adea-d3d2-464c-b299-19c9a57a27f0", //Costa Rica
  "harvested_at": 1528985213,
  "total_weight": "1500000" //in gramms
}
````

4. POST api/seller/auctions

request

````
{
  "auction_uuid": "ab4dcede-40ab-4187-8943-abdfb17ac0a6",
  "lot_uuid": "5f01b49b-38c7-4d6c-a39b-28eb03ef86f9",
  "initial_price": 120, //in cents
  "starting_at": "2018-09-04",
  "ending_at": "2018-09-05" 
}
````

response

http code 201

````
{
    "auction_uuid": "ab4dcede-40ab-4187-8943-abdfb17ac0a6",
}
````

5. POST api/buyer/auctions/ab4dcede-40ab-4187-8943-abdfb17ac0a6/lots/5f01b49b-38c7-4d6c-a39b-28eb03ef86f9/bids 

request

````
{
  "buyer_id": 72 //could be got from auth token as well
  "bid_price": 135 //in cents
}
````

6. GET api/seller/auctions/ab4dcede-40ab-4187-8943-abdfb17ac0a6/lots/5f01b49b-38c7-4d6c-a39b-28eb03ef86f9/bids

An approach of using POST method exists, as well, for "List endpoints" to be able to send complicated filters etc.

request
````
{
    "filters": [] //some filters go here or in the url query if we do operate GET method
}
````

response

http code 200

````
{
    "data": [
        {
          "buyer_id": 72 //could be got from auth token as well
          "bid_price": 135 //in cents,
          "created_at": 1528985213
        }
    ],
    "pagination": {} //possible but not necessary. Depeding on an App logic
}
````


7. DELETE /api/v1/seller/lots/5f01b49b-38c7-4d6c-a39b-28eb03ef86f9

request - no body. There are no restrictions for body for the DELETE method but
- we do not need there  :) 
- most of the frameworks etc. ignore request body for the DELETE method


response 200





