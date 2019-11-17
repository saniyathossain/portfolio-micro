<?php

namespace App\Http\Modules\Core\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Modules\Core\Library\CoreLibraryTrait;

class CoreController extends Controller
{
	use CoreLibraryTrait;

	public function getDashboard ()
	{
		$data['title']	= 'Dashboard';
		$view			= $this->moduleCoreViewPagesDashboard;
		return view($view, $data);
	}
}