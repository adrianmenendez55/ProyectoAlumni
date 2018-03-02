<?php 
class Model_Users extends Orm\Model
{
    protected static $_table_name = 'users';
    protected static $_primary_key = array('id');
    protected static $_properties = array(
        'id', // both validation & typing observers will ignore the PK
        'username' => array(
            'data_type' => 'varchar'   
        ),
        'password' => array(
            'data_type' => 'varchar'   
        ),
        'description' => array(
            'data_type' => 'varchar'   
        ),
        'email' => array(
            'data_type' => 'varchar'   
        ),
        'active' => array(
            'data_type' => 'int'   
        ),
        'image_profile' => array(
            'data_type' => 'varchar'   
        ),
        'id_rol',
        
    );


protected static $_belongs_to = array(
        'roles' => array(
            'key_from' => 'id_rol',
            'model_to' => 'Model_Roles',
            'key_to' => 'id',
            'cascade_save' => false,
            'cascade_delete' => false,
        )
    );
}