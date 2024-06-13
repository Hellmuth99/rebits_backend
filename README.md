# Mantenedor de Vehículos

Este proyecto tiene como objetivo desarrollar un sistema básico de mantención de vehículos, utilizando Laravel 10 para el backend y Vue.js para el frontend.

## Características Implementada

1. **CRUD de Vehículos y Usuarios:**

    - Gestión completa (Crear, Leer, Actualizar, Eliminar) de vehículos y usuarios.
    - Relación donde un usuario puede ser dueño de uno o más vehículos.

2. **Cambiar Dueño de Vehículo:**

    - Permite cambiar el dueño de un vehículo durante la edición del mismo.
    - Mantiene un historial de los dueños anteriores de cada vehículo.

3. **Carga desde Archivo Excel:**

    - Permite cargar usuarios y vehículos desde un archivo Excel con un formato específico.
    - Validaciones incluidas para evitar duplicados y asociaciones incorrectas.

4. **Notificaciones por Correo:**

    - Al completar la carga desde Excel, se envía un correo informando sobre el resultado (éxito o errores).

5. **Seguridad y Validaciones:**

    - Validación para asegurar que los vehículos no se dupliquen por patente.
    - Asociación correcta de vehículos y usuarios existentes.

6. **Pruebas Unitarias:**

    - Incluye al menos una prueba unitaria utilizando PHPUnit para verificar la funcionalidad clave del sistema.

7. **Opcionales:**
    - Implementación de soft deleting para la función DELETE.
    - Utilización de Docker Compose para la configuración de la base de datos.

### Configuración del Proyecto

### Requisitos Previos

-   PHP >= 7.3
-   Composer
-   Node.js y npm (para el frontend)
-   Docker y Docker Compose (para la base de datos)

### Pasos para Ejecutar

1. **Clonar el Repositorio:**

    ```bash
    git clone <URL_DEL_REPOSITORIO>
    cd nombre_del_proyecto

    ```

2. **Instalar Dependencias Backend:**

    ```bash
    composer install

    ```

3. **Configurar el Entorno:**

    ```bash
    Copiar .env.example a .env y configurar la conexión a la base de datos y el envío de correo SMTP.

    ```

4. **Iniciar Docker Compose (Base de Datos):**

    ```bash
    docker-compose up -d

    ```

5. **Generar Clave de Aplicación:**

    ```bash
    php artisan key:generate

    ```

6. **Migrar y Sembrar la Base de Datos:**

    ```bash
    php artisan migrate

    ```

7. **Ejecutar Pruebas Unitarias**

    ```bash
    php artisan test

    ```

8. **Ejecutar Pruebas Unitarias**

    ```bash
    php artisan serve

    ```

9. **Accede al sistema**
    ```bash
    Abrir el navegador y visitar http://localhost:8000



    ```
