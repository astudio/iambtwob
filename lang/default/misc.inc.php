<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2011 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$L['message_limit'] = 'You can send {V0} times today, currently you have already sent {V1} times';
$L['com_not_member'] = 'The operation can not finished, the enterprise has not registered as our member yet.';
$L['send_self'] = 'Please don`t leave a message for yourself.';
$L['price_self'] = 'Please don`t quote yourself.';
$L['inquiry_self'] = 'Please don`t inquiry yourself.';
$L['buy_self'] = '您不能購買自己的商品';
$L['has_expired'] = 'The message has expired.';

$L['msg_type_title'] = 'Enter a title.';
$L['msg_type_content'] = 'Fill in content.';
$L['msg_type_truename'] = 'Enter a contact name.';
$L['msg_type_email'] = 'Enter a valid email address.';
$L['msg_type_telephone'] = 'Enter a telephone number.';
$L['msg_type_address'] = '請填寫聯繫地址';
$L['msg_type_postcode'] = '請填寫郵政編碼';
$L['msg_type_mobile'] = '請填寫手機號碼';
$L['msg_type_express'] = '請填寫期望物流';

$L['msg_message_success'] = 'Message delivered successfully.';
$L['msg_member_failed'] = 'Message deliverey failed, your message might be rejected.';
$L['msg_guest_failed'] = 'Message delivery failed, non-members\' messages might be rejected.';
$L['msg_price_success'] = 'Price list delivered successfully.';
$L['msg_price_member_failed'] = 'Price list delivery failed, your quote might be rejected.';
$L['msg_price_guest_failed'] = 'Price list delivery failed, non-members\' quote might be rejected.';
$L['msg_home_success'] = '提交成功';
$L['msg_home_member_failed'] = '提交失敗，對方可能拒絕您的信息';
$L['msg_home_guest_failed'] = '提交失敗，對方可能拒絕非會員的信息';
$L['content_truename'] = 'Contact: ';
$L['content_email'] = 'Email: ';
$L['content_company'] = 'Co. Name: ';
$L['content_telephone'] = 'TEL: ';
$L['content_qq'] = 'Contact QQ: ';
$L['content_msn'] = 'Contact MSN: ';
$L['content_ali'] = '阿里旺旺：';
$L['content_skype'] = 'Contact Skype: ';
$L['content_type'] = 'I need more details as below: ';
$L['content_from'] = '(Message comes from company homepage.)';
$L['content_date'] = 'I hope to be replied before {V0}';
/* buy/price.inc.php */
$L['content_product'] = 'Product information.：';
$L['price_message_title'] = 'I`m interested in your &ldquo;{V0}&rdquo;.';
$L['price_head_title'] = 'Price list.';
/* info/message.inc.php */
$L['content_info'] = 'Message address：';
$L['info_message_title'] = 'I`m interested in your &ldquo;{V0}&rdquo;.';
$L['info_head_title'] = 'Messages.';
/* brand/message.inc.php */
$L['content_brand'] = 'Product brand.：';
$L['brand_message_title'] = 'Wish to affiliate「{V0}」brand.';
$L['brand_head_title'] = 'Leave a message to affiliate.';
/* sell/inquiry.inc.php */
$L['inquiry_result'] = 'Delivered {V0} items in total, {V1} items succeeded.';
$L['inquiry_no_info'] = '信息不存在或者發佈人未註冊';
$L['inquiry_message_title'] = 'I`m interested in your &ldquo;{V0}&rdquo;.';
$L['inquiry_head_title'] = 'Inquiry';
$L['inquiry_message_title_multi'] = 'I`m interested in your products on {V0}.';
$L['inquiry_head_title_multi'] = 'Batch Inquiry';
$L['inquiry_itemid'] = 'Please specify the message you want to inquire.';
$L['inquiry_limit'] = 'Maximum of {V0} messages to select.';
/* sell/order.inc.php */
$L['order_condition'] = 'This product cannot be ordered dueto unclear price, MOQ and supply ability.';
$L['order_self'] = 'Please don’t purchase your own product.';
$L['order_guest'] = 'Sorry! This company is not registered Member, can’t receive the order.';
$L['order_type_amount'] = 'Enter an order quantity.';
$L['order_min_amount'] = 'Order quantity should exceed MOQ.';
$L['order_max_amount'] = 'Order quantity cannot exceed supply ability.';
$L['order_confirm'] = 'Confirm to order';
$L['order_goods'] = 'Order Product';
/* job/apply.inc.php */
$L['apply_self'] = 'You can not submit resume to your company.';
$L['apply_again'] = 'You have already submitted resume to this job position.';
$L['apply_title'] = 'Submit resume.';
$L['apply_msg_title'] = 'Your job vacancy [{V0}] receives new resume.';
$L['apply_msg_content'] = 'Please see :<a href="{V0}" target="_blank">{V0}</a> in detail.';
$L['apply_success'] = 'Resume submitted successfully.';
$L['make_resume'] = 'Please create your resume first.';
$L['not_resume'] = 'The resume does not exist.';
/* konw/answer.inc.php */
$L['vote_end'] = 'The vote has already ended.';
$L['vote_answer'] = 'The question of vote.';
$L['vote_reject'] = 'You have already voted or you have no right to vote.';
$L['min_answer'] = 'At least reserve two answers.';
$L['record_reward'] = '[{V0}]Best answer bounty.';
$L['record_best'] = '[{V0}]Best answer reward.';
$L['record_thank'] = '[{V0}]Best answer gratitude.';
$L['record_addto'] = '[{V0}]Added bounty.';
$L['record_expired'] = '[{V0}]Question expired.';
$L['select_credit'] = 'Please select'.$DT['credit_name'];
$L['lack_credit'] = $DT['credit_name'].'insufficient.';
$L['type_answer'] = 'Please fill answers.';
$L['answer_question'] = 'Respond questions.';
$L['answer_msg_title'] = 'Your inquiry[{V0}]receives new answer.';
$L['answer_msg_content'] = '<strong>ask</strong>:{V0}<br/><strong>answer</strong>:{V1}<br/>Please see:<a href="{V2}" target="_blank">{V2}</a><br/>If the response does not show up, it might display after needed system verified.';
$L['answer_check'] = 'Answer successfully, please wait for verification.';
$L['expired_msg_title'] = 'Your inquiry [{V0}] is going to expired, please handle it in time.';
$L['expired_msg_content'] = 'Please see:<a href="{V0}" target="_blank">{V0}</a>';
$L['sms_inquiry'] = 'Inquiry.';
$L['sms_price'] = 'Quote.';
$L['sms_message'] = 'Leave a message.';
/* mall/cart.inc.php */
$L['cart_title'] = 'Cart';
/* mall|group/buy.inc.php */
$L['buy_title'] = '提交訂單';
$L['msg_buy_success'] = '訂單提交成功';
/* group/buy.inc.php*/
$L['group_expired'] = '團購已結束';
$L['in_site'] = '站內';
$L['group_order_credit'] = '團購訂單';
$L['need_charge'] = '餘額不足，請充值';
/*ebook/message.inc.php*/
$L['ebook_message_title'] = 'I would like to know more about &ldquo;{V0}&rdquo; magazine information.';
$L['ecatalog_message_title'] = 'I would like to know more about &ldquo;{V0}&rdquo; product information.';
?>