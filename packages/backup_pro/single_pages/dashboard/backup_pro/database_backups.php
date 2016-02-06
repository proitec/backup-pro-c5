<?php include '_includes/_errors.php'; ?>
<?php $active_tab = 'db_backups'; include '_includes/_dashboard_nav.php'; ?>

<div class="panel">
	<table class="table"  width="100%"  border="0" cellpadding="0" cellspacing="0">
	<thead>
		<tr class="even">
			<th><?php echo $view_helper->m62Lang('total_backups')?></th>
			<th style="width:65%"><?php echo $view_helper->m62Lang('total_space_used'); ?></th>
			<th><div style="float:right"><?php echo $view_helper->m62Lang('last_backup_taken'); ?></div></th>
			<th><div style="float:right"><?php echo $view_helper->m62Lang('first_backup_taken'); ?></div></th>
		</tr>
	</thead>
	<tbody>
		<tr class="odd">
			<td><?php echo $backup_meta['database']['total_backups']; ?></td>
			<td><?php echo $backup_meta['database']['total_space_used']; ?></td>
			<td><div style="float:right"><?php echo ($backup_meta['database']['newest_backup_taken'] != '' ? $view_helper->m62DateTime($backup_meta['database']['newest_backup_taken']) : $view_helper->m62Lang('na')); ?></div></td>
			<td><div style="float:right"><?php echo ($backup_meta['database']['oldest_backup_taken'] != '' ? $view_helper->m62DateTime($backup_meta['database']['oldest_backup_taken']) : $view_helper->m62Lang('na')); ?></div></td>
		</tr>
	</tbody>
	</table>
</div>    


<div class="row panel">

	<h3><?=$view_helper->m62Lang('database_backups').' ('.count($backups['database']).')';?></h3>
	
	<?php if(count($backups['database']) == 0): ?>
		<div class="no_backup_found"><?php echo $view_helper->m62Lang('no_database_backups')?> <a href="<?php echo $url_base; ?>confirm_backup_db"><?php echo $view_helper->m62Lang('would_you_like_to_backup_database_now')?></a></div>
	<?php else: ?>
	
	
		<form name="remove_backups" action="<?php echo $url_base; ?>confirm_remove_backup" method="post"  />
        <?php echo wp_nonce_field( 'remove_bp_backups' ); ?>
		<input type="hidden" name="type" id="hidden_backup_type" value="database" />	
        <?php 
        $options = array('enable_type' => 'no', 'enable_editable_note' => 'yes', 'enable_actions' => 'yes', 'enable_delete' => 'yes');
        extract($options);
        $backups = $backups['database'];
        include '_includes/_backup_table.php';
        ?>		
        <div class="buttons right" style="float:right">
            <?php submit_button($view_helper->m62Lang('delete_backups'), 'primary', '_remove_backup_button');?>
        </div>
		</form>		
	<?php endif; ?>

</div>	