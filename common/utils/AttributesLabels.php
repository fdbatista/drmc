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
        'device_type' => 'Tipo de dispositivo',
        'model' => 'Modelo',
        'inventory' => 'Inventario',
        'code' => 'Código',
        'items' => 'Cantidad',
        'price_in' => 'Precio entrada',
        'price_out' => 'Precio salida',
        'price_out' => 'Precio público',
        'pre_diagnosis' => 'Pre diagnóstico',
        'password' => 'Contraseña',
        'pattern' => 'Patrón',
        'observations' => 'Observaciones',
        'effort' => 'Mano de obra',
        'signature_in' => 'Firma de entrada',
        'signature_out' => 'Firma de salida',
        'first_discount' => 'Primer descuento',
        'major_discount' => 'Descuento mayor',
        'receiver_id' => 'Receptor',
        'updated_at' => 'Actualizado',
        'amount' => 'Cantidad',
        'date' => 'Fecha',
        'customer_id' => 'Cliente',
        'first_name' => 'Nombres',
        'last_name' => 'Apellidos',
        'serial_number' => 'Número de serie',
        'telephone' => 'Teléfono',
    ];
    
    public static function getAttributeLabel($name) {
        return isset(self::$labels[$name]) ? self::$labels[$name] : $name;
    }
}
