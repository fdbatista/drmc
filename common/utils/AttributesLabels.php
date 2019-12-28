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
        'receiver_id' => 'Persona que recibe',
        'updated_at' => 'Actualizado',
        'amount' => 'Cantidad',
        'date' => 'Fecha',
        'customer_id' => 'Cliente',
        'first_name' => 'Nombres',
        'last_name' => 'Apellidos',
        'serial_number' => 'Número de serie',
        'telephone' => 'Teléfono',
        'role' => 'Rol',
        'sex' => 'Sexo',
        'password_repeat' => 'Repetir contraseña',
        'date_received' => 'Fecha de entrada',
        'customer_name' => 'Nombre del cliente',
        'customer_telephone' => 'Teléfono del cliente',
        'warranty_until' => 'Fin de la garantía',
        'discount_applied' => 'Descuento real',
        'final_price' => 'Precio final',
        'folio_number' => 'Número de folio',
        'stock_type_id' => 'Destino',
        'date_closed' => 'Fecha del cierre',
        'device' => 'Dispositivo',
        'branch_id' => 'Sucursal',
        'total_price' => 'Precio final',
    ];
    
    public static function getAttributeLabel($name) {
        return isset(self::$labels[$name]) ? self::$labels[$name] : $name;
    }
    
    public static function getLabels() {
        return self::$labels;
    }
}
