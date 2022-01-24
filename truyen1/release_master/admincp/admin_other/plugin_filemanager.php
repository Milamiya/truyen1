<?php
include '../system/perm.php';
$plugin = 1;
include '../includes/header.php';
?>
<title>Plugin/TinyFileManager - <?php echo $titlecp; ?></title>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>PLUGIN</h2>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            File Manager
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="/">Trở về</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="mainIFRAME">
                            <iframe name="content" frameborder="no" scrolling="no" src="https://sv11.zutafsmanagementpanel.gq/fztcp_plugin/filemanager/?fztcp_plugin&fztcp_plugin_user=fztcp&fztcp_plugin_pass=ZUTAfansub2020VN_fztcp_plugin_v3" width="100%" height="750px">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="/js/kuri_uploader.js"></script>
<?php
include '../includes/footer.php'; ?>