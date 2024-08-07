<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Welcome
## Contents
- [How to use](#how-to-use)
- [Data seeding](#seeding)
- [API endpoints](#api-endpoints)
  - [`/api/customers`](#api-customers)
  - [`/api/login`](#api-login)
  - [`/api/logout`](#api-logout)
  - [`/api/product`](#api-product)
  - [`/api/product/{id}` method `DELETE`](#api-product-id-delete)
  - [`/api/product/{id}` method `GET`](#api-product-id-get)
  - [`/api/product/{id}` method `POST`](#api-product-id-post)
  - [`/api/products`](#api-products)
  - [`/api/register`](#api-register)
  - [`/api/reward`](#api-reward)
  - [`/api/rewards`](#api-rewards)
  - [`/api/token`](#api-token)
  - [`/api/topup`](#api-topup)
  - [`/api/user`](#api-user)

<a id="how-to-use"></a>

## How to use
For [`/api/register`](#api-register) and [`/api/login`](#api-login), these headers are required:
| key             | default value      |
|-----------------|--------------------|
| `Accept`        | `application/json` |
| `X-CSRF-TOKEN`  | <sup>[1](#note-1)</sup>     |

For the rest except [`/api/token`](#api-token), these are required:
| key             | default value      |
|-----------------|--------------------|
| `Accept`        | `application/json` |
| `X-CSRF-TOKEN`  | <sup>[1](#note-1)</sup>     |
| `Authorization` | bearer token<sup>[2](#note-2)</sup>     |

<a id="note-1"></a>

<sup>[1]</sup> To obtain `X-CSRF-TOKEN`, run the request at [`/api/token`](#api-token) and copy the token.

<a id="note-2"></a>

<sup>[2]</sup> Bearer token is obtained as or within the response body of [`/api/login`](#api-login) and [`/api/register`](#api-register)

<a id="seeding"></a>

## Data seeding
To generate the rewards, run:
```
php artisan db:seed --class=RewardSeeder
```

<a id="api-endpoints"></a>

## API endpoints

<a id="api-customers"></a>

### `/api/customers`
Method: `GET`
Description: retrieving the list of the user's customers and their transactions.

<a id="api-login"></a>

### `/api/login`
Method: `POST`
Request body example:
```json
{
    "email": "ellenjoe@gmail.com",
    "password": "aaaaaaaa"
}
```

<a id="api-logout"></a>

### `/api/logout`
Method: `GET`

<a id="api-product"></a>

### `/api/product`
Method: `POST`
Description: adding a new product. Merchant-only feature.
Request body example:
```json
{
    "name": "Product 1",
    "price": 129600
}
```

<a id="api-product-id-delete"></a>

### `/api/product/{id}`
Method: `DELETE`
Description: deleting a product. Merchant-only feature.

<a id="api-product-id-get"></a>

### `/api/product/{id}`
Method: `GET`
Description: retrieving a product.

<a id="api-product-id-post"></a>

### `/api/product/{id}`
Method: `POST`
Description: updating a new product. Merchant-only feature.
Request body example:
```json
{
    "name": "Product 1",
    "price": 129600
}
```

<a id="api-products"></a>

### `/api/products`
Method: `GET`
Description: retrieving the list of all products.

<a id="api-register"></a>

### `/api/register`
Method: `POST`
Request body example:
```json
{
    "name": "Ellen Joe",
    "email": "ellenjoe@gmail.com",
    "password": "aaaaaaaa",
    "password_confirmation": "aaaaaaaa",
    "is_merchant": true
}
```

<a id="api-reward"></a>

### `/api/reward`
Method: `POST`
Description: exchanging the user's points with a reward, in the form of extra cash.
Request body example:
```json
{
    "id": 1 // Reward ID.
}
```

<a id="api-rewards"></a>

### `/api/rewards`
Method: `GET`
Description: retrieving all the available rewards.

<a id="api-token"></a>

### `/api/token`
Method: `GET`
Description: retrieving the CSRF token used in this application.

<a id="api-transaction"></a>

### `/api/transaction`
Method: `POST`
Description: saving a new transaction.
Request body example:
```json
{
    "password": "aaaaaaaa",
    "products": [
        {"id": 1, "quantity": 9},
        {"id": 4, "quantity": 16},
         {"id": 5, "quantity": 25}
    ]
}
```

<a id="api-topup"></a>

### `/api/topup`
Method: `POST`
Description: transferring a cash to the user's balance.
Request body example:
```json
{
    "amount": 3600,
    "password": "aaaaaaaa"
}
```

<a id="api-user"></a>

### `/api/user`
Method: `GET`
Description: retrieving the user's information, including the balance and the points earned.