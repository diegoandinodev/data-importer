## Laravel Assessment Task

- Title: Product Data Importer with User Interface
- Objective: Develop a Laravel application to fetch and display products from DummyJSON.com API (https://dummyjson.com/products).
- Key Requirements:
1. Scheduled Data Fetching: Set up Laravel task scheduler for data fetching every 2 hours.
2. API Pagination: Fetch 10 products per request, covering the first 3 pages.
3. Database Storage: Use MySQL to store product details (ID, name, description, price, etc.).
4. Error Handling: Implement robust error handling for API interactions and data processing.
5. Data Update Mechanism: Update existing database entries to avoid duplicates.
6. User Authentication: Create a system for user registration, login, and logout.
7. Product Display: Implement a paginated display for authenticated users, showing 5 products per page.


## How to Setup
- create .env file

- Run Composer to install dependencies
``` bash
composer install
```

## Scheduler

Run the following command if you want to run one time scheduler

``` bash
 php artisan schedule:run >> /dev/null 2>&1
```

how to actually run them on our server. The schedule:run Artisan command will evaluate all of your scheduled tasks and determine if they need to run based on the server's current time.

So, when using Laravel's scheduler, we only need to add a single cron configuration entry to our server that runs the schedule:run command every minute. If you do not know how to add cron entries to your server, consider using a service such as Laravel Forge which can manage the cron entries for you:
``` bash
    * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```
