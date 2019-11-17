<?php

namespace App\Http\Base\Traits;

/**
 * AssetsTrait
 */
trait AssetsTrait
{
	public $assetsPublicPath	= '';
	public $assetsGlobalPath	= 'assets/';
	public $assetsCssPath		= 'assets/app/css/';
	public $assetsJsPath		= 'assets/app/js/';
	public $assetsImagePath		= 'assets/app/image/';
	public $assetsFaviconPath	= 'assets/app/favicon/';
	public $themeJacksonPath	= 'assets/themes/jackson/';

	/**
	 * frontendCssFiles
	 *
	 * @return array
	 */
	public function frontendCssFiles(): array
	{
		return [
			'cdn-font-quicksand'				=> 'https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700',
			'cdn-font-playfair'					=> 'https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700',
			// 'cdn-font-ionicons-v4.4.8'			=> 'https://unpkg.com/ionicons@4.4.8/dist/css/ionicons.min.css',
			'cdn-font-font-awesome-v5.11.1'		=> 'https://use.fontawesome.com/releases/v5.11.2/css/all.css',
			'cdn-css-animate-v3.7.0'			=> 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css',
			'local-css-icomoon'					=> url($this->themeJacksonPath.'css/icomoon.css'),
			'cdn-css-bootstrap-v3.3.7'			=> 'https://unpkg.com/bootstrap@3.3.7/dist/css/bootstrap.min.css',
			'cdn-css-flexslider-v2.7.1'			=> 'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.1/flexslider.min.css',
			// 'local-css-flaticon'				=> url($this->themeJacksonPath.'fonts/flaticon/font/flaticon.css'),
			'cdn-owl-carousel-v1.3.3'			=> 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css',
			// 'cdn-css-progressively-v1.2.5'		=> 'https://unpkg.com/progressively/dist/progressively.min.css',
			// 'local-css-jquery-lity-v2.2.0'	=> 'lity/v2.2.0/dist/lity.min.css',
			'local-css-theme-style'				=> url($this->themeJacksonPath.'css/style.css')
		];
	}

	/**
	 * frontendJsFiles
	 *
	 * @return array
	 */
	public function frontendJsFiles(): array
	{
		return [
			'cdn-js-modernizr-v2.8.3'		=> 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js',
			'cdn-js-jquery-v3.4.1'			=> 'https://unpkg.com/jquery@3.4.1/dist/jquery.min.js',
			'cdn-js-jquery-easing-v1.4.1'	=> 'https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js',
			'cdn-js-bootstrap-v3.3.7'		=> 'https://unpkg.com/bootstrap@3.3.7/dist/js/bootstrap.min.js',
			'cdn-js-waypoints-v4.0.1'		=> 'https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js',
			'cdn-js-flexslider-v2.7.1'		=> 'https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.1/jquery.flexslider.min.js',
			'cdn-js-carousel-v1.3.3'		=> 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js',
			'cdn-js-countTo-v1.2.0'			=> 'https://cdnjs.cloudflare.com/ajax/libs/jquery-countto/1.2.0/jquery.countTo.min.js',
			'cdn-js-jquery-sticky-v1.0.4'	=> 'https://cdnjs.cloudflare.com/ajax/libs/jquery.sticky/1.0.4/jquery.sticky.js',
			// 'cdn-js-progressively-v1.2.5'	=> 'https://unpkg.com/progressively/dist/progressively.min.js',
			'local-js-theme-main'			=> url($this->themeJacksonPath.'js/main.js')
		];
	}

