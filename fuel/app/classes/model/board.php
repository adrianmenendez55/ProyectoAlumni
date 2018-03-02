<?php 
class Model_Board extends Orm\Model
{
    protected static $_table_name = 'board';
    protected static $_primary_key = array('id');
    protected static $_properties = array(
        'id', // both validation & typing observers will ignore the PK
        'title' => array(
            'data_type' => 'varchar'   
        ),
        'description' => array(
            'data_type' => 'varchar'   
        ),
        'localization' => array(
            'data_type' => 'varchar'   
        ),
        'image_board' => array(
            'data_type' => 'varchar'   
        ),
        'group' => array(
            'data_type' => 'int'   
        ),
        'link' => array(
            'data_type' => 'varchar'   
        ),
        'id_user',
        'id_type'
    );

    protected static $_belongs_to = array(
        'users' => array(
            'key_from' => 'id_user',
            'model_to' => 'Model_Users',
            'key_to' => 'id',
            'cascade_save' => false,
            'cascade_delete' => false,
        ),
        'types' => array(
            'key_from' => 'id_type',
            'model_to' => 'Model_types',
            'key_to' => 'id',
            'cascade_save' => false,
            'cascade_delete' => false,
        )
    );
}
