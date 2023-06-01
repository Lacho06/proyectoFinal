Requisitos

php version 8.1 o superior
npm version 8 o superior
node version 16 o superior
composer version 2.3 o superior

Tener instalado un servidor web (XAMPP, WAMPP, LARAGON o cualquiera de sus alternativas)
Debe tener el proyecto en el servidor web seleccionado (en el caso de laragon seria en la carpeta laragon/www/)
Instrucciones de instalación

Ejecutar el comando composer install
Crear una base de datos con el nombre especificado en el archivo .env
Ejecutar el comando php artisan migrate --seed
Ejecutar el comando php artisan storage:link
Ejecutar el comando npm install

Para compilar el codigo:
Ejecutar el comando npm run dev

Es necesario el uso de internet para visualizar la web porque hay librerias que cargan sus datos desde otro servidor
