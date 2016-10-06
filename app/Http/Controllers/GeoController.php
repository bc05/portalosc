<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Dao\GeoDao;

class GeoController extends Controller
{
	private $dao;

	public function __construct()
	{
		$this->dao = new GeoDao();
	}

    public function getOscRegion($region, $id)
	{
		if(array_key_exists($region, $this->dao->queriesRegion)){
			$resultDao = $this->dao->getOscRegion($region, $id);
			$this->configResponse($resultDao);
		}
        return $this->response();
    }

    public function getOscCountry()
	{
		$result = $this->dao->getOscCountry();
		$this->configResponse($result);
        return $this->response();
    }
}