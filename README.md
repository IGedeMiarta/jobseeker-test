# Jobseeker Fullstack Engineer Test

Guide to cloning and setting up a Laravel project, connecting it to a database, and migrating the database.

## Prerequisites

Make sure you have the following installed on your machine:

-   [Git](https://git-scm.com/)
-   [Composer](https://getcomposer.org/)
-   [PHP](https://www.php.net/)

## Clone & Install

```bash
git clone https://github.com/IGedeMiarta/jobseeker-test.git
```

### Install Dependencies

```bash
cd jobseeker-test
composer install
```

### Environment Configuration

Copy the `.env.example` file to create a new `.env` file:

```bash
cp .env.example .env
```

Open the .env file and configure your database connection:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_test
DB_USERNAME=root
DB_PASSWORD=
```

### Migrate the Database

Run the following command to migrate the database:

```bash
php artisan migrate
```

### Seed the Database (Optional)

If you want to populate the database with Faker data, use the `--seed` flag

```bash
php artisan migrate --seed
```

### Run Application

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser to access the Laravel application.

## API Reference

#### Get all candidate

```bash
  GET /api/v1/candidate
```

| Parameter  | Type      | Description                                |
| :--------- | :-------- | :----------------------------------------- |
| `email`    | `string`  | search by email                            |
| `phone`    | `string`  | search by phone_number                     |
| `fullname` | `string`  | search by full_name                        |
| `dob`      | `date`    | search by date of birth `dd/mm/yyyy`       |
| `pob`      | `string`  | search by place of birth                   |
| `gender`   | `string`  | search by gender (only `F` or `M`)         |
| `year_exp` | `integer` | search by year of experience               |
| `salary`   | `integer` | search by of last salary                   |
| `search`   | `string`  | search email, phone_number, full_name, pob |
| `order`    | `string`  | filter by [`ASC`,`DESC`]                   |
| `paginate` | `integer` | order paginate (default 10)                |

Example Request With Parameter:

```bash
GET /api/v1/candidate?pob=denpasar&gender=F&paginate=50
```

The data where will returns candidate where place of birth is in denpasar, and gender female, the data will show per 50 items

#### Add New Candidate

```bash
  POST api/v1/candidate
```

| Parameter      | Type      | Description             |
| :------------- | :-------- | :---------------------- |
| `email`        | `string`  | required, email, unique |
| `phone_number` | `string`  | required, unique        |
| `full_name`    | `string`  | required                |
| `dob`          | `date`    | required,`yyyy-mm-dd`   |
| `pob`          | `string`  | required                |
| `gender`       | `string`  | required,only(`F`,`M`)  |
| `year_exp`     | `integer` | required                |
| `last_salary`  | `integer` | _optional_              |

#### Get Item By Id

```bash
  GET api/v1/candidate/{id}
```

| Parameter | Type     | Description                                 |
| :-------- | :------- | :------------------------------------------ |
| `id`      | `string` | **Required**. candidate_id of item to fetch |

#### Update Candidate

```bash
  PUT api/v1/candidate/{id}
```

| Parameter | Type     | Description                                 |
| :-------- | :------- | :------------------------------------------ |
| `id`      | `string` | **Required**. candidate_id of item to fetch |

POST Parameter:
| Parameter | Type | Description |
| :-------- | :------- | :------------------------- |
| `email` | `string` | required, email, unique |
| `phone_number` | `string` | required, unique |
| `full_name` | `string` | required |
| `dob` | `date` | required,`yyyy-mm-dd` |
| `pob` | `string` | required |
| `gender` | `string` | required,only(`F`,`M`) |
| `year_exp` | `integer` | required |
| `last_salary` | `integer` | _optional_ |

#### Delete Candidate

```bash
  DELETE api/v1/candidate/{id}
```

| Parameter | Type     | Description                                 |
| :-------- | :------- | :------------------------------------------ |
| `id`      | `string` | **Required**. candidate_id of item to fetch |

## Documentation

[Postman Documentation](https://documenter.getpostman.com/view/15990639/2s9YeBdYto)
