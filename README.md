# Vive Sail

## Setup Projet

- git clone

```
cd Chatbots && composer install
```

```
cp .env.example .env
```

### .env settings:

- Setup the Database with correct values:

```
DB_DATABASE=chatbots
DB_USERNAME=sail
DB_PASSWORD=password
```

- Set app name:

```
APP_NAME=Chatbots
```

- Add this to the end:

```
WWWGROUP=1000
WWWUSER=1000
```

### Generate Artisan keys:

```
./bin/vendor/sail up -d
```

```
./bin/vendor/sail artisan key:generate
```

### NPM init

```
npm install
```

### Start Vite with NPM

```
npm run dev
```
