#!/bin/bash
set -e

export NVM_DIR=~/.nvm
source ~/.nvm/nvm.sh

echo "Deployment started ..."

(php artisan down) || true

git pull origin deploy

composer dump-autoload

npm run build

php artisan migrate

php artisan up

echo "Deployment finished!"
