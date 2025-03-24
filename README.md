# Prueba para Delsis

---------------------------------------------------
Versión de PHP utilizada: 8.4.5
Versión de PostgreSQL: 17.2
Versión de pgAdmin 4: 8.13
Versión de XAMPP: 3.3.0
---------------------------------------------------

1. Instalación de PostgreSQL y Configuración de la Base de Datos
Puedes descargarlo desde: https://www.postgresql.org/download/

  Inicia pgAdmin 4 e inicia sesión con las credenciales configuradas.
  En el panel izquierdo, haz clic derecho en Databases > Create > Database.
  Asigna un nombre a la base de datos, para hacer mas fácil esta guía, llámala "prueba_delsis" y presiona Guardar.

  En pgAdmin, selecciona la base de datos creada.
  Haz clic derecho en la base de datos y selecciona Query Tool, esto abrirá una pestaña en la que cargaremos
  los archivos SQL para crear y poblar las tablas con los archivos en la carpeta "sql" de este proyecto:

  1. Para la creación de tablas copiaremos el contenido del archivo "01_creacionTablas.sql" en nuestra Query Tool
  y presionaremos F5 para que se ejecute.

  2. Para poblar nuestras tablas recién creadas, copiaremos el contenido del archivo "02_datosTablas.sql" en
  nuestra Query Tool y presionaremos F5 para ejecutarlo.

  Con esto, nuestras tablas estarán creadas y pobladas con datos para las pruebas correspondientes.

------------------------------------------------------------------------------------------------

2. Instalación y configuración de XAMPP para levantar el proyecto:
Descarga XAMPP desde: https://www.apachefriends.org/es/index.html
Durante la instalación, asegúrate de seleccionar PHP y Apache.

  Abre la carpeta donde instalaste XAMPP (por ejemplo, C:\xampp\php).
  Edita el archivo php.ini y habilita las extensiones necesarias quitando el ; al inicio de las siguientes líneas:

  extension=pgsql
  extension=pdo_pgsql

  Copia los archivos del proyecto en la carpeta htdocs de XAMPP.
  La ruta final debería verse así: "C:\xampp\htdocs\prueba_delsis"

------------------------------------------------------------------------------------------------

3. Configuración del proyecto

  Dentro de la carpeta del proyecto, abre el archivo de configuración de la base de datos (config/db.php).

  Modifica las credenciales de conexión para que coincidan con la configuración local:

  $host = 'localhost';
  $port = '5432';
  $dbname = 'prueba_delsis';
  $user = 'postgres';
  $password = 'tu_contraseña';

------------------------------------------------------------------------------------------------

4. Levantar el Proyecto

  Iniciar XAMPP
  Abre el Panel de Control de XAMPP y activa Apache.

    Asegúrate de que el servicio de PostgreSQL está corriendo.
    Puedes verificarlo desde pgAdmin 4 o ejecutar:

      net start postgresql-x64-17

  Abre un navegador y accede a la aplicación desde:
  http://localhost/prueba_delsis
