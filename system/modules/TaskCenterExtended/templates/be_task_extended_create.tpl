
<div id="tl_buttons">
<a href="contao/main.php?do=tasks" class="header_back" title="<?php echo $this->goBack; ?>" accesskey="b" onclick="Backend.getScrollOffset();"><?php echo $this->goBack; ?></a>
</div>

<h2 class="sub_headline"><?php echo $this->headline; ?></h2>

<form action="<?php echo $this->request; ?>" id="tl_tasks" class="tl_form" method="post">
<div class="tl_formbody_edit">
<input type="hidden" name="FORM_SUBMIT" value="tl_tasks" />

<div class="tl_tbox block">
  <h3><?php echo $this->project->generateLabel(); ?></h3>
  <?php echo $this->project->generateWithError(); if ($this->project->help): ?> 
  <p class="tl_help"><?php echo $this->project->help; ?></p><?php endif; ?> 
</div>

<div class="tl_box block">
  <h3><?php echo $this->title->generateLabel(); ?></h3>
  <?php echo $this->title->generateWithError(); if ($this->title->help): ?> 
  <p class="tl_help"><?php echo $this->title->help; ?></p><?php endif; ?> 

  <h3><?php echo $this->deadline->generateLabel(); ?></h3>
  <?php echo $this->deadline->generateWithError(); if ($this->deadline->help): ?> 
  <p class="tl_help"><?php echo $this->deadline->help; ?></p><?php endif; ?> 
  <script type="text/javascript">
  <!--//--><![CDATA[//><!--
  window.addEvent('domready', function() { <?php echo $this->deadline->datepicker; ?> });
  //--><!]]>
  </script>
</div>

<div class="tl_box block">
  <h3><?php echo $this->tasktype->generateLabel(); ?></h3>
  <?php echo $this->tasktype->generateWithError(); if ($this->tasktype->help): ?> 
  <p class="tl_help"><?php echo $this->tasktype->help; ?></p><?php endif; ?> 

  <h3><?php echo $this->priority->generateLabel(); ?></h3>
  <?php echo $this->priority->generateWithError(); if ($this->priority->help): ?> 
  <p class="tl_help"><?php echo $this->priority->help; ?></p><?php endif; ?> 
</div>

<div class="tl_box block">
  <h3><?php echo $this->assignedTo->generateLabel(); ?></h3>
  <?php echo $this->assignedTo->generateWithError(); if ($this->assignedTo->help): ?> 
  <p class="tl_help"><?php echo $this->assignedTo->help; ?></p><?php endif; ?> 

  <?php echo $this->notify->generateWithError(); if ($this->notify->help): ?> 
  <p class="tl_help"><?php echo $this->notify->help; ?></p><?php endif; ?> 
</div>

<div class="tl_box block">
  <h3><?php echo $this->comment->generateLabel(); ?></h3>
  <?php echo $this->comment->generateWithError(); if ($this->comment->help): ?> 
  <p class="tl_help"><?php echo $this->comment->help; ?></p><?php endif; ?> 
</div>

</div>

<div class="tl_formbody_submit">

<div class="tl_submit_container">
<input type="submit" name="save" id="save" class="tl_submit" accesskey="s" value="<?php echo $this->submit; ?>" />
<input type="submit" name="saveAndEdit" id="saveAndEdit" class="tl_submit" accesskey="e" value="<?php echo $this->submitAndEdit; ?>" />
<input type="submit" name="saveAndNew" id="saveAndNew" class="tl_submit" accesskey="n" value="<?php echo $this->submitAndNew; ?>" />
</div>

</div>
</form>
