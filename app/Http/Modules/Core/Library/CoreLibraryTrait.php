<?php

namespace App\Http\Modules\Core\Library;

use Illuminate\Support\Facades\File;

/**
 * CoreLibraryTrait
 */
trait CoreLibraryTrait
{
	public $hrefHash    = 'javascript:void(0)';

	/**
	 * renderImage
	 *
	 * @param  string $path
	 * @param  int $size
	 * @param  array $attr
	 *
	 * @return void
	 */
	public function renderImage(string $path, int $size = 5, array $attr = ['class' => 'img-responsive']): void
	{
		(string) $parts			= url($this->backwardToForwardSlash($path));
		(array) $omit			= ['medium', 'small', 'thumbnail'];
		(array) $change			= ['full', 'full', 'full'];

		(string) $fullPath		= str_replace($omit, $change, $parts);
		(string) $attributes	= '';

		foreach ($attr as $keyAttr	=> $valueAttr):
			$attributes	.= $keyAttr.'='.'"'.$valueAttr.'"';
		endforeach;

		if (!File::exists($this->backwardToForwardSlash($path))):
			echo (string) '<div class="center-div"><i class="fa fa-'.$size.'x ion-ios-image img-responsive img-rounded"></i><h4>No Image</h4></div>';
		else:
            // echo (string) '<figure class="progressive"><img data-lity data-lity-target="'.$fullPath.'" data-progressive="'.$fullPath.'" src="'.asset($parts).'" '.' '.$attributes.'/></figure>';
            echo (string) '<img src="'.$parts.'" '.' '.$attributes.'/>';
		endif;
	}

	/**
	 * listIcons
     *
	 * @param  string  $iconFile
	 * @param  array   $excludeIcons
	 * @param  string  $iconCssPrefix
	 * @param  boolean $prefix
     *
	 * @link https://gist.github.com/gubi/83402a9aae7cfa762df8
     *
	 * @return array
	 */
	public function listIcons(string $iconFile, array $excludeIcons = [], string $iconCssPrefix = '', bool $prefix = false): array
	{
		(string) $parsed_file	= file_get_contents($iconFile);
		preg_match_all("/".$iconCssPrefix."\-([a-zA-z0-9\-]+[^\:\.\,\s,{,<,>])/", $parsed_file, $matches);
		(array) $icons			= array_diff($matches[0], $excludeIcons);

		(string) $separator	= str_repeat('&nbsp;', 4);
		(array) $array		= [];

		if (!empty($icons)):
			foreach ($icons as $icon):
				$prefix ?
					$array[$iconCssPrefix.' '.$icon]	= '<i class="'.$iconCssPrefix.' '.$icon.'"></i>'.$separator.$iconCssPrefix.' '.$icon
					:
					$array[$icon]						= '<i class="'.$icon.'"></i>'.$separator.$icon;
			endforeach;
		endif;

		return $array;
	}

	/**
	 * listFontAwesome5Icons
	 *
	 * @return array
	 */
	public function listFontAwesome5Icons(): array
	{
        (array) $result     = [];
        (string) $ds		= DIRECTORY_SEPARATOR;
		(string) $filePath	= implode($ds, ['assets', 'global', 'font-awesome', 'v5.0.1', 'font-awesome-v5.0.1.json']);
		(string) $file		= sprintf('%s%s%s', public_path(), $ds, $filePath);

		if (File::exists($file)):
			(string) $contents		= File::get($file);

			(object) $jsonContents	= json_decode($contents);
			(array) $iconsList		= $jsonContents->icons ?? [];
			(string) $separator		= str_repeat('&nbsp;', 4);

			if (!empty($iconsList)):
				foreach ($iconsList as $icon):
					$result[$icon]	= '<i class="'.$icon.'"></i>'.$separator.$icon;
				endforeach;
			endif;
        endif;

        return $result;
	}

    /**
     * backwardToForwardSlash
     *
     * converts string backslash into forwardslash
     *
     * @param  string $string
     *
     * @return string converted forward slashed string
     */
	public function backwardToForwardSlash(string $string): string
	{
		return str_replace('\\', '/', $string);
	}

