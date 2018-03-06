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

    public function post_addUser()
    {
        try
        {
            /*$header = apache_request_headers();
            if (isset($header['Authorization'])) 
            {
                $token = $header['Authorization'];
                $dataJwtUser = JWT::decode($token, $this->key, array('HS256'));
            }*/

            if(empty($_POST['id_user']) || empty($_POST['id_list']))
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' => 'Campos vacíos',
                    'data' => []
                ));
                return $json;
            }
            else
            {
                $id_user = $_POST['id_user'];
                $id_list = $_POST['id_list'];

                $user = Model_Users::find($id_user);
                $list = Model_Lists::find($id_list);

                if(isset($id_user) || !empty($id_user) || isset($id_list) || !empty($id_list))
                {
                    $belong = Model_Belong::find('all', array(
                        'where' => array(
                            array('id_user', $id_user),
                            array('id_list', $id_list)
                        )
                    ));

                    if(!empty($belong))
                    {
                        $json = $this->response(array(
                            'code' => 400,
                            'message' => 'El usuario ya pertenece a la lista',
                            'data' => []
                        ));
                        return $json;
                    }
                    else
                    {
                        $belong = New Model_Belong();
                        $belong->id_user = $id_user;
                        $belong->id_list = $id_list;
                        $belong->save();

                        $json = $this->response(array(
                            'code' => 200,
                            'message' => 'Usuario agregado a lista',
                            'data' => ['list' => $id_list, 'user' => $id_user]
                        ));
                        return $json;
                    }
                }
                else
                {
                    $json = $this->response(array(
                        'code' => 400,
                        'message' => 'No existe el usuario o la lista',
                        'data' => []
                    ));
                    return $json;
                }
            }
        }
        catch (Exception $e) 
        {
            $json = $this->response(array(
                'code' => 500,
                'message' => $e->getMessage(),
                'data' => []
            ));
            return $json;
        }
    }

    public function post_quitUser()
    {
        try
        {
            /*$header = apache_request_headers();
            if (isset($header['Authorization'])) 
            {
                $token = $header['Authorization'];
                $dataJwtUser = JWT::decode($token, $this->key, array('HS256'));
            }*/
            if(empty($_POST['id_user']) || empty($_POST['id_list']))
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' => 'Campos vacíos',
                    'data' => []
                ));
                return $json;
            }
            else
            {
                $id_user = $_POST['id_user'];
                $id_list = $_POST['id_list'];

                $user = Model_Users::find($id_user);
                $list = Model_Lists::find($id_list);

                if(isset($id_user) || !empty($id_user) || isset($id_list) || !empty($id_list))
                {
                    $belong = Model_Belong::find('first', array(
                        'where' => array(
                            array('id_user', $id_user),
                            array('id_list', $id_list)
                        )
                    ));

                    if(!empty($belong))
                    {
                        $belong->delete();

                        $json = $this->response(array(
                            'code' => 200,
                            'message' => 'Usuario quitado de la lista',
                            'data' => ['user' => $id_user]
                        ));
                        return $json; 
                    }
                    else
                    {
                       $json = $this->response(array(
                            'code' => 400,
                            'message' => 'El usuario ya está quitado de la lista',
                            'data' => []
                        ));
                        return $json; 
                    }
                }
                else
                {
                    $json = $this->response(array(
                        'code' => 400,
                        'message' => 'No existe el usuario o la lista',
                        'data' => []
                    ));
                    return $json;
                }
            }
        }
        catch (Exception $e) 
        {
            $json = $this->response(array(
                'code' => 500,
                'message' => $e->getMessage(),
                'data' => []
            ));
            return $json;
        } 
    }

    public function get_users()
    {
        try 
        {
            /*$header = apache_request_headers();
            if (isset($header['Authorization'])) 
            {
                $token = $header['Authorization'];
                $dataJwtUser = JWT::decode($token, $this->key, array('HS256'));
            }*/

            if(empty($_GET['id_list']))
            {
                $json = $this->response(array(
                    'code' => 400,
                    'message' => 'Campos vacíos',
                    'data' => []
                ));
                return $json;
            }
            else
            {
                $id_list = $_GET['id_list'];

                $belonging = Model_Belong::find('all', array(
                    'where' => array(
                        array('id_list', $id_list),
                    ),
                ));

                if($belonging != null)
                {
                    foreach ($belonging as $key => $belong)
                    {   
                        $new = Model_Users::find('all', array(
                            'where' => array(
                                array('id', $belong->id_user),
                            ),
                        ));
                       
                        foreach ($new as $key => $belon)
                        {   
                            $user[] = $belon;
                        } 
                    }
                    
                    $json = $this->response(array(
                        'code' => 200,
                        'message' => 'Usuarios de la lista',
                        'data' => ['usersList' => $user]
                    ));
                    return $json;
                }
                else
                {
                    $json = $this->response(array(
                        'code' => 400,
                        'message' => 'La lista no existe',
                        'data' => []
                    ));
                    return $json;
                }
            }
        }
        catch(Exception $e)
        {
            $json = $this->response(array(
                'code' => 500,
                'message' => $e->getMessage(),
                'data' => []
            ));
            return $json;
        }
    }
}