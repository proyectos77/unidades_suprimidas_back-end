# 📋 Instrucciones para Pruebas - Documentos de Unidades Activas

## 1. Cargar Datos de Prueba

### Opción A: Usando MySQL CLI
```bash
mysql -u tu_usuario -p tu_base_datos < datos_prueba_documentos.sql
```

### Opción B: Usando PhpMyAdmin
1. Ve a tu panel de PhpMyAdmin
2. Selecciona tu base de datos
3. Ve a "SQL"
4. Copia y pega el contenido de `datos_prueba_documentos.sql`
5. Ejecuta

### Opción C: Usando Laravel Tinker
```bash
php artisan tinker
```

## 2. Datos de Prueba Creados

### Unidad
- **Nombre:** COMANDO DEL EJÉRCITO NACIONAL
- **Sigla:** CEN
- **ID:** Se genera automáticamente

### Archivo
- Ubicación: PRUEBA1
- Dirección: PRUEBA1
- Edificio: 1
- Piso: 2
- Bodega: 1

### Estructura de Almacenamiento
- **Cantidad Cuerpos:** 3
- **Cantidad Estantes:** 3
- **Cantidad Baldas:** 3
- **Total Cajas:** 2
- **Total Carpetas:** 2
- **Total Folios:** 70

### Documentos Creados (6 total)
| Número Radicado | Asunto | Firmante | Folios | Observación |
|---|---|---|---|---|
| 2024-001-CEN | Contrato de servicios profesionales | General Carlos López | 5 | Documento importante firmado en enero |
| 2024-002-CEN | Contrato de suministros militares | Coronel David Martínez | 8 | Requisito urgente para operaciones |
| 2024-003-CEN | Acuerdo interinstitucional | Teniente Coronel Roberto Silva | 12 | Documento de coordinación con otras entidades |
| 2024-004-CEN | Protocolo de seguridad | Mayor Fernando Díaz | 15 | Normativa de seguridad operativa |
| 2024-005-CEN | Resolución administrativa | Capitán Alejandro Torres | 10 | Decisión administrativa importante |
| 2024-006-CEN | Memorándum interno | Teniente Juan Pérez | 20 | Comunicación interna crítica |

## 3. Pruebas de Endpoints

### 3.1 Obtener Todos los Documentos (con información completa)
```http
GET /api/documentosUnidadesActivas
```

**Respuesta:** Lista de 6 documentos con toda la jerarquía y sumas de folios

---

### 3.2 Obtener un Documento Específico
```http
GET /api/documentosUnidadesActivas/1
```

**Respuesta incluye:**
```json
{
  "id_unidad_activa": 1,
  "numero_radicado": "2024-001-CEN",
  "asunto": "Contrato de servicios profesionales",
  "nombre_quien_firma": "General Carlos López",
  "cargo_quien_firma": "General del Ejército",
  "cantidad_folios": 5,
  "observaciones": "Documento importante firmado en enero",
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
```

---

### 3.3 Filtrar por Número de Radicado (exacto)
```http
POST /api/documentosUnidadesActivas/filtrar/search
Content-Type: application/json

{
  "numeroRadicado": "2024-001-CEN",
  "asunto": "",
  "firmante": "",
  "observacion": ""
}
```

**Respuesta:** 1 documento exacto
- Solo se aplica el filtro de `numeroRadicado` porque es el único con valor
- Los campos vacíos se ignoran automáticamente

---

### 3.4 Filtrar por Asunto (LIKE - búsqueda parcial)
```http
POST /api/documentosUnidadesActivas/filtrar/search
Content-Type: application/json

{
  "numeroRadicado": "",
  "asunto": "Contrato",
  "firmante": null,
  "observacion": ""
}
```

**Respuesta:** 2 documentos (2024-001-CEN y 2024-002-CEN)
- Solo filtra por `asunto` (búsqueda parcial)
- Los valores vacíos (`""`, `null`) son ignorados

---

