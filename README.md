## Datos básicos

Se debe clonar primero el proyecto ubicado en [LirmiProject](https://github.com/adlpaf/LirmiProject)

Luego se ingresa en el directorio que se creó al momento de clonar el proyecto y allí se ejecuta el comando **composer install**

Se debe modificar el archivo **.env** que aparece dentro del directorio raíz del proyecto, si no aparece copiar o renombrar el archivo **.env.example** a **.env**

En este archivo se deben agregar el nombre de la base de datos, el nombre del usuario de la base de datos y su contraseña. La base de datos debe ser creada de manera manual y darle sus respectivos permisos en su manejador de base de datos (PostgreSQL o MySQL, preferiblemente).

Después de esto, se debe ejecutar **php artisan migrate** para crear las tablas necesarias para el funcionamiento correcto de la aplicación.

Para finalizar, se puede ejecutar **php artisan serve** o configurar su servidor web (se debe tener en cuenta que el directorio que se debe publicar es el directorio **public** que se encuentra dentro del directorio raíz del proyecto).

En caso de usar **artisan** se puede acceder a la aplicación a través de **[localhost:8000](http://localhost:8000)**

No es necesario ejecutar ningún otro comando ya que las librerías de JS fueron insertadas a través de un CDN para facilitar el proceso de instalación para las pruebas.

## Se asume

Se asume que el sistema obtendrá de manera automática las 2 primeras páginas del API.

Se asume que no era necesario iniciar sesión, por tal motivo aparecerá de manera automática la información de la API cargada al iniciar
