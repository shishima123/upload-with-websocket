## Documentation

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Laravel Websockets](https://beyondco.de/docs/laravel-websockets/getting-started/introduction).
- [Video Youtube Tutorial](https://www.youtube.com/watch?v=pIGy7-7gGXI).
- [Laravel Broadcasting](https://laravel.com/docs/8.x/broadcasting).

## NPM INSTALL
If environment is local host, must install pusher-js version 4.3.1. Because Latest version always seems to listen on secure wss instead of the non-secure ws.

	Development:
	- npm install laravel-echo pusher-js@4.3.1

	Production: 
	- npm install laravel-echo pusher-js
	
## Composer
	- composer require beyondcode/laravel-websockets
	- composer require pusher/pusher-php-server
## File config
	- config\broadcasting.php
	- resources\js\bootstrap.js
	- resources\views\welcome.blade.php
	- app\Events\UploadEvent.php
After change file bootstrap.js. Must using laravel-mix to build file app.js