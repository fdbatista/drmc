<?php

namespace common\utils;

class AttributesLabels {
    
    private static $labels = [
        'id' => 'ID',
        'name' => 'Nombre',
        'description' => 'Descripción',
        'email' => 'Correo',
        'status' => 'Estado',
        'username' => 'Nombre de usuario',
        'created_at' => 'Creado',
        'updated_at' => 'Modificado',
        'app_title' => 'Nombre de la aplicación',
        'about' => 'Acerca de',
        'address' => 'Dirección',
        'device_id' => 'Dispositivo',
        'inventory' => 'Inventario',
        'code' => 'Código',
        'price_in' => 'Precio de entrada',
        'price_out' => 'Precio de salida',
        'price_public' => 'Precio público',
        'pre_diagnosis' => 'Pre diagnóstico',
        'password_pattern' => 'Contraseña o patrón',
        'observations' => 'Observaciones',
        'signature_in' => 'Firma de entrada',
    ];
    
    public static function getAttributeLabel($name) {
        return isset(self::$labels[$name]) ? self::$labels[$name] : $name;
    }
}
