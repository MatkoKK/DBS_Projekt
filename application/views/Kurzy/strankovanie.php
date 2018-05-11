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
        <h1>List of Temperatures</h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default ">
                <div class="panel-heading">Temperatures <a href="<?php echo site_url('temperatures/add/'); ?>" class="glyphicon glyphicon-plus pull-right" ></a></div>
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

                            <td>
                                <a href="<?php echo site_url('temperatures/view/'.$kurz->idKurzy); ?>" class="glyphicon glyphicon-eye-open"></a>
                                <a href="<?php echo site_url('temperatures/edit/'.$kurz->idKurzy); ?>" class="glyphicon glyphicon-edit"></a>
                                <a href="<?php echo site_url('temperatures/delete/'.$kurz->idKurzy); ?>" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete?')"></a>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="4">Temperature(s) not found......</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div id="pagination" style="align-content: center">
                <ul class="pagination">
                    <!-- Show pagination links -->
                    <?php foreach ($links as $link) {
                        echo "<li class=\"page-item\">". $link."</li>";
                    } ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div class="panel panel-default ">
                <div class="panel-heading">Records per user</div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Count</th>
                    </tr>
                    </thead>
                    <tbody id="userData">
                    <?php foreach($records_per_user->result() as $row):;?>
                        <tr>
                            <td><?php echo $row->idLektor;?></td>
                            <td><?php echo $row->Meno;?></td>
                            <td><?php echo $row->Priezvisko;?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="panel panel-default ">
                <div class="panel-heading">Records per user - chart</div>
                <p><?php //echo $json_records_per_user;?></p>
                <div id="chart_div"></div>
            </div>
        </div>
    </div>
</div>