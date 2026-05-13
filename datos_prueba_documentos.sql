-- =====================================================
-- SCRIPT DE DATOS DE PRUEBA PARA DOCUMENTOS DE UNIDADES ACTIVAS
-- =====================================================

-- 1. INSERTAR MUNICIPIOS (si no existen)
INSERT INTO municipios (nombre_municipio)
SELECT 'Bogotá' WHERE NOT EXISTS (SELECT 1 FROM municipios WHERE nombre_municipio = 'Bogotá');

-- 2. INSERTAR ESTADOS
INSERT INTO estados (nombre_estado, descripcion_estado, estado)
SELECT 'Activo', 'Estado activo', 1 WHERE NOT EXISTS (SELECT 1 FROM estados WHERE nombre_estado = 'Activo');

INSERT INTO estados (nombre_estado, descripcion_estado, estado)
SELECT 'Inactivo', 'Estado inactivo', 0 WHERE NOT EXISTS (SELECT 1 FROM estados WHERE nombre_estado = 'Inactivo');

-- 3. INSERTAR UNIDAD
INSERT INTO unidades (nombre_unidad, sigla_unidad, id_municipio, id_estado, codigo_unidad_activa)
VALUES ('COMANDO DEL EJÉRCITO NACIONAL', 'CEN', 1, 1, 'CEN001');

SET @id_unidad = LAST_INSERT_ID();

-- 4. INSERTAR CUERPOS
INSERT INTO cuerpos (nombre_cuerpo) VALUES ('Cuerpo Principal');
SET @id_cuerpo = LAST_INSERT_ID();

INSERT INTO cuerpos (nombre_cuerpo) VALUES ('Cuerpo Secundario');
INSERT INTO cuerpos (nombre_cuerpo) VALUES ('Cuerpo Auxiliar');

-- 5. INSERTAR ESTANTES
INSERT INTO estantes (nombre_estante, id_cuerpo) VALUES ('Estante 1', @id_cuerpo);
SET @id_estante = LAST_INSERT_ID();

INSERT INTO estantes (nombre_estante, id_cuerpo) VALUES ('Estante 2', @id_cuerpo);
INSERT INTO estantes (nombre_estante, id_cuerpo) VALUES ('Estante 3', @id_cuerpo);

-- 6. INSERTAR BALDAS
INSERT INTO baldas (nombre_balda, id_estante) VALUES ('Balda A', @id_estante);
SET @id_balda = LAST_INSERT_ID();

INSERT INTO baldas (nombre_balda, id_estante) VALUES ('Balda B', @id_estante);
INSERT INTO baldas (nombre_balda, id_estante) VALUES ('Balda C', @id_estante);

-- 7. INSERTAR ARCHIVO DE UNIDAD ACTIVA
INSERT INTO archivo_unidades_activas (id_unidad, ubicacion_archivo_unidad_activa, direccion_archivo_unidad_activa, edificio_archivo_unidad_activa, piso_archivo_unidad_activa, bodega_archivo_unidad_activa, fecha_creacion_archivo_unidad_activa, fecha_actualizacion_archivo_unidad_activa)
VALUES (@id_unidad, 'PRUEBA1', 'PRUEBA1', '1', '2', '1', NOW(), NOW());

SET @id_archivo = LAST_INSERT_ID();

-- 8. INSERTAR CAJAS
INSERT INTO cajas_unidad_activas (id_archivo_unidad_activa, id_balda, codigo_caja_unidad_activa, numero_consecutivo_bodega_unidad_activa, numero_correlativo_dependencia_unidad_activa, anio_caja_unidad_activa, cantidad_libros_unidad_activa, cantidad_carpetas_unidad_activa, id_estado, fecha_creacion_caja_unidad_activa, fecha_actualizacion_caja_unidad_activa)
VALUES (@id_archivo, @id_balda, 'CJ-001', 1, 'COR-001', 2024, 0, 2, 1, NOW(), NOW());

SET @id_caja = LAST_INSERT_ID();

INSERT INTO cajas_unidad_activas (id_archivo_unidad_activa, id_balda, codigo_caja_unidad_activa, numero_consecutivo_bodega_unidad_activa, numero_correlativo_dependencia_unidad_activa, anio_caja_unidad_activa, cantidad_libros_unidad_activa, cantidad_carpetas_unidad_activa, id_estado, fecha_creacion_caja_unidad_activa, fecha_actualizacion_caja_unidad_activa)
VALUES (@id_archivo, @id_balda, 'CJ-002', 2, 'COR-002', 2024, 0, 3, 1, NOW(), NOW());

-- 9. INSERTAR SERIE Y SUBSERIE
INSERT INTO series (nombre_serie) VALUES ('Serie Administrativa');
SET @id_serie = LAST_INSERT_ID();

INSERT INTO subseries (nombre_subserie, id_serie) VALUES ('Contratos', @id_serie);
SET @id_subserie = LAST_INSERT_ID();

-- 10. INSERTAR CARPETAS
INSERT INTO carpetas_unidad_activas (id_caja_unidad_activa, id_serie, id_subserie, numero_carpeta_unidad_activa, fecha_extrema_inicio, fecha_extrema_fin, cantidad_folios, id_estado, fecha_creacion_carpeta_unidad_activa, fecha_actualizacion_carpeta_unidad_activa)
VALUES (@id_caja, @id_serie, @id_subserie, 'C-001', '2024-01-01', '2024-01-31', 50, 1, NOW(), NOW());

SET @id_carpeta = LAST_INSERT_ID();

