<html lang="en">
<head>
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>
</head>
<body>
    <h1><b>Kooomo Challenge (by Nelson Álvarez)</b></h1>

Instrucciones de instalación

1. Descartar repositorio de: https://github.com/nelsonalva/k-challenge.git
2. Desde la carpeta del proyecto, instalar Composer: <code>composer install</code>
3. Crear archivo .env en el proyecto
4. Generar la llave de encriptación para el archivo .env: <code>php artisan key:generate</code>
5. Crear base de datos vacía (cualquier nombre) en MySQL, con usuario root y sin contraseña. Y asegurarse de que las credenciales coincidan en el archivo .env.
6. Migrar bd: <code>php artisan migrate</code>
7. Propagar registros en base de datos: <code>php artisan db:seed</code>

A continuación, se adjunta el link de Postman con la colección de endpoints.

Endpoints: https://www.getpostman.com/collections/87d771279ef83c644d1c

Los endpoints públicos empiezan por el prefijo "public/". Los endpoints protegidos empiezan por el prefijo "protected/". Estos últimos, tienen un header de autorización con un usuario y contraseña. El usuario puede ser cualquiera de los 3 de la base de datos (el email) y la contraseña para todos es "password".

Para que no tengan que hacer ningún cambio a los requests de Postman, se recomienda en la base de datos editar el email de alguno de los usuarios por el siguiente (que ya está configurado en los requests): 

celestine.kemmer@example.net

De esta manera el proyecto debería funcionar sin inconvenientes. Si no se cambia el correo en base de datos, debe cambiarse en cada endpoint que lo requiera.
 
</body>
</html>






