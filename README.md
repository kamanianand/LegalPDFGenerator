### LegalPDF Generator - Laravel Project

## Features

    - Simulates a 25-message email thread
    - [Generates a large PDF document (~70MB) from the thread]
    - [Uses content from a sample Word document]
    - [Backend-only implementation with simple API endpoint]

## Prerequisites

    - [PHP 8.2 or higher]
    - [Composer]
    - [Laravel 12]
    - [512MB+ PHP memory limit]

## Ensure your php.ini has these settings:

    - [memory_limit = 512M]
    - [max_execution_time = 300]
    - [post_max_size = 256M]
    - [upload_max_filesize = 256M]

## Installation

1. Clone the repository

    ```
    git clone [repository-url]
    ```

    ```
    cd LegalPDFGenerator
    ```

2. Install dependencies

    ```
    composer install
    ```

3. Set up environment and connect database

    ```
    cp .env.example .env
    ```

    - [DB_CONNECTION=mysql]
    - [DB_HOST=127.0.0.1]
    - [DB_PORT=3306]
    - [DB_DATABASE=[database-name]]
    - [DB_USERNAME=[database-username]]
    - [DB_PASSWORD=[database-username-password]]

4. Generate application key:

    ```
    php artisan key:generate
    ```

5. Start the development server

    ```
    php artisan serve
    ```
6. Access the endpoint in your browser :

    ```
    http://localhost:8000/generate-pdf
    ```
7. output:
    https://youtu.be/dDEhXG3R82A