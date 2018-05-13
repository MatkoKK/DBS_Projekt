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
                <div class="panel-heading"><?php echo $action; ?> Kupa kurzu <a href="<?php echo site_url('zakaznik/'); ?>" class="glyphicon glyphicon-arrow-left pull-right"></a></div>
                <div class="panel-body">
                    <form method="post" action="" class="form">

                        <form method="post" action="" class="form">
                            <div class="form-group">
                                <?php echo form_label('kurz'); ?>
                                <?php echo form_dropdown('idkurz', $kurzy, $kurzOznaceny, 'name="idkurz" class="form-control"'); ?>
                            </div>
                        <form method="post" action="" class="form">
                            <div class="form-group">
                                <?php echo form_label('Faktura'); ?>
                                <?php echo form_dropdown('idfaktura', $faktury, $novaFaktura, 'name="idfaktura" class="form-control"'); ?>
                            </div>
                        <input type="submit" name="postSubmit" class="btn btn-primary" value="Submit"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>