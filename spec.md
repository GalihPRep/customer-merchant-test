# Models
## Reward
| fields      |
|-------------|
| id          |
| name        |
| point       |

## Rewarding
| fields      |
|-------------|
| id          |
| customer_id |
| reward_id   |

## Product
| fields      |
|-------------|
| id          |
| merchant_id |
| name        |
| price       |

## Transaction
| fields      |
|-------------|
| id          |
| customer_id |
| merchant_id |
| product_id  |
| quantity    |
| cost        |

## User
| fields      | type    | default |
|-------------|---------|---------|
| id          | integer |         |
| name        | string  |         |
| email       | string  |         |
| password    | string  |         |
| is_merchant | boolean |         |
| balance     | decimal | 0       |
| point       | integer | 0       |

