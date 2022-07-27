# Millenium social network developed in laravel and vue

## How to use

### Download the files from GitHub

- Create a folder
- Open cmd in the folder
```sh
git clone https://github.com/Douglas-Kodi/millenium.git
```

### Install npm and composer

```sh
npm install
composer install
```

### How to start DataBase(BD)

- Copy the contents of the file ".env.example" 
- Create a file named like ".env" and paste
- Start a BD of your choice
- Create BD name "millenium" and collation "utf8mb4_unicode_ci"
- Open cmd in the folder where your repository is
```sh
php artisan migrate
```

### Starter Millenium

- Open cmd in the folder where your repository is
```sh
php artisan serve
npm run dev
```
