<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Acerca Del Proyecto

Este proyecto es un requisito de la prueba tecnica para Cita Medica, lamentablemente el proyecto no esta completo, me hubiera gustador terminarlo y hacer un mejor trabajo, asi que es tiempo de aprender mucho mas, igualmente continuare con el proyecto hasta que este presentable, ahora hablemos de requerimientos:

Es importante tener un ambiente de desarrollo bien configurado, necesitaras PHP 8.1^ y composer. Yo me apoyo con Laragon para tener un ambiente de desarrollo completo y enfocado al desarrollo en PHP.

**Pasos:**

1. Descarga el proyecto (o clonalo usando Git)
2. Copia el contenido de `.env.example` en tu archivo `.env` y confighura las credenciales de base de datos.
3. Navega al directorio raiz del proyecto usando la terminal.
4. Corre el comando `composer install`
5. Setea la llave de encriptacion corriendo el comando `php artisan key:generate --ansi`
6. Corre las migraciones con el comando `php artisan migrate`
7. Por ultimo inicia el servidor local con el comando `php artisan serve`
8. Para las pruebas de la API use [Bruno](https://www.usebruno.com/) un excelente cliente php, de todas formas dejare la coleccion de endpoints compatibles para Postman, en el directorio raiz en la carpeta `PostmanCollection`

## ¿Por que Laravel?

Laravel tiene uan de las documentaciones mas extensas [documentation](https://laravel.com/docs) y muchos video tutoriales , haciendo que sea un framework facil de entender.

la idea de usar laravel es poder usar los principios SOLID, ya que Laravel te da muchas herramientas que te permiten aplicar todos los principios SOLID de quererse o ser necesario, dando como resulto, valga la redundancia un codigo SOLIDO(SOLID).

## ¿Qué Falta por hacer?
Falta implementar el CRUD de hospitales y todo el frontend, dicho frontend se implementara con ReactJS + Vite.

## Finalizando
Este proyecto, a pesar de no esatr terminado, se ira actualizando hasta alcanzar el objetivo principal, que serai implementar tanto el agendado de citas como la edicion de los medicos por hospital, con su correspondiente frontend, quedando este proyecto como una muestra de un sistema web implementado con Laravel + ReactJS, que dando no solo como una muestra de mi portafolio, sino tambien como un proyecto que pueda ser utilizado por quien lo necesite y desee aprender.
