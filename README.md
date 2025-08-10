# Laravel Livewire Starter App with CRUD System

A comprehensive Laravel 11 starter application with Livewire 3 featuring complete CRUD operations for Users and Roles management.

## Features Implemented

### ✅ Database Structure
- **Users Table**: id, name, email, email_verified_at, password, role_id, avatar, status, created_at, updated_at, deleted_at
- **Roles Table**: id, name, slug, description, permissions (JSON), created_at, updated_at
- Proper foreign key relationships between Users and Roles
- Soft deletes for users

### ✅ Models & Relationships
- **User Model**: Enhanced with role relationship, fillable attributes, scopes for search and filtering
- **Role Model**: Complete with user relationship, permission casting, and helper methods
- Eloquent relationships properly established

### ✅ CRUD Operations

#### Users Management
- ✅ **List Users**: Paginated table with search, role filtering, status filtering, and sorting
- ✅ **Create User**: Form with validation (name, email, password, role assignment, avatar upload)
- ✅ **View User**: Display detailed user information and role details
- ✅ **Edit User**: Update user information, role assignment, and avatar
- ✅ **Delete User**: Soft delete with confirmation (prevents self-deletion)
- ✅ **Bulk Actions**: Delete, activate, deactivate, suspend, and role assignment for multiple users

#### Roles Management
- ✅ **List Roles**: Table showing all roles with user count and permissions preview
- ✅ **Create Role**: Form to create new roles with permission assignment
- ✅ **View Role**: Show role details and assigned users
- ✅ **Edit Role**: Update role name, description, and permissions
- ✅ **Delete Role**: Delete role (with validation for assigned users)

### ✅ Frontend Components
- **Bootstrap 5** responsive design
- **Livewire Components**: UsersList with real-time search and filtering
- **Blade Templates**: Complete set of views for all CRUD operations
- **Navigation**: Responsive navigation with active states
- **Flash Messages**: Success/error notifications

### ✅ Permissions System
Built-in permission system with predefined permissions:
- `users.view`, `users.create`, `users.edit`, `users.delete`
- `roles.view`, `roles.create`, `roles.edit`, `roles.delete`

### ✅ Security & Validation
- Form request validation for all operations
- CSRF protection
- Input sanitization
- Authorization checks (prevent self-deletion, role validation)
- Secure file uploads for avatars

### ✅ Seeders & Default Data
- **RoleSeeder**: Creates 5 default roles (Super Admin, Admin, Manager, User, Subscriber)
- **UserSeeder**: Creates sample users with different roles and statuses
- Proper permission assignments for each role

### ✅ Advanced Features
- **Search Functionality**: Real-time search across user names and emails
- **Filtering**: Filter users by role and status
- **Sorting**: Sortable columns (name, email, status, created date)
- **Pagination**: Laravel pagination with query string preservation
- **Avatar System**: File uploads with automatic fallback to generated avatars
- **Bulk Operations**: Select all/multiple users for bulk actions

## Tech Stack

- **Laravel 11**: Latest Laravel framework
- **Livewire 3**: For reactive components
- **Bootstrap 5**: For responsive UI
- **Tailwind CSS**: For utility-first styling
- **Alpine.js**: For JavaScript interactions
- **SQLite**: Default database (easily configurable for MySQL/PostgreSQL)
- **Vite**: For asset compilation

## Installation

1. Clone the repository
2. Install dependencies: `composer install`
3. Copy environment file: `cp .env.example .env`
4. Generate application key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Seed the database: `php artisan db:seed`
7. Install Node dependencies: `npm install`
8. Build assets: `npm run build`
9. Serve the application: `php artisan serve`

## Default Users

The seeder creates the following users:
- **Super Admin**: superadmin@example.com (password: password)
- **Admin**: admin@example.com (password: password)
- **Regular Users**: john@example.com, jane@example.com, etc. (password: password)

## Routes

- `/` - Welcome page
- `/dashboard` - Main dashboard with statistics
- `/users` - Users management (index, create, show, edit, delete)
- `/roles` - Roles management (index, create, show, edit, delete)
- `/login` - Authentication
- `/register` - User registration

## File Structure

```
app/
├── Http/Controllers/
│   ├── UserController.php      # Users CRUD
│   ├── RoleController.php      # Roles CRUD
│   └── Auth/                   # Authentication controllers
├── Livewire/
│   └── UsersList.php          # Livewire users table component
├── Models/
│   ├── User.php               # User model with relationships
│   └── Role.php               # Role model with permissions
database/
├── migrations/                # Database structure
└── seeders/                  # Default data
resources/
├── views/
│   ├── users/                # User CRUD views
│   ├── roles/                # Role CRUD views
│   ├── livewire/             # Livewire component views
│   └── layouts/              # Layout templates
```

## Key Features Highlights

- **Mobile Responsive**: Works perfectly on all devices
- **Real-time Search**: Instant search results without page refresh
- **Bulk Operations**: Efficient management of multiple users
- **Permission-based**: Role-based access control system
- **User-friendly**: Intuitive interface with clear navigation
- **Secure**: Proper validation and authorization throughout
- **Extensible**: Easy to add more roles, permissions, and features

## Next Steps for Production

1. Add email verification system
2. Implement password reset functionality
3. Add API endpoints for mobile/external access
4. Set up proper file storage (S3, etc.)
5. Add audit logging
6. Implement more granular permissions
7. Add export functionality (CSV/Excel)
8. Set up automated testing
9. Configure proper caching strategy
10. Set up monitoring and logging

This starter application provides a solid foundation for any Laravel project requiring user and role management with a modern, responsive interface.