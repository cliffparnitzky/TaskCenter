
<form action="<?php echo $this->request; ?>" id="tl_filter" class="tl_form" method="post">
<div class="tl_formbody">
<input type="hidden" name="FORM_SUBMIT" value="tl_filters" />

<div class="tl_panel">
  <div class="tl_filter tl_subpanel">
  <strong><?php echo $this->filter; ?>:</strong>
    <select onchange="form.submit();" name="id" id="id" class="tl_select<?php echo $this->idClass; ?>"><option value=""><?php echo $this->thId; ?></option><option value="">---</option><?php echo $this->idOptions; ?></select>
    <select onchange="form.submit();" name="project" id="project" class="tl_select<?php echo $this->projectClass; ?>"><option value=""><?php echo $this->thProject; ?></option><option value="">---</option><?php echo $this->projectOptions; ?></select>
    <select onchange="form.submit();" name="assignedTo" id="assignedTo" class="tl_select<?php echo $this->assignedToClass; ?>"><option value=""><?php echo $this->thAssignedTo; ?></option><option value="">---</option><?php echo $this->assignedOptions; ?></select>
    <select onchange="form.submit();" name="progress" id="progress" class="tl_select<?php echo $this->progressClass; ?>"><option value=""><?php echo $this->thProgress; ?></option><option value="">---</option><?php echo $this->progressOptions; ?></select>
    <select onchange="form.submit();" name="deadline" id="deadline" class="tl_select<?php echo $this->deadlineClass; ?>"><option value=""><?php echo $this->thDeadline; ?></option><option value="">---</option><?php echo $this->deadlineOptions; ?></select>
  </div>
  
  <div class="clear"></div>
</div>

<div class="tl_panel">
  <div class="tl_filter tl_subpanel tl_specialFilter">
  <strong><?php echo $this->specialFilter; ?>:</strong>
    <span class="specialCheckboxFilter">
		<div class="tl_select<?php echo $this->tasktypeClass; ?>">
			<span class="label"><?php echo $this->thTasktype; ?>:</span>
			<?php echo $this->tasktypeOptions; ?>
		</div>
	</span>
    <span class="specialCheckboxFilter">
		<div class="tl_select<?php echo $this->priorityClass; ?>">
			<span class="label"><?php echo $this->thPriority; ?>:</span>
			<?php echo $this->priorityOptions; ?>
		</div>
	</span>
    <span class="specialCheckboxFilter">
		<div class="tl_select<?php echo $this->statusClass; ?>">
			<span class="label"><?php echo $this->thStatus; ?>:</span>
			<?php echo $this->statusOptions; ?>
		</div>
	</span>
  </div>
  
  <div class="clear"></div>
</div>

<div class="tl_panel">
  <div class="tl_submit_panel tl_subpanel">
    <input type="image" name="filter" id="filter" src="system/themes/<?php echo $this->getTheme(); ?>/images/reload.gif" class="tl_img_submit" title="<?php echo $this->apply; ?>" value="<?php echo $this->apply; ?>" />
  </div>
  
  <div class="tl_search tl_subpanel">
  <strong><?php echo $this->search; ?>:</strong>
    <select name="tl_field" class="tl_select<?php echo $this->searchClass; ?>"><?php echo $this->searchOptions; ?></select>
    <span>=</span>
    <input type="text" name="tl_value" class="tl_text<?php echo $this->searchClass; ?>" value="<?php echo $this->keywords; ?>" />
  </div>
  
  <div class="tl_sorting tl_subpanel">
  <strong><?php echo $this->sorting; ?>:</strong>
    <select onchange="form.submit();" name="tl_sorting" class="tl_select"><?php echo $this->sortingOptions; ?></select>
  </div>
  
  <div class="clear"></div>
</div>

</div>
</form>

<div id="tl_buttons">
<a href="<?php echo $this->createHref; ?>" class="header_new" title="<?php echo $this->createTitle; ?>" accesskey="n" onclick="Backend.getScrollOffset();"><?php echo $this->createLabel; ?></a>
</div>

