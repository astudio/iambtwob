<?php
defined('IN_DESTOON') or exit('Access Denied');
$one = (isset($one) && $one) ? 1 : 0;
if(isset($all)) {
	if($one) dheader('?file=html&action=back&mid='.$moduleid);
	msg('擴展功能更新成功');
} else {
	#spread->ad->announce->webpage->vote
	msg('正在開始更新擴展', '?moduleid=3&file=spread&action=html&all=1&one='.$one);
}
?>