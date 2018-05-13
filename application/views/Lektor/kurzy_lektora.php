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
        <h1> <?php if(!empty($kurzs)){ $kurz=$kurzs[0];  echo "Kurzy lektora :". $kurz ['meno'] ." ". $kurz ['priezvisko'] ; } else echo"Lektor nemá žiadne kurzy"?></h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default ">

                <table class="table table-striped">
                    <thead>
                    <tr>


                        <th width="30%">Kurzy</th>

                    </tr>
                    </thead>
                    <tbody id="userData">
                    <?php if(!empty($kurzs)): foreach($kurzs as $kurz): ?>
                        <tr>

                            <td><?php echo $kurz['kurz']; ?></td>

                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="4">Žiadne priradené kurzy</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>