<?php
/** List with all available otw sitebars
  *
  *
  */
global $_wp_column_headers;

$_wp_column_headers['toplevel_page_otw-sbm'] = array(
	'id' => esc_html__( 'Sidebar ID', 'widgetize-pages-light' ),
	'title' => esc_html__( 'Title', 'widgetize-pages-light' ),
	'status' => esc_html__( 'Status', 'widgetize-pages-light' ),
	'description' => esc_html__( 'Description', 'widgetize-pages-light' )

);

$otw_sidebar_list = get_option( 'otw_sidebars' );

$message = '';
$massages = array();
$messages[1] = 'Sidebar saved.';
$messages[2] = 'Sidebar deleted.';
$messages[3] = 'Sidebar activated.';
$messages[4] = 'Sidebar deactivated.';

if( otw_get('message',false) && isset( $messages[ otw_get('message','') ] ) ){
	$message .= $messages[ otw_get('message','') ];
}

$filtered_otw_sidebar_list = array();

if( is_array( $otw_sidebar_list ) && count( $otw_sidebar_list ) ){
	foreach( $otw_sidebar_list as $sidebar_key => $sidebar_item ){
		if( $sidebar_item['replace'] == '' ){
			$filtered_otw_sidebar_list[ $sidebar_key ] = $sidebar_item;
		}
	}
}

?>
<?php if ( $message ) : ?>
<div id="message" class="updated"><p><?php echo esc_html( $message ); ?></p></div>
<?php endif; ?>
<div class="wrap">
	<div id="icon-edit" class="icon32"><br/></div>
	<h2>
		<?php esc_html_e('Available Custom Sidebars', 'widgetize-pages-light') ?>
		<a class="button add-new-h2" href="<?php echo admin_url( 'admin.php?page=otw-wpl-add'); ?>">Add New</a>
	</h2>
	
	<form class="search-form" action="" method="get">
	</form>
	
	<br class="clear" />
	<?php if( is_array( $filtered_otw_sidebar_list ) && count( $filtered_otw_sidebar_list ) ){?>
	<table class="widefat fixed" cellspacing="0">
		<thead>
			<tr>
				<?php foreach( $_wp_column_headers['toplevel_page_otw-sbm'] as $key => $name ){?>
					<th><?php echo esc_html( $name )?></th>
				<?php }?>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<?php foreach( $_wp_column_headers['toplevel_page_otw-sbm'] as $key => $name ){?>
					<th><?php echo esc_html( $name )?></th>
				<?php }?>
			</tr>
		</tfoot>
		<tbody>
			<?php foreach( $filtered_otw_sidebar_list as $sidebar_item ){?>
				<tr>
					<?php foreach( $_wp_column_headers['toplevel_page_otw-sbm'] as $column_name => $column_title ){
						
						$edit_link = admin_url( 'admin.php?page=otw-wpl&amp;action=edit&amp;sidebar='.$sidebar_item['id'] );
						$delete_link = admin_url( 'admin.php?page=otw-wpl-action&amp;sidebar='.$sidebar_item['id'].'&amp;action=delete' );
						
						switch($column_name) {
							
							case 'cb':
									echo '<th scope="row" class="check-column"><input type="checkbox" name="itemcheck[]" value="'. esc_attr($sidebar_item['id']) .'" /></th>';
								break;
							case 'id':
									echo '<td><strong><a href="'.esc_attr( $edit_link ).'" title="'.esc_attr(sprintf(__('Edit &#8220;%s&#8221;', 'widgetize-pages-light'), $sidebar_item['id'])).'">'.$sidebar_item['id'].'</a></strong><br />';
									
									echo '<div class="row-actions">';
									echo '<a href="'.esc_attr( $edit_link ).'">' . esc_html__('Edit', 'widgetize-pages-light') . '</a>';
									echo ' | <a href="'.esc_attr( $delete_link ).'">' . esc_html__('Delete', 'widgetize-pages-light'). '</a>';
									echo '</div>';
									
									echo '</td>';
								break;
							case 'title':
									echo '<td>'.$sidebar_item['title'].'</td>';
									
								break;
							case 'description':
									echo '<td>'.$sidebar_item['description'].'</td>';
								break;
							case 'status':
									switch( $sidebar_item['status'] ){
										case 'active':
												echo '<td class="sidebar_active">'.esc_html__( 'Active', 'widgetize-pages-light' ).'</td>';
											break;
										case 'inactive':
												echo '<td class="sidebar_inactive">'.esc_html__( 'Inactive', 'widgetize-pages-light' ).'</td>';
											break;
										default:
												echo '<td>'.esc_html__( 'Unknown', 'widgetize-pages-light' ).'</td>';
											break;
									}
								break;
						}
					}?>
				</tr>
			<?php }?>
		</tbody>
	</table>
	<div class="updated einfo"><p><?php echo otw_esc_text( esc_html( 'Create as many sidebars as you need. Then add them in your pages/posts/template files. Here is how you can add sidebars:<br /><br />&nbsp;- page/post bellow content using the Grid Manager metabox when you edit your page<br />&nbsp;- page/post content - select the sidebar you want to insert from the Insert Sidebar ShortCode button in your page/post editor.<br />&nbsp;- page/post content - copy the shortcode and paste it in the editor of a page/post.<br />&nbsp;- any page template using the do_shortcode WP function.<br /><br />Use the Sidebar ID to build your shortcodes.<br />Example: [otw_is sidebar=otw-sidebar-1] ', 'widgetize-pages-light' ), 'rcont' );?></p></div>
	<?php }else{ ?>
		<p><?php esc_html_e('No custom sidebars found.', 'widgetize-pages-light')?></p>
	<?php } ?>
</div>
