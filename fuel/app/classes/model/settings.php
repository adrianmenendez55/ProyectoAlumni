<?php
class Model_Settings extends Orm\Model
{
	protected static $_table_name = 'settings';
    protected static $_primary_key = array('id');
    protected static $_properties = array(
        'id', // both validation & typing observers will ignore the PK
        'location' => array(
            'data_type' => 'int'   
        ),
        'notifications' => array(
            'data_type' => 'int'   
        ),
        'information' => array(
            'data_type' => 'int'   
        ),
        'id_user' => array(
            'data_type' => 'int'   
        )
    );
    protected static $_belongs_to = array(
        'users' => array(
            'key_from' => 'id_user',
            'model_to' => 'Model_Users',
            'key_to' => 'id',
            'cascade_save' => false,
            'cascade_delete' => false,
        )
    );
}