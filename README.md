# Alumni Data Management System

A Laravel-based web application for managing alumni data including personal information, education history, and employment records.

## Features

-   Complete CRUD operations for alumni profiles
-   Education history tracking (fakultas, jurusan, IPK)
-   Employment history management
-   Search and filter functionality
-   Responsive design using Tailwind CSS

## Requirements

-   PHP 8.0+
-   Composer
-   Node.js 16+
-   MySQL 5.7+

## Installation

1. Clone the repository
2. Install PHP dependencies: `composer install`
3. Install JavaScript dependencies: `npm install`
4. Create `.env` file from `.env.example`
5. Generate application key: `php artisan key:generate`
6. Configure database settings in `.env`
7. Run migrations: `php artisan migrate`
8. Compile assets: `npm run dev`

## Usage

1. Start development server: `php artisan serve`
2. Access the application at `http://localhost:8000`
3. Login with admin credentials
4. Navigate to alumni section to manage records

## Development

-   Run Vite dev server: `npm run dev`
-   Build for production: `npm run build`

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Open a pull request

## License

[MIT](https://choosealicense.com/licenses/mit/)
