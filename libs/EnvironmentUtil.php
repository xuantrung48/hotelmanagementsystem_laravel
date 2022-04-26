<?php

namespace libs;


Class EnvironmentUtil{

	/**
	*
	*	@param env. key
	*   @return env. value
	**/


	public function getEnvInfo($data){


		//dd($_ENV);
		if(in_array($data,$this->EnvInfoKey()))
		return getenv($data);
		else
		return
		{
			$msgUtil  = new MessageUtil;
	        $errorMsg = $msgUtil->getErrorMessage('20000','Number');

	        throw new Exception($errorMsg);

	     }

	}


	/**
	*
	*	@param
	*   @return all  env. value (commment management table)
	**/

	public function getEnvInfoAll(){

				$count=0;
				$data=array();
				foreach($_ENV as $key =>$val)
					{

						$data[$key]=$val;

						$count++;
					}

			return response()->json($data);
	}


}


