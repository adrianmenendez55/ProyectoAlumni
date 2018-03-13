<?php

use Firebase\JWT\JWT;

class Controller_Roles extends Controller_Rest
{
	public function get_roles()
	{
		$roles = Model_Roles::find('all');
		return $this->response(Arr::reindex($roles));
	}
}