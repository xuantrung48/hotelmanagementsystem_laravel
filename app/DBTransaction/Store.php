<?php

namespace App\DBTransaction;

use Illuminate\Database\Eloquent\Model;
use App\Libs\DBaccessUtil;
use Exception;

/**
 * Store database transaction
 */
class Store extends DBaccessUtil
{
    /**
     * Constructor to assign interface to variable
     */
    public function __construct(Model $model, $data)
    {
        $this->model = $model;
        $this->data = $data;
    }
    /*
	*call executeProcess method that already write database transaction
	*/
    public function process()
    {
        try {
            $this->model::store($this->data);
            return ['status' => true, 'error' => ''];
        } catch (Exception $e) {
            return ['status' => false, 'error' => $e->getMessage()];
        }
    }
}
