# Google Cloud Deployment Guide for CarbonWallet

## 🚀 **Google Cloud Production Setup**

### **1. Required Google Cloud Services**

- **Cloud Run** - Serverless Laravel app hosting
- **Cloud SQL** - PostgreSQL database
- **Cloud Storage** - File storage and static assets
- **Cloud Build** - CI/CD pipeline
- **Cloud DNS** - Domain management

### **2. Environment Configuration**

Create `.env.production` with these settings:

```bash
# Production Environment
APP_NAME=CarbonWallet
APP_ENV=production
APP_KEY=base64:your-production-app-key-here
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Google Cloud SQL Database (PostgreSQL)
DB_CONNECTION=pgsql
DB_HOST=/cloudsql/project-id:region:instance-name
DB_PORT=5432
DB_DATABASE=carbonwallet_prod
DB_USERNAME=your-db-user
DB_PASSWORD=your-db-password

# Session & Cache (Redis recommended)
SESSION_DRIVER=database
SESSION_ENCRYPT=true
CACHE_STORE=redis
REDIS_HOST=your-redis-instance-ip
REDIS_PASSWORD=your-redis-password
REDIS_PORT=6379

# File Storage (Google Cloud Storage)
FILESYSTEM_DISK=gcs
GOOGLE_CLOUD_PROJECT_ID=your-project-id
GOOGLE_CLOUD_STORAGE_BUCKET=your-bucket-name

# Email Service (SendGrid recommended)
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="CarbonWallet"

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=error
```

### **3. Dockerfile for Cloud Run**

Create `Dockerfile` in project root:

```dockerfile
FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    postgresql-dev \
    redis

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www
RUN chmod -R 755 /var/www/storage

# Expose port
EXPOSE 8080

# Start PHP-FPM
CMD ["php-fpm"]
```

### **4. Cloud Run Configuration**

Create `cloudbuild.yaml`:

```yaml
steps:
  # Build the container image
  - name: 'gcr.io/cloud-builders/docker'
    args: ['build', '-t', 'gcr.io/$PROJECT_ID/carbonwallet:$COMMIT_SHA', '.']
  
  # Push the container image to Container Registry
  - name: 'gcr.io/cloud-builders/docker'
    args: ['push', 'gcr.io/$PROJECT_ID/carbonwallet:$COMMIT_SHA']
  
  # Deploy container image to Cloud Run
  - name: 'gcr.io/cloud-builders/gcloud'
    args:
    - 'run'
    - 'deploy'
    - 'carbonwallet'
    - '--image'
    - 'gcr.io/$PROJECT_ID/carbonwallet:$COMMIT_SHA'
    - '--region'
    - 'us-central1'
    - '--platform'
    - 'managed'
    - '--allow-unauthenticated'
```

### **5. Database Setup**

1. **Create Cloud SQL Instance:**
```bash
gcloud sql instances create carbonwallet-db \
    --database-version=POSTGRES_14 \
    --tier=db-f1-micro \
    --region=us-central1
```

2. **Create Database:**
```bash
gcloud sql databases create carbonwallet_prod \
    --instance=carbonwallet-db
```

3. **Create User:**
```bash
gcloud sql users create carbonwallet_user \
    --instance=carbonwallet-db \
    --password=your-secure-password
```

### **6. Storage Setup**

1. **Create Storage Bucket:**
```bash
gsutil mb gs://your-project-carbonwallet-assets
```

2. **Set Public Access:**
```bash
gsutil iam ch allUsers:objectViewer gs://your-project-carbonwallet-assets
```

### **7. Email Service Setup**

**Option 1: SendGrid (Recommended)**
1. Sign up at sendgrid.com
2. Create API key
3. Verify your domain
4. Use SendGrid SMTP settings

**Option 2: Mailgun**
1. Sign up at mailgun.com
2. Add your domain
3. Get SMTP credentials
4. Configure in .env

### **8. Deployment Commands**

```bash
# Build and deploy
gcloud builds submit --config cloudbuild.yaml

# Set environment variables
gcloud run services update carbonwallet \
    --set-env-vars="APP_ENV=production,APP_DEBUG=false" \
    --region=us-central1

# Run migrations
gcloud run jobs create migrate-db \
    --image=gcr.io/$PROJECT_ID/carbonwallet:latest \
    --command="php" \
    --args="artisan,migrate,--force" \
    --region=us-central1

# Execute migration job
gcloud run jobs execute migrate-db --region=us-central1
```

### **9. Domain & SSL Setup**

1. **Map Custom Domain:**
```bash
gcloud run domain-mappings create \
    --service=carbonwallet \
    --domain=yourdomain.com \
    --region=us-central1
```

2. **SSL Certificate** (automatic with Cloud Run)

### **10. Monitoring & Logging**

- **Cloud Logging** - Application logs
- **Cloud Monitoring** - Performance metrics
- **Error Reporting** - Error tracking
- **Uptime Checks** - Service monitoring

### **11. Security Considerations**

- ✅ Enable Cloud Armor for DDoS protection
- ✅ Use Cloud SQL Auth Proxy
- ✅ Set up VPC for private networking
- ✅ Enable audit logs
- ✅ Use Secret Manager for sensitive data

### **12. Cost Optimization**

- Use Cloud Run (pay per request)
- Choose appropriate Cloud SQL tier
- Enable Cloud CDN for static assets
- Set up budget alerts

## 📋 **Pre-Deployment Checklist**

- [ ] Database migrations tested
- [ ] Email service configured
- [ ] Environment variables set
- [ ] SSL certificate ready
- [ ] Domain DNS configured
- [ ] Monitoring setup
- [ ] Backup strategy planned
- [ ] Security review completed

## 🚀 **Deployment Timeline**

1. **Week 1:** Infrastructure setup (Cloud SQL, Storage)
2. **Week 2:** Application deployment (Cloud Run)
3. **Week 3:** Domain & SSL configuration
4. **Week 4:** Testing & monitoring setup
5. **Week 5:** Go live! 🎉
