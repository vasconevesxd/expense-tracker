#!/bin/bash

# Stop and remove all containers and volumes
docker-compose down -v

# Recreate and start containers
docker-compose up -d --build

# Wait
sleep 10


# Run migrations and seeders for backend
docker exec backend php artisan migrate --force
docker exec backend php artisan db:seed --force

# Start frontend development server
docker exec -d frontend quasar dev