<?php 
namespace Fuel\Migrations;
class Users
{
    function up()
    {
        \DBUtil::create_table('users', array(
            'id' => array('type' => 'int', 'constraint' => 11, 'auto_increment' => true),
            'username' => array('type' => 'varchar', 'constraint' => 100, 'null' => true),
            'email' => array('type' => 'varchar', 'constraint' => 100),
            'password' => array('type' => 'varchar', 'constraint' => 100, 'null' => true),
            'description' => array('type' => 'varchar', 'constraint' => 100, 'null' => true),
            'active' => array('type' => 'int', 'constraint' => 1),
            'image_profile' => array('type' => 'varchar', 'constraint' => 100, 'null' => true),
            'id_rol' => array('type' => 'int', 'constraint' => 11),
        ), array('id'), false, 'InnoDB', 'utf8_unicode_ci',
		    array(
		        array(
		            'constraint' => 'foreignKeyFromUsersToRoles',
		            'key' => 'id_rol',
		            'reference' => array(
		                'table' => 'roles',
		                'column' => 'id',
		            ),
		            'on_update' => 'CASCADE',
		            'on_delete' => 'RESTRICT'
		        ),
		    )
		);
		\DB::query("INSERT INTO users (id, username, email, password,active, id_rol) VALUES (NULL, 'admin', 'admin@cev.com', 'admin','1', '1');")->execute();
    }
    function down()
    {
       \DBUtil::drop_table('users');
    }
}