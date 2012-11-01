<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2011 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$L['message_limit'] = '今日可發送{V0}次 當前已發送{V1}次';
$L['com_not_member'] = '無法完成操作，該企業未註冊本站會員';
$L['send_self'] = '請不要給自己留言';
$L['price_self'] = '請不要給自己報價';
$L['inquiry_self'] = '請不要給自己詢價';
$L['buy_self'] = '您不能購買自己的商品';
$L['has_expired'] = '此信息已過期';

$L['msg_type_title'] = '請填寫主題';
$L['msg_type_content'] = '請填寫內容';
$L['msg_type_truename'] = '請填寫聯繫人';
$L['msg_type_email'] = '請填寫正確的電子郵件';
$L['msg_type_telephone'] = '請填寫聯繫電話';
$L['msg_type_address'] = '請填寫聯繫地址';
$L['msg_type_postcode'] = '請填寫郵政編碼';
$L['msg_type_mobile'] = '請填寫手機號碼';
$L['msg_type_express'] = '請填寫期望物流';

$L['msg_message_success'] = '留言發送成功';
$L['msg_member_failed'] = '留言發送失敗，對方可能拒絕您的留言';
$L['msg_guest_failed'] = '留言發送失敗，對方可能拒絕非會員的留言';
$L['msg_price_success'] = '報價單發送成功';
$L['msg_price_member_failed'] = '報價發送失敗，對方可能拒絕您的報價';
$L['msg_price_guest_failed'] = '報價發送失敗，對方可能拒絕非會員的報價';
$L['msg_home_success'] = '提交成功';
$L['msg_home_member_failed'] = '提交失敗，對方可能拒絕您的信息';
$L['msg_home_guest_failed'] = '提交失敗，對方可能拒絕非會員的信息';
$L['content_truename'] = '聯繫人：';
$L['content_email'] = '電子郵件：';
$L['content_company'] = '公司名：';
$L['content_telephone'] = '聯繫電話：';
$L['content_qq'] = '聯繫QQ：';
$L['content_msn'] = '聯繫MSN：';
$L['content_ali'] = '阿里旺旺：';
$L['content_skype'] = '聯繫Skype：';
$L['content_type'] = '我想瞭解的產品信息有：';
$L['content_from'] = '(信息來自公司主頁)';
$L['content_date'] = '我希望在 {V0} 之前回復';
/* buy/price.inc.php */
$L['content_product'] = '產品信息：';
$L['price_message_title'] = '我對您發佈的「{V0}」很感興趣';
$L['price_head_title'] = '報價單';
/* info/message.inc.php */
$L['content_info'] = '信息地址：';
$L['info_message_title'] = '我對您發佈的「{V0}」很感興趣';
$L['info_head_title'] = '留言信息';
/* brand/message.inc.php */
$L['content_brand'] = '產品品牌：';
$L['brand_message_title'] = '願加盟「{V0}」品牌';
$L['brand_head_title'] = '留言加盟';
/* sell/inquiry.inc.php */
$L['inquiry_result'] = '共發送{V0}條，成功{V1}條';
$L['inquiry_no_info'] = '信息不存在或者發佈人未註冊';
$L['inquiry_message_title'] = '我對您發佈的「{V0}」很感興趣';
$L['inquiry_head_title'] = '詢價單';
$L['inquiry_message_title_multi'] = '我對您在「{V0}」發佈的信息很感興趣';
$L['inquiry_head_title_multi'] = '批量詢價';
$L['inquiry_itemid'] = '請指定需要詢價的信息';
$L['inquiry_limit'] = '最多可選擇 {V0} 條信息';
/* sell/order.inc.php */
$L['order_condition'] = '此信息未設置價格或計量單位或起訂量，無法在線訂購';
$L['order_self'] = '請不要給自己的信息下單';
$L['order_guest'] = '該企業未註冊本站會員，無法收到訂單';
$L['order_type_amount'] = '請填寫訂貨總量';
$L['order_min_amount'] = '訂貨總量不能小於最小起訂量';
$L['order_max_amount'] = '訂貨總量不能大於供貨總量';
$L['order_confirm'] = '確認訂單';
$L['order_goods'] = '訂購產品';
/* job/apply.inc.php */
$L['apply_self'] = '您不能向自己公司投遞簡歷';
$L['apply_again'] = '您已經向此職位投遞過簡歷';
$L['apply_title'] = '投遞簡歷';
$L['apply_msg_title'] = '您的招聘[{V0}]收到新的簡歷';
$L['apply_msg_content'] = '詳見:<a href="{V0}" target="_blank">{V0}</a>';
$L['apply_success'] = '簡歷投遞成功';
$L['make_resume'] = '請先創建簡歷';
$L['not_resume'] = '簡歷不存在';
/* konw/answer.inc.php */
$L['vote_end'] = '投票已經結束';
$L['vote_answer'] = '問題投票';
$L['vote_reject'] = '您已經投過票或無權投票';
$L['min_answer'] = '至少需要保留兩個答案';
$L['record_reward'] = '[{V0}]最佳答案懸賞';
$L['record_best'] = '[{V0}]最佳答案獎勵';
$L['record_thank'] = '[{V0}]最佳答案感謝';
$L['record_addto'] = '[{V0}]追加懸賞';
$L['record_expired'] = '[{V0}]問題過期';
$L['select_credit'] = '請選擇'.$DT['credit_name'];
$L['lack_credit'] = $DT['credit_name'].'不足';
$L['type_answer'] = '請填寫答案';
$L['answer_question'] = '回答問題';
$L['answer_msg_title'] = '您的提問[{V0}]收到新的回答';
$L['answer_msg_content'] = '<strong>問</strong>:{V0}<br/><strong>答</strong>:{V1}<br/>詳見:<a href="{V2}" target="_blank">{V2}</a><br/>如果回答沒有顯示出來，可能需要系統審核後顯示';
$L['answer_check'] = '回答成功，請等待審核';
$L['expired_msg_title'] = '您的提問[{V0}]即將到期，請及時處理';
$L['expired_msg_content'] = '詳見:<a href="{V0}" target="_blank">{V0}</a>';
$L['sms_inquiry'] = '詢盤';
$L['sms_price'] = '報價';
$L['sms_message'] = '留言';
/* mall/cart.inc.php */
$L['cart_title'] = '購物車';
/* mall|group/buy.inc.php */
$L['buy_title'] = '提交訂單';
$L['msg_buy_success'] = '訂單提交成功';
/* group/buy.inc.php*/
$L['group_expired'] = '團購已結束';
$L['in_site'] = '站內';
$L['group_order_credit'] = '團購訂單';
$L['need_charge'] = '餘額不足，請充值';
?>