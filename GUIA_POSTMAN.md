# 📮 Guía Completa: Peticiones en Postman

## 1. Configuración Inicial

### Paso 1: Crear Nueva Request
1. Abre Postman
2. Haz clic en **"New"** → **"HTTP Request"**
3. Se abrirá una nueva pestaña

---

## 2. Ejemplos de Peticiones

### ✅ Ejemplo 1: Obtener Todos los Documentos

**Tipo:** GET  
**URL:** `http://localhost:8000/api/documentosUnidadesActivas`

```
GET http://localhost:8000/api/documentosUnidadesActivas
```

**Pasos en Postman:**
1. Selecciona método: **GET**
2. En el campo URL escribe: `http://localhost:8000/api/documentosUnidadesActivas`
3. Haz clic en **Send**

**Respuesta esperada:** Array con todos los 6 documentos

---

### ✅ Ejemplo 2: Obtener Documento por ID

**Tipo:** GET  
**URL:** `http://localhost:8000/api/documentosUnidadesActivas/1`

```
GET http://localhost:8000/api/documentosUnidadesActivas/1
```

**Pasos en Postman:**
1. Selecciona método: **GET**
2. En el campo URL escribe: `http://localhost:8000/api/documentosUnidadesActivas/1`
3. Haz clic en **Send**

**Respuesta esperada:** 1 documento con toda la información jerárquica

---

### ✅ Ejemplo 3: Filtrar por Asunto (búsqueda parcial)

**Tipo:** POST  
**URL:** `http://localhost:8000/api/documentosUnidadesActivas/filtrar/search`

**Headers:**
```
Content-Type: application/json
```

**Body (JSON):**
```json
{
  "numeroRadicado": "",
  "asunto": "Contrato",
  "firmante": "",
  "observacion": ""
}
```

**Pasos en Postman:**
1. Selecciona método: **POST**
2. En el campo URL escribe: `http://localhost:8000/api/documentosUnidadesActivas/filtrar/search`
3. Ve a la pestaña **Headers** y verifica que esté: `Content-Type: application/json`
4. Ve a la pestaña **Body** → selecciona **raw** → elige **JSON** en el dropdown
5. Copia y pega el JSON anterior
6. Haz clic en **Send**

**Respuesta esperada:** 2 documentos (2024-001-CEN y 2024-002-CEN)

---

### ✅ Ejemplo 4: Filtrar por Número de Radicado (exacto)

**Tipo:** POST  
**URL:** `http://localhost:8000/api/documentosUnidadesActivas/filtrar/search`

**Body (JSON):**
```json
{
  "numeroRadicado": "2024-001-CEN",
  "asunto": "",
  "firmante": "",
  "observacion": ""
}
```

**Pasos en Postman:**
1. Selecciona método: **POST**
2. URL: `http://localhost:8000/api/documentosUnidadesActivas/filtrar/search`
3. Body → raw → JSON
4. Pega el JSON
5. **Send**

**Respuesta esperada:** 1 documento exacto (2024-001-CEN)

---

### ✅ Ejemplo 5: Filtrar por Firmante

**Tipo:** POST  
**URL:** `http://localhost:8000/api/documentosUnidadesActivas/filtrar/search`

**Body (JSON):**
```json
{
  "numeroRadicado": "",
  "asunto": "",
  "firmante": "Carlos",
  "observacion": ""
}
```

**Respuesta esperada:** 1 documento (General Carlos López)

---

### ✅ Ejemplo 6: Filtrar por Observación

**Tipo:** POST  
**URL:** `http://localhost:8000/api/documentosUnidadesActivas/filtrar/search`

**Body (JSON):**
```json
{
  "numeroRadicado": "",
  "asunto": "",
  "firmante": "",
  "observacion": "importante"
}
```

**Respuesta esperada:** 3 documentos que contienen "importante"

---

### ✅ Ejemplo 7: Filtros Combinados (AND)

**Tipo:** POST  
**URL:** `http://localhost:8000/api/documentosUnidadesActivas/filtrar/search`

**Body (JSON):**
```json
{
  "asunto": "Contrato",
  "firmante": "Coronel"
}
```

**Respuesta esperada:** 1 documento (2024-002-CEN)
- Filtra: asunto LIKE "Contrato" AND firmante LIKE "Coronel"

---

### ✅ Ejemplo 8: Múltiples Criterios

**Tipo:** POST  
**URL:** `http://localhost:8000/api/documentosUnidadesActivas/filtrar/search`

**Body (JSON):**
```json
{
  "numeroRadicado": "2024-002-CEN",
  "asunto": "Contrato",
  "firmante": "Coronel",
  "observacion": "urgente"
}
```

**Respuesta esperada:** 1 documento
- Filtra: numeroRadicado = "2024-002-CEN" AND asunto LIKE "Contrato" AND firmante LIKE "Coronel" AND observacion LIKE "urgente"

---

### ❌ Ejemplo 9: Error - Todos los Filtros Vacíos

**Tipo:** POST  
**URL:** `http://localhost:8000/api/documentosUnidadesActivas/filtrar/search`

**Body (JSON):**
```json
{
  "numeroRadicado": "",
  "asunto": "",
  "firmante": "",
  "observacion": ""
}
```

**Respuesta esperada:** Error 400
```json
{
  "code": 400,
  "title": "Filtros inválidos",
  "message": "Debe proporcionar al menos un parámetro de búsqueda válido: numeroRadicado, asunto, firmante u observacion"
}
```

---

### ✅ Ejemplo 10: Documentos por Unidad

**Tipo:** GET  
**URL:** `http://localhost:8000/api/documentosPorUnidad/1`

```
GET http://localhost:8000/api/documentosPorUnidad/1
```

