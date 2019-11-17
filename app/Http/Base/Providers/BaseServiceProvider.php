<?php

namespace App\Http\Base\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Base\Traits\ModuleTrait;
use App\Http\Base\Traits\ViewsTrait;

/**
* BaseServiceProvider
*
* The service provider for the commonly used file which sholud be
* autoloaded throughout the entire application view files
*
* @author Saniyat Hossain <saniyat1000@gmail.com>
* @package App\Http\Base\Providers
*/
class BaseServiceProvider extends ServiceProvider
{
	use ModuleTrait, ViewsTrait;

	/**
	 * Will make sure that the required modules have been fully loaded
     *
	 * @return void
	 */
	public function boot(): void
	{
		$this->bindServiceViewClass();
		$this->shareViewStatic();
		// $this->requireClass();
	}

	/**
	 * register
	 *
	 * @return void
	 */
	public function register()
	{
        //
	}

	/**
	 * bindServiceViewClass
	 *
	 * @return void
	 */
	private function bindServiceViewClass(): void
	{
		// check if the directory exists
		if (is_dir($this->baseDirectory())):
			// list all the files containng defined extension
			(string) $libraryDirectory	= sprintf('%s%s', $this->baseLibraryDirectory(), $this->ds());
			(string) $libraryNamespace	= $this->baseLibraryNamespace();
            (array) $files				= glob(sprintf('%s*.%s', $libraryDirectory, $this->fileExtension));

			if (!empty($files)):
				// loop through the listed files
				foreach ($files as $file):
					(string) $className		= basename($file, sprintf('.%s', $this->fileExtension));
                    (string) $class			= sprintf('%s%s%s', $libraryNamespace, $this->ns(), $className);

					// check if class exists on specified files
					if (class_exists($class)):
						$this->app->bind($className, $class);
						// share the class to Laravel Views
						view()->share($className, $this->app->make($class));
					endif;
				endforeach;
			endif;
		endif;
	}

	/**
	 * shareViewStatic
	 *
	 * @return void
	 */
	private function shareViewStatic(): void
	{
		if (property_exists($this, __FUNCTION__) && !empty($this->{__FUNCTION__})):
            foreach ($this->{__FUNCTION__} as $key => $value):
                view()->share($key, $value);
            endforeach;
		endif;
	}

	/**
	 * requireClass
	 *
	 * @return void
	 */
	private function requireClass(): void
	{
		// check if the directory exists
		if (is_dir($this->baseDirectory())):
			// list all the files containng defined extension
			(string) $requireDirectory	    = sprintf('%s%s', $this->baseRequireDirectory(), $this->ds());
			(string) $this->fileExtension   = 'php';
			(array) $files				    = glob(sprintf('%s*.%s', $requireDirectory, $this->fileExtension));

			if (!empty($files)):
				// loop through the listed files
				foreach ($files as $file):
					// require files
					require_once($file);
				endforeach;
			endif;
		endif;
	}
}
