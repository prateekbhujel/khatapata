# Khatapata

Khatapata is an simple expense and income tracker with budget management built with Laravel and jQuery. It provides administrators with a user-friendly interface to create and manage financial content, while also offering users robust tools for expense tracking, budgeting.

## Features

- **Frontend CMS**:
  - User management with roles and permissions
  - Content creation and management (articles, guides, tutorials)
  - Categorization and tagging
  - SEO optimization

- **Backend Financial Management**:
  - Custom Categories
  - Dashboard with Bardiagram
  - Expense and income tracking
  - Budgeting setting

## Installation

1. Clone the repository: `git clone https://github.com/prateekbhujel/khatapata.git`
2. Navigate to the project directory: `cd khatapata`
3. Install dependencies: `composer install` and `npm install`
4. Configure the environment variables by creating a `.env` file and copying the contents from `.env.example`
5. Generate an application key: `php artisan key:generate`
6. Run database migrations: `php artisan migrate`
7. Compile assets: `npm run watch` (for development) or `npm run build` (for production)
8. Start the development server: `php artisan serve`
