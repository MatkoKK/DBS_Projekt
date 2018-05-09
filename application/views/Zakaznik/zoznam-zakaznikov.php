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
        <h1>List kurzov</h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default ">
                <div class="panel-heading">Kurzy <a href="<?php echo site_url('Lektor/PridajLektora/'); ?>" class="glyphicon glyphicon-plus pull-right" ></a></div>
                <div class="panel-heading">PridajZakaznika <a href="<?php echo site_url('zakaznik/pridaj_zakaznika/'); ?>" class="glyphicon glyphicon-plus pull-right" ></a></div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="30%">Meno</th>
                        <th width="20%">Priezvisko</th>
                        <th width="35%">ICO</th>
                        <th width="10%">firma?</th>


                    </tr>
                    </thead>
                    <tbody id="userData">
                    <?php if(!empty($zakaznici)): foreach($zakaznici as $zakaznik): ?>
                        <tr>
                            <td><?php echo '#'.$zakaznik['idZakaznik']; ?></td>
                            <td><?php echo $zakaznik['firma_meno']; ?></td>
                            <td><?php echo $zakaznik['priezvisko']; ?></td>
                            <td><?php echo $zakaznik['ICO']; ?></td>
                            <td><?php if($zakaznik['JeFirma']==1) echo "firma"; else echo "sukromná osoba"; ?></td>
                            <td><a href="<?php echo site_url('lektor/LektorKurz'."/?id=".$zakaznik['idZakaznik']); ?>" class="glyphicon glyphicon-plus pull-right" ></a></td>
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