INSERT INTO carpetas_unidad_activas (id_caja_unidad_activa, id_serie, id_subserie, numero_carpeta_unidad_activa, fecha_extrema_inicio, fecha_extrema_fin, cantidad_folios, id_estado, fecha_creacion_carpeta_unidad_activa, fecha_actualizacion_carpeta_unidad_activa)
VALUES (@id_caja, @id_serie, @id_subserie, 'C-002', '2024-02-01', '2024-02-28', 45, 1, NOW(), NOW());

-- 11. INSERTAR DOCUMENTOS DE UNIDAD ACTIVA
INSERT INTO documentos_unidad_activas (id_carpeta_unidad_activa, numero_radicado, fecha_elaboracion, id_unidad, nombre_funcionario_destino, asunto, nombre_quien_firma, cargo_quien_firma, tipo_soporte, cantidad_folios, tipo_documental, observaciones, id_estado, fecha_creacion_documento_unidad_activa, fecha_actualizacion_documento_unidad_activa)
VALUES (@id_carpeta, '2024-001-CEN', '2024-01-15', @id_unidad, 'Juan García', 'Contrato de servicios profesionales', 'General Carlos López', 'General del Ejército', 'Papel', 5, 'Contrato', 'Documento importante firmado en enero', 1, NOW(), NOW());

INSERT INTO documentos_unidad_activas (id_carpeta_unidad_activa, numero_radicado, fecha_elaboracion, id_unidad, nombre_funcionario_destino, asunto, nombre_quien_firma, cargo_quien_firma, tipo_soporte, cantidad_folios, tipo_documental, observaciones, id_estado, fecha_creacion_documento_unidad_activa, fecha_actualizacion_documento_unidad_activa)
VALUES (@id_carpeta, '2024-002-CEN', '2024-01-20', @id_unidad, 'María Rodríguez', 'Contrato de suministros militares', 'Coronel David Martínez', 'Coronel', 'Papel', 8, 'Contrato', 'Requisito urgente para operaciones', 1, NOW(), NOW());

INSERT INTO documentos_unidad_activas (id_carpeta_unidad_activa, numero_radicado, fecha_elaboracion, id_unidad, nombre_funcionario_destino, asunto, nombre_quien_firma, cargo_quien_firma, tipo_soporte, cantidad_folios, tipo_documental, observaciones, id_estado, fecha_creacion_documento_unidad_activa, fecha_actualizacion_documento_unidad_activa)
VALUES (@id_carpeta, '2024-003-CEN', '2024-01-25', @id_unidad, 'Pedro González', 'Acuerdo interinstitucional', 'Teniente Coronel Roberto Silva', 'Teniente Coronel', 'Papel', 12, 'Acuerdo', 'Documento de coordinación con otras entidades', 1, NOW(), NOW());

-- Documentos en la segunda carpeta
INSERT INTO documentos_unidad_activas (id_carpeta_unidad_activa, numero_radicado, fecha_elaboracion, id_unidad, nombre_funcionario_destino, asunto, nombre_quien_firma, cargo_quien_firma, tipo_soporte, cantidad_folios, tipo_documental, observaciones, id_estado, fecha_creacion_documento_unidad_activa, fecha_actualizacion_documento_unidad_activa)
VALUES ((SELECT id_carpeta_unidad_activa FROM carpetas_unidad_activas WHERE numero_carpeta_unidad_activa = 'C-002'), '2024-004-CEN', '2024-02-05', @id_unidad, 'Ana López', 'Protocolo de seguridad', 'Mayor Fernando Díaz', 'Mayor', 'Papel', 15, 'Protocolo', 'Normativa de seguridad operativa', 1, NOW(), NOW());

INSERT INTO documentos_unidad_activas (id_carpeta_unidad_activa, numero_radicado, fecha_elaboracion, id_unidad, nombre_funcionario_destino, asunto, nombre_quien_firma, cargo_quien_firma, tipo_soporte, cantidad_folios, tipo_documental, observaciones, id_estado, fecha_creacion_documento_unidad_activa, fecha_actualizacion_documento_unidad_activa)
VALUES ((SELECT id_carpeta_unidad_activa FROM carpetas_unidad_activas WHERE numero_carpeta_unidad_activa = 'C-002'), '2024-005-CEN', '2024-02-10', @id_unidad, 'Luis Ramírez', 'Resolución administrativa', 'Capitán Alejandro Torres', 'Capitán', 'Papel', 10, 'Resolución', 'Decisión administrativa importante', 1, NOW(), NOW());

INSERT INTO documentos_unidad_activas (id_carpeta_unidad_activa, numero_radicado, fecha_elaboracion, id_unidad, nombre_funcionario_destino, asunto, nombre_quien_firma, cargo_quien_firma, tipo_soporte, cantidad_folios, tipo_documental, observaciones, id_estado, fecha_creacion_documento_unidad_activa, fecha_actualizacion_documento_unidad_activa)
VALUES ((SELECT id_carpeta_unidad_activa FROM carpetas_unidad_activas WHERE numero_carpeta_unidad_activa = 'C-002'), '2024-006-CEN', '2024-02-15', @id_unidad, 'Carmen Sánchez', 'Memorándum interno', 'Teniente Juan Pérez', 'Teniente', 'Papel', 20, 'Memorándum', 'Comunicación interna crítica para operaciones', 1, NOW(), NOW());

-- =====================================================
-- RESUMEN DE DATOS INSERTADOS
-- =====================================================
-- Unidad: COMANDO DEL EJÉRCITO NACIONAL
-- Archivo: Ubicación PRUEBA1, Dirección PRUEBA1, Edificio 1, Piso 2, Bodega 1
-- Cuerpos: 3
-- Estantes: 3
-- Baldas: 3 (en el estante 1)
-- Cajas: 2
-- Carpetas: 2
-- Documentos: 6
-- Total Folios: 70 (5+8+12+15+10+20)
-- =====================================================
