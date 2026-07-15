# Almacenamiento de Documentos FUID

## Configuración de Almacenamiento

Se han configurado dos entornos para el almacenamiento de documentos:

### 📁 **AMBIENTE LOCAL**
- **Disco:** `public`
- **Ruta Física:** `storage/app/public/documentosFUID`
- **Acceso URL:** `http://localhost:8000/storage/documentosFUID/[archivo]`
- **Configuración:** Definida en `.env` con `FILESYSTEM_DISK=public`

```php
// Configurado en config/filesystems.php
'public' => [
    'driver' => 'local',
    'root' => storage_path('app/public'),
],
```

### 🔒 **AMBIENTE PRODUCCIÓN**
- **Disco:** `bodega`
- **Ruta Física:** `/bodega/unidades-suprimidas/documentosFUID`
- **Acceso URL:** Dependería de tu configuración de servidor
- **Configuración:** Definida en `config/filesystems.php`

```php
// Configurado en config/filesystems.php
'bodega' => [
    'driver' => 'local',
    'root' => '/bodega/unidades-suprimidas',
],
```

---

## Cómo Cambiar el Ambiente

### Para LOCAL (Desarrollo)
En tu archivo `.env`:
```
FILESYSTEM_DISK=public
```

### Para PRODUCCIÓN
En tu archivo `.env` de producción:
```
FILESYSTEM_DISK=bodega
```

O cambia en `config/filesystems.php` la línea:
```php
'default' => env('FILESYSTEM_DISK', 'bodega'), // Cambiar a 'bodega' para producción
```

---

## Estructura de Carpetas

### LOCAL
```
storage/
└── app/
    └── public/
        └── documentosFUID/
            ├── archivo1_20260714_103045.pdf
            ├── archivo2_20260714_104530.docx
            └── archivo3_20260714_105015.xlsx
```

### PRODUCCIÓN
```
/bodega/
└── unidades-suprimidas/
    └── documentosFUID/
        ├── archivo1_20260714_103045.pdf
        ├── archivo2_20260714_104530.docx
        └── archivo3_20260714_105015.xlsx
```

---

## Características de Almacenamiento

✅ **Tamaño máximo:** 10 MB por archivo

✅ **Extensiones permitidas:**
- `pdf`, `doc`, `docx`, `xls`, `xlsx`
- `jpg`, `jpeg`, `png`, `txt`

✅ **Nombre del archivo:** Se renombra automáticamente con timestamp
- Ejemplo: `miArchivo_20260714_103045.pdf`
- Previene conflictos de nombres

✅ **Validación:**
- Verifica tamaño antes de guardar
- Verifica que el archivo existe después de guardarlo
- Valida extensión de archivo

---

## Uso en la API

### Opción 1: Enviar solo datos sin archivo

```json
{
  "numero_orden": 1,
  "codigo": 100,
  "nombre_serie_subserie_asunto": "Serie Administrativa",
  "fecha_extrema_inicio": "2020-01-15",
  "fecha_extrema_fin": "2023-12-31",
  "numero_caja": "CAJA-001",
  "numero_carpeta": "CARPETA-001",
  "numero_tomo": "TOMO-001",
  "numero_folios": "250",
  "numero_soporte": "SOPORTE-001",
  "numero_frecuencia_consulta": "ALTA",
  "url_documento": "https://example.com/documento.pdf"
}
```

### Opción 2: Enviar archivo y datos

En Postman:
1. Cambia "Body" a **form-data** (no raw JSON)
2. Agrega los campos como `Key | Value` type `text`:
   - `numero_orden`: 1
   - `codigo`: 100
   - `nombre_serie_subserie_asunto`: Serie Administrativa
   - (resto de campos...)

3. Agrega el archivo como `Key | Value` type `file`:
   - Key: `archivo_documento`
   - Value: Selecciona tu archivo PDF/DOC/etc

4. **IMPORTANTE:** No agregues `url_documento` si estás usando `archivo_documento`

**Resultado:** El archivo se guardará automáticamente en:
- LOCAL: `storage/app/public/documentosFUID/archivo_20260714_103045.pdf`
- PRODUCCIÓN: `/bodega/unidades-suprimidas/documentosFUID/archivo_20260714_103045.pdf`

Y la `url_documento` en la BD contendrá: `documentosFUID/archivo_20260714_103045.pdf`

---

## Respuesta API

```json
{
  "statusCode": 200,
  "titulo": "Registro realizado",
  "mensaje": "Se realizó el registro del documento general FUID correctamente",
  "icono": "success",
  "data": {
    "id_documento_general": 1,
    "numero_orden": 1,
    "codigo": 100,
    "nombre_serie_subserie_asunto": "Serie Administrativa",
    "fecha_extrema_inicio": "2020-01-15",
    "fecha_extrema_fin": "2023-12-31",
    "numero_caja": "CAJA-001",
    "numero_carpeta": "CARPETA-001",
    "numero_tomo": "TOMO-001",
    "numero_folios": "250",
    "numero_soporte": "SOPORTE-001",
    "numero_frecuencia_consulta": "ALTA",
    "notas": null,
    "url_documento": "documentosFUID/archivo_20260714_103045.pdf",
    "id_estado": 1,
    "fecha_creacion": "2026-07-14 10:30:45",
    "fecha_actualizacion": "2026-07-14 10:30:45"
  }
}
```

---

## Errores Comunes

### ❌ "El archivo supera el tamaño máximo permitido de 10 MB"
- Solución: Comprimir el archivo o dividirlo en partes

### ❌ "El tipo de archivo no está permitido"
- Solución: Usa solo: pdf, doc, docx, xls, xlsx, jpg, jpeg, png, txt

### ❌ "Error al guardar el archivo en el servidor"
- Solución: Verifica permisos en `storage/app/public/` (debe ser 755)

```bash
# En Linux/Mac
chmod -R 755 storage/app/public/
```

### ❌ "El archivo no se pudo verificar después de guardarse"
- Solución: Verifica espacio disponible en disco

---

## Acceso a los Archivos

### LOCAL
```
URL: http://localhost:8000/storage/documentosFUID/archivo_20260714_103045.pdf
```

### PRODUCCIÓN
Depende de tu configuración de servidor. Ejemplo con nginx:
```
URL: https://tudominio.com/documentos/documentosFUID/archivo_20260714_103045.pdf
```

Necesitarías configurar un alias en nginx:
```nginx
location /documentos/ {
    alias /bodega/unidades-suprimidas/;
}
```

---

## Resumen de Cambios

✅ El servicio ahora:
- Acepta archivos en el campo `archivo_documento`
- Valida tamaño (máx 10MB)
- Valida extensión
- Almacena en la carpeta `documentosFUID`
- Usa la ruta configurada (local o producción)
- Registra automáticamente en la BD

✅ El Request ahora:
- Acepta `archivo_documento` como opcional
- Cambia `url_documento` a opcional
- Valida extensiones permitidas

✅ La estructura de carpetas es:
- LOCAL: `storage/app/public/documentosFUID/`
- PRODUCCIÓN: `/bodega/unidades-suprimidas/documentosFUID/`

---

## Próximos Pasos (Opcional)

Si necesitas descargar archivos, puedes crear un endpoint GET como:
```php
Route::get('/documentoGeneralFuid/{id}/descargar', [documentoGeneralFuidController::class, 'descargar']);
```

O hacer streaming del archivo:
```php
public function descargar($id)
{
    $documento = DocumentoGeneralFuidModel::find($id);
    return Storage::disk(config('filesystems.default'))
        ->download($documento->url_documento);
}
```
