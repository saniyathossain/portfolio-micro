<?php

namespace App\Http\Base\Traits;

/**
 * ModuleTrait
 */
trait ModuleTrait
{
    /**
     * fileExtension
     *
     * @var string
     */
    public $fileExtension =  'php';

	/**
	 * getModuleName
	 *
	 * @return string
	 */
	public function getModuleName(): string
	{
		return ucfirst(app('request')->segment(1));
	}

	/**
	 * getModuleControllerName
	 *
	 * @return string
	 */
	public function getModuleControllerName(): string
	{
		return sprintf('%sController', $this->getModuleName());
	}

    /**
     * ds
     *
     * Directory Separator
     *
     * @return string
     */
	public function ds(): string
	{
		return DIRECTORY_SEPARATOR;
	}

    /**
	 * ns
     *
	 * Namespace Separator
     *
	 * @return string
	 */
	public function ns(): string
	{
		return '\\';
	}

	/**
	 * baseNamespace
	 *
	 * @return string
	 */
	public function baseNamespace(): string
	{
		return config('base.namespace');
	}

    /**
	 * baseDirectory
	 *
	 * @return string
	 */
	public function baseDirectory(): string
	{
        return sprintf('%s%s%s', base_path(), $this->ds(), config('base.directory'));
	}

	/**
	 * baseLibraryNamespace
	 *
	 * @return string
	 */
	public function baseLibraryNamespace(): string
	{
		return sprintf('%s%sLibrary', $this->baseNamespace(), $this->ns());
	}

	/**
	 * baseLibraryDirectory
	 *
	 * @return string
	 */
	public function baseLibraryDirectory(): string
	{
		return sprintf('%s%sLibrary', $this->baseDirectory(), $this->ds());
	}

	/**
	 * baseRequireDirectory
	 *
	 * @return string
	 */
	public function baseRequireDirectory(): string
	{
		return sprintf('%s%sRequire', $this->baseDirectory(), $this->ds());
	}
}
