<div class="container">
    <div class="row"><br></div>
    <div class="col-xs-12">
        <?php
        if(!empty($success_msg)){
            echo '<div class="alert alert-success">'.$success_msg.'</div>';
        }elseif(!empty($error_msg)){
            echo '<div class="alert alert-danger">'.$error_msg.'</div>';
        }
        ?>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $action; ?> Temperature <a href="<?php echo site_url('temperatures/'); ?>" class="glyphicon glyphicon-arrow-left pull-right"></a></div>
                <div class="panel-body">
                    <form method="post" action="" class="form">
                        <div class="form-group">
                            <label for="title">Meno /názov firmy</label>
                            <input type="text" class="form-control" name="meno" id="meno" placeholder="Meno/nazov firmy" value="<?php echo !empty($post['meno'])?$post['meno']:''; ?>">
                            <?php echo form_error('measurement_date','<p class="help-block text-danger">','</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="title">priezvisko</label>
                            <input type="text" class="form-control" name="priezvisko" placeholder="priezvisko" value="<?php echo !empty($post['priezvisko'])?$post['priezvisko']:''; ?>">
                            <?php echo form_error('priezvisko','<p class="help-block text-danger">','</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="title">ICO</label>
                            <input type="text" class="form-control" name="ico" placeholder="Zadaj ico" value="<?php echo !empty($post['ico'])?$post['ico']:''; ?>">
                            <?php echo form_error('ico','<p class="help-block text-danger">','</p>'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_checkbox('jefirma', 1, false); ?>
                        </div>
                        <input type="submit" name="postSubmit" class="btn btn-primary" value="Submit"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>