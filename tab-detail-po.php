<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                    <div class="row">
                                    <form method="get" action="<?=$_SERVER['PHP_SELF']?>">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label class="hidden-md hidden-lg">No Pickup Order</label>
                                                <input name="nopo" type="text" class="form-control border-input text-uppercase" placeholder="No Pickup Order" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-1" hidden>
                                            <div class="form-group">
                                                <input name="m" type="text" value="13" hidden>
                                                <input name="page" type="text"  value="1" hidden>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="hidden-md hidden-lg">Tampilkan</label>
                                                <select name="itemsperpage"  style='max-height:200px; overflow-y:scroll; overflow-x:hidden;' class="form-control border-input" required>
                                                    <option value="10">Default</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                    <option value="250">250</option>
                                                    <option value="500">500</option>
                                                    <option value="1000">1000</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-info btn-fill btn-wd">Show</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>

                    <?php if(isset($_GET['nopo'])) 
{
    include 'assets/lib/custom.php';
    $api = "https://api.tkd.co.id/v2/";
    $url = $api."?mode=detailpo&nopo=".$_GET['nopo']."&page=".$_GET['page']."&itemsperpage=".$_GET['itemsperpage']."";	
	$data = json_decode(curl_get_contents($url));
	if (!empty($data))
    {
        if ($data->{'status'} == "success")
        {
            echo '<div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title text-uppercase">No PO: '.$_GET['nopo'].'</h4>
                                <p class="category">Menampilkan no. '.$data->metadata->{'number_item_first'}.' - '.$data->metadata->{'number_item_last'}.', dari total semua data: '.$data->metadata->{'records_total'}.'</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>No</th>
                                    	<th>Tanggal Pickup</th>
                                    	<th>PIC Order</th>
                                    	<th>No Pickup Order</th>
                                        <th>Verifikasi</th>
                                    	<th>Connote</th>
                                    	<th>Nama Pengirim</th>
                                    	<th>Referensi ID</th>
                                    	<th>UP</th>
                                        <th>Nama Penerima</th>
                                    	<th>Deskripsi Barang</th>
                                    	<th>Produk</th>
                                    	<th>Kg</th>
                                        <th>Koli</th>
                                    	<th>Rate %</th>
                                    	<th>Total</th>
                                    	<th>Destinasi</th>
                                        <th>Tanggal Kirim</th>
                                    	<th>Status Delivery</th>
                                        <th>Diterima Oleh</th>
                                        <th>Tanggal POD</th>
                                        <th>Detail POD</th>
                                    </thead>
                                    <tbody>';
            $n=$data->metadata->{'number_item_first'};
            foreach ($data->results as $name => $value) 
	        {
                echo '<tr>';
                echo '<td>' . $n++ .'</td>';
                echo '<td>' . $value->{'Tanggal_Pickup'} .'</td>';
			    echo '<td>' . $value->{'PIC_Order'} .'</td>';
    			echo '<td>' . $value->{'No_Pickup_Order'} .'</td>';
            	echo '<td>' . $value->{'Verified_at'} .'</td>';
        	    echo '<td>' . $value->{'Connote'} .'</td>';
    			echo '<td>' . $value->{'Nama_Pengirim'} .'</td>';
                echo '<td>' . $value->{'ReferensiID'} .'</td>';
    			echo '<td>' . $value->{'UP'} .'</td>';
            	echo '<td>' . $value->{'Nama_Penerima'} .'</td>';
        	    echo '<td>' . $value->{'Deskripsi_Barang'} .'</td>';
    			echo '<td>' . $value->{'ProductID'} .'</td>';
                echo '<td>' . $value->{'Kg'} .'</td>';
                echo '<td>' . $value->{'Koli'} .'</td>';
                echo '<td>' . $value->{'Percent_Asuransi'} .'</td>';
                echo '<td>' . $value->{'Total_Biaya'} .'</td>';
                echo '<td>' . $value->{'Cabang Destinasi'} .'</td>';
                echo '<td>' . $value->{'Tanggal Kirim'} .'</td>';
                echo '<td>' . $value->{'Status Delivery'} .'</td>';
                echo '<td>' . $value->{'Diterima Oleh'} .'</td>';
                echo '<td>' . $value->{'Tanggal POD'} .'</td>';
                echo '<td>' . $value->{'Detail POD'} .'</td>';
	    		echo '</tr>';              
            }
            echo '</tbody>
                    </table>
                    </div>
                </div>
            </div>';

            //pagination
            echo '<div class="col-md-12">
                        <div class="card card-plain">
                            <div class="row">
                                <div class="col-md-2 text-center" '.(($data->metadata->{'page_now'}<2)?"hidden":"").'>
                                    <div class="btn btn-wd">
                                            <a href="'.$_SERVER['PHP_SELF'].'?m=13&mode=detailpo&nopo='.$_GET['nopo'].'&page='.($data->metadata->{'page_now'}-1).'&itemsperpage='.$_GET['itemsperpage'].'" ><i class="ti-arrow-left"></i> Sebelumnya</a>
                                    </div>
                                </div>';
                                if($data->metadata->{'page_total'} > 1)
                                {
                                    echo '<div class="col-md-'.(($data->metadata->{'page_now'}<2 || $data->metadata->{'page_now'}==$data->metadata->{'page_total'})?"10":"8").'">
                                    <div class="text-center">
                                        <form id="halamanpaginasi" method="get">
                                        <input name="m" type="text" value="13" hidden>
                                        <input name="mode" type="text" value="detailpo" hidden>
                                        <input name="nopo" type="text" value="'.$_GET['nopo'].'" hidden>
                                        <input name="itemsperpage" type="text" value="'.$_GET['itemsperpage'].'" hidden>
                                        <select name="page"  style="max-height:200px; overflow-y:scroll; overflow-x:hidden;" class="form-control border-input" onchange="change()" required>';
                                            for ($i=0;$i< $data->metadata->{'page_total'};$i++) 
                                            {
                                                echo '<option value="'.($i+1).'"'.(($i == $data->metadata->{'page_now'}-1)?'selected':'').'>Halaman: '.($i+1).'</option>';
                                            }
                                            echo '</select>
                                        </form>
                                        <script>function change(){document.getElementById("halamanpaginasi").submit();}</script>
                                   </div>
                                </div>';
                                }
                                echo '<div class="col-md-2 text-center" '.(($data->metadata->{'page_now'}>=$data->metadata->{'page_total'})?"hidden":"").'>
                                    <div class="btn btn-wd">
                                        <a href="'.$_SERVER['PHP_SELF'].'?m=13&mode=detailpo&nopo='.$_GET['nopo'].'&page='.($data->metadata->{'page_now'}+1).'&itemsperpage='.$_GET['itemsperpage'].'" > Berikutnya <i class="ti-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
        }
        else
        {
            echo '<div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title">Message: '.$data->{'message'}.'</h4>
                            </div>
                        </div>
                    </div>';
        } 
    }
}
                    ?>


                </div>