# Facts Africa API
[http://factsafrika.herokuapp.com/api/](http://factsafrika.herokuapp.com/api/)

### Endpoints
##### Authentication
The API uses token based authentication. On successful login, user is assigned a token.

To use the token, add **Header** `Bearer Token` on your request.

| Endpoint  | Verb  | Description  |
|---|---|---|
| /login  | POST  | Authenticate user and login  |
| /logout  | POST  | End active session  |
| /user/{id}  | GET  | Get user by id  |
| /user  | GET  | Get logged in user  |
| /buyers  | GET  | Logged in supplier buyers  |

##### Sample Authentication Data

###### Login
```
email:supplier@mail.com
password:password
```

##### Invoices
| Endpoint  | Verb  | Description  
|---|---|---|
| /invoice  | GET  | Logged in user invoices  |
| /buyer/invoices  | GET  | Logged in BUYER invoices  |
| /invoice/{id}  | GET  | Logged in user invoice by id  |
| /invoice  | POST  | Upload new invoice  |
| /invoice/update/{id}  | POST  | Update invoice status ONLY by invoice ID  |
| /user/{id}/invoices/approved  | GET  | Supplier get buyers approved invoices. {id} is buyer id  |

##### Sample Invoices Data
###### New Invoice
```
buyer_id:1
due_date:2020-04-09
invoice_amount:9999.00
```

##### Accounts
| Endpoint  | Verb  | Description  
|---|---|---|
| /account  | GET  | Logged in user accounts  |
| /account/{id}  | GET  | Logged in user account by id  |
| /account  | POST  | Create new bank account  |

##### Sample Account Data
###### Create Account
```
date_opened:2020-01-02
account_number:234567890
account_name:Bidco
```

##### Transaction
| Endpoint  | Verb  | Description  
|---|---|---|
| /transaction  | GET  | Logged in user transactions  |
| /transaction/{id}  | GET  | Logged in user transaction by id  |
| /transaction  | POST  | Create new transaction  |

##### Sample Transaction Data
###### New Transaction
```
transaction_type:1
account_id:1
invoice_id:6
transaction_amount:10000.00
```

### Unauthenticated Routes
| Endpoint  | Verb  | Description  
|---|---|---|
| /options/invoice  | GET  | Invoice statuses as defined by admin |
| /options/transactions  | GET  | Transaction types as defined by admin  |
| /users/all  | GET  | All users...  |