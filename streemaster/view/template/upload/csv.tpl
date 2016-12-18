<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
       
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" form="form-backup" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-exchange"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="" method="post" enctype="multipart/form-data" id="form-restore" class="form-horizontal">
          

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-import"><?php echo $entry_upload; ?></label>
            <div class="col-sm-10">
              <input type="file" name="import" id="input-import" />
            </div>
          </div>
          <div class="form-group">
             <label class="col-sm-2 control-label" for="input-status"> </label>
            <div class="col-sm-10">
              <input type="submit" name="submit" value="<?php echo $button_upload; ?>"> 
            </div>
          </div>
         
        </form>
        
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>