<h1 align="center">
    <p>Contact book</p>
</h1>

## 🚨 About


**Contact book** is a contact book management system.


## 🔨 Tools

- PHP
- MYSQL
- HTML5
- CSS
- JAVASCRIPT

## Libraries/Frameworks

- [Vue](https://vuejs.org/)
- [BOOTSTRAP](https://getbootstrap.com/docs/5.0/getting-started/introduction/)
- [Eloquent ORM](https://laravel-docs-pt-br.readthedocs.io/en/latest/eloquent/)

### Requirements

- Have installed at least one composer package manager, [composer](https://getcomposer.org/).
- You must have a [MySql](https://www.mysql.com/) database for the connection.

## 👨‍💻 How to configure

```bash
    # Clone the project
    $ git clone https://github.com/gabrielteixeira-0814/contact.git
```

```bash
    # Enter the directory
    $ cd contact
```

```bash
    # Install dependencies and framework
    $ composer install
```

```bash
    # To connect to your MySQL database, open the bootstrap.php file and configure your connection.
    $ bootstrap.php
```

```bash
    # After relating the bootstrap.php file to the MySql database, run the command below to start the database
    # Create the tables
    $ php scripts/migrate.php up
```

```bash
    # To delete tables
    $ php scripts/migrate.php down
```

### Application Routes API

- **`GET contact/api/users `**: Route to user list.
- **`GET contact/api/users/{id} `**: Route to find the user.
- **`POST contact/api/users/create `**: Route to create user.
- **`PUT contact/api/users/update `**: Route to edit user.
- **`DELETE contact/api/users/{ID}/delete `**: Route to delete user.

- **`GET contact/api/phones `**: Route to phones list.
- **`GET contact/api/phones/{id} `**: Route to find the phone.
- **`POST contact/api/phones/create `**: Route to create phone.
- **`PUT contact/api/phones/update `**: Route to edit phone.
- **`DELETE contact/api/phones/{ID}/delete `**: Route to delete phone.

- **`GET contact/api/address `**: Route to address list.
- **`GET contact/api/address/{id} `**: Route to find the address.
- **`POST contact/api/address/create `**: Route to create address.
- **`PUT contact/api/address/update `**: Route to edit address.
- **`DELETE contact/api/address/{ID}/delete `**: Route to delete address.

- **`GET contact/api/contact `**: Route to contacts list.
- **`GET contact/api/contact/{id} `**: Route to find the contact.
- **`POST contact/api/contact/create `**: Route to create contact.
- **`PUT contact/api/contact/update `**: Route to edit contact.
- **`DELETE contact/api/contact/{ID}/delete `**: Route to delete contact.

## 📝 License

Este projeto está sob a licença do MIT. Veja o arquivo <a href="https://github.com/gabrielteixeira-0814/contact/blob/main/LICENCE">LICENCE</a> para mais detalhes.

---

<p align="center">Created by Gabriel Teixeira</p>