### 3.5 Filtrar por Firmante (búsqueda parcial)
```http
POST /api/documentosUnidadesActivas/filtrar/search
Content-Type: application/json

{
  "numeroRadicado": "",
  "asunto": "",
  "firmante": "Carlos",
  "observacion": ""
}
```

**Respuesta:** 1 documento (2024-001-CEN - General Carlos López)
- Búsqueda parcial en `nombre_quien_firma`

---

### 3.6 Filtrar por Observación (búsqueda parcial)
```http
POST /api/documentosUnidadesActivas/filtrar/search
Content-Type: application/json

{
  "numeroRadicado": "",
  "asunto": "",
  "firmante": "",
  "observacion": "importante"
}
```

**Respuesta:** 3 documentos que contienen "importante"

---

### 3.7 Filtro Combinado (todos con datos)
```http
POST /api/documentosUnidadesActivas/filtrar/search
Content-Type: application/json

{
  "numeroRadicado": "2024-002-CEN",
  "asunto": "Contrato",
  "firmante": "Coronel",
  "observacion": "urgente"
}
```

**Respuesta:** Documentos que cumplan TODOS los criterios simultáneamente
- En este caso: 1 documento (2024-002-CEN)

---

### 3.8 Filtro Mixto (algunos vacíos, algunos llenos)
```http
POST /api/documentosUnidadesActivas/filtrar/search
Content-Type: application/json

{
  "asunto": "Contrato",
  "firmante": "Coronel"
}
```

**Respuesta:** Documentos donde ASUNTO contenga "Contrato" AND FIRMANTE contenga "Coronel"
- Solo se aplican filtros para campos con información
- Campos no enviados o vacíos se ignoran

---

### 3.9 Sin parámetros válidos (error)
```http
POST /api/documentosUnidadesActivas/filtrar/search
Content-Type: application/json

{
  "numeroRadicado": "",
  "asunto": null,
  "firmante": "   ",
  "observacion": ""
}
```

**Respuesta:** Error 400 - "Debe proporcionar al menos un parámetro de búsqueda válido"
- No hay filtros válidos (todos están vacíos o son nulos)

---

## 4. 🔍 Cómo Funciona el Sistema de Filtros Inteligente

### Validación de Parámetros

El servicio valida automáticamente los parámetros entrantes:

```
ENTRADA                          VALIDACIÓN                    ACCIÓN
────────────────────────────────────────────────────────────────────────
""  (string vacío)       ➜ Se considera vacío           ➜ IGNORADO
null                     ➜ Se considera sin valor       ➜ IGNORADO
"   " (solo espacios)    ➜ Después de trim() = ""       ➜ IGNORADO
"Valor"                  ➜ Tiene contenido              ➜ APLICADO
0                        ➜ Es valor válido              ➜ APLICADO
false                    ➜ Es valor válido              ➜ APLICADO
```

### Lógica de Filtrado

1. **Recibe todos los parámetros** en una sola petición POST
2. **Valida cada parámetro** para saber si tiene información válida
3. **Aplica solo los filtros** para parámetros con datos
4. **Combina con AND** - todos los filtros activos deben cumplirse
5. **Retorna resultados** que cumplan con todos los criterios

### Ejemplos de Validación

#### Ejemplo 1: Todos los campos vacíos
```json
{
  "numeroRadicado": "",
  "asunto": null,
  "firmante": "   ",
  "observacion": ""
}
```
**Resultado:** ❌ Error 400 - No hay filtros válidos

---

#### Ejemplo 2: Un campo con valor, otros vacíos
```json
{
  "numeroRadicado": "",
  "asunto": "Contrato",
  "firmante": null,
  "observacion": ""
}
```
**Validación:**
- `numeroRadicado`: "" ➜ IGNORADO
- `asunto`: "Contrato" ➜ APLICADO
- `firmante`: null ➜ IGNORADO
- `observacion`: "" ➜ IGNORADO

**Query ejecutado:**
```sql
SELECT * FROM documentos_unidad_activas 
WHERE asunto LIKE '%Contrato%'
```

