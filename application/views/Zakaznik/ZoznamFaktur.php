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
                        <th width="5%">Zakaznik</th>
                        <th width="30%">Datum</th>
                        <th width="20%">Kurzy</th>



                    </tr>
                    </thead>
                    <tbody id="userData">
                    <?php if(!empty($faktury)): foreach($faktury as $faktura): ?>
                                            <tr>
                                                <td><?php echo '#'.$faktura->cena; ?></td>
                                                <td><?php echo $faktura['datum']; ?></td>
                                                <td><?php echo $faktura['nazovKurz']; ?></td>
                                                <td><a href="<?php echo site_url('lektor/LektorKurz'."/?id=".$faktura['zmeno']); ?>" class="glyphicon glyphicon-plus pull-right" ></a></td>
                                                <td><a href="<?php echo site_url('zakaznik/LektorKurz'."/?id=".$faktura['zmeno']); ?>" class="glyphicon glyphicon-plus pull-right" ></a></td>
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