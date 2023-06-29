
## Oauth integration with google calendar using Laravel

This project tells how to integrate Google Calendar API with a Laravel application, allowing users to view their Google Calendar events within the application.

### Requirements

- [PHP](https://www.php.net/downloads.php)

- [Composer](https://getcomposer.org/download/)

- Laravel installation command ($ composer global require laravel/installer)
- Need Apache , MySQL server
- Google Account to create a project and enable Google Calendar API
### For new project
```bash
$ composer create-project --prefer-dist laravel/laravel calendar-integration
```
### Create Google Calendar API Credentials
- Visit the[ Google Developers Console.](https://console.cloud.google.com/)

- Create a new project and give it a name.

- Go to the "Library" section and search for "Google Calendar API".
- Enable the Google Calendar API for your project.
- Go to the "Credentials" section and click on "Create Credentials".
- Select "OAuth client ID" as the credential type.
- Configure the OAuth consent screen by providing a name and authorized domains.
- Set the "Authorized JavaScript origins" to your application's URL.
- Set the "Authorized redirect URIs" to URL/auth/google/callback.
- Save the OAuth credentials generated for your application


### Configure Laravel for Google Calendar API
open the .env file and set the following variables:
```bash
GOOGLE_CLIENT_ID=your-client-id
GOOGLE_CLIENT_SECRET=your-client-secret
GOOGLE_REDIRECT_URI=URL/auth/google/callback
```

## Install Required Packages
- Open your command-line interface and navigate to the project directory
- Run the following command to install the required package for Google API integration
```bash
$ composer require google/apiclient guzzlehttp/guzzle
```

### Implement Google Calendar Integration
- In Laravel, open the routes/web.php file and add the following routes:
```bash
Route::get('/', [GoogleCalendarController::class, 'authenticate']);
Route::get('/auth/google/callback', [GoogleCalendarController::class, 'authenticate']);
Route::get('/events', [GoogleCalendarController::class, 'events'])->name('events');
```
- Create a new controller by running the following command in your command-line interface, write necessary to authenticate
```bash
php artisan make:controller GoogleCalendarController
```
-  Create a View to Display Events

### Run the Application
```bash
$ php artisan serve
```



