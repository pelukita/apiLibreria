# apiLibreria

API RESTful para la gestión de la libreria AE.  
Permite **listar, obtener, crear, actualizar y eliminar** generos y libros mediante distintos endpoints HTTP.

## Contenido del proyecto

- `api_router.php` - Entry point para los endpoints de la API.
- `app/controllers/` - Controladores para libros y generos, por ejemplo `genres-api.controller.php`.
- `app/models/` - Modelos para libros y generos, por ejemplo `genres-api.model.php`.
- `libs/router/` - Librería ligera de ruteo usada por este proyecto.
- `db/db_libreria_tpe.sql` - Script SQL para crear la base de datos y tablas iniciales.
- `.htaccess`: reglas apache para soportar URL semánticas

---

## Endpoints

La URL base para todas las peticiones es `http://localhost/apilibreria/`.

## Endpoints de Géneros

### GET /api/genres — Listar todos los géneros

Devuelve todos los géneros. Se puede ordenar opcionalmente.

**Parámetros opcionales (query string):**
- `direction=ASC` (default) o `direction=DESC`

**Ejemplos:**
```
GET /api/genres
GET /api/genres?direction=DESC
```

**Respuesta exitosa:** `200 OK`
```json
[
  { "id_genero": 1, "nombre": "Ciencia Ficción", "descripcion": "...", "imagen": "..." },
  { "id_genero": 2, "nombre": "Terror", "descripcion": "...", "imagen": "..." }
]
```

---

### GET /api/genres/:id — Obtener un género por ID

**Ejemplo:**
```
GET /api/genres/1
```

**Respuesta exitosa:** `200 OK`
```json
{ "id_genero": 1, "nombre": "Ciencia Ficción", "descripcion": "...", "imagen": "..." }
```

**Si no existe:** `404 Not Found`
```json
"El genero con el id=1 no existe"
```

---

### POST /api/genres — Crear un género

**Body (JSON):**
```json
{
  "nombre": "Fantasía",
  "descripcion": "Libros de mundos imaginarios",
  "imagen": "https://ejemplo.com/imagen.jpg"
}
```

**Respuesta exitosa:** `201 Created`
```json
{ "id_genero": 3, "nombre": "Fantasía", "descripcion": "...", "imagen": "..." }
```

**Si faltan datos:** `400 Bad Request`
```json
"Faltan datos"
```

---

### PUT /api/genres/:id — Actualizar un género

**Ejemplo:**
```
PUT /api/genres/1
```

**Body (JSON):**
```json
{
  "nombre": "Acción y Aventura",
  "descripcion": "Descripción actualizada",
  "imagen": "https://ejemplo.com/imagen.jpg""
}
```

**Respuesta exitosa:** `201 Created`
```json
{ "id_genero": 1, "nombre": "Acción y Aventura", "descripcion": "...", "imagen": "..." }
```

**Si no existe:** `404 Not Found`

**Si faltan datos:** `400 Bad Request`

---

### DELETE /api/genres/:id — Eliminar un género

**Ejemplo:**
```
DELETE /api/genres/1
```

**Respuesta exitosa:** `204 No Content`

**Si no existe:** `404 Not Found`

---