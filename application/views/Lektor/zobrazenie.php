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
        <h1>Zoznam všetkých lektorov</h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default ">
                <div class="panel-heading">Pridaj lektora <a href="<?php echo site_url('Lektor/PridajLektora/'); ?>" class="glyphicon glyphicon-plus pull-right" ></a></div>
                <table class="table table-striped">
                    <thead>
                    <tr>

                        <th width="30%">Meno</th>
                        <th width="20%">Priezvisko</th>


                    </tr>
                    </thead>
                    <tbody id="userData">
                    <?php if(!empty($lektors)): foreach($lektors as $lektor): ?>
                        <tr>

                            <td><?php echo $lektor->Meno; ?></td>
                            <td><?php echo $lektor->Priezvisko; ?></td>
                            <td><a href="<?php echo site_url('lektor/LektorKurz'."/?id=".$lektor->idLektor); ?>" class="glyphicon glyphicon-eye-open pull-right" ></a></td>
                            <td><a href="<?php echo site_url('lektor/edit'."/?id=".$lektor->idLektor); ?>" class="glyphicon glyphicon-pencil pull-right" ></a></td>
                            <td><a href="<?php echo site_url('lektor/OdstranLektora'."/?id=".$lektor->idLektor); ?>" class="glyphicon glyphicon-remove pull-right" ></a></td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="4">Žiadny lektor na zobrazenie</td></tr>
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