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
                                        <div class="col-md-4">
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
                                                                    echo '<option value="'.$orivalue.'" '.((!empty($_GET['origin']))?(($orivalue==$_GET['origin'])?'selected':''):'').'>'.$orivalue.'</option>';
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="hidden-md hidden-lg">Destinasi</label>
                                                <select name="destinasi" type="text" class="form-control border-input text-uppercase" placeholder="Destinasi" value="" required>
                                                    <?php 
                                                        $dest = $api."?mode=destinasicompletion&term=";	
                                                    	$destdata = json_decode(curl_get_contents($dest));
                                                        if (!empty($destdata))
                                                        {
                                                            if ($destdata->{'status'} == "success")
                                                            {
                                                                foreach ($destdata->results as $destname => $destvalue) 
                                                                {
                                                                    echo '<option value="'.$destvalue.'" '.((!empty($_GET['destinasi']))?(($destvalue==$_GET['destinasi'])?'selected':''):'').'>'.$destvalue.'</option>';
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
                                                <input name="m" type="text" value="2" hidden>
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
    $url = $api."?mode=tarif&origin=".urlencode($_GET['origin'])."&destinasi=".urlencode($_GET['destinasi'])."&weight=".$_GET['weight']."";	
	$data = json_decode(curl_get_contents($url));
	if (!empty($data))
    {
        if ($data->{'status'} == "success")
        {
            echo '<div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title text-uppercase">Tarif Origin: '.$_GET['origin'].', Destinasi: '.$_GET['destinasi'].'</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <th>No</th>
                                    	<th>Produk</th>
                                        <th>Kota Asal</th>
                                    	<th>Kabupaten / Kota</th>
                                        <th>Kelurahan Tujuan</th>
                                        <th>Berat</th>
                                        <th>Biaya Kirim</th>
                                    	<th>Estimasi</th>
                                    </thead>
                                    <tbody>';
            $n=1;
            foreach ($data->results as $name => $value) 
	        {
                echo '<tr>';
                echo '<td>' . $n++ .'</td>';
                echo '<td>' . $value->{'Produk'} .'</td>';
                echo '<td>' . $value->{'Kota Asal'} .'</td>';
			    echo '<td>' . $value->{'Kabupaten / Kota'} .'</td>';
    			echo '<td>' . $value->{'Daerah Tujuan'} .'</td>';
                echo '<td>' . $_GET['weight'] .'</td>';
            	echo '<td>' . $value->{'Biaya_Kirim'} .'</td>';
        	    echo '<td>' . $value->{'Estimasi'} .'</td>';
	    		echo '</tr>';              
            }
            echo '</tbody>';
            echo '</table>
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