<?php

namespace App\Http\Base\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use App\Http\Base\Traits\ModuleTrait;

/**
 * ModuleServiceProvider
 *
 * The service provider for the modules. After being registered
 * it will make sure that each of the modules are properly loaded
 * i.e. with their routes, views etc.
 *
 * @author Saniyat Hossain <saniyat1000@gmail.com>
 * @package App\Base\Providers
 */
class ModulesServiceProvider extends ServiceProvider
{
    use ModuleTrait;

	/**
     * boot
     *
	 * Will make sure that the required modules have been fully loaded
     *
	 * @return void
	 */
	public function boot(): void
	{
		$this->loadModules();
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
	 * loadModules
	 *
	 * @return void
	 */
	private function loadModules(): void
	{
        // dd($this->app->router);
        (object) $router	= $this->app->router;
		(array) $modules	= config('module.modules');

		// If modules array is not empty then for each modules, require_once routes and views
		if (!empty($modules)):
			(string) $moduleNamespace	= config('module.namespace');
			(string) $modulesDir    	= config('module.directory');
            (string) $modulesDirectory	= sprintf('%s%s%s', base_path(), $this->ds(), $modulesDir);
			(array) $noPrefix			= config('module.no-prefix');

			foreach ($modules as $module):
				// Load the routes for each of the modules
                (string) $routeDirectory = sprintf('%s%s%s%sRoutes', $modulesDirectory, $this->ds(), $module, $this->ds());

				if (is_dir($routeDirectory)):
					(array) $routeFiles	= glob(sprintf('%s%s*.%s', $routeDirectory, $this->ds(), $this->fileExtension));

					if (!empty($routeFiles)):
                        (string) $controllerNamespace	= sprintf('%s%s%s%sControllers', $moduleNamespace, $this->ns(), $module, $this->ns());

						foreach ($routeFiles as $routeFile):
							(array) $routeGroup = [
								// 'middleware'	=> ['web'],
								'namespace'		=> $controllerNamespace
							];

							if (!in_array($module, $noPrefix)):
								$routeGroup['prefix'] = strtolower($module);
							endif;

							$router->group($routeGroup, function() use($routeFile) {
								$this->loadRoutesFrom($routeFile);
							});
						endforeach;
					endif;
				endif;

				(string) $viewsDirectory	= sprintf('%s%s%s%sViews', $modulesDirectory, $this->ds(), $module, $this->ds());

				// Load the views
				if (is_dir($viewsDirectory)):
					$this->loadViewsFrom($viewsDirectory, $module);
				endif;
			endforeach;
		endif;
	}
}
