<?php
include 'assets/lib/custom.php'; 
$api = "https://api.tkd.co.id/v2/";
?>
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                    <div class="row">
                                    <form method="get" action="<?=$_SERVER['PHP_SELF']?>">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="hidden-md hidden-lg">Origin</label>
                                                <select name="origin"  style='max-height:200px; overflow-y:scroll; overflow-x:hidden;' class="form-control border-input" required>
                                                    <?php 
                                                        $ori = $api."?mode=origincompletion&term=";	
                                                    	$oridata = json_decode(curl_get_contents($ori));
                                                        if (!empty($oridata))
                                                        {
                                                            if ($oridata->{'status'} == "success")
                                                            {
                                                                foreach ($oridata->results as $oriname => $orivalue) 
                                                                {
                                                                    echo '<option value="'.$orivalue.'">'.$orivalue.'</option>';
                                                                }
                                                            }
                                                            else
                                                            {
                                                                echo '<option value="">Gagal mengambil data, silahkan reload halaman ini.</option>';
                                                            }
                                                        }
                                                        else
                                                        {
                                                            echo '<option value="">Gagal mengambil data, silahkan reload halaman ini.</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="hidden-md hidden-lg">Berat Kg</label>
                                                <input name="weight" type="text" class="form-control border-input text-uppercase" placeholder="Berat Kg" value="1" required>
                                            </div>
                                        </div>
                                        <div class="col-md-1" hidden>
                                            <div class="form-group">
                                                <input name="m" type="text" value="3" hidden>
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
                    

                    <?php if(isset($_GET['origin'])) 
{
    $url = $api."?mode=pricelist&origin=".urlencode($_GET['origin'])."&weight=".$_GET['weight']."&page=".$_GET['page']."&itemsperpage=".$_GET['itemsperpage']."";	
	$data = json_decode(curl_get_contents($url));
	if (!empty($data))
    {
        if ($data->{'status'} == "success")
        {
            echo '<div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title text-uppercase">Price List: '.$_GET['origin'].'</h4>
                                <p class="category">Menampilkan no. '.$data->metadata->{'number_item_first'}.' - '.$data->metadata->{'number_item_last'}.', dari total semua data: '.$data->metadata->{'records_total'}.'</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>No</th>
                                    	<th>Kota Asal</th>
                                    	<th>Kabupaten / Kota</th>
                                    	<th>Produk</th>
                                        <th>Biaya Terendah</th>
                                    	<th>Biaya Tertinggi</th>
                                    </thead>
                                    <tbody>';
            $n=$data->metadata->{'number_item_first'};
            foreach ($data->results as $name => $value) 
	        {
                echo '<tr>';
                echo '<td>' . $n++ .'</td>';
                echo '<td>' . $value->{'Kota Asal'} .'</td>';
			    echo '<td>' . $value->{'Kabupaten / Kota'} .'</td>';
    			echo '<td>' . $value->{'Produk'} .'</td>';
            	echo '<td>' . $value->{'Biaya Terendah'} .'</td>';
        	    echo '<td>' . $value->{'Biaya Tertinggi'} .'</td>';
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
                                            <a href="'.$_SERVER['PHP_SELF'].'?m=3&mode=pricelist&origin='.$_GET['origin'].'&weight='.$_GET['weight'].'&page='.($data->metadata->{'page_now'}-1).'&itemsperpage='.$_GET['itemsperpage'].'" ><i class="ti-arrow-left"></i> Sebelumnya</a>
                                    </div>
                                </div>';
                                if($data->metadata->{'page_total'} > 1)
                                {
                                    echo '<div class="col-md-'.(($data->metadata->{'page_now'}<2 || $data->metadata->{'page_now'}==$data->metadata->{'page_total'})?"10":"8").'">
                                    <div class="text-center">
                                        <form id="halamanpaginasi" method="get">
                                        <input name="m" type="text" value="3" hidden>
                                        <input name="mode" type="text" value="pricelist" hidden>
                                        <input name="origin" type="text" value="'.$_GET['origin'].'" hidden>
                                        <input name="weight" type="text" value="'.$_GET['weight'].'" hidden>
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
                                        <a href="'.$_SERVER['PHP_SELF'].'?m=3&mode=pricelist&origin='.$_GET['origin'].'&weight='.$_GET['weight'].'&page='.($data->metadata->{'page_now'}+1).'&itemsperpage='.$_GET['itemsperpage'].'" > Berikutnya <i class="ti-arrow-right"></i></a>
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