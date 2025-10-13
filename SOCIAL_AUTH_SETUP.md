# Social Authentication Setup

## Environment Variables

Add these variables to your `.env` file:

```env
# Google OAuth
GOOGLE_CLIENT_ID=your_google_client_id_here
GOOGLE_CLIENT_SECRET=your_google_client_secret_here
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback

# Microsoft OAuth
MICROSOFT_CLIENT_ID=your_microsoft_client_id_here
MICROSOFT_CLIENT_SECRET=your_microsoft_client_secret_here
MICROSOFT_REDIRECT_URI=http://localhost:8000/auth/microsoft/callback

# Apple OAuth
APPLE_CLIENT_ID=your_apple_client_id_here
APPLE_CLIENT_SECRET=your_apple_client_secret_here
APPLE_REDIRECT_URI=http://localhost:8000/auth/apple/callback
```

## Setting up OAuth Applications

### Google OAuth
1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select existing one
3. Enable Google+ API
4. Go to "Credentials" → "Create Credentials" → "OAuth 2.0 Client IDs"
5. Set authorized redirect URI: `http://localhost:8000/auth/google/callback`
6. Copy Client ID and Client Secret to your `.env` file

### Microsoft OAuth
1. Go to [Azure Portal](https://portal.azure.com/)
2. Navigate to "Azure Active Directory" → "App registrations"
3. Click "New registration"
4. Set redirect URI: `http://localhost:8000/auth/microsoft/callback`
5. Copy Application (client) ID and create a client secret
6. Add the credentials to your `.env` file

### Apple OAuth
1. Go to [Apple Developer Console](https://developer.apple.com/)
2. Navigate to "Certificates, Identifiers & Profiles"
3. Create a new App ID and Services ID
4. Configure Sign in with Apple
5. Set redirect URI: `http://localhost:8000/auth/apple/callback`
6. Add the credentials to your `.env` file

## Testing

1. Run `php artisan serve`
2. Visit `http://localhost:8000/register` to test the signup page
3. Visit `http://localhost:8000/login` to test the login page
4. Try accessing `/admin` without authentication - you should be redirected to login

## Features Implemented

- ✅ Custom signup page with HubSpot-like design
- ✅ Custom login page with social login options
- ✅ Google, Microsoft, and Apple OAuth integration
- ✅ Email/password authentication
- ✅ Admin routes protected by authentication middleware
- ✅ User model updated with social authentication fields
- ✅ Database migration for social authentication
- ✅ Responsive design with modern UI
- ✅ Microsoft and Apple OAuth providers installed and configured
- ✅ EventServiceProvider configured for social providers

## Packages Installed

- `laravel/socialite` - Core OAuth functionality
- `socialiteproviders/microsoft` - Microsoft OAuth provider
- `socialiteproviders/apple` - Apple OAuth provider
- `socialiteproviders/manager` - Manager for social providers
