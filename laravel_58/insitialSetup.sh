#!/usr/bin/env bash

# Fails at the first error encountered
set -e

echo "INITIAL SETUP start"

# Migrations and seeders
echo "Migrating tables . . ."

php artisan migrate

echo "Tables migrated successfully."

echo "Seeding data . . ."

php artisan db:seed --class=PermissionTableSeeder
php artisan db:seed --class=CreateAdminUserSeeder
php artisan db:seed --class=DevUserSeeder

echo "Data seeded successfully."

echo "INITIAL SETUP finished successfully, have fun ;)"