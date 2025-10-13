# CarbonWallet

A Laravel-based carbon emissions tracking and management platform for organizations to monitor and report their Scope 1, 2, and 3 emissions.

## 🌍 About CarbonWallet

CarbonWallet helps organizations track their carbon footprint across:
- **Scope 1**: Direct emissions (Natural Gas, Vehicle Fuel, Equipment)
- **Scope 2**: Indirect emissions (Electricity, Heat & Steam, Cooling)
- **Scope 3**: Value chain emissions (18 categories including Purchased Goods, Business Travel, etc.)

## ✨ Features

- 📍 **Location Management** - Track emissions by facility/location
- 🚗 **Vehicle Tracking** - Monitor vehicle fuel consumption and distance
- ⚙️ **Equipment Management** - Track equipment fuel usage
- 📊 **Scope 1, 2, 3 Emissions** - Comprehensive carbon accounting
- 🔐 **OAuth Integration** - Sign in with Google/Microsoft
- 📱 **Responsive Dashboard** - Modern, user-friendly interface

## 🚀 Quick Start

### Local Development

```bash
# Clone the repository
git clone https://github.com/Biancapei/carbonwallet.git
cd carbonwallet

# Install dependencies
composer install
npm install

# Set up environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate

# Build assets
npm run build

# Start development server
php artisan serve
```

Visit `http://localhost:8000`

## 🌐 Deployment

### Deploy to Render.com

See [RENDER_DEPLOYMENT.md](RENDER_DEPLOYMENT.md) for detailed deployment instructions.

**Quick Deploy:**
1. Fork this repository
2. Sign up at [render.com](https://render.com)
3. Create new Web Service from your fork
4. Add environment variables
5. Deploy!

## 🛠️ Tech Stack

- **Backend**: Laravel 12 (PHP 8.2)
- **Frontend**: Blade Templates, Bootstrap, JavaScript
- **Database**: SQLite (dev) / PostgreSQL (production)
- **Build**: Vite
- **Deployment**: Docker (Render.com)

## 📁 Project Structure

```
carbonwallet/
├── app/
│   ├── Http/Controllers/    # Application controllers
│   └── Models/              # Eloquent models
├── resources/
│   ├── views/
│   │   ├── admin/          # Admin dashboard views
│   │   └── auth/           # Authentication views
│   └── js/                 # Frontend JavaScript
├── database/
│   └── migrations/         # Database migrations
├── public/
│   ├── css/               # Stylesheets
│   └── images/            # Static assets
├── Dockerfile             # Production deployment
└── render.yaml            # Render configuration
```

## 🔐 Authentication

CarbonWallet supports multiple authentication methods:
- Email/Password
- Google OAuth
- Microsoft OAuth

## 🧪 Testing

```bash
php artisan test
```

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📧 Contact

For questions or support, please open an issue on GitHub.

---

Built with ❤️ using Laravel
