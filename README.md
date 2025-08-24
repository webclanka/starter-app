# Laravel Livewire Starter Application

A complete Laravel Livewire starter application with authentication, CRUD operations, and modern frontend tooling.

## Features

- 🔐 **Authentication System** - Complete user registration, login, password reset, and profile management
- ⚡ **Livewire Components** - Interactive components with real-time updates and form handling
- 🎨 **Modern Frontend** - Tailwind CSS, Alpine.js, and Vite for fast development
- 🗄️ **Database Ready** - Migrations, models, factories, and seeders included
- 🧪 **Testing Setup** - PHPUnit configuration with example tests
- 📱 **Mobile Responsive** - Fully responsive design for all devices
- 🔒 **Security Best Practices** - CSRF protection, password hashing, and secure sessions

## Requirements

- PHP 8.2+
- Composer
- Node.js & npm
- MySQL/PostgreSQL/SQLite

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd starter-app
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment Configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure your database** in `.env`
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations and seed the database**
   ```bash
   php artisan migrate --seed
   ```

7. **Build frontend assets**
   ```bash
   npm run build
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` to see the application.

## Development

### Frontend Development
```bash
# Watch for changes during development
npm run dev

# Build for production
npm run build
```

### Database Operations
```bash
# Create a new migration
php artisan make:migration create_table_name

# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Seed the database
php artisan db:seed
```

### Livewire Components
```bash
# Create a new Livewire component
php artisan make:livewire ComponentName

# Create a component with inline view
php artisan make:livewire ComponentName --inline
```

## Testing

Run the test suite:
```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/ExampleTest.php

# Run tests with coverage
php artisan test --coverage
```

## Available Features

### Authentication
- User registration and login
- Password reset functionality
- Email verification
- Profile management
- Secure logout

### Posts Management
- Create, read, update, delete posts
- Real-time search and filtering
- Status management (draft, published, archived)
- User ownership validation

### Livewire Components
- **Counter**: Simple interactive counter demonstration
- **Search Demo**: Real-time search with instant results
- **Form Demo**: Real-time form validation
- **Post Management**: Full CRUD operations with Livewire
- **Recent Posts**: Dashboard widget showing latest posts

### Admin Panel
- User management
- Role-based access control (with Spatie Permissions)
- System settings

## Project Structure

```
├── app/
│   ├── Http/Controllers/     # HTTP Controllers
│   ├── Livewire/            # Livewire Components
│   ├── Models/              # Eloquent Models
│   └── Providers/           # Service Providers
├── database/
│   ├── factories/           # Model Factories
│   ├── migrations/          # Database Migrations
│   └── seeders/            # Database Seeders
├── resources/
│   ├── css/                # Stylesheets
│   ├── js/                 # JavaScript
│   └── views/              # Blade Templates
├── routes/                 # Route Definitions
├── tests/                  # Test Files
└── public/                 # Public Assets
```

## Customization

### Adding New Components
1. Create a Livewire component:
   ```bash
   php artisan make:livewire MyComponent
   ```

2. Add the component to your blade template:
   ```blade
   @livewire('my-component')
   ```

### Styling
The project uses Tailwind CSS. Customize the design by:
- Editing `tailwind.config.js`
- Adding custom styles in `resources/css/app.css`
- Using Tailwind utility classes in your templates

### Database Models
Add new models with relationships:
```bash
php artisan make:model ModelName -mfs
# -m: migration, -f: factory, -s: seeder
```

## Production Deployment

1. **Optimize for production**
   ```bash
   composer install --no-dev --optimize-autoloader
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   npm run build
   ```

2. **Set up environment**
   - Configure `.env` for production
   - Set `APP_ENV=production`
   - Set `APP_DEBUG=false`
   - Configure proper database credentials
   - Set up mail configuration

3. **Security Checklist**
   - Enable HTTPS
   - Set secure session cookies
   - Configure CORS if needed
   - Set up proper file permissions
   - Configure rate limiting

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests for new functionality
5. Ensure all tests pass
6. Submit a pull request

## License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## Support

For issues and questions:
- Check the [Laravel documentation](https://laravel.com/docs)
- Review [Livewire documentation](https://laravel-livewire.com/docs)
- Open an issue in this repository

---

**Built with ❤️ using Laravel, Livewire, and Tailwind CSS**