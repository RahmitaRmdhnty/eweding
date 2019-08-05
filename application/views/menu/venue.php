<div class="content">
    <br><br><br><br>
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Venue </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th> No </th>
                                <th> Store Name </th>
                                <th> Location </th>
                                <th> Price </th>
                                <th> Action </th>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($hasil as $d) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $no++ ?></th>
                                        <td><?php echo $d->nama ?></td>
                                        <td><?php echo $d->alamat ?></td>
                                        <td><?php echo $d->harga ?></td>
                                        <td><button>Details</button></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>