<?php

namespace App\Http\Base\Traits;

trait ViewsTrait
{
    /**
     * shareViewStatic
     *
     * Global View Share Data
     *
     * @var array
     */
    public $shareViewStatic	= [
		'label_required'		=> '<span>&nbsp;<i class="text-red ion-ios-star"></i></span>',
		'box_tools'				=> '<div class="box-tools pull-right hidden-print">
										<button type="button" class="btn btn-box-tool" data-widget="collapse">
											<i class="fa fa-minus"></i>
										</button>
									</div>',
		'system_mail_message'	 => '<p>---------------------------------------------------------</p>
									<p>System generated email. Please do not reply</p>
									<p>---------------------------------------------------------</p>',
		'loading' 				=> '<i class="fa fa-3x text-center fa-spin text-red ion-load-c loading-z-index"></i>',
		'clearfix' 				=> '<div class="clearfix"></div>'
	];
}