<div id="tl_taskcenter">
<table cellpadding="0" cellspacing="0" class="sortable" id="taskcenter" summary="">
<thead>
  <tr>
    <?php $columnCounter = 0; ?>
	<th class="col_<?php echo $columnCounter++; ?> col_first"><?php echo $this->thId; ?></th>
	<?php if ($this->tableColumnVisibleProject): ?>
		<th class="col_<?php echo $columnCounter++; ?>"><?php if ($this->tableUseShortNames): ?><?php echo $this->thProjectShort; ?><?php else: ?><?php echo $this->thProject; ?><?php endif; ?></th>
	<?php endif; ?>
	<?php if ($this->tableColumnVisibleTasktype): ?>
		<th class="col_<?php echo $columnCounter++; ?>"><?php if ($this->tableUseShortNames): ?><?php echo $this->thTasktypeShort; ?><?php else: ?><?php echo $this->thTasktype; ?><?php endif; ?></th>
	<?php endif; ?>
	<?php if ($this->tableColumnVisibleTitle): ?>
		<th class="col_<?php echo $columnCounter++; ?>"><?php if ($this->tableUseShortNames): ?><?php echo $this->thTitleShort; ?><?php else: ?><?php echo $this->thTitle; ?><?php endif; ?></th>
	<?php endif; ?>
	<?php if ($this->tableColumnVisibleAssignedTo): ?>
		<th class="col_<?php echo $columnCounter++; ?>"><?php if ($this->tableUseShortNames): ?><?php echo $this->thAssignedToShort; ?><?php else: ?><?php echo $this->thAssignedTo; ?><?php endif; ?></th>
	<?php endif; ?>
	<?php if ($this->tableColumnVisiblePriority): ?>
		<th class="col_<?php echo $columnCounter++; ?>"><?php if ($this->tableUseShortNames): ?><?php echo $this->thPriorityShort; ?><?php else: ?><?php echo $this->thPriority; ?><?php endif; ?></th>
	<?php endif; ?>
	<?php if ($this->tableColumnVisibleStatus): ?>
		<th class="col_<?php echo $columnCounter++; ?>"><?php if ($this->tableUseShortNames): ?><?php echo $this->thStatusShort; ?><?php else: ?><?php echo $this->thStatus; ?><?php endif; ?></th>
	<?php endif; ?>
	<?php if ($this->tableColumnVisibleProgress): ?>
		<th class="col_<?php echo $columnCounter++; ?>"><?php if ($this->tableUseShortNames): ?><?php echo $this->thProgressShort; ?><?php else: ?><?php echo $this->thProgress; ?><?php endif; ?></th>
	<?php endif; ?>
	<?php if ($this->tableColumnVisibleDeadline): ?>
		<th class="col_<?php echo $columnCounter++; ?>"><?php if ($this->tableUseShortNames): ?><?php echo $this->thDeadlineShort; ?><?php else: ?><?php echo $this->thDeadline; ?><?php endif; ?></th>
	<?php endif; ?>
    <th class="col_<?php echo $columnCounter++; ?> col_last">&nbsp;</th>
  </tr>
