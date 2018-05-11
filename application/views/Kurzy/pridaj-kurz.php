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
                            <label for="title">nazov_kurzu</label>
                            <input type="text" class="form-control" name="nazov_kurzu" id="nazov_kurzu" placeholder="Zadaj názov kurzu" value="<?php echo !empty($post['Nazov'])?$post['Nazov']:''; ?>">
                            <?php echo form_error('nazov_kurzu','<p class="help-block text-danger">','</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="title">Obtiaznosť</label>
                            <input type="text" class="form-control" name="level" placeholder="Zadaj obtiažnosť" value="<?php echo !empty($post['Level'])?$post['Level']:''; ?>">
                            <?php echo form_error('level','<p class="help-block text-danger">','</p>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="title">Cena</label>
                            <input type="text" class="form-control" name="cena" placeholder="Zadaj cenu" value="<?php echo !empty($post['Cena'])?$post['Cena']:''; ?>">
                            <?php echo form_error('sky','<p class="help-block text-danger">','</p>'); ?>
                        </div>


                        <input type="submit" name="postSubmit" class="btn btn-primary" value="Submit"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>