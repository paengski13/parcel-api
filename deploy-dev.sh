# Pull the latest changes from the git repository
git pull origin master

# Install/update composer dependencies
composer install

# Run database migrations
php artisan migrate --force

# Insert configuration data and store in respective tables
php artisan db:seed

# This is to enable oauth2 and to be able to use bearer token
php artisan passport:install

# Clear caches
php artisan cache:clear

# Clear views
php artisan view:clear

# Clear expired password reset tokens
php artisan auth:clear-resets

# Clear and cache routes
php artisan route:clear

# Clear and cache config
php artisan config:clear

# Install node modules
npm ci

# Build assets using Laravel Mix
npm run watch