</thead>
<tbody>
<?php if ($this->tasks): ?>
<?php foreach ($this->tasks as $task): ?>
  <?php $columnCounter = 0; ?>
  <tr class="<?php echo $task['trClass']; ?>">
    <td class="col_<?php echo $columnCounter++; ?> col_first <?php echo $task['tdClass']; ?>"<?php if (strlen($task['tdStyle'])) {echo ' style="' . $task['tdStyle'] . '"';} ?>><?php echo $task['id']; ?></td>
	<?php if ($this->tableColumnVisibleProject): ?>	
		<td class="col_<?php echo $columnCounter++; ?> <?php echo $task['tdClass']; ?>"<?php if (strlen($task['tdStyle'])) {echo ' style="' . $task['tdStyle'] . '"';} ?>><?php echo $task['projectName']; ?></td>
	<?php endif; ?>
	<?php if ($this->tableColumnVisibleTasktype): ?>
		<td class="col_<?php echo $columnCounter++; ?> <?php echo $task['tdClass']; ?><?php if ($this->tableUseIcons): ?> icon<?php endif; ?>"<?php if (strlen($task['tdStyle'])) {echo ' style="' . $task['tdStyle'] . '"';} ?>>
			<?php if ($this->tableUseIcons): ?>
				<img src="<?php echo $task['tasktypeIcon']; ?>" title="<?php echo $task['tasktypeLabel']; ?>" alt="<?php echo $task['tasktypeLabel']; ?>" />
			<?php else: ?>
				<?php echo $task['tasktypeLabel']; ?>
			<?php endif; ?>
		</td>
	<?php endif; ?>
	<?php if ($this->tableColumnVisibleTitle): ?>
		<td class="col_<?php echo $columnCounter++; ?> <?php echo $task['tdClass']; ?>"<?php if (strlen($task['tdStyle'])) {echo ' style="' . $task['tdStyle'] . '"';} ?>><?php echo $task['title']; ?><br /><span class="tl_gray"><?php echo $task['creator']; ?></span></td>
	<?php endif; ?>
	<?php if ($this->tableColumnVisibleAssignedTo): ?>
		<td class="col_<?php echo $columnCounter++; ?> <?php echo $task['tdClass']; ?>"<?php if (strlen($task['tdStyle'])) {echo ' style="' . $task['tdStyle'] . '"';} ?>><?php echo $task['user']; ?></td>
	<?php endif; ?>
	<?php if ($this->tableColumnVisiblePriority): ?>
		<td class="col_<?php echo $columnCounter++; ?> <?php echo $task['tdClass']; ?><?php if ($this->tableUseIcons): ?> icon<?php endif; ?>"<?php if (strlen($task['tdStyle'])) {echo ' style="' . $task['tdStyle'] . '"';} ?>>
			<?php if ($this->tableUseIcons): ?>
				<img src="<?php echo $task['priorityIcon']; ?>" title="<?php echo $task['priorityLabel']; ?>" alt="<?php echo $task['priorityLabel']; ?>" />
			<?php else: ?>
				<?php echo $task['priorityLabel']; ?>
			<?php endif; ?>
		</td>
	<?php endif; ?>
	<?php if ($this->tableColumnVisibleStatus): ?>
		<td class="col_<?php echo $columnCounter++; ?> <?php echo $task['tdClass']; ?><?php if ($this->tableUseIcons): ?> icon<?php endif; ?>"<?php if (strlen($task['tdStyle'])) {echo ' style="' . $task['tdStyle'] . '"';} ?>>
			<?php if ($this->tableUseIcons): ?>
				<img src="<?php echo $task['statusIcon']; ?>" title="<?php echo $task['statusLabel']; ?>" alt="<?php echo $task['statusLabel']; ?>" />
			<?php else: ?>
				<?php echo $task['statusLabel']; ?>
			<?php endif; ?>
		</td>
	<?php endif; ?>
	<?php if ($this->tableColumnVisibleProgress): ?>
		<td class="col_<?php echo $columnCounter++; ?> <?php echo $task['tdClass']; ?>"<?php if (strlen($task['tdStyle'])) {echo ' style="' . $task['tdStyle'] . '"';} ?>><?php echo $task['progress']; ?>%</td>
	<?php endif; ?>
	<?php if ($this->tableColumnVisibleDeadline): ?>
		<td class="col_<?php echo $columnCounter++; ?> <?php echo $task['tdClass']; ?>"<?php if (strlen($task['tdStyle'])) {echo ' style="' . $task['tdStyle'] . '"';} ?>><?php echo $task['deadline']; ?></td>
	<?php endif; ?>
    <td class="col_<?php echo $columnCounter++; ?> col_last <?php echo $task['tdClass']; ?>"<?php if (strlen($task['tdStyle'])) {echo ' style="' . $task['tdStyle'] . '"';} ?>">
		<a href="<?php echo $task['editHref']; ?>" title="<?php echo $task['editTitle']; ?>"><img src="<?php echo $task['editIcon']; ?>" alt="<?php echo $this->editLabel; ?>" /></a>
		<?php if ($task['deleteHref']): ?> <a href="<?php echo $task['deleteHref']; ?>" title="<?php echo $task['deleteTitle']; ?>" onclick="if (!confirm('<?php echo $task['deleteConfirm']; ?>')) return false; Backend.getScrollOffset();"><img src="<?php echo $task['deleteIcon']; ?>" alt="<?php echo $this->deleteLabel; ?>" /></a><?php else: ?> <img src="<?php echo $task['deleteIcon']; ?>" alt="" /><?php endif; ?>
		<a href="<?php echo $task['showHref']; ?>" title="<?php echo $task['showTitle']; ?>"><img src="<?php echo $task['showIcon']; ?>" alt="<?php echo $this->showLabel; ?>" /></a>
		</td>
  </tr>
<?php endforeach; ?>
<?php else: ?>
  <tr>
    <td colspan="6"><?php echo $this->noTasks; ?></td>
  </tr>
<?php endif; ?>
</tbody>
</table>
</div>