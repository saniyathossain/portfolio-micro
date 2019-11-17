<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>{!! $title or '' !!}</title>

		<style>
			@font-face {
				font-family: 'Source Sans Pro';
				font-style: normal;
				font-weight: normal;
				src: url('{!! asset($Constants_Library::ASSETS_PUBLIC_PATH.'assets/global/fonts/source-sans-pro/source-sans-pro.regular.ttf') !!}') format('truetype');
			}
			@font-face {
				font-family: 'Source Sans Pro';
				font-style: bold;
				font-weight: bold;
				src: url('{!! asset($Constants_Library::ASSETS_PUBLIC_PATH.'assets/global/fonts/source-sans-pro/source-sans-pro.bold.ttf') !!}') format('truetype');
			}
			@font-face {
				font-family: 'Source Sans Pro';
				font-style: italic;
				font-weight: italic;
				src: url('{!! asset($Constants_Library::ASSETS_PUBLIC_PATH.'assets/global/fonts/source-sans-pro/source-sans-pro.italic.ttf') !!}') format('truetype');
			}
			/*@font-face {
				font-family: 'Source Sans Pro';
				font-style: italic, oblique;
				font-weight: bold;
				src: url('{!! asset($Constants_Library::ASSETS_PUBLIC_PATH.'assets/global/fonts/source-sans-pro/source-sans-pro.bold-italic.ttf') !!}') format('truetype');
			}*/

			@font-face {
				font-family: 'FSLola';
				font-style: normal;
				font-weight: normal;
				src: url('{!! asset($Constants_Library::ASSETS_PUBLIC_PATH.'assets/global/fonts/FS-Lola/FSLola-Regular.ttf') !!}') format('truetype');
			}
			@font-face {
				font-family: 'FSLola';
				font-style: bold;
				font-weight: bold;
				src: url('{!! asset($Constants_Library::ASSETS_PUBLIC_PATH.'assets/global/fonts/FS-Lola/FSLola-Bold.ttf') !!}') format('truetype');
			}
			@font-face {
				font-family: 'FSLola';
				font-style: italic;
				font-weight: italic;
				src: url('{!! asset($Constants_Library::ASSETS_PUBLIC_PATH.'assets/global/fonts/FS-Lola/FSLola-Italic.ttf') !!}') format('truetype');
			}
			/*@font-face {
				font-family: 'FSLola';
				font-style: italic, oblique;
				font-weight: bold;
				src: url('{!! asset($Constants_Library::ASSETS_PUBLIC_PATH.'assets/global/fonts/FS-Lola/FSLola-BoldItalic.ttf') !!}') format('truetype');
			}*/

			/* -------------------------------------
			GLOBAL
			------------------------------------- */

			* {
				margin: 0;
				padding: 0;
				/*font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;*/
				font-family: 'Source Sans Pro', 'FSLola', Arial, sans-serif;
				box-sizing: border-box;
				/*font-size: 14px;*/
			}

			html, body {
				font-family: 'Source Sans Pro', 'FSLola', Arial, sans-serif;
				font-size: 1em;
				color: #111;
				font-weight: 400;
				-webkit-font-smoothing: antialiased;
				font-smoothing: antialiased;
				background: #fff;
				text-align: justify;
			}

			/* -------------------------------------
				BODY & CONTAINER
				------------------------------------- */

			img {
				max-width: 100%;
			}

			body {
				-webkit-font-smoothing: antialiased;
				-webkit-text-size-adjust: none;
				width: 100% !important;
				height: 100%;
				line-height: 1.5;
				background-color: #f6f6f6;
			}

			.body-wrap {
				background-color: #f6f6f6;
				width: 100%;
			}

			.container {
				display: block !important;
				/*max-width: 600px !important;*/
				margin: 0 auto !important;
				/* makes it centered */
				clear: both !important;
			}
			.content {
				/*max-width: 600px;*/
				margin: 0 auto;
				display: block;
				padding: 20px;
			}

			/* -------------------------------------
				HEADER, FOOTER, MAIN
				------------------------------------- */

			.main {
				background: #fff;
				border: 1px solid #e9e9e9;
				border-radius: 3px;
			}
			.content-wrap {
				padding: 20px;
			}
			.content-block {
				padding: 0 0 20px;
			}
			.header {
				width: 100%;
				margin-bottom: 20px;
			}
			.footer {
				width: 100%;
				clear: both;
				color: #999;
				padding: 20px;
			}
			.footer a {
				color: #999;
			}
			.footer p, .footer a, .footer unsubscribe, .footer td {
				font-size: 12px;
			}

			/* -------------------------------------
				GRID AND COLUMNS
				------------------------------------- */

			.column-left {
				float: left;
				width: 50%;
			}
			.column-right {
				float: left;
				width: 50%;
			}

			/* -------------------------------------
				TYPOGRAPHY
				------------------------------------- */

			h1, h2, h3 {
				font-family: 'Source Sans Pro', 'FSLola', Arial, sans-serif;
				color: #000;
				margin: 40px 0 0;
				line-height: 1.2;
				font-weight: 400;
			}
			h1 {
				font-size: 32px;
				font-weight: 500;
			}
			h2 {
				font-size: 24px;
			}
			h3 {
				font-size: 18px;
			}
			h4 {
				font-size: 14px;
				font-weight: 600;
			}
			p, ul, ol {
				margin-bottom: 10px;
				font-weight: normal;
			}
			p li, ul li, ol li {
				margin-left: 5px;
				list-style-position: inside;
			}

			/* -------------------------------------
				TABLE
				------------------------------------- */

			.table {
				border-collapse: collapse !important;
				margin-bottom: 20px;
			}

			table td {
				vertical-align: top;
			}

			.table td,
			.table th {
				background-color: #fff !important;
			}
			.table-bordered th,
			.table-bordered td {
				border: 1px solid #ddd !important;
			}

			.table > thead > tr > th,
			.table > tbody > tr > th,
			.table > tfoot > tr > th,
			.table > thead > tr > td,
			.table > tbody > tr > td,
			.table > tfoot > tr > td {
				padding: 8px;
				line-height: 1.42857143;
				vertical-align: top;
				border-top: 1px solid #ddd;
			}
			.table > thead > tr > th {
				vertical-align: bottom;
				border-bottom: 2px solid #ddd;
			}
			.table > caption + thead > tr:first-child > th,
			.table > colgroup + thead > tr:first-child > th,
			.table > thead:first-child > tr:first-child > th,
			.table > caption + thead > tr:first-child > td,
			.table > colgroup + thead > tr:first-child > td,
			.table > thead:first-child > tr:first-child > td {
				border-top: 0;
			}
			.table > tbody + tbody {
				border-top: 2px solid #ddd;
			}

			/* -------------------------------------
			LINKS & BUTTONS
			------------------------------------- */

			a {
				color: #348eda;
				text-decoration: underline;
			}

			.btn-primary {
				text-decoration: none;
				color: #FFF;
				background-color: #348eda;
				border: solid #348eda;
				/*border-width: 10px 20px;*/
				border-width: 5px 10px;
				/*line-height: 2;*/
				/*font-weight: bold;*/
				text-align: center;
				cursor: pointer;
				display: inline-block;
				border-radius: 4px;
				text-transform: capitalize;
			}

			/* -------------------------------------
				OTHER STYLES THAT MIGHT BE USEFUL
				------------------------------------- */

			.last {
				margin-bottom: 0;
			}
			.first {
				margin-top: 0;
			}
			.padding {
				padding: 10px 0;
			}
			.aligncenter {
				text-align: center;
			}
			.alignright {
				text-align: right;
			}
			.alignleft {
				text-align: left;
			}
			.alignjustify {
				text-align: justify;
			}
			.clear {
				clear: both;
			}

			.dl-horizontal dt {
				float: left;
				width: 75px;
				overflow: hidden;
				clear: left;
				text-align: left;
				text-overflow: ellipsis;
				white-space: nowrap;
			}
			.dl-horizontal dd {
				margin-left: 75px;
			}

			/* -------------------------------------
				Alerts
				------------------------------------- */

			.alert {
				font-size: 16px;
				color: #fff;
				font-weight: 500;
				padding: 20px;
				text-align: center;
				border-radius: 3px 3px 0 0;
			}
			.alert a {
				color: #fff;
				text-decoration: none;
				font-weight: 500;
				font-size: 16px;
			}
			.alert.alert-warning {
				background: #ff9f00;
			}
			.alert.alert-bad {
				background: #d0021b;
			}
			.alert.alert-good {
				background: #68b90f;
			}
			.alert.alert-info {
				background: #00799E;
			}

			/* -------------------------------------
				INVOICE
				------------------------------------- */

			.invoice {
				margin: 40px auto;
				text-align: left;
				width: 80%;
			}
			.invoice td {
				padding: 5px 0;
			}
			.invoice .invoice-items {
				width: 100%;
			}
			.invoice .invoice-items td {
				border-top: #eee 1px solid;
			}
			.invoice .invoice-items .total td {
				border-top: 2px solid #333;
				border-bottom: 2px solid #333;
				font-weight: 700;
			}

			/* -------------------------------------
				RESPONSIVE AND MOBILE FRIENDLY STYLES
				------------------------------------- */

			@media only screen and (max-width: 640px) {
				h1, h2, h3, h4 {
					font-weight: 600 !important;
					margin: 20px 0 5px !important;
				}
				h1 {
					font-size: 22px !important;
				}
				h2 {
					font-size: 18px !important;
				}
				h3 {
					font-size: 16px !important;
				}
				.container {
					width: 100% !important;
				}
				.content, .content-wrapper {
					padding: 10px !important;
				}
				.invoice {
					width: 100% !important;
				}
			}
		</style>

	</head>

	<body>
		@yield('contents')
	</body>
</html>