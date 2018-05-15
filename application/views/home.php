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
        <h1>Zoznam kurzov</h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default ">
                <div class="panel-heading">Pridať kurz<a href="<?php echo site_url('kurzy/add/'); ?>" class="glyphicon glyphicon-plus pull-right" ></a></div>
                <div class="panel-heading">PridajZakaznika <a href="<?php echo site_url('zakaznik/pridaj_zakaznika/'); ?>" class="glyphicon glyphicon-plus pull-right" ></a></div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="30%">Nazov</th>
                        <th width="20%">Level</th>
                        <th width="15%">Cena</th>

                    </tr>
                    </thead>
                    <tbody id="userData">
                    <?php if(!empty($kurzy)): foreach($kurzy as $kurz): ?>
                        <tr>
                            <td><?php echo '#'.$kurz->idKurzy; ?></td>
                            <td><?php echo $kurz->Nazov; ?></td>
                            <td><?php echo $kurz->Level; ?></td>
                            <td><?php echo $kurz->Cena;?></td>
                            <td><a href="<?php echo site_url('kurzy/pridaj_lektora'."/?id=".$kurz->idKurzy); ?>" class="glyphicon glyphicon-user pull-right" ></a></td>
                            <td><a href="<?php echo site_url('kurzy/edit'."/?id=".$kurz->idKurzy); ?>" class="glyphicon glyphicon-pencil pull-right" ></a></td>
                            <td><a href="<?php echo site_url('kurzy/KurzLektory'."/?id=".$kurz->idKurzy); ?>" class="glyphicon glyphicon-eye-open pull-right" ></a></td>
                            <td><a href="<?php echo site_url('kurzy/OdstranKurz'."/?id=".$kurz->idKurzy); ?>" class="glyphicon glyphicon-remove pull-right" ></a></td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="4">Žiadne kurzy</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <div id="pagination" style="align-content: center">
                    <ul class="pagination">
                        <!-- Show pagination links -->
                        <?php foreach ($links as $link) {
                            echo "<li class=\"page-item\">". $link."</li>";
                        } ?>
                </div>
            </div>
        </div>
    </div>
</div>