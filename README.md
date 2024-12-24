# Deacero - Simple Inventory
Instalar proyecto
--

**Requisitos previos**

 - Instalar composer
 - Instalar servidor local, se recomienda ([Laragon](https://laragon.org/download/index.html)) o docker con ([Laradock](https://laradock.io/))

**Requisitos del servidor**

 - PHP >= 8.2.0

## Ejecutar el proyecto

### **Para ejecutar el proyecto debe realizar los siguientes pasos:**

1. Clonar, instalar las dependencias:
 ```
 git https://github.com/crayderr/simple_inventory.git
 composer install
 ```

2. Copiar el archivo `.env.example` como `.env`:

```
cp .env.example .env
```

3. Configurar la base de datos en el archivo `.env` (por defecto se utilizará sqlite)

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

4. Generar una APP_KEY para la aplicación:

```
php artisan key:generate
```
5. Ejecutar las migraciones y seeder para crear las tablas y los datos por defecto:

```
php artisan migrate:fresh
```

### Comandos para test

 - Ejecutar los test
`php artisan test`

 - Ejecutar un test de forma especifica
`php artisan test --filter methodNameTest`




## **Documentación de la API**

datos de prueba
- email:
    -   super@admin.com
- password:
    -   12345678

### **Obtener un token de acceso**

```
url: /api/login
method: POST
params: {
    'email'    => 'required|email',
    'password' => 'required|string',
}
```

- Ejemplo de respuesta

```json
{
    "message": "Login successful",
    "token": "1|aKVLkHyhiyp5TzstfPbCFou6sqmj2ii5tvS2QIJPde1b85d7",
    "user": {
        "id": 1,
        "name": "Super admin",
        "email": "super@admin.com",
        "email_verified_at": "2024-12-24T14:27:07.000000Z",
        "created_at": "2024-12-24T14:27:08.000000Z",
        "updated_at": "2024-12-24T14:27:08.000000Z"
    }
}

```


### **Listar productos**
---

```
url: /api/products'
method: GET
auth: SI
headers: {
    'Authorization Bearer {token}'
}
params: {
    'search'     => 'sometimes|string',
    'category'   => 'sometimes|string',
    'price'      => 'sometimes|numeric',
    'limit'      => 'sometimes|integer',
}
```

- Ejemplo de respuesta

```json
{
    "data": [
        {
            "id": "d8022072-8b64-3cdd-98af-58bd9e182cb6",
            "name": "Leonel Will II",
            "description": "Vel dolorum sit magnam delectus perferendis. Quibusdam quidem dolor in temporibus maiores. Rem pariatur nemo suscipit ducimus magni molestiae facere.",
            "category": "aliquid",
            "price": 2956,
            "sku": "Magni."
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/products?page=1",
        "last": null,
        "prev": null,
        "next": "http://127.0.0.1:8000/api/products?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "path": "http://127.0.0.1:8000/api/products",
        "per_page": "1",
        "to": 1
    }
}
```

### **Crear un producto**
---

```
url: /api/products'
method: POST
auth: SI
headers: {
    'Authorization Bearer {token}'
}
params: {
    'name'        => 'required|string',
    'description' => 'required|string',
    'category'    => 'required|string',
    'price'       => 'required|numeric',
    'sku'         => 'required|string',
}
```

- Ejemplo de respuesta

```json
{
    "id": "d8022072-8b64-3cdd-98af-58bd9e182cb6",
}
```

### **Actualizar un producto**
---

```
url: /api/products/{id}'
method: PUT
auth: SI
headers: {
    'Authorization Bearer {token}'
}
params: {
    'name'        => 'sometimes|string',
    'description' => 'sometimes|string',
    'category'    => 'sometimes|string',
    'price'       => 'sometimes|numeric',
    'sku'         => 'sometimes|string',
}
```

- Ejemplo de respuesta

```json
{
    "success": true,
}
```

### **Eliminar un producto**
---

```
url: /api/products/{id}'
method: DELETE
auth: SI
headers: {
    'Authorization Bearer {token}'
}
```

- Ejemplo de respuesta

```json
{
    "success": true,
}
```

### **Obtener un producto**
---

```
url: /api/products/{id}'
method: GET
auth: SI
headers: {
    'Authorization Bearer {token}'
}
```

- Ejemplo de respuesta

```json
{
    "data": {
        "id": "d8022072-8b64-3cdd-98af-58bd9e182cb6",
        "name": "Leonel Will II",
        "description": "Vel dolorum sit magnam delectus perferendis. Quibusdam quidem dolor in temporibus maiores. Rem pariatur nemo suscipit ducimus magni molestiae facere.",
        "category": "aliquid",
        "price": 2956,
        "sku": "Magni."
    }
}
```

### **Listar inventario de una tienda**

```
url: api/stores/{id}/inventory'
method: GET
auth: SI
headers: {
    'Authorization Bearer {token}'
}
```

- Ejemplo de respuesta

```json

{
    "current_page": 1,
    "data": [
        {
            "id": "51adfedf-bd83-3d2a-b1f1-e21ec52ba0e1",
            "product_id": "f5f0f7c7-1c29-3aaa-ba18-cf1bbe07978e",
            "store_id": "338ce7e3-4d4a-3a20-b810-dddc2b7b282d",
            "quantity": 47,
            "name": "Theo Dibbert",
            "price": 2446
        }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/stores/338ce7e3-4d4a-3a20-b810-dddc2b7b282d/inventory?page=1",
    "from": 1,
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/api/stores/338ce7e3-4d4a-3a20-b810-dddc2b7b282d/inventory",
    "per_page": 15,
    "prev_page_url": null,
    "to": 1
}

```

### **Transferir inventario de una tienda a otra**

```
url: api/inventory/transfer'
method: POST
auth: SI
headers: {
    'Authorization Bearer {token}'
}
params: {
    'product_id'        => 'required|string',
    'source_store_id'   => 'required|string',
    'target_store_id'   => 'required|string',
    'quantity'          => 'required|numeric',
}
```

- Ejemplo de respuesta

```json
{
    "success": true,
}
```

### **Listar productos con stock bajo**

```
url: /api/inventory/alerts'

method: GET
auth: SI
headers: {
    'Authorization Bearer {token}'
}
```

- Ejemplo de respuesta

```json
{
    "data": [
        {
            "id": "c226e3f9-5338-31f2-8ffd-8814c4d8f05d",
            "name": "Leonel Will II",
            "description": "Vel dolorum sit magnam delectus perferendis. Quibusdam quidem dolor in temporibus maiores. Rem pariatur nemo suscipit ducimus magni molestiae facere.",
            "category": "aliquid",
            "price": 2956,
            "sku": "Magni.",
            "quantity": 8
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/inventory/alerts?page=1",
        "last": null,
        "prev": null,
        "next": "http://127.0.0.1:8000/api/inventory/alerts?page=2"
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "path": "http://127.0.0.1:8000/api/inventory/alerts",
        "per_page": "1",
        "to": 1
    }
}
```