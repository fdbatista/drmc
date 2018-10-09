<p align="center">
    Warehouse Management
</p>

Instrucciones de instalación:
-------------------------------
- Descarga este repositorio y colócalo en una carpeta visible de tu servidor Web (WAMP usa www, XAMPP usa htdocs, etc...).
- Crea una nueva base de datos o deja completamente vacía una existente.
- Por defecto, la configuración de la aplicación usa una base de datos llamada 'drmc'. Si quieres usar otro nombre de base de datos, edita el fichero de configuración <code>common/config/main-local.php</code> y escribe los parámetros deseados.
- Abre una consola en la raíz de la aplicación y ejecuta <code>yii migrate</code>. Eso te va a generar los objetos de la base de datos.
- Una vez finalizada la migración, ejecuta <code>composer install</code> para descargar todas las dependencias del proyecto. Cuando termine, puedes ejecutar <code>composer update</code> para asegurarte de que tengas las últimas versiones de todos los paquetes.
- Suponiendo que tu servidor Web escuche en el puerto 80 predeterminado y que hayas colocado la aplicación en la raíz del directorio visible, tendrías el frontend en http://localhost/drmc/ y el backend en http://localhost/drmc/admin.
- Puedes iniciar sesión en el backend con la combinación de usuario/contraseña admin/a
