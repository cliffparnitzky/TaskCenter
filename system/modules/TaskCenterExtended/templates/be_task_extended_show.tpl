
<div id="tl_buttons">
<a href="contao/main.php?do=tasks" class="header_back" title="<?php echo $this->goBack; ?>" accesskey="b" onclick="Backend.getScrollOffset();"><?php echo $this->goBack; ?></a>
</div>

<h2 class="sub_headline"><?php echo $this->headline; ?></h2>

<table cellspacing="0" cellpadding="0" summary="Table lists all details of an entry" class="tl_show">
	<tr>
		<td><span class="tl_label"><?php echo $this->idLabel; ?>:</span></td>
		<td><?php echo $this->id; ?></td>
	</tr>
	<tr>
		<td><span class="tl_label"><?php echo $this->projectNameLabel; ?>:</span></td>
		<td><?php echo $this->projectName; ?></td>
	</tr>
	<tr>
		<td><span class="tl_label"><?php echo $this->titleLabel; ?>:</span></td>
		<td><?php echo $this->title; ?></td>
	</tr>
	<tr>
		<td><span class="tl_label"><?php echo $this->createdByLabel; ?>:</span></td>
		<td><?php echo $this->createdBy; ?></td>
	</tr>
	<tr>
		<td><span class="tl_label"><?php echo $this->dateLabel; ?>:</span></td>
		<td><?php echo $this->date; ?></td>
	</tr>
	<tr>
		<td><span class="tl_label"><?php echo $this->deadlineLabel; ?>:</span></td>
		<td><?php echo $this->deadline; ?></td>
	</tr>
	<tr>
		<td><span class="tl_label"><?php echo $this->tasktypeLabel; ?>:</span></td>
		<td><?php echo $this->tasktype; ?></td>
	</tr>
	<tr>
		<td><span class="tl_label"><?php echo $this->priorityLabel; ?>:</span></td>
		<td><?php echo $this->priority; ?></td>
	</tr>
	<tr>
		<td><span class="tl_label"><?php echo $this->assignedToLabel; ?>:</span></td>
		<td><?php echo $this->assignedTo; ?></td>
	</tr>
	<tr>
		<td><span class="tl_label"><?php echo $this->statusLabel; ?>:</span></td>
		<td><?php echo $this->status; ?></td>
	</tr>
	<tr>
		<td><span class="tl_label"><?php echo $this->progressLabel; ?>:</span></td>
		<td><?php echo $this->progress; ?>%</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2" class="tl_box"><h2><?php echo $this->lastUpdateLabel; ?></h2></td>
	</tr>
	<tr>
		<td><span class="tl_label"><?php echo $this->lastUpdateUserLabel; ?>:</span></td>
		<td><?php echo $this->lastUpdateUser; ?></td>
	</tr>
	<tr>
		<td><span class="tl_label"><?php echo $this->lastUpdateTimeLabel; ?>:</span></td>
		<td><?php echo $this->lastUpdateTime; ?></td>
	</tr>
	<tr>
		<td colspan="2"><span class="tl_label"><?php echo $this->lastUpdateCommentLabel; ?>:</span></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo $this->lastUpdateComment; ?></td>
	</tr>
</table>
<table cellpadding="0" cellspacing="0" summary="" class="tl_history block tl_show">
	<tr>
		<td colspan="5" class="tl_box"><h2><?php echo $this->historyLabel; ?></h2></td>
	</tr>
<?php foreach ($this->history as $row): ?>
    <tr class="odd">
      <td class="<?php echo $row['class']; ?>"><strong><?php echo $this->dateLabel; ?>:</strong> <?php echo $row['date']; ?></td>
      <td class="<?php echo $row['class']; ?>"><strong><?php echo $this->createdByLabel; ?>:</strong>  <?php echo $row['commentBy']; ?></td>
      <td class="<?php echo $row['class']; ?>"><strong><?php echo $this->assignedToLabel; ?>:</strong>  <?php echo $row['name']; ?></td>
      <td class="<?php echo $row['class']; ?>"><strong><?php echo $this->statusLabel; ?>:</strong>  <?php echo $row['status']; ?></td>
      <td class="<?php echo $row['class']; ?>"><strong><?php echo $this->progressLabel; ?>:</strong>  <?php echo $row['progress']; ?>%</td>
    </tr>
    <tr class="even">
      <td class="<?php echo $row['class']; ?>" colspan="5"><?php echo $row['comment']; ?></td>
    </tr>
<?php endforeach; ?>
</table>