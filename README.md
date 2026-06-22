# Blog Website Showcase

A collaborative Laravel blog platform for user authentication, post publishing, and live news discovery.

## What the project does

- Lets users register, log in, and log out securely.
- Supports creating, editing, viewing, and deleting blog posts.
- Stores post cover images and displays them in the feed and post pages.
- Includes a news explorer with search, language, date, and sorting filters.
- Shows posts owned by the signed-in user in a dedicated profile view.

## Team contribution split

This project was built as a team effort. A realistic split of work for this codebase is:

- Authentication, validation, password hashing, and session handling.
- Access control and security checks for editing and deleting posts.
- Create Post page and image upload flow.
- Database design and SQL queries.
- News search and filter integration.

## Tech stack

- Laravel 12
- PHP 8.2+
- Blade templates
- MySQL or SQLite
- Vite
- Tailwind CSS
- NewsAPI

## Main pages

- Login page
- Register page
- Posts feed
- Create post page
- Edit post page
- Single post page
- User posts page
- News explorer page

## Requirements to run the project

You need the following installed locally:

- PHP 8.2 or newer
- Composer
- Node.js and npm
- Git
- A database engine

The project ships with SQLite as the default local database in the environment file, so the easiest setup is SQLite. If you prefer MySQL, update the database settings in the environment file before migrating.

You also need a valid NewsAPI key for the news page to return results.

## Local setup

1. Install PHP dependencies with Composer.
2. Copy the environment file and configure it.
3. Generate the application key.
4. Create the database and run migrations.
5. Install frontend dependencies.
6. Link the storage folder for uploaded post images.
7. Start the backend and frontend build process.

### Commands

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate
npm install
php artisan storage:link
php artisan serve
npm run dev
```

If you are using SQLite, make sure the database file exists before running migrations:

```bash
type nul > database\database.sqlite
```

## Environment variables

Set these values in the environment file before running the project:

- APP_URL=http://localhost
- DB_CONNECTION=sqlite or mysql
- DB_DATABASE=database/database.sqlite for SQLite, or your MySQL database name
- DB_USERNAME and DB_PASSWORD if you use MySQL
- NEWS_API_KEY=your_api_key_here

## Demo account for local testing

The database seeder creates a sample user:

- Email: test@example.com
- Password: password

Use that account after running the seed step if you want a quick login for local testing.

## Notes on the codebase

- Registration validates name, email, and password.
- Login validates credentials and regenerates the session on success.
- Post update and delete actions are restricted to the post owner.
- Uploaded images are stored on the public disk and shown through the storage link.

## License

MIT