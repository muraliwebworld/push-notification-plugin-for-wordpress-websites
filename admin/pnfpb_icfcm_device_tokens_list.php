<?php
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

if ( !class_exists( 'PNFPB_ICFM_Device_tokens_List' ) ) {
	
	class PNFPB_ICFM_Device_tokens_List extends WP_List_Table {
		
	private $table_data;

	/** Class constructor */
	public function __construct() {

		parent::__construct( [
			'singular' => __( 'Devicetoken', 'PNFPB_TD' ), //singular name of the listed records
			'plural'   => __( 'Devicetokens', 'PNFPB_TD' ), //plural name of the listed records
			'ajax'     => false //does this table support ajax?
		] );

	}


	/**
	 * Retrieve Device tokens data from the database
	 *
	 * @param int $per_page
	 * @param int $page_number
	 *
	 * @return mixed
	 */
	public static function get_devicetokens( $per_page = 20, $page_number = 1, $search='' ) {

		global $wpdb;

		if ( !empty($search) && is_numeric($search) ) {
			$sql = "SELECT * FROM {$wpdb->prefix}pnfpb_ic_subscribed_deviceids_web WHERE userid = {$search} OR device_id LIKE '%{$search}%' OR subscription_option LIKE '%{$search}%'";
		}
		else 
		{
			if ( !empty($search) && !is_numeric($search) ) {
				$sql = "SELECT * FROM {$wpdb->prefix}pnfpb_ic_subscribed_deviceids_web WHERE device_id LIKE '%{$search}%' OR subscription_option LIKE '%{$search}%'";				
			}
			else 
			{
				$sql = "SELECT * FROM {$wpdb->prefix}pnfpb_ic_subscribed_deviceids_web";
			}
		}

		if ( ! empty( $_REQUEST['orderby'] ) ) {
			$sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
			$sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
		}

		if ($per_page > 0) {
			$sql .= " LIMIT $per_page";
			$sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;			
		}

		$result = $wpdb->get_results( $sql, 'ARRAY_A' );

		return $result;
	}


	/**
	 * Delete a customer record.
	 *
	 * @param int $id device token ID
	 */
	public static function delete_devicetoken( $id ) {
		global $wpdb;

		$wpdb->delete(
			"{$wpdb->prefix}pnfpb_ic_subscribed_deviceids_web",
			[ 'id' => $id ],
			[ '%d' ]
		);
	}


	/**
	 * Returns the count of records in the database.
	 *
	 * @return null|string
	 */
	public static function record_count() {
		global $wpdb;

		$sql = "SELECT COUNT(*) FROM {$wpdb->prefix}pnfpb_ic_subscribed_deviceids_web";

		return $wpdb->get_var( $sql );
	}


	/** Text displayed when no device token data is available */
	public function no_items() {
		_e( 'No registered device tokens avaliable.', 'PNFPB_TD' );
	}


	/**
	 * Render a column when no column specific method exist.
	 *
	 * @param array $item
	 * @param string $column_name
	 *
	 * @return mixed
	 */
	public function column_default( $item, $column_name ) {
		switch ( $column_name ) {
			case 'id':
			case 'device_id':
			case 'userid':
			case 'subscription_option':
				return $item[ $column_name ];
			default:
				return print_r( $item, true ); //Show the whole array for troubleshooting purposes
		}
	}

	/**
	 * Render the bulk edit checkbox
	 *
	 * @param array $item
	 *
	 * @return string
	 */
	function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['id']
		);
	}


	/**
	 * Method for name column
	 *
	 * @param array $item an array of DB data
	 *
	 * @return string
	 */
	function column_name( $item ) {

		$delete_nonce = wp_create_nonce( 'pnfpb_delete_devicetoken' );

		$title = '<strong>' . $item['device_id'] . '</strong>';

		$actions = [
			'delete' => sprintf( '<a href="?page=%s&action=%s&devicetoken=%s&_wpnonce=%s">Delete</a>', esc_attr( $_REQUEST['page'] ), 'delete', absint( $item['id'] ), $delete_nonce )
		];

		return $title . $this->row_actions( $actions );
	}


	/**
	 *  Associative array of columns
	 *
	 * @return array
	 */
	function get_columns() {
		$columns = [
			'cb'      => '<input type="checkbox" />',
			'id'    => __( 'Id', 'PNFPB_TD' ),
			'device_id' => __( 'Device token', 'PNFPB_TD' ),
			'userid'    => __( 'Userid', 'PNFPB_TD' ),
			'subscription_option' => __('Shortcode Subscription','PNFPB_TD')
		];

		return $columns;
	}


	/**
	 * Columns to make sortable.
	 *
	 * @return array
	 */
	public function get_sortable_columns() {
		$sortable_columns = array(
			'id' => array( 'id', true ),
			'device_id' => array( 'device_id', true ),
			'userid' => array( 'userid', true ),
			'subscription_option' => array( 'subscription_option', true )
		);

		return $sortable_columns;
	}

	/**
	 * Returns an associative array containing the bulk action
	 *
	 * @return array
	 */
	public function get_bulk_actions() {
		$actions = [
			'bulk-delete' => 'Delete'
		];

		return $actions;
	}


	/**
	 * Handles data query and filter, sorting, and pagination.
	 */
	public function prepare_items($search='') {
		
        //data
        if ( isset($_REQUEST['s']) ) {
            $this->table_data = $this->get_table_data($_REQUEST['s']);
        } else {
            $this->table_data = $this->get_table_data($search);
        }		

		$this->_column_headers = $this->get_column_info();

		/** Process bulk action */
		$this->process_bulk_action();

		$per_page     = $this->get_items_per_page( 'records_per_page', 20 );
		$current_page = $this->get_pagenum();
		$total_items  = self::record_count();

		if ( isset($_REQUEST['s']) ) {
			$this->items = self::get_devicetokens( $per_page, $current_page, $_REQUEST['s'] );
			$total_items_search = self::get_devicetokens( 0, $current_page, $_REQUEST['s'] );
			$this->set_pagination_args( [
				'total_items' => count($total_items_search), //WE have to calculate the total number of items
				'per_page'    => $per_page //WE have to determine how many items to show on a page
			] );			
		}
		else 
		{
			$this->items = self::get_devicetokens( $per_page, $current_page, '' );
			$this->set_pagination_args( [
				'total_items' => $total_items, //WE have to calculate the total number of items
				'per_page'    => $per_page //WE have to determine how many items to show on a page
			] );			
		}
		
		
	}
		
	public function pnfpb_url_scheme_start() {
    	add_filter( 'set_url_scheme', [$this, 'pnfpb_url_scheme'], 10, 3 );
	}
		
	public function pnfpb_url_scheme_stop() {
    	remove_filter( 'set_url_scheme', [$this, 'pnfpb_url_scheme'], 10 );
	}
		
	public function pnfpb_url_scheme( string $url, string $scheme, $orig_scheme ) {
    	if ( ! empty( $url ) && mb_strpos( $url, '?page=pnfpb_icfm_device_tokens_list' ) !== false && isset( $_REQUEST['s'] ) ) {
        	$url = add_query_arg( 's', urlencode( $_REQUEST['s'] ), $url );
    	}
    	return( $url );
	}	
		

	public function process_bulk_action() {

		//Detect when a bulk action is being triggered...
		if ( 'delete' === $this->current_action() ) {

			// In our file that handles the request, verify the nonce.
			$nonce = esc_attr( $_REQUEST['_wpnonce'] );

			if ( ! wp_verify_nonce( $nonce, 'pnfpb_delete_devicetoken' ) ) {
				die( 'wnonce failure' );
			}
			else {
				self::delete_devicetoken( absint( $_GET['devicetoken'] ) );

		                // esc_url_raw() is used to prevent converting ampersand in url to "#038;"
		                // add_query_arg() return the current url
		               //wp_redirect( esc_url_raw(add_query_arg()) );
					   //exit;
			}

		}

		// If the delete bulk action is triggered
		if ( ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'bulk-delete' )
		     || ( isset( $_REQUEST['action2'] ) && $_REQUEST['action2'] == 'bulk-delete' )
		) {

			$delete_ids = esc_sql( $_REQUEST['bulk-delete'] );

			// loop over the array of record IDs and delete them
			foreach ( $delete_ids as $id ) {
				self::delete_devicetoken( $id );

			}

			// esc_url_raw() is used to prevent converting ampersand in url to "#038;"
		        // add_query_arg() return the current url
		        //wp_redirect( esc_url_raw(add_query_arg()) );
			//exit;
		}
	}

  }
}
else 
{
	exit;
}
?>