	/**
	 * backButton
	 *
	 * @param  string $href
	 * @param  string $return
	 * @param  string $title
	 * @param  array $attr
	 *
	 * @return string
	 */
	public function backButton(string $href = 'javascript:void(0)', string $return = 'echo', string $title = '<i class="ion-md-arrow-round-back"></i> Back', array $attr = ['class' => 'btn btn-primary btn-sm pull-right', 'title' => 'Back', 'data-toggle' => 'tooltip'])
	{
		(string) $attributes	= '';

		foreach ($attr as $keyAttr	=> $valueAttr):
			$attributes	.= $keyAttr.'='.'"'.$valueAttr.'"';
		endforeach;

		(string) $html	= '<a href="'.$href.'" '.$attributes.'>'.$title.'</a>';

		switch ($return):
			case 'return':
				return $html;
				break;

			case 'echo':
			default:
				echo $html;
				break;
		endswitch;
	}

	/**
	 * storeSession
	 *
	 * @param  array $session
	 *
	 * @return void
	 */
	public function storeSession(array $session = []): void
	{
		if (!empty($session)):
			foreach ($session as $key => $value):
				if (!session()->has($key)):
					session([$key => $value]);
				endif;
			endforeach;
		endif;
	}

    /**
     * Function to add empty option to select lists
     *
     * @param array $selectList
     * @param string $emptyLabel to use as label for empty option
     *
     * @author rtconner
     *
     * @return array
     */
	public function withEmpty(array $selectList, string $emptyLabel = ''): array
	{
		return ['' => $emptyLabel] + $selectList;
	}


	/**
	 * systemErrorMessages
	 *
	 * @param  int $code
	 *
	 * @return array\string
	 */
	public static function systemErrorMessages($code = null)
	{
		(array) $array	= [
			100	=> 'Continue',
			101	=> 'Switching Protocols',
			102	=> 'Processing',
			103	=> 'Checkpoint',
			200	=> 'OK',
			201	=> 'Created',
			202	=> 'Accepted',
			203	=> 'Non-Authoritative Information',
			204	=> 'No Content',
			205	=> 'Reset Content',
			206	=> 'Partial Content',
			207	=> 'Multi-Status',
			300	=> 'Multiple Choices',
			301	=> 'Moved Permanently',
			302	=> 'Found',
			303	=> 'See Other',
			304	=> 'Not Modified',
			305	=> 'Use Proxy',
			306	=> 'Switch Proxy',
			307	=> 'Temporary Redirect',
			400	=> 'Bad Request',
			401	=> 'Unauthorized',
			402	=> 'Payment Required',
			403	=> 'Forbidden',
			404	=> 'Not Found',
			405	=> 'Method Not Allowed',
			406	=> 'Not Acceptable',
			407	=> 'Proxy Authentication Required',
			408	=> 'Request Timeout',
			409	=> 'Conflict',
			410	=> 'Gone',
			411	=> 'Length Required',
			412	=> 'Precondition Failed',
			413	=> 'Request Entity Too Large',
			414	=> 'Request-URI Too Long',
			415	=> 'Unsupported Media Type',
			416	=> 'Requested Range Not Satisfiable',
			417	=> 'Expectation Failed',
			418	=> 'I\'m a teapot',
			422	=> 'Unprocessable Entity',
			423	=> 'Locked',
			424	=> 'Failed Dependency',
			425	=> 'Unordered Collection',
			426	=> 'Upgrade Required',
			449	=> 'Retry With',
			450	=> 'Blocked by Windows Parental Controls',
			500	=> 'Internal Server Error',
			501	=> 'Not Implemented',
			502	=> 'Bad Gateway',
			503	=> 'Service Unavailable',
			504	=> 'Gateway Timeout',
			505	=> 'HTTP Version Not Supported',
			506	=> 'Variant Also Negotiates',
			507	=> 'Insufficient Storage',
			509	=> 'Bandwidth Limit Exceeded',
			510	=> 'Not Extended'
		];

		return empty($code) ? $array : ($array[$code] ?? 'Undefined');
	}

	/**
	 * systemShortErrorMessages
	 *
	 * @param  string $message
	 *
	 * @return array\string
	 */
	public static function systemShortErrorMessages(string $message = null)
	{
		(array) $array	= [
			'success'				=> 200,
			'error'					=> 400,
			'unauthorized'			=> 401,
			'forbidden'				=> 403,
			'not-found'				=> 404,
			'method-not-allowed'	=> 405,
			'validation'			=> 422,
			'internal-server-error'	=> 500
		];

		return empty($message) ? $array : ($array[$message] ?? 'Undefined');
	}

	/**
	 * statusData
	 *
	 * @return array
	 */
	public function statusData(): array
	{
		return [
			1	=> 'Active',
			0	=> 'Inactive'
		];
	}
}