	/**
	 * backendCssFiles
	 *
	 * @param  string $public
	 *
	 * @return array
	 */
	public function backendCssFiles(string $public = ''): array
	{
		return [
			'local-css-boostrap-v3.3.7'										=> url($public.$this->assetsGlobalPath.'bootstrap/v3.3.7/css/bootstrap.min.css'),
			'local-css-jasny-boostrap-v3.1.3'								=> url($public.$this->assetsGlobalPath.'jasny-bootstrap/v3.1.3/css/jasny-bootstrap.min.css'),
			'local-css-x-editable-boostrap-v1.5.1'							=> url($public.$this->assetsGlobalPath.'x-editable/v1.5.1/dist/bootstrap3-editable/css/bootstrap-editable.css'),
			'cdn-font-ionicons-v4.6.3'									    => 'https://unpkg.com/ionicons@4.6.3/dist/css/ionicons.min.css',
			'local-font-ionicons-v2.0.1'									=> url($public.$this->assetsGlobalPath.'ionicons/v2.0.1/css/ionicons.min.css'),
			// 'cdn-font-ionicons-v2.0.1'									=> 'http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
			'cdn-font-font-awesome-v5.11.1'									=> 'https://use.fontawesome.com/releases/v5.11.1/css/all.css',
			'local-font-font-awesome-v4.7.0'								=> url($public.$this->assetsGlobalPath.'font-awesome/v4.7.0/css/font-awesome.min.css'),
			// 'cdn-font-font-awesome-v4.7.0'								=> 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
			// 'local-font-FSLolaWeb-Regular'								=> url($public.$this->assetsGlobalPath.'fonts/FSLolaWeb-Regular.woff'),
			// 'local-font-FSLolaWeb-Bold'									=> url($public.$this->assetsGlobalPath.'fonts/FSLolaWeb-Bold.woff'),
			// 'local-font-FSLolaWeb-Italic'								=> url($public.$this->assetsGlobalPath.'fonts/FSLolaWeb-Italic.woff'),
			// 'local-font-FSLolaWeb-BoldItalic'							=> url($public.$this->assetsGlobalPath.'fonts/FSLolaWeb-BoldItalic.woff'),
			// 'local-font-SourceSansPro-Regular'							=> url($public.$this->assetsGlobalPath.'fonts/SourceSansPro-Regular.otf'),
			'local-css-jquery-pace-v1.0.2'									=> url($public.$this->assetsGlobalPath.'pace/v1.0.2/themes/blue/pace-theme-flash.css'),
			'local-css-jquery-lity-v2.2.0'									=> url($public.$this->assetsGlobalPath.'lity/v2.2.0/dist/lity.min.css'),
			// 'local-css-jquery-sweetalert-v1.1.0'							=> url($public.$this->assetsGlobalPath.'sweetalert/v1.1.0/dist/sweetalert.css'),
			'local-css-jquery-icheck-v1.x'									=> url($public.$this->assetsGlobalPath.'icheck/v1.x/skins/square/blue.css'),
			'local-css-jquery-flatpickr-v3.0.7'								=> url($public.$this->assetsGlobalPath.'flatpickr/v3.0.7/dist/flatpickr.min.css'),
			'local-css-jquery-flatpickr-v3.0.7-dark'						=> url($public.$this->assetsGlobalPath.'flatpickr/v3.0.7/dist/themes/material_red.css'),
			'local-css-jquery-air-datepicker-v2.2.3'						=> url($public.$this->assetsGlobalPath.'air-datepicker/v2.2.3/dist/css/datepicker.min.css'),
			'local-css-jquery-select2-v3.5.1'								=> url($public.$this->assetsGlobalPath.'select2/v3.5.1/select2-concat.min.css'),
			'local-css-jquery-bootstrap-wysihtml5-v0.0.2'					=> url($public.$this->assetsGlobalPath.'bootstrap-wysihtml5/v0.0.2/dist/bootstrap-wysihtml5-0.0.2.css'),
			'local-css-jquery-formValidation-v0.6.2-dev'					=> url($public.$this->assetsGlobalPath.'formvalidation/v0.6.2-dev/dist/css/formValidation.min.css'),
			'local-css-jquery-intl-tel-input-v12.4.0'						=> url($public.$this->assetsGlobalPath.'intl-tel-input/v12.4.0/build/css/intlTelInput.css'),
			'local-css-jquery-datatables-v1.10.16'							=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/media/css/jquery.dataTables.min.css'),
			'local-css-jquery-datatables-bootstrap-v1.10.16'				=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/media/css/dataTables.bootstrap.min.css'),
			'local-css-jquery-datatables-buttons-v1.10.16'					=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/Buttons/css/buttons.dataTables.min.css'),
			'local-css-jquery-datatables-buttons-bootstrap-v1.10.16'		=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/Buttons/css/buttons.bootstrap.min.css'),
			'local-css-jquery-datatables-scroller-v1.10.16'					=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/Scroller/css/scroller.dataTables.min.css'),
			'local-css-jquery-datatables-scroller-bootstrap-v1.10.16'		=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/Scroller/css/scroller.bootstrap.min.css'),
			'local-css-jquery-datatables-fixed-header-v1.10.16'				=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/FixedHeader/css/fixedHeader.dataTables.min.css'),
			'local-css-jquery-datatables-fixed-header-bootstrap-v1.10.16'	=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/FixedHeader/css/fixedHeader.bootstrap.min.css'),
			'local-css-jquery-datatables-fixed-columns-v1.10.16'			=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/FixedColumns/css/fixedColumns.dataTables.min.css'),
			'local-css-jquery-datatables-fixed-columns-bootstrap-v1.10.16'	=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/FixedColumns/css/fixedColumns.bootstrap.min.css'),
			'local-css-jquery-datatables-key-table-v1.10.16'				=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/KeyTable/css/keyTable.dataTables.min.css'),
			'local-css-jquery-datatables-key-table-bootstrap-v1.10.16'		=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/KeyTable/css/keyTable.bootstrap.min.css'),
			// 'local-css-jquery-datatables-select-v1.10.16'				=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/Select/css/select.dataTables.min.css'),
			// 'local-css-jquery-datatables-select-bootstrap-v1.10.16'		=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/Select/css/select.bootstrap.min.css'),
			// 'local-css-jquery-datatables-responsive-v1.10.16'			=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/Responsive/css/responsive.dataTables.min.css'),
			// 'local-css-jquery-datatables-responsive-bootstrap-v1.10.16'	=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/Responsive/css/responsive.bootstrap.min.css'),
			'local-css-jquery-datatables-plugin-searchhighlight-v1.10.16'	=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/plugins/features/searchHighlight/dataTables.searchHighlight.css'),
			'local-css-highcharts-v6.0.3'									=> url($public.$this->assetsGlobalPath.'highcharts/v6.0.3/code/css/highcharts.css'),
			'local-css-jquery-fullcalendar-v3.9.0'							=> url($public.$this->assetsGlobalPath.'fullcalendar/v3.9.0/fullcalendar.min.css'),
			'cdn-css-progressively-v1.2.5'									=> 'https://unpkg.com/progressively@1.2.5/dist/progressively.min.css',
			'cdn-css-vue-element-ui-theme-chalk-index-v2.12.0'				=> 'https://unpkg.com/element-ui@2.12.0/lib/theme-chalk/index.css',
			'local-css-theme-admin-lte-v2.3.6'								=> url($public.$this->assetsGlobalPath.'themes/admin-lte/v2.3.6/dist/css/AdminLTE.min.css'),
			'local-css-theme-admin-lte-all-skins-v2.3.6'					=> url($public.$this->assetsGlobalPath.'themes/admin-lte/v2.3.6/dist/css/skins/_all-skins.min.css'),
			// 'local-css-theme-supina-concat-theme-supina'					=> url($public.$this->assetsGlobalPath.'themes/supina/concat/theme-supina.min.css'),
			// 'local-css-theme-supina-helpers-all'							=> url($public.$this->assetsGlobalPath.'themes/supina/helpers/helpers-all.css'),
			// 'local-css-theme-supina-elements-progress-bar'				=> url($public.$this->assetsGlobalPath.'themes/supina/elements/progress-bar.css'),
			// 'local-css-admin-lte-skin-black'								=> url($public.$this->assetsGlobalPath.'themes/admin-lte/v2.3.6/dist/css/skins/skin-black.min.css'),
			// 'local-css-admin-lte-custom'									=> url($public.$this->assetsGlobalPath.'themes/admin-lte/v2.3.6/dist/css/custom.css'),
			'local-css-app-style'											=> url($public.$this->assetsCssPath.'style.css')
		];
	}