---

#### Ejemplo 3: Múltiples campos con valores
```json
{
  "asunto": "Contrato",
  "firmante": "Coronel",
  "observacion": "urgente"
}
```
**Validación:**
- `asunto`: "Contrato" ➜ APLICADO
- `firmante`: "Coronel" ➜ APLICADO
- `observacion`: "urgente" ➜ APLICADO

**Query ejecutado:**
```sql
SELECT * FROM documentos_unidad_activas 
WHERE asunto LIKE '%Contrato%'
  AND nombre_quien_firma LIKE '%Coronel%'
  AND observaciones LIKE '%urgente%'
```

**Resultado:** Solo documentos que cumplan TODOS los criterios

---

### 3.8 Documentos por Unidad
```http
GET /api/documentosPorUnidad/1
```

**Respuesta:** Todos los 6 documentos de la unidad con información completa

---

### 3.9 Documentos por Carpeta
```http
GET /api/documentosPorCarpeta/1/1
```

**Respuesta:** Documentos de la carpeta C-001 (3 documentos)

---

## 5. Validaciones

### Verificar que todas las sumas sean correctas:
- **Carpeta C-001:** 5 + 8 + 12 = 25 folios
- **Carpeta C-002:** 15 + 10 + 20 = 45 folios
- **Caja CJ-001:** 25 folios (de C-001)
- **Caja CJ-002:** 45 folios (de C-002)
- **Balda A:** 25 + 45 = 70 folios
- **Estante 1:** 70 folios (solo una balda con datos)
- **Cuerpo Principal:** 70 folios
- **Archivo:** 70 folios
- **Unidad:** 70 folios totales

---

## 6. Herramientas Recomendadas para Pruebas

### Postman
1. Importa una nueva colección
2. Crea las solicitudes HTTP según los ejemplos arriba
3. Guarda la colección para futuras pruebas

### cURL (línea de comandos)
```bash
# Filtrar por asunto
curl -X POST http://localhost:8000/api/documentosUnidadesActivas/filtrar/search \
  -H "Content-Type: application/json" \
  -d '{"asunto":"Contrato"}'

# Obtener documento específico
curl -X GET http://localhost:8000/api/documentosUnidadesActivas/1
```

### Thunder Client (VS Code)
- Extensión para VS Code similar a Postman
- Más liviana y directamente en el editor

---

## 7. Limpiar Datos de Prueba

Si necesitas limpiar los datos de prueba, ejecuta:

```sql
-- Eliminar documentos de prueba
DELETE FROM documentos_unidad_activas WHERE numero_radicado LIKE '2024-%';

-- Eliminar carpetas de prueba
DELETE FROM carpetas_unidad_activas WHERE numero_carpeta_unidad_activa LIKE 'C-%';

-- Eliminar cajas de prueba
DELETE FROM cajas_unidad_activas WHERE codigo_caja_unidad_activa LIKE 'CJ-%';

-- Eliminar baldas de prueba
DELETE FROM baldas WHERE nombre_balda LIKE 'Balda%';

-- Eliminar estantes de prueba
DELETE FROM estantes WHERE nombre_estante LIKE 'Estante%';

-- Eliminar cuerpos de prueba
DELETE FROM cuerpos WHERE nombre_cuerpo LIKE 'Cuerpo%';

-- Eliminar archivo de prueba
DELETE FROM archivo_unidades_activas WHERE ubicacion_archivo_unidad_activa = 'PRUEBA1';

-- Eliminar unidad de prueba
DELETE FROM unidades WHERE nombre_unidad = 'COMANDO DEL EJÉRCITO NACIONAL';
```

---

## 8. Notas Importantes

- Los datos de prueba son totalmente funcionales y realistas
- Las sumas de folios se calculan automáticamente
- El sistema soporta búsquedas parciales con LIKE
- Todos los documentos tienen estado "Activo"
- Las fechas se registran automáticamente en UTC

---

¡Listo para probar! 🚀
