<?php defined('C5_EXECUTE') or die('Access Denied.'); 
\View::element('_errors', array('bp_errors' => $bp_errors, 'backup_meta' => $backup_meta, 'context' => $this, 'view_helper' => $view_helper), 'backup_pro');
\View::element('_dashboard_nav', array('active_tab' => 'file_backups', 'context' => $this, 'view_helper' => $view_helper), 'backup_pro');
?>

    <div class="panel">
	<table class="table" width="100%"  border="0" cellpadding="0" cellspacing="0">
	<thead>
		<tr class="even">
			<th><?php echo $view_helper->m62Lang('total_backups'); ?></th>
			<th style="width:65%"><?php echo $view_helper->m62Lang('total_space_used'); ?></th>
			<th><div style="float:right"><?php echo $view_helper->m62Lang('last_backup_taken'); ?></div></th>
			<th><div style="float:right"><?php echo $view_helper->m62Lang('first_backup_taken'); ?></div></th>
		</tr>
	</thead>
	<tbody>
		<tr class="odd">
			<td><?php echo $backup_meta['files']['total_backups']; ?></td>
			<td><?php echo $backup_meta['files']['total_space_used']; ?></td>
			<td><div style="float:right"><?php echo ($backup_meta['files']['newest_backup_taken'] != '' ? $view_helper->m62DateTime($backup_meta['files']['newest_backup_taken']) : $view_helper->m62Lang('na')); ?></div></td>
			<td><div style="float:right"><?php echo ($backup_meta['files']['oldest_backup_taken'] != '' ? $view_helper->m62DateTime($backup_meta['files']['oldest_backup_taken']) : $view_helper->m62Lang('na')); ?></div></td>
		</tr>
	</tbody>
	</table>
	</div>    
	
	<div class=" panel">
	
    <h3  class="accordion"><?php echo $view_helper->m62Lang('file_backups').' ('.count($backups['files']).')'?></h3>
	<?php if(count($backups['files']) == 0): ?>
		<div class="no_backup_found"><?php echo $view_helper->m62Lang('no_file_backups')?> <a href="<?php echo $this->url('/dashboard/backup_pro/backup_files'); ?>"><?php echo $view_helper->m62Lang('would_you_like_to_backup_files_now')?></a></div>
	<?php else: ?>
	
	
		<form name="remove_backups" action="<?php echo $this->action('delete_backups'); ?>" method="post">
        <?php 
        $app = \Concrete\Core\Support\Facade\Application::getFacadeApplication();
        $token = $app->make('helper/validation/token');
        $token->output('bp3_remove_backups_confirm');
        $options = array(
            'enable_type' => 'no',
            'enable_editable_note' =>
            'yes', 'enable_actions' => 'yes',
            'enable_delete' => 'yes',
            'backups' => $backups['files'],
            'context' => $this,
            'view_helper' => $view_helper,
            'bp_static_path' => $bp_static_path
        );        
        \View::element('_backup_table', $options, 'backup_pro');
        ?>	
		<input type="hidden" name="type" id="hidden_backup_type" value="files" />	
		
        
            <input type="submit" name="_remove_backup_button" id="_remove_backup_button" value="<?php echo t($view_helper->m62Lang('delete_selected')); ?>" class="btn btn-primary pull-right">
		
		</form>
							
	<?php endif; ?>
	
	</div>