<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index($leftType = "kjv", $rightType = "jst") {
    	
    	$string = file_get_contents(storage_path() . "/json/jst.json"); 
    	$string =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $string);
		$jst = json_decode($string, true);
		$jst['Header'] = "Inspired Version (Joseph Smith Translation)";

		$string = file_get_contents(storage_path() . "/json/kjv.json"); 
    	$string =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $string);
		$kjv = json_decode($string, true);
		$kjv['Header'] = "Authorized Version (King James)";

		$string = file_get_contents(storage_path() . "/json/kj21.json"); 
    	$string =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $string);
		$kj21 = json_decode($string, true);
		$kj21['Header'] = "21st Century King James Version)";

		$string = file_get_contents(storage_path() . "/json/nrsv.json"); 
    	$string =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $string);
		$nrsv = json_decode($string, true);
		$nrsv['Header'] = "New Revised Standard Version";

		switch ($leftType) {
			case 'kjv':
				$left = $kjv;
				break;
			case 'jst':
				$left = $jst;
				break;
			case 'kj21':
				$left = $kj21;
				break;
			case 'nrsv':
				$left = $nrsv;
				break;
		}

		switch ($rightType) {
			case 'kjv':
				$right = $kjv;
				break;
			case 'jst':
				$right = $jst;
				break;
			case 'kj21':
				$right = $kj21;
				break;
			case 'nrsv':
				$right = $nrsv;
				break;
		}

		$options = ['kjv', 'nrsv', 'jst', 'kj21'];
		$leftOptions = [];
		$leftOptions[0] = $leftType;
		foreach($options as $value){
		    if(!in_array($value, $leftOptions, true)){
		        array_push($leftOptions, $value);
		    }
		}
		$rightOptions = [];
		$rightOptions[0] = $rightType;
		foreach($options as $value){
		    if(!in_array($value, $rightOptions, true)){
		        array_push($rightOptions, $value);
		    }
		}

    	return view('welcome', compact('left', 'right', 'leftOptions', 'rightOptions'));
    }

}
