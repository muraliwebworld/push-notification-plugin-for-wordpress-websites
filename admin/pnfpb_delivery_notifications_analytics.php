<?php
/**
 * Analytics chart page — shows sent/delivered/read stats filterable by day/month/year.
 *
 * Included by PNFPB_icfm_analytics_notifications() which is registered as a submenu page.
 *
 * @since 2.21.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<h1 class="pnfpb_ic_push_settings_header">
	<span class="dashicons dashicons-chart-area" style="font-size:26px;width:26px;height:26px;color:#D97706;margin-top:3px;"></span>
	<?php echo esc_html( __( 'PNFPB - Push Notification Reports', 'push-notification-for-post-and-buddypress' ) ); ?>
</h1>
<?php
	$pnfpb_tab_reportdelivery_active = 'nav-tab-active';
	require_once plugin_dir_path( __FILE__ ) . 'push_admin_menu_list.php';
?>

<nav class="nav-tab-wrapper pnfpb-reports-sub-bar"
	 aria-label="<?php esc_attr_e( 'Report type', 'push-notification-for-post-and-buddypress' ); ?>">
	<a class="nav-tab pnfpb-sub-tab pnfpb-sub-tab--delivery"
	   href="<?php echo esc_url( admin_url( 'admin.php?page=pnfpb_icfm_delivery_notifications_list&orderby=id&order=desc' ) ); ?>">
		<span class="pnfpb-sub-tab__icon" aria-hidden="true">
			<span class="dashicons dashicons-chart-line"></span>
		</span>
		<span class="pnfpb-sub-tab__label">
			<?php echo esc_html( __( 'Delivery &amp; Read Report', 'push-notification-for-post-and-buddypress' ) ); ?>
		</span>
	</a>
	<a class="nav-tab pnfpb-sub-tab pnfpb-sub-tab--browser"
	   href="<?php echo esc_url( admin_url( 'admin.php?page=pnfpb_icfm_browser_delivery_notifications_list&orderby=id&order=desc' ) ); ?>">
		<span class="pnfpb-sub-tab__icon" aria-hidden="true">
			<span class="dashicons dashicons-desktop"></span>
		</span>
		<span class="pnfpb-sub-tab__label">
			<?php echo esc_html( __( 'Browser Details', 'push-notification-for-post-and-buddypress' ) ); ?>
		</span>
	</a>
	<a class="nav-tab pnfpb-sub-tab pnfpb-sub-tab--adminpush"
	   href="<?php echo esc_url( admin_url( 'admin.php?page=pnfpb_icfm_onetime_notifications_list&orderby=id&order=desc' ) ); ?>">
		<span class="pnfpb-sub-tab__icon" aria-hidden="true">
			<span class="dashicons dashicons-megaphone"></span>
		</span>
		<span class="pnfpb-sub-tab__label">
			<?php echo esc_html( __( 'Sent from Admin', 'push-notification-for-post-and-buddypress' ) ); ?>
		</span>
	</a>
	<a class="nav-tab pnfpb-sub-tab pnfpb-sub-tab--analytics nav-tab-active"
	   aria-current="page"
	   href="<?php echo esc_url( admin_url( 'admin.php?page=pnfpb_icfm_analytics_notifications' ) ); ?>">
		<span class="pnfpb-sub-tab__icon" aria-hidden="true">
			<span class="dashicons dashicons-chart-area"></span>
		</span>
		<span class="pnfpb-sub-tab__label">
			<?php echo esc_html( __( 'Analytics Chart', 'push-notification-for-post-and-buddypress' ) ); ?>
		</span>
	</a>
</nav>

<div class="pnfpb-analytics-wrap">

	<!-- ───── Filter bar ───── -->
	<div class="pnfpb-chart-filters">
		<div class="pnfpb-chart-filters__group">
			<label class="pnfpb-chart-filters__label">
				<?php esc_html_e( 'Group by', 'push-notification-for-post-and-buddypress' ); ?>
			</label>
			<div class="pnfpb-chart-filters__radios">
				<label><input type="radio" name="pnfpb_group_by" value="day"><?php esc_html_e( 'Day', 'push-notification-for-post-and-buddypress' ); ?></label>
				<label><input type="radio" name="pnfpb_group_by" value="week"><?php esc_html_e( 'Week', 'push-notification-for-post-and-buddypress' ); ?></label>
				<label><input type="radio" name="pnfpb_group_by" value="month" checked><?php esc_html_e( 'Month', 'push-notification-for-post-and-buddypress' ); ?></label>
				<label><input type="radio" name="pnfpb_group_by" value="year"><?php esc_html_e( 'Year', 'push-notification-for-post-and-buddypress' ); ?></label>
			</div>
		</div>
		<div class="pnfpb-chart-filters__group">
			<label class="pnfpb-chart-filters__label" for="pnfpb_date_from">
				<?php esc_html_e( 'From', 'push-notification-for-post-and-buddypress' ); ?>
			</label>
			<input type="date" id="pnfpb_date_from" name="pnfpb_date_from" class="pnfpb-chart-date-input">
		</div>
		<div class="pnfpb-chart-filters__group">
			<label class="pnfpb-chart-filters__label" for="pnfpb_date_to">
				<?php esc_html_e( 'To', 'push-notification-for-post-and-buddypress' ); ?>
			</label>
			<input type="date" id="pnfpb_date_to" name="pnfpb_date_to" class="pnfpb-chart-date-input">
		</div>
		<button id="pnfpb-chart-apply" class="button button-primary pnfpb-chart-apply-btn">
			<?php esc_html_e( 'Apply', 'push-notification-for-post-and-buddypress' ); ?>
		</button>
	</div>

	<!-- ───── Legend / summary strip ───── -->
	<div class="pnfpb-chart-legend-strip" id="pnfpb-chart-summary" aria-live="polite"></div>

	<!-- ───── Chart canvas ───── -->
	<div class="pnfpb-chart-container">
		<canvas id="pnfpb-analytics-chart" aria-label="<?php esc_attr_e( 'Push notification analytics chart', 'push-notification-for-post-and-buddypress' ); ?>" role="img"></canvas>
		<div class="pnfpb-chart-loading" id="pnfpb-chart-loading" style="display:none;">
			<span class="spinner is-active"></span>
			<?php esc_html_e( 'Loading…', 'push-notification-for-post-and-buddypress' ); ?>
		</div>
	</div>

</div><!-- .pnfpb-analytics-wrap -->

<script>
/* global wp, Chart */
(function () {
	'use strict';

	var ajaxUrl  = <?php echo wp_json_encode( admin_url( 'admin-ajax.php' ) ); ?>;
	var nonce    = <?php echo wp_json_encode( wp_create_nonce( 'pnfpb_analytics_chart_nonce' ) ); ?>;

	var chartInstance = null;
	var canvas        = document.getElementById( 'pnfpb-analytics-chart' );
	var loading       = document.getElementById( 'pnfpb-chart-loading' );
	var summary       = document.getElementById( 'pnfpb-chart-summary' );

	function getGroupBy() {
		var el = document.querySelector( 'input[name="pnfpb_group_by"]:checked' );
		return el ? el.value : 'month';
	}

	function buildSummary( data ) {
		if ( ! data || ! data.sent ) {
			summary.innerHTML = '';
			return;
		}
		var totalSent      = data.sent.reduce( function(a, b){ return a + b; }, 0 );
		var totalDelivered = data.delivered.reduce( function(a, b){ return a + b; }, 0 );
		var totalRead      = data.read.reduce( function(a, b){ return a + b; }, 0 );
		summary.innerHTML =
			'<span class="pnfpb-chart-summary-item pnfpb-summary--sent">' +
				'<strong>' + totalSent.toLocaleString() + '</strong> <?php echo esc_js( __( 'Sent', 'push-notification-for-post-and-buddypress' ) ); ?>' +
			'</span>' +
			'<span class="pnfpb-chart-summary-item pnfpb-summary--delivered">' +
				'<strong>' + totalDelivered.toLocaleString() + '</strong> <?php echo esc_js( __( 'Delivered', 'push-notification-for-post-and-buddypress' ) ); ?>' +
			'</span>' +
			'<span class="pnfpb-chart-summary-item pnfpb-summary--read">' +
				'<strong>' + totalRead.toLocaleString() + '</strong> <?php echo esc_js( __( 'Read / Opened', 'push-notification-for-post-and-buddypress' ) ); ?>' +
			'</span>';
	}

	function renderChart( data ) {
		if ( chartInstance ) {
			chartInstance.destroy();
			chartInstance = null;
		}

		var ctx = canvas.getContext( '2d' );

		chartInstance = new Chart( ctx, {
			type: 'bar',
			data: {
				labels: data.labels || [],
				datasets: [
					{
						label: '<?php echo esc_js( __( 'Sent', 'push-notification-for-post-and-buddypress' ) ); ?>',
						data: data.sent || [],
						backgroundColor: 'rgba(99,102,241,0.75)',
						borderColor: 'rgba(99,102,241,1)',
						borderWidth: 1,
						borderRadius: 4,
					},
					{
						label: '<?php echo esc_js( __( 'Delivered', 'push-notification-for-post-and-buddypress' ) ); ?>',
						data: data.delivered || [],
						backgroundColor: 'rgba(34,197,94,0.75)',
						borderColor: 'rgba(34,197,94,1)',
						borderWidth: 1,
						borderRadius: 4,
					},
					{
						label: '<?php echo esc_js( __( 'Read / Opened', 'push-notification-for-post-and-buddypress' ) ); ?>',
						data: data.read || [],
						backgroundColor: 'rgba(251,191,36,0.75)',
						borderColor: 'rgba(251,191,36,1)',
						borderWidth: 1,
						borderRadius: 4,
					},
				],
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				plugins: {
					legend: {
						position: 'top',
					},
					tooltip: {
						mode: 'index',
						intersect: false,
					},
				},
				scales: {
					x: {
						grid: { display: false },
					},
					y: {
						beginAtZero: true,
						ticks: { precision: 0 },
					},
				},
			},
		} );
	}

	function loadData() {
		var groupBy  = getGroupBy();
		var dateFrom = document.getElementById( 'pnfpb_date_from' ).value;
		var dateTo   = document.getElementById( 'pnfpb_date_to' ).value;

		loading.style.display = 'flex';
		canvas.style.opacity  = '0.4';

		var fd = new FormData();
		fd.append( 'action',    'pnfpb_analytics_chart_data' );
		fd.append( 'nonce',     nonce );
		fd.append( 'group_by',  groupBy );
		fd.append( 'date_from', dateFrom );
		fd.append( 'date_to',   dateTo );

		fetch( ajaxUrl, { method: 'POST', body: fd, credentials: 'same-origin' } )
			.then( function( res ) { return res.json(); } )
			.then( function( json ) {
				loading.style.display = 'none';
				canvas.style.opacity  = '1';
				if ( json.success && json.data ) {
					renderChart( json.data );
					buildSummary( json.data );
				}
			} )
			.catch( function() {
				loading.style.display = 'none';
				canvas.style.opacity  = '1';
			} );
	}

	document.getElementById( 'pnfpb-chart-apply' ).addEventListener( 'click', function() {
		loadData();
	} );

	// Auto-trigger when group_by radio changes.
	document.querySelectorAll( 'input[name="pnfpb_group_by"]' ).forEach( function( el ) {
		el.addEventListener( 'change', function() { loadData(); } );
	} );

	// Initial load.
	loadData();
}());
</script>
