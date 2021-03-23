CREATE DATABASE IF NOT EXISTS inmobiliaria;

USE inmobiliaria;

CREATE TABLE IF NOT EXISTS users (
    id INT(255) AUTO_INCREMENT NOT NULL,
    role INT(11),
    name VARCHAR(100),
    surname VARCHAR(200),
    nick VARCHAR(100),
    email VARCHAR(255),
    password VARCHAR(255),
    image VARCHAR(255),
    created_at DATETIME NOT NULL DEFAULT NOW(),
    updated_at DATETIME,
    remember_token VARCHAR(255),
    deleted_at DATETIME,
    api_token VARCHAR(80) UNIQUE DEFAULT NULL,

    CONSTRAINT pk_users PRIMARY KEY (id)
) ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS tipos (
    id INT(255) AUTO_INCREMENT NOT NULL,
    descripcion VARCHAR(255),
    id_padre INT(255),
    created_at DATETIME NOT NULL DEFAULT NOW(),
    updated_at DATETIME,
    deleted_at BIT NOT NULL DEFAULT 0,

    CONSTRAINT pk_ubigeos PRIMARY KEY (id),
    CONSTRAINT fk_tipos_tipos_padre FOREIGN KEY (id_padre) REFERENCES tipos (id)
) ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS ubigeos (
    id INT(255) AUTO_INCREMENT NOT NULL,
    id_tipo INT(255) NOT NULL,
    descripcion VARCHAR(255),
    id_padre INT(255),
    created_at DATETIME NOT NULL DEFAULT NOW(),
    updated_at DATETIME,
    flg_eliminado BIT NOT NULL DEFAULT 0,

    CONSTRAINT pk_ubigeos PRIMARY KEY (id),
    CONSTRAINT fk_ubigeos_tipos FOREIGN KEY (id_tipo) REFERENCES tipos (id),
    CONSTRAINT fk_ubigeos_ubigeos_padre FOREIGN KEY (id_padre) REFERENCES ubigeos (id)
) ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS propiedades (
    id INT(255) AUTO_INCREMENT NOT NULL,
    id_tipo INT(255) NOT NULL,
    id_venta INT(255) NOT NULL,
    id_estado INT(255) NOT NULL,
    precio_soles DECIMAL(12,2) NOT NULL,
    precio_dolares DECIMAL(12,2),
    area DECIMAL(9,2) NOT NULL,
    nro_habitaciones TINYINT NOT NULL DEFAULT 0,
    nro_banos TINYINT NOT NULL DEFAULT 0,
    descripcion TEXT,
    image_path VARCHAR(255) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    id_distrito INT(255) NOT NULL,
    id_agente INT(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT NOW(),
    updated_at DATETIME,
    flg_eliminado BIT NOT NULL DEFAULT 0,

    CONSTRAINT pk_propiedades PRIMARY KEY (id),
    CONSTRAINT fk_propiedades_tipos FOREIGN KEY (id_tipo) REFERENCES tipos (id),
    CONSTRAINT fk_propiedades_tipos_venta FOREIGN KEY (id_venta) REFERENCES tipos (id),
    CONSTRAINT fk_propiedades_tipos_estado FOREIGN KEY (id_estado) REFERENCES tipos (id),
    CONSTRAINT fk_propiedades_ubigeos FOREIGN KEY (id_distrito) REFERENCES ubigeos (id),
    CONSTRAINT fk_propiedades_users FOREIGN KEY (id_agente) REFERENCES users (id)
) ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS propiedades_fotos (
    id INT(255) AUTO_INCREMENT NOT NULL,
    id_propiedad INT(255) NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT NOW(),
    updated_at DATETIME,
    flg_eliminado BIT NOT NULL DEFAULT 0,

    CONSTRAINT pk_propiedades_fotos PRIMARY KEY (id),
    CONSTRAINT fk_propiedades_fotos_propiedades FOREIGN KEY (id_propiedad) REFERENCES propiedades (id)
) ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS propiedades_caracteristicas (
    id INT(255) AUTO_INCREMENT NOT NULL,
    id_propiedad INT(255) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT NOW(),
    updated_at DATETIME,
    flg_eliminado BIT NOT NULL DEFAULT 0,

    CONSTRAINT pk_propiedades_fotos PRIMARY KEY (id),
    CONSTRAINT fk_propiedades_caracteristicas_propiedades FOREIGN KEY (id_propiedad) REFERENCES propiedades (id)
) ENGINE=InnoDb;