**Respuesta esperada:** Todos los documentos de la unidad (6 documentos)

---

### ✅ Ejemplo 11: Documentos por Carpeta

**Tipo:** GET  
**URL:** `http://localhost:8000/api/documentosPorCarpeta/1/1`

```
GET http://localhost:8000/api/documentosPorCarpeta/1/1
```

**Parámetros:**
- `1` = id_unidad
- `1` = id_carpeta

**Respuesta esperada:** 3 documentos de la carpeta C-001

---

## 3. Respuesta Completa (Ejemplo Real)

Cuando hagas una solicitud GET a un documento individual, recibirás:

```json
{
  "code": 200,
  "title": "Documento de unidad activa obtenido",
  "message": "Se obtuvo el documento de unidad activa",
  "status": "success",
  "data": {
    "id_unidad_activa": 1,
    "id_carpeta_unidad_activa": 1,
    "numero_radicado": "2024-001-CEN",
    "fecha_elaboracion": "2024-01-15",
    "id_unidad": 1,
    "nombre_funcionario_destino": "Juan García",
    "asunto": "Contrato de servicios profesionales",
    "nombre_quien_firma": "General Carlos López",
    "cargo_quien_firma": "General del Ejército",
    "tipo_soporte": "Papel",
    "cantidad_folios": 5,
    "tipo_documental": "Contrato",
    "observaciones": "Documento importante firmado en enero",
    "id_estado": 1,
    "resumen": {
      "carpeta": {
        "id": 1,
        "numero": "C-001",
        "cantidad_folios": 50,
        "fecha_extrema_inicio": "2024-01-01",
        "fecha_extrema_fin": "2024-01-31"
      },
      "caja": {
        "id": 1,
        "codigo": "CJ-001",
        "numero_consecutivo": 1,
        "numero_correlativo": "COR-001",
        "anio": 2024,
        "cantidad_carpetas": 2,
        "cantidad_libros": 0,
        "suma_folios_caja": 50
      },
      "balda": {
        "id": 1,
        "nombre": "Balda A",
        "total_cajas": 2,
        "suma_folios_balda": 95
      },
      "estante": {
        "id": 1,
        "nombre": "Estante 1",
        "cantidad_baldas": 3,
        "suma_folios_estante": 95
      },
      "cuerpo": {
        "id": 1,
        "nombre": "Cuerpo Principal",
        "cantidad_estantes": 3,
        "suma_folios_cuerpo": 95
      },
      "archivo": {
        "id": 1,
        "ubicacion": "PRUEBA1",
        "direccion": "PRUEBA1",
        "edificio": "1",
        "piso": "2",
        "bodega": "1",
        "total_carpetas": 2,
        "suma_folios_archivo": 95
      },
      "unidad": {
        "id": 1,
        "nombre": "COMANDO DEL EJÉRCITO NACIONAL",
        "sigla": "CEN",
        "cantidad_cuerpos": 3,
        "total_carpetas": 2,
        "total_folios": 70
      },
      "estado": {
        "id": 1,
        "nombre": "Activo"
      }
    }
  }
}
```

---

## 4. Guardar como Colección en Postman

### Método 1: Crear Colección Manualmente

1. Haz clic en **Collections** (lado izquierdo)
2. Haz clic en **"+"** para crear nueva colección
3. Nombre: `Documentos Unidades Activas`
4. Guarda cada request dentro
5. Organiza por carpetas:
   - Documentos (GET)
   - Filtros (POST)
   - Por Unidad (GET)

### Método 2: Importar desde JSON

Copia y guarda este archivo como `postman_collection.json`:

```json
{
  "info": {
    "name": "Documentos Unidades Activas",
    "schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
  },
  "item": [
    {
      "name": "Obtener Todos",
      "request": {
        "method": "GET",
        "url": "http://localhost:8000/api/documentosUnidadesActivas"
      }
    },
    {
      "name": "Obtener por ID",
      "request": {
        "method": "GET",
        "url": "http://localhost:8000/api/documentosUnidadesActivas/1"
      }
    },
    {
      "name": "Filtrar por Asunto",
      "request": {
        "method": "POST",
        "header": [
          {
            "key": "Content-Type",
            "value": "application/json"
          }
        ],
        "body": {
          "mode": "raw",
          "raw": "{\"numeroRadicado\": \"\", \"asunto\": \"Contrato\", \"firmante\": \"\", \"observacion\": \"\"}"
        },
        "url": "http://localhost:8000/api/documentosUnidadesActivas/filtrar/search"
      }
    }
  ]
}
```

Luego en Postman: File → Import → selecciona el JSON

---

## 5. Tips Útiles

### Pre-request Script (Opcional)
Si quieres agregar un token o datos dinámicos:

```javascript
// En la pestaña "Pre-request Script"
pm.environment.set("base_url", "http://localhost:8000");
```

Luego usa: `{{base_url}}/api/documentosUnidadesActivas`

### Test Script (Opcional)
Para validar respuestas automáticamente:

```javascript
// En la pestaña "Tests"
pm.test("Status code is 200", function () {
    pm.response.to.have.status(200);
});

pm.test("Response has success status", function () {
    var jsonData = pm.response.json();
    pm.expect(jsonData.status).to.eql("success");
});
```

---

## 6. Variables de Entorno

Crea un environment en Postman:

**Nombre:** Desarrollo

**Variables:**
| Key | Value |
|---|---|
| base_url | http://localhost:8000 |
| api_version | api |
| documento_id | 1 |

Luego usa: `{{base_url}}/{{api_version}}/documentosUnidadesActivas/{{documento_id}}`

---

¡Listo! Ya tienes todo para probar desde Postman 🚀
