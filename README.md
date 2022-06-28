# dlabs_restaurant
Backend task , The Restaurant at the End of the Universe

LIST OF API ENDPOINTS
USERS

POST:/api/register 
NOAUTH

Example request payload
{
"username":"testwaiter",
"role":”waiter"
}

POST:/api/login 
NOAUTH

Example request payload
{
"username":"testwaiter",
"role":”waiter"
}
Example response payload
{
    "bearer_token": "2|JGbSoSRFST4nm9n6gcTy3LRGOskls90SpZClR8KP"
}

GET:/api/checkrole 
AUTH WITH TOKEN

Example response payload
{
    "role": "waiter"
}

ORDERS

POST:/api/orders 
NOAUTH

Example request payload
{
    "table_id":"86af191c-b9a8-4241-bbb6-025bb08acbeb",
        "items": [
            {"item_id": "21f51256-e54d-4b99-b9e7-177d6839e82c",
            "quantity": 2
            }
            ]
}
Example response payload
{
    "order_id": "23b54774-b3a4-4162-b66f-d73902ee2403",
    "table_id": "86af191c-b9a8-4241-bbb6-025bb08acbeb",
    "order_items": [
        {
            "order_item_id": "85fd3227-4f9a-4ad7-8150-a1e66a26b7ab",
            "item_id": "21f51256-e54d-4b99-b9e7-177d6839e82c",
            "status": "ordered"
        }
    ]
}
GET:/api/orders/[order_id] 
NOAUTH

Example response payload
{
    "order_id": "23b54774-b3a4-4162-b66f-d73902ee2403",
    "table_id": "86af191c-b9a8-4241-bbb6-025bb08acbeb",
    "order_items": [
        {
            "order_item_id": "85fd3227-4f9a-4ad7-8150-a1e66a26b7ab",
            "item_id": "21f51256-e54d-4b99-b9e7-177d6839e82c",
            "status": "ordered"
        }
    ],
    "order_total": "11.00"
}

GET:/api/orders
AUTH WITH TOKEN
Example response payload
[
    {
        "order_id": "0e785d0a-05ed-473a-89f6-1d4cc63e2046",
        "table_id": "86af191c-b9a8-4241-bbb6-025bb08acbeb",
        "order_items": [
            {
                "order_item_id": "4b19c8a5-9fee-4fee-9ea0-28164c5a0d7f",
                "item_id": "21f51256-e54d-4b99-b9e7-177d6839e82c",
                "status": "preparing"
            },
            {
                "order_item_id": "729589a6-d571-4db6-9924-f7b0ff13a256",
                "item_id": "8aa37998-43f3-4715-9dd0-4c7a055829d8",
                "status": "ordered"
            }
        ]
    },
   …..
]

ORDER ITEMS

PUT:/api/order-items/[order_item_id]
AUTH WITH TOKEN
Example request payload
  {
	 "order_item_id": "f45822a3-9a1b-4d6f-a003-f9a86d1027cd",
         "item_id": "21f51256-e54d-4b99-b9e7-177d6839e82c",
         "status": "delivered"
   }
Example response payload
{
    "id": "f45822a3-9a1b-4d6f-a003-f9a86d1027cd",
    "status": "delivered",
    "price": "5.50",
    "quantity": 2,
    "order_id": "d873b66a-c120-4a84-b19d-3bb213eb6e5d",
    "item_id": "21f51256-e54d-4b99-b9e7-177d6839e82c",
    "created_at": "2022-06-27T22:16:39.000000Z",
    "updated_at": "2022-06-27T22:16:39.000000Z"
}

ITEMS

GET:/api/menu-items/
NOAUTH
Example response payload
[
    {
        "id": "21f51256-e54d-4b99-b9e7-177d6839e82c",
        "title": "Pan Galactic Gargle Blaster",
        "description": "Pan Galactic Gargle Blaster",
        "image": "https://miro.medium.com/max/699/1*UfV5sxZUkgyUQIyZf8Wzjg.png",
        "price": "5.50",
        "type": "drink",
        "created_at": null,
        "updated_at": null
    },
    {
        "id": "2b893545-5e14-4924-94f0-4f481cb47c75",
        "title": "Ameglian Major Cow casserole",
        "description": "Ameglian Major Cow casserole",
        "image": "https://miro.medium.com/max/699/1*UfV5sxZUkgyUQIyZf8Wzjg.png",
        "price": "55.75",
        "type": "food",
        "created_at": null,
        "updated_at": null
    }, …..
]
**aditional

GET:/api/items/
AUTH WITH TOKEN (ROLE MANAGER :) )
Example response payload
[
    {
        "id": "21f51256-e54d-4b99-b9e7-177d6839e82c",
        "title": "Pan Galactic Gargle Blaster",
        "description": "Pan Galactic Gargle Blaster",
        "image": "https://miro.medium.com/max/699/1*UfV5sxZUkgyUQIyZf8Wzjg.png",
        "price": "5.50",
        "type": "drink",
        "created_at": null,
        "updated_at": null
    },
    {
        "id": "2b893545-5e14-4924-94f0-4f481cb47c75",
        "title": "Ameglian Major Cow casserole",
        "description": "Ameglian Major Cow casserole",
        "image": "https://miro.medium.com/max/699/1*UfV5sxZUkgyUQIyZf8Wzjg.png",
        "price": "55.75",
        "type": "food",
        "created_at": null,
        "updated_at": null
    }, …
]
POST:/api/items 
AUTH WITH TOKEN (ROLE MANAGER :) )
Example request payload
{
"title":"Tzjin-anthony-ks",
"description":"the Gagrakackan version of the gin and tonic",
"image":"https://miro.medium.com/max/699/1*UfV5sxZUkgyUQIyZf8Wzjg.png",
"price":11.50,
"type":"drink"
}
Example response payload
{
    "title": "Tzjin-anthony-ks",
    "description": "the Gagrakackan version of the gin and tonic",
    "image": "https://miro.medium.com/max/699/1*UfV5sxZUkgyUQIyZf8Wzjg.png",
    "price": 11.5,
    "type": "drink",
    "id": "3db47ccb-d8b5-49b2-b351-6dad363068be",
    "updated_at": "2022-06-28T08:27:29.000000Z",
    "created_at": "2022-06-28T08:27:29.000000Z"
}

TABLES

GET:/api/tables/
AUTH WITH TOKEN (ROLE MANAGER :) )
Example response payload
[
    {
        "id": "86af191c-b9a8-4241-bbb6-025bb08acbeb",
        "tag": "T1",
        "created_at": "2022-06-27T09:20:07.000000Z",
        "updated_at": "2022-06-27T09:20:07.000000Z"
    }, ...
]
POST:/api/tables 
AUTH WITH TOKEN (ROLE MANAGER :) )
Example request payload
{
"tag":"T1"
}
Example response payload
   {
        "id": "86af191c-b9a8-4241-bbb6-025bb08acbeb",
        "tag": "T1",
        "created_at": "2022-06-27T09:20:07.000000Z",
        "updated_at": "2022-06-27T09:20:07.000000Z"
    }
