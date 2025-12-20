# Urglo

Urglo is an esports coaching platform I built in 2014 after high school to connect gamers across Latin America (Chile, Perú, México, Colombia, and Argentina) with experienced coaches. It provides personalized training, strategic guidance, and structured sessions for games like League of Legends, CS:GO, Dota 2, and Overwatch.

![download](https://github.com/matiasrodlo/urglo/assets/52969662/baa715ef-2c55-4ad7-a6b0-30912b24c3c6)

## Features

- Multi-game coaching support (LoL, CS:GO, Dota 2, Overwatch)
- Role-based access control (Admin, Coach, User)
- Real-time messaging system
- Order and job management
- Multi-language support with country-specific features
- Responsive design

## Tech Stack

**Backend:** PHP | **Database:** MySQL | **Frontend:** HTML, CSS, JavaScript

### Installation

```bash
# Clone repository
git clone https://github.com/matiasrodlo/urglo.git
cd urglo

# Configure database
cp platform/app/config.local.php.example platform/app/config.local.php
# Edit config.local.php with your database credentials

# Import schema
mysql -u root -p urglo_local < platform/app/schema.sql

# Run development server
cd platform && php -S 127.0.0.1:8000 router.php
```

Visit `http://localhost:8000` in your browser.

## Project Structure

```
urglo/
├── platform/
│   ├── app/
│   │   ├── controladores/    # Controllers
│   │   ├── modelos/          # Models
│   │   ├── vistas/           # Views
│   │   ├── css/              # Stylesheets
│   │   ├── js/               # JavaScript
│   │   └── schema.sql        # Database schema
│   └── router.php            # Router
└── README.md
```

## License

MIT License - see [LICENSE](LICENSE) for details.