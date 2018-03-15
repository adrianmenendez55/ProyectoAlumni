<?php 
namespace Fuel\Migrations;

class Settings
{

    function up()
    {
        \DBUtil::create_table('settings', array(
            'id' => array('type' => 'int', 'constraint' => 5, 'auto_increment' => true),
            'location' => array('type' => 'int', 'constraint' => 1),
            'notifications' => array('type' => 'int', 'constraint' => 1),
            'information' => array('type' => 'int', 'constraint' => 1),
            'id_user' => array('type' => 'int', 'constraint' => 5),

            
        ), array('id'), false, 'InnoDB', 'utf8_unicode_ci',
            array(
                array(
                    'constraint' => 'foreignKeyFromSettingsToUsers',
                    'key' => 'id_user',
                    'reference' => array(
                        'table' => 'users',
                        'column' => 'id',
                    ),
                    'on_update' => 'RESTRICT',
                    'on_delete' => 'CASCADE'
                )
            )
        );
    }

    function down()
    {
      
       \DBUtil::drop_table('settings');
    }
}