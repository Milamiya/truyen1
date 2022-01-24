<?php
function get_server_memory_usage(){
	
	$free = shell_exec('free');
	$free = (string)trim($free);
	$free_arr = explode("\n", $free);
	$mem = explode(" ", $free_arr[1]);
	$mem = array_filter($mem);
	$mem = array_merge($mem);
	$memory_usage = $mem[2]/$mem[1]*100;

	return $memory_usage;
}
echo get_server_memory_usage()."<br>";
?>
<p>
<?php
// set partition
$fs = "/home/pgybseis";
// display available and used space
echo "Total available space on this partition: " . 
round(disk_total_space($fs) / (1024*1024)) . " MB\r\n<br />"; 
echo "Total free space: " . round(disk_free_space($fs) / (1024*1024)) . " MB\r\n<br />";
// calculate used space
$disk_used_space =
round((disk_total_space($fs) - disk_free_space($fs)) / (1024*1024)); 
echo "Total used space: " . $disk_used_space . " MB\r\n<br />";
// calculate % used space
echo "% used space: " . round((disk_total_space($fs) -
disk_free_space($fs)) / disk_total_space($fs) * 100) . " %";
?>
</p>