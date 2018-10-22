<?php

namespace app\utilities;

class Constantes{

  const remitente_correo = "mvcloudfase2@gmail.com";
  const remitente_nombre = "FIUSAC Toolbox";
  const remitente_password = "passwordfase2";
  const remitente_username = "mvcloudfase2@gmail.com";

  const protocolo_tipo = "smtp";
  const protocolo_host = "ssl://smtp.gmail.com";
  const protocolo_auth = true;
  const protocolo_charset = "utf-8";
  const protocolo_html = true;
  const protocolo_puerto = 465;

  const asunto = "Recordatorio nuevo en FIUSAC - Toolbox" ;

  //Retorno de constantes de remitente del correo

  public static function get_remitente_correo(){
    return self::remitente_correo;
  }

  public static function get_remitente_nombre(){
    return self::remitente_nombre;
  }

  public static function get_remitente_password(){
    return self::remitente_password;
  }

  public static function get_remitente_username(){
    return self::remitente_username;
  }

//Retorno de constantes del protocolo

  public static function get_protocolo_tipo(){
    return self::protocolo_tipo;
  }

  public static function get_protocolo_host(){
    return self::protocolo_host;
  }

  public static function get_protocolo_auth(){
    return self::protocolo_auth;
  }

  public static function get_protocolo_charset(){
    return self::protocolo_charset;
  }

  public static function get_protocolo_html(){
    return self::protocolo_html;
  }

  public static function get_protocolo_puerto(){
    return self::protocolo_puerto;
  }

  //Retorno de constantes de asunto del correo

  public static function get_asunto(){
    return self::asunto;
  }

}
