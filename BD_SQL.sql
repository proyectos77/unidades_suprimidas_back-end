CREATE TABLE estados (
    id_estado INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre_estado VARCHAR(256) NOT NULL,
    estado CHAR(1),
    fecha_creacion_estado DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion_estado DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE tipo_usuarios (
    id_tipo_usuario INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre_tipo_usuario VARCHAR(256) NOT NULL,
    id_estado INT NOT NULL,
    fecha_creacion_tipo_usuario DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion_tipo_usuario DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_estado) REFERENCES estados (id_estado)
);

CREATE TABLE permisos (
    id_permiso INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre_permiso VARCHAR(256) NOT NULL,
    id_estado INT NOT NULL,
    fecha_creacion_permisos DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion_permisos DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_estado) REFERENCES estados (id_estado)
);

CREATE TABLE tipo_usuario_permisos (
    id_tipo_usuario_permiso INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_tipo_usuario INT NOT NULL,
    id_permiso INT NOT NULL,
    id_estado INT NOT NULL,
    fecha_creacion_tipo_usuario_permisos DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion_tipo_usuario_permisos DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_tipo_usuario) REFERENCES tipo_usuarios (id_tipo_usuario),
    FOREIGN KEY (id_permiso) REFERENCES permisos (id_permiso),
    FOREIGN KEY (id_estado) REFERENCES estados (id_estado)
);

CREATE TABLE usuarios (
    id_usuario INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre_usuario VARCHAR(256) NOT NULL,
    email_usuario VARCHAR(256) NOT NULL,
    id_cargo INT,
    id_tipo_usuario INT NOT NULL,
    id_estado INT NOT NULL,
    fecha_creacion_usuario DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion_usuario DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_tipo_usuario) REFERENCES tipo_usuarios (id_tipo_usuario),
    FOREIGN KEY (id_estado) REFERENCES estados (id_estado)
);



