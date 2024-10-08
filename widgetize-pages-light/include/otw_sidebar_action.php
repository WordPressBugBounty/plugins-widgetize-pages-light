<?php
/** Sidebar actions
  *  - delete sidebar
  *  - activate
  *  - deactivate
  */
	$otw_sidebar_values = array(
		'sbm_title'       =>  '',
		'sbm_description' =>  '',
		'sbm_replace'     =>  '',
		'sbm_status'      =>  'active'
	);
	
	$otw_sidebar_id = '';
	$otw_action = '';
	
	if( otw_get('action',false) ){
		
		switch( otw_get('action','') ){
			
			case 'delete':
					$otw_action = 'delete_otw_sidebar';
					$page_title = esc_html__( 'Delete Sidebar', 'widgetize-pages-light' );
					$confirm_text = esc_html__( 'Please confirm to delete the sidebar', 'widgetize-pages-light' );
				break;
		}
	}
	if( !$otw_action ){
		wp_die( esc_html__( 'Invalid sidebar action', 'widgetize-pages-light' ) );
	}
	if( otw_get( 'sidebar', false ) ){
		
		$otw_sidebar_id = otw_get( 'sidebar', '' );
		$otw_sidebars = get_option( 'otw_sidebars' );
		
		if( is_array( $otw_sidebars ) && isset( $otw_sidebars[ $otw_sidebar_id ] ) ){
			
			$otw_sidebar_values['sbm_title'] = $otw_sidebars[ $otw_sidebar_id ]['title'];
			$otw_sidebar_values['sbm_description'] = $otw_sidebars[ $otw_sidebar_id ]['description'];
			$otw_sidebar_values['sbm_replace'] = $otw_sidebars[ $otw_sidebar_id ]['replace'];
			$otw_sidebar_values['sbm_status'] = $otw_sidebars[ $otw_sidebar_id ]['status'];
			$otw_sidebar_values['sbm_validfor'] = $otw_sidebars[ $otw_sidebar_id ]['validfor'];
		}
	}
	if( !$otw_sidebar_id ){
		wp_die( esc_html__( 'Invalid sidebar', 'widgetize-pages-light' ) );
	}
	
?>
<div class="wrap">
	<div id="icon-edit" class="icon32"><br/></div>
	<h2>
		<?php echo $page_title; ?>
		<a class="button add-new-h2" href="admin.php?page=otw-wpl">Back To List Of Sidebars</a>
	</h2>
	<div id="ajax-response"></div>
	<div class="form-wrap" id="poststuff">
		<form method="post" action="" class="validate">
			<input type="hidden" name="otw_wpl_action" value="<?php echo esc_attr( $otw_action )?>" />
			<?php wp_original_referer_field(true, 'previous'); wp_nonce_field('otw-sbm-action'); ?>

			<div id="post-body">
				<div id="post-body-content">
					<div id="col-right">
						<div class="form-field form-required">
							<?php esc_html_e( 'Sidebar title', 'widgetize-pages-light' );?>:
							<strong><?php echo esc_html( $otw_sidebar_values['sbm_title'] )?></strong>
						</div>
						<div class="form-field">
							<?php esc_html_e( 'Description', 'widgetize-pages-light' )?>:
							<strong><?php echo esc_html( $otw_sidebar_values['sbm_description'] )?></strong>
						</div>
					</div>
					<div id="col-left">
						<p>
							<?php echo $confirm_text;?>
						</p>
						<p class="submit">
							<input type="submit" value="<?php esc_html_e( 'Confirm', 'widgetize-pages-light') ?>" name="submit" class="button"/>
							<input type="submit" value="<?php esc_html_e( 'Cancel', 'widgetize-pages-light' ) ?>" name="cancel" class="button"/>
						</p>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>