<?php
/**
 * Constantes de configuración de la aplicación
 */
const DB_HOST = 'db-dbuser'; // Host de la base de datos (sólo para contenedores)
const DB_USER = 'josema'; // Usuario de la base de datos
const DB_PASSWORD = 'josema'; // Contraseña de la base de datos
const DB_PORT = '3306'; // Puerto de la base de datos
const DB_NAME = 'dbuser'; // Nombre de la base de datos
const DB_TABLE_USER = 'usuarios'; // Nombre de la tabla de usuarios

// Clave secreta para la aplicación
const KEY = 'clave_secreta_muy_discreta';

// Códigos de respuesta HTTP
const CODE_RESPONSE_NO_LOGIN = 400; // No se ha proporcionado credencial de inicio de sesión
const CODE_RESPONSE_METHOD = 401; // Método no permitido
const CODE_RESPONSE_ERROR_LOGIN = 403; // Error al iniciar sesión
const CODE_RESPONSE_ERROR_PERMISSION = 403; // No se tiene permiso para realizar la acción
const CODE_LOGIN_OK = 201; // Inicio de sesión exitoso
const CODE_REGISTER_OK = 202; // Registro exitoso
const CODE_ERROR_REGISTER = 403; // Error al registrar usuario
const CODE_DATA_OK = 203; // Datos devueltos correctamente

// Detalles de errores
const DETAILS_NO_LOGIN = 'Los campos password y email son obligatorios'; // Error al no proporcionar credenciales de inicio de sesión
const DETAILS_ERROR_LOGIN = 'Los campos password/email son incorrectos'; // Error al proporcionar credenciales de inicio de sesión incorrectas
const DETAILS_PERMISSION = 'Usted no tiene permisos para esta solicitud'; // Error de permiso
const DETAILS_ERROR_METHOD = 'ERROR METHOD'; // Error de método no permitido
const DETAILS_ERROR_REGISTER = 'ha ocurrido algún error al registrar los datos'; // Error al registrar usuario

// Detalles de errores de campos
const DETAILS_NO_EMAIL_FIELD = 'El campo email es obligatorio'; // Error al no proporcionar campo email
const DETAILS_NO_NAME_FIELD = 'El campo nombre es obligatorio'; // Error al no proporcionar campo nombre
const DETAILS_NO_PASSWORD_FIELD = 'El campo password es obligatorio'; // Error al no proporcionar campo password