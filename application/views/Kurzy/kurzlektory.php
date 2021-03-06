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
        <h1>Lektory v kurze</h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default ">
                <table class="table table-striped">
                    <thead>
                    <tr>

                        <th width="30%">Meno</th>
                        <th width="20%">Priezvisko</th>
                        <th width="30%">Kurz</th>

                    </tr>
                    </thead>
                    <tbody id="userData">
                    <?php if(!empty($kurzs)): foreach($kurzs as $kurz): ?>
                        <tr>

                            <td><?php echo $kurz['meno']; ?></td>
                            <td><?php echo $kurz['priezvisko']; ?></td>
                            <td><?php echo $kurz['kurz']; ?></td>
                            <td><a href="<?php echo site_url('kurzy/odstran_lektora'."/?id=".$kurz['idKurz']."&idRow=".$kurz['id']); ?>" class="glyphicon glyphicon-remove pull-right" ></a></td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="4">Tento kurz nemá zatiaľ žiadny lektor</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>