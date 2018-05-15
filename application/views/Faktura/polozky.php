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
                        <th width="5%">Kurz</th>
                        <th width="30%">Level</th>
                        <th width="30%">cena</th>



                    </tr>
                    </thead>
                    <tbody id="userData">
                    <?php if(!empty($polozky)): foreach($polozky as $polozka): ?>
                        <tr>
                            <td><?php echo $polozka['nazov']; ?></td>
                            <td><?php echo $polozka['lvl']; ?></td>
                            <td><?php echo $polozka['cena']; ?></td>
                            <td><a href="<?php echo site_url('faktura/OdstranKurz'."/?id=".$polozka['idcko']."&idfaktura=".$polozka['idfaktura']); ?>" class="glyphicon glyphicon-eye-open pull-right" ></a></td>

                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="4">Faktúra nemá žiadne kurzy</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>