	/**
	 * backendJsFiles
	 *
	 * @param  string $public
	 *
	 * @return array
	 */
	public function backendJsFiles(string $public = ''): array
	{
		return [
			// 'local-js-underscore-v1.8.3'										=> url($public.$this->assetsGlobalPath.'underscore-js/v1.8.3/underscore-min.js'),
			'local-js-jquery-v2.2.4'											=> url($public.$this->assetsGlobalPath.'jquery/v2.2.4/jquery.min.js'),
			'local-js-jquery-highlight-v3'										=> url($public.$this->assetsGlobalPath.'jquery-highlight/v3/jquery.highlight.js'),
			'local-js-boostrap-v3.3.7'											=> url($public.$this->assetsGlobalPath.'bootstrap/v3.3.7/js/bootstrap.min.js'),
			'local-js-jasny-boostrap-v3.1.3'									=> url($public.$this->assetsGlobalPath.'jasny-bootstrap/v3.1.3/js/jasny-bootstrap.min.js'),
			'local-js-x-editable-boostrap-v1.5.1'								=> url($public.$this->assetsGlobalPath.'x-editable/v1.5.1/dist/bootstrap3-editable/js/bootstrap-editable.min.js'),
			'local-js-x-editable-wysihtml5.js'									=> url($public.$this->assetsGlobalPath.'x-editable/v1.5.1/dist/inputs-ext/wysihtml5/wysihtml5.js'),
			'local-js-modernizr-v3.3.1'											=> url($public.$this->assetsGlobalPath.'modernizr/v3.3.1/modernizr-custom.js'),
			'local-js-prefixfree-v1.0.7'										=> url($public.$this->assetsGlobalPath.'prefixfree/v1.0.7/prefixfree.min.js'),
			'local-js-moment-js-v2.22.2'										=> url($public.$this->assetsGlobalPath.'moment-js/v2.22.2/moment.min.js'),
			'local-js-pace-v1.0.2'												=> url($public.$this->assetsGlobalPath.'pace/v1.0.2/pace.min.js'),
			// 'local-js-jquery-nicescroll-v3.6.8'								=> url($public.$this->assetsGlobalPath.'jquery-nicescroll/v3.6.8/jquery.nicescroll.min.js'),
			'local-js-jquery-lity-v2.2.0'										=> url($public.$this->assetsGlobalPath.'lity/v2.2.0/dist/lity.min.js'),
			// 'local-js-jquery-bootbox-v4.4.0'									=> url($public.$this->assetsGlobalPath.'bootbox/v4.4.0/bootbox.js'),
			// 'local-js-jquery-sweetalert-v1.1.0'								=> url($public.$this->assetsGlobalPath.'sweetalert/v1.1.0/dist/sweetalert.min.js'),
			'cdn-js-jquery-sweetalert-v2.1.2'									=> 'https://unpkg.com/sweetalert/dist/sweetalert.min.js',
			'local-js-jquery-icheck-v1.x'										=> url($public.$this->assetsGlobalPath.'icheck/v1.x/icheck.min.js'),
			'local-js-jquery-flatpickr-v3.0.7'									=> url($public.$this->assetsGlobalPath.'flatpickr/v3.0.7/dist/flatpickr.min.js'),
			'local-js-jquery-air-datepicker-v2.2.3'								=> url($public.$this->assetsGlobalPath.'air-datepicker/v2.2.3/dist/js/datepicker.min.js'),
			'local-js-jquery-air-datepicker-en-v2.2.3'							=> url($public.$this->assetsGlobalPath.'air-datepicker/v2.2.3/dist/js/i18n/datepicker.en.js'),
			'local-js-jquery-select2-v3.5.1'									=> url($public.$this->assetsGlobalPath.'select2/v3.5.1/select2.min.js'),
			'local-js-jquery-bootstrap-wysihtml5-wysihtml5-v0.3.0'				=> url($public.$this->assetsGlobalPath.'bootstrap-wysihtml5/v0.0.2/lib/js/wysihtml5-0.3.0.min.js'),
			'local-js-jquery-bootstrap-wysihtml5-v0.0.2'						=> url($public.$this->assetsGlobalPath.'bootstrap-wysihtml5/v0.0.2/dist/bootstrap-wysihtml5-0.0.2.min.js'),
			'local-js-jquery-tinymce-v4.7.8'									=> url($public.$this->assetsGlobalPath.'tinymce/v4.7.8/js/tinymce/tinymce.min.js'),
			'local-js-jquery-formValidation-v0.6.2-dev'							=> url($public.$this->assetsGlobalPath.'formvalidation/v0.6.2-dev/dist/js/formValidation.min.js'),
			'local-js-jquery-formValidation-bootstrap-v0.6.2-dev'				=> url($public.$this->assetsGlobalPath.'formvalidation/v0.6.2-dev/dist/js/framework/bootstrap.min.js'),
			'local-js-jquery-intl-tel-input-v12.4.0'							=> url($public.$this->assetsGlobalPath.'intl-tel-input/v12.4.0/build/js/intlTelInput.min.js'),
			'local-js-jquery-intl-tel-input-util-v12.4.0'						=> url($public.$this->assetsGlobalPath.'intl-tel-input/v12.4.0/build/js/utils.js'),
			'local-js-jquery-datatables-v1.10.16'								=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/media/js/jquery.dataTables.min.js'),
			'local-js-jquery-datatables-bootstrap-v1.10.16'						=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/media/js/dataTables.bootstrap.min.js'),
			'local-js-jquery-datatables-buttons-v1.10.16'						=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/Buttons/js/dataTables.buttons.min.js'),
			'local-js-jszip-v3.1.4'												=> url($public.$this->assetsGlobalPath.'jszip/v3.1.4/dist/jszip.min.js'),
			'local-js-pdfmake-v0.1.33'											=> url($public.$this->assetsGlobalPath.'pdfmake/v0.1.33/build/pdfmake.min.js'),
			'local-js-pdfmake-vfs_fonts-v0.1.33'								=> url($public.$this->assetsGlobalPath.'pdfmake/v0.1.33/build/vfs_fonts.js'),
			'local-js-jquery-datatables-buttons-html5-v1.10.16'					=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/Buttons/js/buttons.html5.min.js'),
			'local-js-jquery-datatables-buttons-print-v1.10.16'					=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/Buttons/js/buttons.print.min.js'),
			// 'local-js-jquery-datatables-select-v1.10.16'						=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/Select/js/dataTables.select.min.js'),
			'local-js-jquery-datatables-buttons-bootstrap-v1.10.16'				=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/Buttons/js/buttons.bootstrap.min.js'),
			'local-js-jquery-datatables-scroller-v1.10.16'						=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/Scroller/js/dataTables.scroller.min.js'),
			// 'local-js-jquery-datatables-col-reorder-v1.10.16'				=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/ColReorder/js/dataTables.colReorder.min.js'),
			'local-js-jquery-datatables-fixed-header-v1.10.16'					=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/FixedHeader/js/dataTables.fixedHeader.min.js'),
			'local-js-jquery-datatables-fixed-columns-v1.10.16'					=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/FixedColumns/js/dataTables.fixedColumns.min.js'),
			'local-js-jquery-datatables-key-table-v1.10.16'						=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/KeyTable/js/dataTables.keyTable.min.js'),
			// 'local-js-jquery-datatables-buttons-colVis-v1.10.16'				=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/Buttons/js/buttons.colVis.min.js'),
			// 'local-js-jquery-datatables-responsive-v1.10.16'					=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/Responsive/js/dataTables.responsive.min.js'),
			// 'local-js-jquery-datatables-responsive-bootstrap-v1.10.16'		=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/extensions/Responsive/js/responsive.bootstrap.min.js'),
			'local-js-jquery-datatables-plugin-searchhighlight-v1.10.16'		=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/plugins/features/searchHighlight/dataTables.searchHighlight.min.js'),
			'local-js-jquery-datatables-plugin-scrolling-pagination-v1.10.16'	=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/plugins/pagination/select.js'),
			// 'local-js-jquery-datatables-plugin-percentageBars-v1.10.16'		=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/plugins/dataRender/percentageBars.js'),
			// 'local-js-jquery-mark-v8.6.0'									=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/mark/js/jquery.mark.min.js'),
			// 'local-js-jquery-datatables-mark-v2.0.0'							=> url($public.$this->assetsGlobalPath.'datatables/v1.10.16/mark/js/datatables.mark.min.js'),
			'local-js-highcharts-v6.0.3'										=> url($public.$this->assetsGlobalPath.'highcharts/v6.0.3/code/highcharts.js'),
			'local-js-highcharts-modules-exporting-v6.0.3'						=> url($public.$this->assetsGlobalPath.'highcharts/v6.0.3/code/modules/exporting.js'),
			'local-js-jquery-fullcalendar-v3.9.0'								=> url($public.$this->assetsGlobalPath.'fullcalendar/v3.9.0/fullcalendar.min.js'),
			// 'local-js-vue-js-v2.5.2'											=> url($public.$this->assetsGlobalPath.'vue-js/v2.5.2/dist/vue.min.js'),
			'cdn-js-progressively-v1.2.5'										=> 'https://unpkg.com/progressively@1.2.5/dist/progressively.min.js',
			'cdn-js-vue-js-v2.5.17'												=> 'https://unpkg.com/vue@2.5.17/dist/vue.min.js',
			'cdn-js-vue-element-ui-index-v2.12.0'								=> 'https://unpkg.com/element-ui@2.12.0/lib/index.js',
			'cdn-js-vue-element-ui-locale-en-v2.12.0'							=> 'https://unpkg.com/element-ui/lib/umd/locale/en.js',
			'local-js-theme-admin-lte-v2.3.6'									=> url($public.$this->assetsGlobalPath.'themes/admin-lte/v2.3.6/dist/js/app.min.js'),
			// 'local-js-theme-supina-elements-progressbar'						=> url($public.$this->assetsGlobalPath.'themes/supina/widgets/progressbar/progressbar.js'),
			// 'local-js-theme-supina-widgets-wizard'							=> url($public.$this->assetsGlobalPath.'themes/supina/widgets/wizard/js/jquery.bootstrap.wizard.min.js'),
			'local-js-app-script'												=> url($public.$this->assetsJsPath.'script.js')
		];
	}
}
