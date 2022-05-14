# Chat
To run chat part of app you have to:
```bash
# Pusher credentials must be set in .env
# Broadcasting driver should be set to pusher 
cd .docker
docker-compose up
# Inside another instance of shell
docker-compose exec php-fpm sh
# Inside container shell
php artisan horizon
# Inside another instance of container shell
php artisan queue:work
```
