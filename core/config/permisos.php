<?php

if (!isset($_SESSION)) {
   session_start();
}

class Permisos
{
   private $tipo_usuario;

   public function __construct($rol) {
      if (is_string($rol)) {
         $tipo_usuario = strtolower($rol);
      } else {
         $tipo_usuario = (string) strtolower($rol);
      }
      $this->tipo_usuario = $tipo_usuario;
   }

   public function getIncludeView($view) {
      $methods = get_class_methods('Permisos');
      $include_str = '';

      foreach ($methods as $method) {
         if ($method == $this->tipo_usuario) {
            $include_str = $method($view);
            break;
         }
      }
      return $include_str;
   }

   public function administrador($archivo) {
      $url = '';

      if (is_file('public/views/admin/'. $archivo)) {
         $url = 'public/views/admin/'. $archivo;

      } else if (is_file('public/views/ventas/'. $archivo)) {
         $url = 'public/views/ventas/'. $archivo;
         
      } else if (is_file('public/views/consulta/'. $archivo)) {
         $url = 'public/views/consulta/'. $archivo;
      }
      return $url;
   }

   public function ventas($archivo) {
      $admin_views = 'public/view/admin/'. $archivo;
      return $admin_views;
   }
}