<div class="sidebar-wrapper">
            <div class="logo">
                <a href="https://report.tkd.co.id" class="simple-text">
                    Report<br>TKD Express
                </a>
                <div class="text-center">v.1.3.12</div>
            </div>

            <ul class="nav">
                <li <?php if (!empty($_GET['m'])) if($_GET['m']==1) echo 'class="active"';?> >
                    <a href="modul-cek-connote.php?m=1">
                        <i class="ti-search"></i>
                        <p>Check Connote</p>
                    </a>
                </li>
                <li <?php if (!empty($_GET['m'])) if($_GET['m']==2) echo 'class="active"';?> >
                    <a href="modul-cek-tarif.php?m=2">
                        <i class="ti-search"></i>
                        <p>Check Tarif</p>
                    </a>
                </li>
                <li <?php if (!empty($_GET['m'])) if($_GET['m']==3) echo 'class="active"';?> >
                    <a href="modul-pricelist.php?m=3">
                        <i class="ti-agenda"></i>
                        <p>Price List</p>
                    </a>
                </li>
                <li <?php if (!empty($_GET['m'])) if($_GET['m']==4) echo 'class="active"';?> >
                    <a href="modul-referensiid.php?m=4">
                        <i class="ti-medall"></i>
                        <p>Histori Referensi ID</p>
                    </a>
                </li>
                <li <?php if (!empty($_GET['m'])) if($_GET['m']==5) echo 'class="active"';?> >
                    <a href="modul-member.php?m=5">
                        <i class="ti-user"></i>
                        <p>Histori Member</p>
                    </a>
                </li>
                <li <?php if (!empty($_GET['m'])) if($_GET['m']==6) echo 'class="active"';?> >
                    <a href="modul-non-member.php?m=6">
                        <i class="ti-user"></i>
                        <p>Histori Non Member</p>
                    </a>
                </li>
                <li <?php if (!empty($_GET['m'])) if($_GET['m']==7) echo 'class="active"';?> >
                    <a href="modul-corporate.php?m=7">
                        <i class="ti-view-list-alt"></i>
                        <p>Histori Corp.</p>
                    </a>
                </li>
                <li <?php if (!empty($_GET['m'])) if($_GET['m']==8) echo 'class="active"';?> >
                    <a href="modul-corporate-user.php?m=8">
                        <i class="ti-view-list-alt"></i>
                        <p>Histori User Corp.</p>
                    </a>
                </li>
                <li <?php if (!empty($_GET['m'])) if($_GET['m']==9) echo 'class="active"';?> >
                    <a href="modul-invoice-corporate.php?m=9">
                        <i class="ti-receipt"></i>
                        <p>Invoice Corp.</p>
                    </a>
                </li>
                <li <?php if (!empty($_GET['m'])) if($_GET['m']==10) echo 'class="active"';?> >
                    <a href="modul-invoice-corporate-user.php?m=10">
                        <i class="ti-receipt"></i>
                        <p>Invoice User Corp.</p>
                    </a>
                </li>
                <li <?php if (!empty($_GET['m'])) if($_GET['m']==15) echo 'class="active"';?> >
                    <a href="modul-detail-invoice.php?m=15">
                        <i class="ti-receipt"></i>
                        <p>Detail Invoice</p>
                    </a>
                </li>
                <li <?php if (!empty($_GET['m'])) if($_GET['m']==11) echo 'class="active"';?> >
                    <a href="modul-po-corporate.php?m=11">
                        <i class="ti-truck"></i>
                        <p>PO Corporate</p>
                    </a>
                </li>
                <li <?php if (!empty($_GET['m'])) if($_GET['m']==12) echo 'class="active"';?> >
                    <a href="modul-po-corporate-user.php?m=12">
                        <i class="ti-truck"></i>
                        <p>PO User Corporate</p>
                    </a>
                </li>
                <li <?php if (!empty($_GET['m'])) if($_GET['m']==13) echo 'class="active"';?> >
                    <a href="modul-detail-po.php?m=13">
                        <i class="ti-truck"></i>
                        <p>Detail Pickup Order</p>
                    </a>
                </li>
				<li <?php if (!empty($_GET['m'])) if($_GET['m']==14) echo 'class="active"';?> >
                    <a href="modul-pod-kurir.php?m=14">
                        <i class="ti-image"></i>
                        <p>POD Kurir</p>
                    </a>
                </li>
            </ul>
    	</div>