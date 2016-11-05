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
                                                <input name="m" type="text" value="14" hidden>
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

<?php 

if(isset($_GET['connote'])) 
{
    include 'assets/lib/custom.php';
    $api = "https://api.tkd.co.id/v2/";
    $url = $api.'?mode=pod&connote='.$_GET['connote'];
    $data = json_decode(curl_get_contents($url));
    if (!empty($data))
    {
        if ($data->{'status'} == "success")
        {
            $date = date_create($data->results[0]->{'Tanggal Upload'});
            echo '<div class="col-md-12">
                        <div class="card card">
                            <div class="header">
                                
                                <table class="table table-striped">
                                    <thead>
                                        <h5>POD CONNOTE: '.$_GET['connote'].'</h5>
                                    </thead>
                                    <tbody>
                                        <tr><td>Tanggal upload</td> <td>: '.date_format($date,"d-m-Y, H:i").' WIB</td></tr>
                                        <tr><td>Ukuran gambar</td> <td>: '.formatBytes($data->results[0]->{'Filesize'}).'</td></tr>
                                        <tr><td>Di upload oleh</td> <td>: '.$data->results[0]->{'Username'}.'</td></tr>
                                        '.(($data->results[0]->{'Koordinat'} == '0, 0')?'':'<tr><td>Posisi kurir</td> <td>: <a href="https://www.google.co.id/maps?source=tldsi&hl=id&q='.$data->results[0]->{'Koordinat'}.'" target="_blank" alt="'.$data->results[0]->{'Koordinat'}.'">'.$data->results[0]->{'Koordinat'}.'</a></td></tr>').'
                                    </tbody>
                                </table>
                                
                                <hr>
                                <div class="well well-sm">
                                    <img class="img-responsive center-block" src="'.$data->results[0]->{'Filepath'}.'" alt="POD CONNOTE '.$_GET['connote'].'"/>
                                </div>
                                <div class="form-group text-center">
                                    <form method="get" action="'.$_SERVER['PHP_SELF'].'">
                                        <input name="m" type="text" value="1" hidden>
                                        <input name="connote" type="text" value="'.$_GET['connote'].'" hidden>
                                    </form>
                                </div>
                            </div>
                            <br>
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
            </div>
        </div>