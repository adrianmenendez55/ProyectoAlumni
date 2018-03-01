<?php

use Firebase\JWT\JWT;

class Controller_Lists extends Controller_Rest
{
	public function post_create()
    {
    	try {
            
            if ( empty($_POST['title']))
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' =>  'Falta algun campo'
                ));
                return $json;            }

            $list = $_POST['title'];

            if($this->isListCreated($list))
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' => 'Lista ya existe',
                    'data' => []
                ));
                return $json;
            }

            $input = $_POST;
            $list = new Model_Lists();
            $list->title = $input['title'];
            $list->save();
            /*
            $dataToken = array(
                        "title" => $list,
                        
                    );

                    $token = JWT::encode($dataToken, $this->$key);
                    */
            $json = $this->response(array(
                'code' => 200,
                'message' => 'Lista creada',
                'data' => []
            ));
            return $json;
        } 
        catch (Exception $e) 
        {
            $json = $this->response(array(
                'code' => 500,
                'message' => $e->getMessage()
            ));
            return $json;
        }
    }
     public function get_lists()
    {
        /*return $this->respuesta(500, 'trace');
        exit;*/
        $lists = Model_Lists::find('all');
        return $this->response(Arr::reindex($lists));
    }

    public function isListCreated($title)
    {
        $lists = Model_Lists::find('all', array(
            'where' => array(
                array('title', $title)
            )
        ));
        
        if(count($lists) < 1)  {
            return false;
        }
        else 
        {
            return true;
        }
    }

    public function post_users()
    {
        if (empty($_POST['id']))
        {
            $json = $this->response(array(
                'code' => 400,
                'message' =>  'Falta algun campo'
            ));
            return $json;            
        }
        else
        {
            $id_list = $_POST['id'];

            $list = Model_Lists::find('all', array(
                'where' => array(
                    array('id', $id_list)
                )
            ));

            if(isset($list))
            {
                $json = $this->response(array(
                    'code' => 200,
                    'message' =>  'Usuarios de la lista',
                    'data' => ['users' => $list]
                ));
                return $json; 
            }
            else
            {
                return $this->respuesta(400, 'La lista no existe', []);
            } 
        }
    }
}