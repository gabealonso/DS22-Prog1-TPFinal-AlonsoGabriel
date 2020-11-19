# TP Final Programacion I

Consiste en la realización de un sistema con conexión a una base de datos.

Debe tener autenticación de usuarios, para lo cual puede reutilizarse el código propuesto las últimas clases (con o sin modificaciones).
Debe incluir un CRUD (Create, Read, Update, Delete) a otra tabla (además de la de usuarios). Ejemplos: trabajos en un pequeño comercio de reparaciones, lista de gastos de un hogar, etc.
Debe incluir además un informe útil. Ejemplos: impuestos de más de "X" monto; o lista de trabajos pendientes, etc.

# Base de datos

escuela.sql

# Archivo de conexion a la BD

Crear un archivo .env.php con el siguiente codigo

<?php
function credenciales() {
    return [
        'usuario'=>'' ,
        'clave'=>'',
        'servidor'=>'localhost',
        'base_de_datos'=>'escuela'
    ];
}
