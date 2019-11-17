<?php

namespace App\Http\Modules\Frontend\Library;

trait FrontendLibraryTrait
{
	// Controllers
	public $moduleFrontendController				= 'App\Http\Modules\Frontend\Controllers\FrontendController';

	// Views
	public $moduleFrontendViewPartialHead			= 'Frontend::partials.head';
	public $moduleFrontendViewPartialMaster			= 'Frontend::partials.master';
	public $moduleFrontendViewPartialStylesheets	= 'Frontend::partials.stylesheets';
	public $moduleFrontendViewPartialScripts		= 'Frontend::partials.scripts';
	public $moduleFrontendViewPartialFooter			= 'Frontend::partials.footer';

	public $moduleFrontendViewPagesHome				= 'Frontend::pages.home';
}
