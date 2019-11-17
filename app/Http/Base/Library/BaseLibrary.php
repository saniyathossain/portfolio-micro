<?php

namespace App\Http\Base\Library;

use App\Http\Base\Traits\ModuleTrait;
use App\Http\Base\Traits\AssetsTrait;
use App\Http\Base\Traits\IconsTrait;
use App\Http\Base\Traits\ViewsTrait;
use App\Http\Modules\Frontend\Library\FrontendLibraryTrait;
// use App\Http\Modules\Auth\Library\AuthLibraryTrait;
use App\Http\Modules\Core\Library\CoreLibraryTrait;
// use App\Http\Modules\Acl\Library\AclLibraryTrait;

class BaseLibrary
{
	use ModuleTrait,
		AssetsTrait,
		IconsTrait,
		ViewsTrait,
		CoreLibraryTrait,
		FrontendLibraryTrait
		// AuthLibraryTrait,
		// AclLibraryTrait
		;

	public $ownerName						= 'Saniyat Hossain';
	public $ownerWebsite					= 'htttps://saniyathossain.com';

	public $messageCommonError				= 'Something went wrong!';
	public $messageDeleteConfirm			= 'Are you sure to delete this record?';
	public $messageFormSubmitConfirm		= 'Are you sure to continue?';
	public $messageModelNotFoundException	= 'Sorry. No Data Found.';

	public $ajaxLoaderHTML					= '';
}
