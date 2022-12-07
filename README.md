# Laravel Assignment

This is the output of the required Laravel assignment requested by **Abyss** through Mr. Kamal Taghizade.

## Requirements

1. Create a fresh Laravel project
2. Create table with these fields:
    - name (string, max 50),
    - description (string, max 250),
    - file (image, size max 5mb),
    - type (should be 1, 2 or 3)
3. Create APİ to save inputs in DB. Save the image file in a private folder in storage. Before saving make sure you validate incoming data. This API should return only name, type and description after saving data.
4. Create an API to list the whole records only with name, type and description being returned. Data should paginate by 10 at a time.
5. Create an API to show a single record with name, type, description and temporary URL of image (don't display image path directly, you should create temporary URL for image path and it should expire in 10 minutes).
6. Create a cron job to delete 30 days old records each hour. Writing clean codes and using Laravel functionalities will be a plus.
7. Create a public GitHub repository and push your whole codes

## Assumptions

-   All API endpoints responses will be in JSON.
-   All API endpoints that are returning data will return it in a 'data' object. and if there is no data records to be returned an empty data object will be returned instead of 404 response.
-   All Record data fields will be considered as required, no optional fields.
-   As adhering to Laravel functionalities is considered as a plus by requirements, better alternative (ease of use, functionality, performance, scalability, etc.) implementation options will be ignored, for example using AWS S3 and pre-signed URLs, or Scheduled Events through AWS EventBridge.
-   A prefix of '**v1**' will be added to all API endpoints.
-   A prefix of '**record**' will be added to all Record related API endpoints.
-   **Eloquent: API Resources** will be used to format API endpoints responses.
-   **temporarySignedRoute** will be used to create a temporary URL for image path and that will expire in 10 minutes of its creation. Its callback function will be **getImageURL route** which is protected by middleware **signed**.
-   The cron job will be implemented via a command that will be scheduled through kernel.php.
-   Image files will be named by the record ID with the source extension.
-   Images will be saved to private folder '**images**'

## Please Remember to:

1. Install dependencies through composer.
2. Migrate database.
3. Change the **APP_URL** in **.env** file to the URL serving the app to be able to download images as required.
4. run **php artisan schedule:work** to trigger the cron job as required.
