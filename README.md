## Project Setup Instructions

### Update `.env` File

Before running the application, make sure to rename the `.env.example` file with `.env`.

Change your database name, username, password and change your mail credentials.

### Install Dependencies

Run the following commands to install the necessary dependencies:

```bash
composer install
```

### Generate Application Key

Generate the application key with the following command:

```bash
php artisan key:generate
```

### Migrate database table

Migrate tables with following command:

```bash
php artisan migrate
```

### Install Node Package

Install npm with following command:

```
npm install
```

### Run Node Package

Run npm with following command:

```
npm run dev
```

### Start Server

Start server using following command:

```
php artisan serve
```

## Publish Mail Templates

To publish mail templates, run the following command in your Laravel project:

```bash
php artisan vendor:publish --tag=laravel-mail
```