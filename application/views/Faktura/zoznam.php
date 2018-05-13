<div class="container">
    <?php if(!empty($success_msg)){ ?>
        <div class="col-xs-12">
            <div class="alert alert-success"><?php echo $success_msg; ?></div>
        </div>
    <?php }elseif(!empty($error_msg)){ ?>
        <div class="col-xs-12">
            <div class="alert alert-danger"><?php echo $error_msg; ?></div>
        </div>
    <?php } ?>
    <div class="row">
        <h1>Faktúry</h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default ">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="30%">Zakaznik</th>
                        <th width="20%">Datum</th>


                    </tr>
                    </thead>
                    <tbody id="userData">
                    <?php if(!empty($faktury)): foreach($faktury as $faktura): ?>
                        <tr>
                            <td><?php echo '#'.$faktura['id']; ?></td>
                            <td><?php echo $faktura['meno']; ?></td>
                            <td><?php echo $faktura['datum']; ?></td>
                            <td><a href="<?php echo site_url('faktura/VratPolozky'."/?id=".$faktura['id']); ?>" class="glyphicon glyphicon-plus pull-right" ></a></td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="4">No kurses</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>