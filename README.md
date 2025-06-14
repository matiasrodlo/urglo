# Urglo - Esports Coaching Platform (2014)

Urglo is a professional esports coaching platform that connects gamers from Latin America (Chile, Perú, México, Colombia, and Argentina) with experienced coaches. The platform offers personalized guidance, strategic insights, and tailored training sessions for popular games like League of Legends, CS:GO, Dota 2, and Overwatch.

<p>
  <a href="#">
    <img src="https://github-production-user-asset-6210df.s3.amazonaws.com/52969662/281887769-b9511aef-aae5-451d-9a79-e212ef13beea.jpg" alt="urglo-prototype">
  </a>
</p>

## Features
- Multi-game coaching support (LoL, CS:GO, Dota 2, Overwatch)
- User authentication and role-based access (Admin, Coach, User)
- Real-time messaging system
- Order management system
- Job board for coaches
- Multi-language support with country-specific flags
- Responsive design for mobile and desktop

## Technical Stack
- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Additional Features**:
  - Google Analytics integration
  - Geo-location services
  - Responsive design
  - Custom font integration (Typography.com)

## Requirements
- PHP 5.6 or higher
- MySQL 5.5 or higher
- Apache/Nginx web server
- mod_rewrite enabled (for Apache)
- GD Library for image processing
- cURL extension for API calls

## Project Structure
```
urglo/
├── public/          # Public-facing files
│   ├── index.php
│   ├── contacto.php
│   ├── empleo.php
│   └── ...         # Other public PHP files
├── src/            # Source code
│   ├── controladores/  # Controllers
│   ├── modelos/       # Database models
│   ├── funciones/     # Helper functions
│   ├── vistas/        # View templates
│   └── geoplugin.class.php
├── assets/         # Static assets
│   ├── css/       # Stylesheets
│   ├── js/        # JavaScript files
│   ├── images/    # Image assets
│   ├── fonts/     # Font files
│   ├── files/     # Other static files
│   └── favicon.png
├── config/        # Configuration files
│   └── error_log
└── README.md
```

## Setup Instructions
1. Clone the repository
2. Configure your web server to point to the `public` directory
3. Create a MySQL database and import the schema
4. Update database credentials in configuration files
5. Set appropriate permissions for file uploads
6. Configure your web server's rewrite rules

## Development Guidelines
- Follow PSR-4 autoloading standards
- Use meaningful variable and function names
- Comment complex logic
- Keep functions small and focused
- Use prepared statements for database queries
- Validate all user input
- Sanitize output data

## Key Components
- **User Management**: Registration, authentication, and profile management
- **Coaching System**: Booking, scheduling, and payment processing
- **Messaging System**: Real-time communication between coaches and users
- **Job Board**: Coach recruitment and management
- **Admin Panel**: Platform management and oversight

## Security Considerations
- All user passwords are hashed
- SQL injection prevention through prepared statements
- XSS protection through output sanitization
- CSRF protection implemented
- Input validation on all forms
- Secure session management

## Context
This project was developed in 2014 as part of an entrepreneurial journey after high school. It represents an early attempt to professionalize esports coaching in Latin America, providing a structured platform for gamers to improve their skills through professional guidance.

## Note
This is a legacy project from 2014 and may contain outdated dependencies or security practices. Use with caution in production environments.

## License
This project is proprietary and confidential. All rights reserved.
