<?php 
namespace Fuel\Migrations;

class Roles
{

    function up()
    {
        \DBUtil::create_table('roles', array(
            'id' => array('type' => 'int', 'constraint' => 5, 'auto_increment' => true),
            'type' => array('type' => 'varchar', 'constraint' => 100),
        ), array('id'));
<<<<<<< HEAD
        \DB::query("INSERT INTO roles (id,type) VALUES ('1','admin');")->execute();
        \DB::query("INSERT INTO roles (id,type) VALUES ('2','profesores');")->execute();
        \DB::query("INSERT INTO roles (id,type) VALUES ('3','alumnos');")->execute();
=======
        \DB::query("INSERT INTO roles (id,type) VALUES ('1', 'admin');")->execute();
        \DB::query("INSERT INTO roles (id,type) VALUES ('2', 'profesor');")->execute();
        \DB::query("INSERT INTO roles (id,type) VALUES ('3', 'alumno');")->execute();
>>>>>>> d9023047155a03ecc3dbe1c06d36ee3d2c653df6
    }

    function down()
    {
       \DBUtil::drop_table('roles');
    }
}
