<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Welcome
## API endpoints
### `/api/customers`
Method: `GET`
Description: retrieving the list of the user's customers and their transactions.

### `/api/login`
Method: `POST`
Request body example:
```json
{
    "email": "ellenjoe@gmail.com",
    "password": "aaaaaaaa"
}
```

### `/api/logout`
Method: `GET`

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

### `/api/product/{id}`
Method: `DELETE`
Description: deleting a product. Merchant-only feature.

### `/api/product/{id}`
Method: `GET`
Description: retrieving a product.

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

### `/api/products`
Method: `GET`
Description: retrieving the list of all products.

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

### `/api/token`
Method: `GET`
Description: retrieving the CSRF token used in this application.

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

### `/api/user`
Method: `GET`
Description: retrieving the user's information, including the balance and the points earned.