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
                <div class="panel-heading"><?php echo $action; ?> Kurzy <a href="<?php echo site_url('Kurzy/'); ?>" class="glyphicon glyphicon-arrow-left pull-right"></a></div>
                <div class="panel-body">
                    <form method="post" action="" class="form">
                        <div class="form-group">
                            <label for="title">Meno</label>
                            <input type="text" class="form-control" name="Meno" id="Meno" placeholder="Meno lektora" value="<?php echo !empty($post['Meno'])?$post['Meno']:''; ?>">
                            <?php echo form_error('meno','<p class="help-block text-danger">','</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="title">Priezvisko</label>
                            <input type="text" class="form-control" name="Priezvisko" placeholder="Priezvisko lektora" value="<?php echo !empty($post['Priezvisko'])?$post['Priezvisko']:''; ?>">
                            <?php echo form_error('Priezvisko','<p class="help-block text-danger">','</p>'); ?>
                        </div>



                        <input type="submit" name="postSubmit" class="btn btn-primary" value="Submit"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>