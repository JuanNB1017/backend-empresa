# 🏗️ API de Gestión de Colaboradores - Laravel 10 + JWT

Esta es una API RESTful desarrollada en **Laravel 10** con **JWT (JSON Web Token)** para autenticación. Permite la gestión de colaboradores, incluyendo creación, actualización, eliminación y consulta de datos.

---

## 🚀 **Requisitos previos**
Antes de iniciar el proyecto, asegúrate de tener instalados los siguientes requisitos:

- **PHP 8.1 o superior**
- **Composer** (https://getcomposer.org/)
- **MySQL** o **PostgreSQL** como base de datos
- **Laravel 10**
- **Postman** o cualquier cliente HTTP para pruebas

---

## 📌 **Instalación**
### 1️⃣ Clonar el repositorio
```bash
git clone https://github.com/tu-usuario/tu-repositorio.git
cd tu-repositorio
```

### 2️⃣ Instalar dependencias
```bash
composer install
```

### 3️⃣ Configurar el entorno
Copia el archivo de entorno:
```bash
cp .env.example .env
```
Genera la clave de la aplicación:
```bash
php artisan key:generate
```

Configura tu conexión a la base de datos en **`.env`**:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_bd
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

---

## 🛠 **Configuración de JWT**
Genera la clave secreta de JWT:
```bash
php artisan jwt:secret
```

---

## 📂 **Migraciones y Seeders**
Ejecuta las migraciones para crear las tablas en la base de datos:
```bash
php artisan migrate
```

Opcionalmente, puedes agregar datos de prueba:
```bash
php artisan db:seed
```

---

## 🚀 **Ejecutar el servidor**
Para iniciar la aplicación, ejecuta:
```bash
php artisan serve
```
Esto iniciará el servidor en:
```
http://127.0.0.1:8000
```

Si deseas ejecutar la API en un puerto diferente:
```bash
php artisan serve --port=8080
```

---

## 🔑 **Autenticación con JWT**
### 📌 Registro de usuario
**Endpoint:**  
`POST /api/auth/register`  
**Body (JSON):**
```json
{
    "name": "Juan Pérez",
    "email": "juan@example.com",
    "password": "123456"
}
```

### 📌 Iniciar sesión (Obtener token)
**Endpoint:**  
`POST /api/auth/login`  
**Body (JSON):**
```json
{
    "email": "juan@example.com",
    "password": "123456"
}
```
**Respuesta esperada:**
```json
{
    "access_token": "tu_token_aqui",
    "token_type": "bearer",
    "expires_in": 7200
}
```

### 📌 Validar usuario autenticado
**Endpoint:**  
`GET /api/auth/me`  
**Headers:**
```json
Authorization: Bearer TU_TOKEN
```

### 📌 Cerrar sesión
**Endpoint:**  
`POST /api/auth/logout`  
**Headers:**
```json
Authorization: Bearer TU_TOKEN
```

---

## 📂 **Rutas de la API**
Todas las rutas CRUD requieren autenticación con **JWT** (`Authorization: Bearer TU_TOKEN`).

### 📌 Obtener todos los colaboradores
**GET** `/api/colaborator`

### 📌 Buscar colaborador por ID
**GET** `/api/find-colaborator/{id}`

### 📌 Filtrar colaboradores por estatus (activo/inactivo)
**POST** `/api/colaborator/status`
**Body (JSON):**
```json
{
    "status": "activo"
}
```

### 📌 Crear un nuevo colaborador
**POST** `/api/create-colaborator`
**Body (multipart/form-data):**
- `nombre_completo` (string)
- `empresa` (string)
- `area` (string)
- `departamento` (string)
- `puesto` (string)
- `fotografia` (archivo opcional)
- `estatus` (`activo` o `inactivo`)

### 📌 Actualizar un colaborador
**PUT** `/api/update-colaborator-info/{id}`
**Body (JSON):**
```json
{
    "nombre_completo": "Nuevo Nombre",
    "empresa": "Nueva Empresa",
    "area": "Nuevo Área",
    "departamento": "Nuevo Departamento",
    "puesto": "Nuevo Puesto",
    "fotografia": "imagen.jpg",
    "estatus": "activo"
}
```

### 📌 Eliminar un colaborador
**DELETE** `/api/delete-colaborator/{id}`

---

## 🖼️ **Manejo de Imágenes**
Las imágenes se almacenan en `storage/app/public/colaboradores` y son accesibles a través de:
```
http://127.0.0.1:8000/storage/colaboradores/imagen.jpg
```
Si no puedes acceder a las imágenes, ejecuta:
```bash
php artisan storage:link
```

---

## 📌 **Errores comunes y soluciones**
1. **Error 419 en peticiones PUT o POST**
   - Excluye la ruta en `app/Http/Middleware/VerifyCsrfToken.php`:
   ```php
   protected $except = ['api/*'];
   ```

2. **Token no válido o expirado**
   - Asegúrate de enviar `Authorization: Bearer TU_TOKEN` en cada petición protegida.
   - Si el token expiró, inicia sesión de nuevo.

3. **No puedo acceder a imágenes subidas**
   - Asegúrate de ejecutar:
   ```bash
   php artisan storage:link
   ```

---

## 🛠 **Tecnologías usadas**
- **Laravel 10**
- **MySQL / PostgreSQL**
- **JWT para autenticación**
- **Manejo de imágenes con Laravel Storage**
- **Postman para pruebas de API**

---

## 🛠 **Autor y contacto**
👤 **Desarrollado por**: [Tu Nombre]  
📧 **Email**: [tu-email@example.com]  
📌 **GitHub**: [https://github.com/tu-usuario](https://github.com/tu-usuario)  

---

## 🎯 **Contribuir**
Si quieres mejorar esta API, ¡eres bienvenido!  
1. Haz un **fork** del repositorio.  
2. Crea una nueva rama:  
   ```bash
   git checkout -b nueva-feature
   ```
3. Haz tus cambios y **commitea**:  
   ```bash
   git commit -m "Agregada nueva funcionalidad"
   ```
4. Sube los cambios a tu repositorio:  
   ```bash
   git push origin nueva-feature
   ```
5. Abre un **Pull Request** en este repositorio.  
