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
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <label class="hidden-md hidden-lg">No Connote</label>
                                                <input name="connote" type="text" class="form-control border-input text-uppercase" placeholder="No Connote Anda" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-1" hidden>
                                            <div class="form-group">
                                                <input name="m" type="text" value="1" hidden>
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
            

<?php if(isset($_GET['connote'])) 
{
    //Status Connote
    $url = $api."?mode=statusconnote&connote=".$_GET['connote']."";	
	$data = json_decode(curl_get_contents($url));
    
	if (!empty($data))
    {
        if ($data->{'status'} == "success")
        {
            echo '<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 col-md-6">
                        <div class="card card-user">
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <h5 class="text-center">Data Connote</h5>
                                    </thead>
                                    <tbody>
                                        <tr><td>No Connote</td> <td>: '.$data->results[0]->{'Connote'}.'</td></tr>
                                        <tr><td>Referensi ID</td> <td>: '.$data->results[0]->{'ReferensiID'}.'</td></tr>
                                        <tr><td>Origin</td> <td>: '.$data->results[0]->{'Origin'}.'</td></tr>
                                        <tr><td>Daerah Tujuan</td> <td>: '.$data->results[0]->{'Destinasi'}.'</td></tr>
                                        <tr><td>Kel. / Kab. Tujuan</td> <td>: '.$data->results[0]->{'Tujuan'}.'</td></tr>
                                        <tr><td>Produk / Service</td> <td>: '.$data->results[0]->{'Produk'}.'</td></tr>
                                        <tr><td>No Polis</td> <td>: '.$data->results[0]->{'No Polis'}.'</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-1">
                                        <h5>Status</h5>
                                    </div>
                                    <div class="col-md-6 col-md-offset-1">
                                        <h5 class="'.(($data->results[0]->{'Status Delivery'}=="DELIVERED")?"text-success":"text-danger").'">'.$data->results[0]->{'Status Delivery'}.'</h5>
                                    </div>
                                </div>
                            </div>
                        </div>';

                        //POD Connote
                        $urlpod = $api."?mode=pod&connote=".$data->results[0]->{'Connote'}."";	
                    	$datapod = json_decode(curl_get_contents($urlpod));
                        if (!empty($datapod))
                        {
                            if ($datapod->{'status'} == "success")
                            {
                                $date = date_create($datapod->results[0]->{'Tanggal Upload'});
                                echo '<div class="card card-user">
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <h5 class="text-center">Data POD</h5>
                                    </thead>
                                    <tbody>
                                        <tr><td>Tanggal upload</td> <td>: '.date_format($date,"d-m-Y, H:i").'</td></tr>
                                        <tr><td>Ukuran gambar</td> <td>: '.formatBytes($datapod->results[0]->{'Filesize'}).'</td></tr>
                                        <tr><td>Di upload oleh</td> <td>: '.$datapod->results[0]->{'Username'}.'</td></tr>
                                        '.(($datapod->results[0]->{'Koordinat'} == '0, 0')?'':'<tr><td>Posisi kurir</td> <td>: <a href="https://www.google.co.id/maps?source=tldsi&hl=id&q='.$datapod->results[0]->{'Koordinat'}.'" target="_blank" alt="'.$datapod->results[0]->{'Koordinat'}.'">'.$datapod->results[0]->{'Koordinat'}.'</a></td></tr>').'
                                    </tbody>
                                </table>
                                <hr>
                                <div class="well well-sm">
                                    <img class="img-responsive center-block" src="'.$datapod->results[0]->{'Filepath'}.'" alt="POD CONNOTE '.$_GET['connote'].'"/>
                                </div>
                            </div>
                        </div>';
                            }
                        }
                        
                    echo '</div>

                    <div class="col-lg-7 col-md-6">
                        <div class="card">
                            
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                        <h5 class="text-center">Histori Kiriman Anda</h5>
                                    </thead>
                                    <tbody>';

            foreach ($data->results as $name => $value) 
	        {
                echo '<tr>';
                echo '<td ><i class="ti-angle-double-right"></i></td>';
                echo '<td >' .$value->{'Waktu'}.'<br>'. $value->{'Status Kiriman'} .'</td>';
                echo '</tr>';   
            }
            echo '</tbody>
                    </table>
                </div>
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
                