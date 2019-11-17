<?php

// namespace App\Http\Base\Library;
namespace Yajra\DataTables\Html;

use Illuminate\Support\Fluent;

/**
 * Class Parameters.
 *
 * @package Yajra\DataTables\Html
 * @see     https://datatables.net/reference/option/ for possible columns option
 * @author  Arjay Angeles <aqangeles@gmail.com>
 */
class Parameters extends Fluent
// class YajraDataTablesHtmlBuilderParameters
{
	/**
	 * @var array
	 */
	public $attributes = [
		'serverSide' => true,
		'processing' => true,
		'ajax'       => '',
		'columns'    => [],
		// CUSTOM OPTIONS ADDED FROM FURTHER CODE
		'deferRender' => true,
		'searchHighlight' => true,
		// 'colReorder' => true,
		// 'mark' => true,
		// 'scrollY' => '400px',
		// 'sortable' => false,
		// 'select' => true,
		// 'stateSave' => true,
		// 'scroller' => [
		// 	'loadingIndicator' => true
		// ],
		'fixedHeader' => [
			'header' => true,
			'footer' => true
		],
		// 'fixedColumns' => true,
		'keys' => true,
		'scrollX' => true,
		'scrollCollapse' => true,
		'language' => [
			'processing'		=> '<i class="fa fa-3x text-center fa-spin text-red ion-load-c loading-z-index"></i>',
			'loadingRecords'	=> '<i class="fa fa-3x text-center fa-spin text-red ion-load-c loading-z-index"></i>',
			'search'			=> 'Search',
			'searchPlaceholder'	=> 'Search Records...'
		],
		'lengthMenu' => [
			[10, 25, 50, 75, 100, -1],
			[10, 25, 50, 75, 100, 'All']
		],
		// 'dom' => '<"pull-left mrg15B"B><"clearfix"><"pull-left"l><"pull-right"f><"clearfix">rtip',
		'dom' => '<"mrg0A col-md-2 pull-left"l><"col-md-offset-1 col-md-6"B><"col-md-3 pull-right"f><"clearfix">rtip',
		'buttons' => [
			'dom' => [
				'button' => [
					'tag'			=> 'button',
					'className'		=> 'btn btn-sm btn-primary',
					'exportOptions'	=> [
						'columns' => 'th:not(.no-export)'
					]
				]
			],
			'buttons' => [
				[
					'extend'	=> 'copyHtml5',
					'text'		=> '<i class="far fa-copy"></i> Copy',
					'titleAttr'	=> 'Copy to clipboard'
				],
				[
					'extend'	=> 'excelHtml5',
					'text'		=> '<i class="far fa-file-excel"></i> Excel',
					'titleAttr'	=> 'Export to excel'
				],
				[
					'extend'	=> 'csvHtml5',
					'text'		=> '<i class="far fa-file"></i> CSV',
					'titleAttr'	=> 'Export to CSV'
				],
				[
					'extend'		=> 'pdfHtml5',
					'text'			=> '<i class="far fa-file-pdf"></i> PDF',
					'titleAttr'		=> 'Export to PDF',
					'orientation'	=> 'landscape', // portrait
					'pageSize'		=> 'A4' // A3 , A5 , A6 , legal , letter
				],
				[
					'extend'	=> 'print',
					'text'		=> '<i class="fas fa-print"></i> Print',
					'titleAttr'	=> 'Print',
					'autoPrint'	=> true
				]
				// [
				// 	'text'		=> '<i class="ion-ios-refresh"></i> Reload',
				// 	'action'	=> 'function (e, dt, node, config) {
				// 						dt.ajax.reload();
				// 					}'
				// ]
			],
		],
		'pagingType'	=> 'listbox',
		'drawCallback'	=> 'function() {
			const SELECTOR_PAGING_LISTBOX_SELECT	= $(".paging_listbox");
			const SELECTOR_BOOTSTRAP_TOOLTIP		= $("[data-toggle=\'tooltip\']");
			const SELECTOR_BOOTSTRAP_POPOVER		= $("[data-toggle=\'popover\']");

			if (SELECTOR_PAGING_LISTBOX_SELECT.length > 0 && typeof $.fn.select2 != "undefined") {
				SELECTOR_PAGING_LISTBOX_SELECT
					.find("select")
					.css({
						"display": "inline-block"
					})
					.select2({
						width: "100%",
						allowClear: true,
						placeholder: function() {
							$(this).data("placeholder");
						},
						escapeMarkup: function(markup) {
							return markup;
						}
					})
					.focus(function () {
						$(this).select2("focus");
					});

				SELECTOR_PAGING_LISTBOX_SELECT
					.find(".select2-container")
					.css({
						"display": "inline-block",
						"width": "40%"
					});
			}


			// fix bootstrap tooltip plugin.
			// INITIALIZE BOOTSTRAP TOOLTIP
			if (SELECTOR_BOOTSTRAP_TOOLTIP.length > 0 && typeof $.fn.tooltip != "undefined") {
				$(".tooltip.fade.top.in").hide();
				SELECTOR_BOOTSTRAP_TOOLTIP.tooltip({
					container: "body",
					placement: "top"
				});
			}

			// INITIALIZE BOOTSTRAP POPOVER
			if (SELECTOR_BOOTSTRAP_POPOVER.length > 0 && typeof $.fn.popover != "undefined") {
				SELECTOR_BOOTSTRAP_POPOVER.popover({
					container: "body",
					trigger: "hover",
					placement: "top"
				});
			}

			/*progressively.init({
				delay: 50,
				throttle: 300,
				smBreakpoint: 600,
				onLoad: function(elem) {

				},
				onLoadComplete: function() {

				}
			});*/

		}'
	];
}
