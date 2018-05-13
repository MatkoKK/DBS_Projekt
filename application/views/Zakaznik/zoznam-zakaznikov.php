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
        <h1>Zákazníci</h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default ">
                <div class="panel-heading">PridajZakaznika <a href="<?php echo site_url('zakaznik/pridaj_zakaznika/'); ?>" class="glyphicon glyphicon-plus pull-right" ></a></div>
                <table class="table table-striped">
                    <thead>
                    <tr>

                        <th width="30%">Meno</th>
                        <th width="20%">Priezvisko</th>
                        <th width="35%">ICO</th>
                        <th width="10%">firma?</th>


                    </tr>
                    </thead>
                    <tbody id="userData">
                    <?php if(!empty($zakaznici)): foreach($zakaznici as $zakaznik): ?>
                        <tr>
                            <td><?php echo $zakaznik['Firma_Meno']; ?></td>
                            <td><?php echo $zakaznik['firma_priezvisko']; ?></td>
                            <td><?php if($zakaznik['ICO']=='0')echo "súkromná osoba" ; else echo $zakaznik['ICO']; ?></td>
                            <td><?php if($zakaznik['JeFirma']==1) echo "firma"; else echo "sukromná osoba"; ?></td>
                            <td><a href="<?php echo site_url('zakaznik/edit'."/?id=".$zakaznik['idZakaznik']); ?>" class="glyphicon glyphicon-plus pull-right" ></a></td>
                            <td><a href="<?php echo site_url('zakaznik/LektorKurz'."/?id=".$zakaznik['idZakaznik']); ?>" class="glyphicon glyphicon-plus pull-right" ></a></td>
                            <td><a href="<?php echo site_url('zakaznik/OdstranZakaznika'."/?id=".$zakaznik['idZakaznik']); ?>" class="glyphicon glyphicon-plus pull-right" ></a></td>
                            <td><a href="<?php echo site_url('zakaznik/kupaKurzu'."/?id=".$zakaznik['idZakaznik']); ?>" class="glyphicon glyphicon-plus pull-right" ></a></td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="4">Žiadny zákazík</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>