<?php

namespace Fuel\Migrations;
class Belong
{
    function up()
    {
        \DBUtil::create_table('belong', array(
            'id_user' => array('type' => 'int', 'constraint' => 11),
            'id_list' => array('type' => 'int', 'constraint' => 11),
        ), array('id_user','id_list'), false, 'InnoDB', 'utf8_unicode_ci',
		    array(
		        array(
		            'constraint' => 'foreignKeyFromBelongToUser',
		            'key' => 'id_user',
		            'reference' => array(
		                'table' => 'users',
		                'column' => 'id',
		            ),
		            'on_update' => 'CASCADE',
		            'on_delete' => 'RESTRICT'
		        ),
                array(
                    'constraint' => 'foreignKeyFromBelongToLists',
                    'key' => 'id_list',
                    'reference' => array(
                        'table' => 'lists',
                        'column' => 'id',
                    ),
                    'on_update' => 'RESTRICT',
                    'on_delete' => 'RESTRICT'
                )
		    )
		);
    }

    function down()
    {
       \DBUtil::drop_table('belong');
    }
}