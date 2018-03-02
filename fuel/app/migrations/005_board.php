<?php

namespace Fuel\Migrations;
class Board
{
    function up()
    {
        \DBUtil::create_table('board', array(
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'title' => array('type' => 'varchar', 'constraint' => 100),
            'description' => array('type' => 'varchar', 'constraint' => 100),
            'localization' => array('type' => 'varchar', 'constraint' => 100, 'null' => true),
            'image_board' => array('type' => 'varchar', 'constraint' => 100, 'null' => true),
            'group' => array('type' => 'int', 'constraint' => 100),
            'link' => array('type' => 'varchar', 'constraint' => 100, 'null' => true),
            'id_user' => array('type' => 'int', 'constraint' => 11, 'null' => true),
            'id_type' => array('type' => 'int', 'constraint' => 11),
        ), array('id'), false, 'InnoDB', 'utf8_unicode_ci',
		    array(
		        array(
		            'constraint' => 'foreignKeyFromBoardToUser',
		            'key' => 'id_user',
		            'reference' => array(
		                'table' => 'users',
		                'column' => 'id',
		            ),
		            'on_update' => 'CASCADE',
		            'on_delete' => 'RESTRICT'
		        ),
                array(
                    'constraint' => 'foreignKeyFromBoardToTypes',
                    'key' => 'id_type',
                    'reference' => array(
                        'table' => 'types',
                        'column' => 'id',
                    ),
                    'on_update' => 'CASCADE',
                    'on_delete' => 'RESTRICT'
                )
		    )
		);
    }

    function down()
    {
       \DBUtil::drop_table('board');
    }
}