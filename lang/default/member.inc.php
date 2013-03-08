<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2011 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$L['bad_data'] = 'It`s from unknown domain name.  Please contact us for any questions.';
$L['info_add'] = 'Add';
$L['info_manage'] = 'Manage';
$L['error_password'] = 'Your password is incorrect.';
$L['error_payword'] = 'Your payment password is incorrect.';
$L['money_not_enough'] = 'Out of balance.  Please recharge your account';
$L['credit_not_enough'] = 'Your'.$DT['credit_name'].' is out of balance.  Get more!';
$L['pay_in_site'] = 'Online payment';
$L['in_site'] = '';
$L['month'] = 'Month';
$L['forever'] = 'Permanent';
$L['buy'] = 'Buy';
$L['guest'] = 'Guest';
$L['status'] = 'Status';
$L['feature_close'] = 'This function is not available for the moment.';
$L['limit_add'] = 'Maximum of {V0} new records.  {V1} new records added.';
$L['default_type'] = 'Default';          
$L['all_type'] = 'All categories';
$L['choose_type'] = 'Please choose category.';
$L['check_auth'] = 'Your request has not been approved.';//global.func
$L['auth_time'] = 'Your request has been expired.';
$L['check_sign'] = '數據校驗失敗';
$L['goto'] = 'Transfer';
$L['job_name'] = 'Wanted';
$L['resume_name'] = 'Resume';
$L['module_name'] = 'Module';
$L['individual_sign'] = '(Personal)';

$L['search_by'] = 'Search by';
$L['search_by_title'] = 'Title';
$L['search_by_note'] = 'Note';
$L['order_by'] = 'Sort by';

$L['op_add_success'] = 'Added';
$L['op_checking'] = 'Under Process';
$L['op_del_success'] = 'Deleted';
$L['op_edit_success'] = 'Amemded';
$L['op_set_success'] = 'Set Up';
$L['op_update_success'] = 'Updated';

$L['pass_title'] = 'Enter a title.';
$L['pass_content'] = 'Fill in content.';
$L['pass_typeid'] = 'Select a category.';
$L['pass_url'] = 'Enter a link URL.';

$L['alert_pass'] = 'Enter a keyword or choose a category.';
$L['alert_title'] = 'Trade Alert';
$L['alert_add_title'] = 'Add Alert';

$L['ask_status'] = array('Awaiting', '<span style="color:blue;">Processing</span>', '<span style="color:green;">Solved</span>', '<span style="color:red;">Unsolved</span>');
$L['ask_title'] = 'Q & A';
$L['ask_title_show'] = 'Review my question';
$L['ask_title_edit'] = 'Edit my question';
$L['ask_title_add'] = 'Ask a new question';
$L['ask_msg_edit'] = 'Unable to modify this question anymore.';
$L['ask_msg_star'] = 'Select your satisfication level.';
$L['ask_star_type'] = array('', '<span style="color:red;">Poor</span>', 'Fair', '<span style="color:green;">Satisfied</span>');
$L['ask_star_success'] = 'Ranked';
$L['ask_add_success'] = 'Submitted';

$L['cash_status'] = array('<span style="color:blue;">Awaiting</span>', '<span style="color:#666666;">Rejected</span>', '<span style="color:red;">Payment Failure</span>', '<span style="color:green;">Payment Completed</span>');
$L['cash_title_record'] = 'Withdrawal Record';
$L['cash_title_setting'] = 'Account Settings';
$L['cash_title_confirm'] = 'Confirm to withdraw';
$L['cash_title'] = 'Withdrawal Request';
$L['cash_pass_bank'] = 'Select the collection method.';
$L['cash_pass_account'] = 'Enter beneficiary`s account.';
$L['cash_pass_amount'] = 'Enter withdrawal amount.';
$L['cash_pass_amount_min'] = 'Minimum of dollars for single operation: ';
$L['cash_pass_amount_max'] = 'Maximum of dollars for single operation: ';
$L['cash_pass_amount_day'] = 'Maximum of {v0} withdrawals within 24 hours. Please try again later.';
$L['cash_pass_amount_large'] = 'Out of balance.';
$L['cash_msg_success'] = 'Your withdrawal request has been sent and under process.<br/>The fund of '.$DT['money_name']. 'will be frozen during the duration.';
$L['cash_msg_account'] = 'Set up the beneficiary account first.';

$L['charge'] = 'Recharge';
$L['charge_online'] = 'Recharge Online';
$L['charge_card'] = 'Recharge your prepaid card.';
$L['charge_reward'] = 'Recharge bonus';
$L['charge_card_name'] = 'Prepaid card';
$L['charge_card_number'] = 'Card No.: ';
$L['charge_status'] = array('<span style="color:blue;">Unknown</span>', '<span style="color:red;">Failure</span>', '<span style="color:#FF00FF;">Nullified</span>', '<span style="color:green;">Succeeded</span>', '<span style="color:green;">Manual</span>');
$L['charge_title_record'] = 'Recharge Record';
$L['charge_title_confirm'] = 'Confirm to recharge';
$L['charge_title_pay'] = 'Recharge your account';
$L['charge_title'] = 'Recharged';
$L['charge_pass_card_number'] = 'Enter your prepaid card number.';
$L['charge_pass_card_password'] = 'Enter your password.';
$L['charge_pass_card_used'] = 'Invalid prepaid card.';
$L['charge_pass_card_expired'] = 'Expired prepaid card.';
$L['charge_pass_card_error_password'] = 'Incorrect password.';
$L['charge_pass_card_error_number'] = 'Invalid prepaid card number.';
$L['charge_pass_type_amount'] = 'Enter payment amount.';
$L['charge_pass_choose_amount'] = 'Select payment amount.';
$L['charge_pass_amount_min'] = 'Minimum amount:';
$L['charge_pass_bank'] = 'Select a payment platform.';
$L['charge_pass_bank_close'] = 'The platform has not been activated.';
$L['charge_msg_card_success'] = 'Recharged.';
$L['charge_msg_order_fail'] = 'Order status is failure. ID: ';
$L['charge_msg_order_cancel'] = 'Order status is nullified. ID: ';
$L['charge_msg_not_order'] = 'The recharge record is not found.';

$L['credit_title_add'] = 'Add Certificate';
$L['credit_title_edit'] = 'Amend Certificate';
$L['credit_title'] = 'Certificate';
$L['credit_pass_title'] = 'Enter your certificate name.';
$L['credit_pass_authority'] = 'Enter an issuer.';
$L['credit_pass_thumb'] = 'Upload your certificate image.';
$L['credit_pass_fromdate'] = 'Select the issued date.';
$L['credit_pass_fromdate_error'] = 'The issued date must be earlier than the present.';
$L['credit_pass_todate'] = 'Select the expiry date.';
$L['credit_pass_todate_error'] = 'The expiry date must be later than the present.';
$L['credit_reward_reason'] = 'Uploaded';
$L['credit_punish_reason'] = 'Deleted';

$L['credits_exchange_title'] = $DT['credit_name'].' Exchange';
$L['credits_buy_title'] = $DT['credit_name'].' Buy';
$L['credits_title'] = $DT['credit_name'].' Record';
$L['credits_pass_ex_min'] = 'Out of balance';
$L['credits_pass_ex_max'] = 'Maximum amount to exchange: ';
$L['credits_msg_amount'] = 'Completed';
$L['credits_msg_active'] = 'Your account is not activated.';
$L['credits_msg_buy_amount'] = 'Please select the amount.';
$L['credits_msg_buy_success'] = 'Completed';
$L['credits_fields'] = array($L['search_by'], 'Amount', 'Reason', $L['search_by_note']);

$L['edit_title'] = 'Edit my profile';
$L['edit_invite'] = 'Member Promotion';
$L['edit_profile'] = 'Complete your profile.';
$L['edit_msg_success'] = 'Amemded';

$L['favorite_title_add'] = 'Add Favorite';
$L['favorite_title_edit'] = 'Amend Favorite';
$L['favorite_title'] = 'My Favorite';
$L['favorite_msg_choose'] = 'Select a favorite';
$L['favorite_sfields'] = array($L['search_by'], $L['search_by_title'], 'Link URL', $L['search_by_note']);

$L['friend_title_add'] = 'Add Friend';
$L['friend_title_edit'] = 'Amend Friend';
$L['friend_title'] = 'My Friend';
$L['friend_pass_truename'] = 'Enter your real name.';
$L['friend_msg_add_again'] = 'The member has added in your business friends.';
$L['friend_msg_choose'] = 'Select a friend.';
$L['friend_sfields'] = array($L['search_by'], 'Name', 'Co. Name', 'Position', 'TEL', 'Mobile', 'Website', 'Email', 'MSN', 'Skype', 'Username', $L['search_by_note']);

$L['grade_title'] = 'Member Upgrade';
$L['grade_fail'] = 'Failure to upgrade to ({V0}).';
$L['grade_success'] = 'Success to upgrade to ({V0}).';
$L['grade_return'] = 'The payment will be refunded.';
$L['grade_upto'] = 'Upgrade to: ';
$L['grade_pass_balance'] = 'Your account is out of balance.';
$L['grade_pass_company'] = 'Enter your company name.';
$L['grade_pass_truename'] = 'Enter a contact name.';
$L['grade_pass_telephone'] = 'Enter your telephone number.';
$L['grade_msg_bad_promo'] = 'Invalid coupon.';
$L['grade_msg_time_promo'] = 'Valid for {V0} days.';
$L['grade_msg_money_promo'] = 'Rebate {V0} '.$DT['money_unit'];
$L['grade_msg_success'] = 'Your request has been sent and under process.';

$L['home_title'] = 'Website Settings';
$L['home_msg_reset'] = 'Restored';
$L['home_msg_save'] = 'Saved';

$L['index_msg_logout'] = 'Nullified';
$L['index_msg_note_limit'] = 'Biz Memo has 1000 characters limit.';

$L['invite_title'] = $DT['credit_name'].' Promotion';

$L['link_title'] = 'Friendly Link';
$L['link_title_add'] = 'Add Link';
$L['link_title_edit'] = 'Amend Link';
$L['link_pass_username'] = 'Member name is required.';
$L['link_pass_title'] = 'Enter a link name.';
$L['link_pass_linkurl'] = 'Enter a link URL.';
$L['link_msg_choose'] = 'Select a link.';

$L['login_title'] = 'Member Login';
$L['login_title_reg'] = 'Registered, please login.';
$L['login_msg_username'] = 'Enter your username.';
$L['login_msg_password'] = 'Enter your password.';
$L['login_msg_not_member'] = 'The username is not found.';
$L['login_msg_success'] = 'Logged In';

$L['logout_msg_success'] = 'Logged Out';

$L['mail_title'] = 'My Subscription';
$L['mail_title_list'] = 'Newsletter List';
$L['mail_msg_not_add'] = 'You have not subscribed to newsletter(s).';
$L['mail_msg_cancel'] = 'Unsubscribed';
$L['mail_msg_update'] = 'Updated';
$L['mail_msg_choose'] = 'Select cateogries of newsletter(s). If you want to unsubscribe, please click "Unsubscribe" button.';
$L['mail_msg_not_item'] = 'Newsletter list is not found.';

$L['member_username_match'] = 'Username should be composed of lowercase letters(a-z), numbers(0-9), underscore(_).';
$L['member_username_len'] = 'Username should be between {V0}-{V1} characters.';
$L['member_username_ban'] = 'The username has been forbidden.';
$L['member_username_reg'] = 'The username has been registered.';
$L['member_passport_len'] = 'Passport name should be between {V0}-{V1} characters.';
$L['member_passport_char'] = 'No special symbol(s) in the passport name.';
$L['member_passport_ban'] = 'The passport name has been forbidden.';
$L['member_passport_reg'] = 'The passport name has been registered.';
$L['member_password_null'] = 'Password is not null.';
$L['member_password_match'] = 'Two passwords are not the same.';
$L['member_password_len'] = 'Password should be between {V0}-{V1} characters.';
$L['member_payword_null'] = 'Payment password is not null.';
$L['member_payword_match'] = 'Two payment passwords are not the same.';
$L['member_payword_len'] = 'Payment password should be between {V0}-{V1} characters.';
$L['member_groupid_null'] = 'Select a member group.';
$L['member_truename_null'] = 'Enter your real name.';
$L['member_email_null'] = 'Invalid email format.';
$L['member_email_ban'] = '此郵件域名已經被禁止註冊';
$L['member_email_reg'] = 'Exsited email address.';
$L['member_areaid_null'] = 'Select a location.';
$L['member_company_null'] = 'Enter your company name.';
$L['member_company_bad'] = 'Invalid company name.';
$L['member_company_reg'] = 'Exsited company name.';
$L['member_company_ban'] = '此公司名已經被禁止註冊';
$L['member_type_null'] = 'Select a business type at least.';
$L['member_telephone_null'] = 'Enter your company telephone number.';
$L['member_regyear_null'] = 'Enter establishment year of your company.';
$L['member_address_null'] = 'Enter your company address.';
$L['member_introduce_null'] = 'Company profile should contain more than 50 characters.';
$L['member_business_null'] = 'Fill in the main business scope of your company.';
$L['member_catid_null'] = 'Select an industry of your company.';
$L['member_login_username_bad'] = 'Username format error.';
$L['member_login_password_bad'] = 'Incorrect password. Please try again.';
$L['member_login_not_member'] = 'The username is not found.';
$L['member_login_ban'] = 'Due to {V0} errors, you cannot log in within {V1} hours.';
$L['member_login_member_ban'] = 'Your account is forbidden.';
$L['member_login_ok'] = 'Completed';
$L['member_founder_del'] = 'You cannot delete founder.';
$L['member_founder_move'] = 'You cannot move founder.';
$L['member_rename_not_member'] = 'The member name doesn`t exsit.';
$L['member_record_reg'] = 'Register Bonus';
$L['member_record_login'] = 'Login Bonus';

$L['message_title'] = 'Internal Mail';
$L['message_title_black'] = 'Blocklist';
$L['message_title_inbox'] = 'Inbox';
$L['message_title_outbox'] = 'Sent Mail';
$L['message_title_draft'] = 'Drafts';
$L['message_title_recycle'] = 'Trash';
$L['message_limit'] = 'Maximun of {V0} mails for today.  {V1} have been sent.';
$L['message_send_max'] = 'Maximum of {V0} recipients for each mail.';
$L['message_list_date'] = 'M-d-Y H:i';
$L['message_from_system'] = 'System';
$L['message_from_notice'] = 'Notice';
$L['message_names'] = array(1=>'Drafts', 2=>'Sent Mail', 3=>'Inbox', 4=>'Trash');
$L['message_feedback_title'] = 'Your mail [{V0}] has been read.';
$L['message_feedback_content'] = '{V0} <small style="color:blue;">{V1}</small> has read the mail you sent.<br/><div style="padding:10px;margin:10px 10px 0 0;border-left:#E5EBFA 3px solid;line-height:180%;background:#FFFFFF;"><strong>Subject: </strong>{V2}<br/><strong>Date: </strong>{V3}<br/><strong>Quote: </strong><br/>{V4}</div>';
$L['message_msg_edit'] = 'The email is not found or you are not authorized to edit.';
$L['message_msg_null'] = 'No mails in the scope.';
$L['message_msg_save_draft'] = 'Draft Saved';
$L['message_msg_edit_draft'] = 'Draft Amemded';
$L['message_msg_send'] = 'Sent';
$L['message_msg_choose'] = 'Select the mail(s).';
$L['message_msg_deny'] = 'The email is not found or you are not authorized to edit.';
$L['message_msg_clear'] = 'Cleaned Up';
$L['message_msg_mark'] = 'Marked as read';
$L['message_msg_restore'] = 'Restored';
$L['message_msg_empty'] = 'Cleaned Up';
$L['message_msg_inbox_limit'] = 'Full capacity of inbox.  Please clean up.';
$L['message_black_username'] = 'Select the member to blocklist.';
$L['message_black_not_member'] = 'The member is not found.  Please check.';
$L['message_black_exist'] = 'The member is on the blocklist.';
$L['message_black_update'] = 'Blocklist Updated';
$L['message_pass_groupid'] = 'Select a member group.';
$L['message_pass_touser'] = 'Recipient is required.';
$L['message_pass_title'] = 'Subject and content are required.';

$L['news_title'] = 'Company News';
$L['news_title_add'] = 'Release News';
$L['news_title_edit'] = 'Amend News';
$L['news_record_add'] = 'Released';
$L['news_record_del'] = 'Deleted';
$L['news_msg_choose'] = 'Select the news.';

$L['page_title'] = '公司單頁';
$L['page_title_add'] = '添加單頁';
$L['page_title_edit'] = '修改單頁';
$L['page_record_add'] = '單頁發佈';
$L['page_record_del'] = '單頁刪除';
$L['page_msg_choose'] = '請選擇單頁';

$L['address_title'] = '收貨地址';
$L['address_title_add'] = '添加地址';
$L['address_title_edit'] = '修改地址';
$L['address_record_add'] = '地址發佈';
$L['address_record_del'] = '地址刪除';
$L['address_msg_choose'] = '請選擇地址';

$L['pay_title'] = 'Online Payment';
$L['pay_record_view'] = 'Views';
$L['pay_msg_fee'] = 'Your payment amount is incorrect.';

$L['record_title'] = $DT['money_name'].' Records';
$L['record_title_login'] = 'Login Record';
$L['record_title_pay'] = 'History Views';
$L['record_sfields'] = array($L['search_by'], 'Amount', 'Bank', 'Reason', $L['search_by_note']);

$L['register_title'] = 'Member Registration';
$L['register_msg_close'] = 'Member registration has been closed.';
$L['register_msg_agent'] = 'Your clients` message are blocked by ImB2B.  Please contact us for any questions.';
$L['register_msg_ip'] = 'One registration with the same IP in {V0} hours.';
$L['register_msg_passport'] = 'The passport name exists.\n\nIf you`ve registered the passport name, please enter your password.\n\nOr if not, please change your passport name.';
$L['register_msg_activate'] = $DT['sitename'].' - Member Activation Email';
$L['register_msg_welcome'] = 'Welcome to Join '.$DT['sitename'];
$L['register_pass_groupid'] = 'Select a member group.';

/*2010-10-25<<*/
$L['register_msg_emailcode'] = $DT['sitename'].'用戶註冊郵件驗證碼';
$L['register_pass_emailcode'] = '郵件驗證碼錯誤';
/*2010-10-25>>*/

$L['renew_title'] = VIP.' Service Renewal';
$L['renew_msg_fee'] = 'Your payment amount is incorrect.';
$L['renew_msg_success'] = 'Service Renewed';
$L['renew_record'] = '{V0} Year,{V1} expired';

$L['send_mail_close'] = 'The function of email-sending is closed.';
$L['send_sms_close'] = 'The function of SMS-sending is closed.';

$L['send_check_success'] = 'Your account has been activated.';
$L['send_check_email_bad'] = 'Enter a valid email address.';
$L['send_check_email_repeat'] = 'Exsited email address.  Please enter a new one.';
$L['send_check_username_bad'] = 'Wrong member name';
$L['send_check_password_bad'] = 'Your member name and password didn`t match.';
$L['send_check_deny'] = 'Activation letter is not required for your account.';
$L['send_check_mail'] = $DT['sitename'].' - Member Activation Email';
$L['send_check_username_null'] = 'Invalid member name';
$L['send_check_title'] = 'Resend the activation email.';
$L['send_payword_success'] = 'The payment code has been updated.';
$L['send_payword_mail'] = $DT['sitename'].' - Amend Payment Password';
$L['send_payword_title'] = 'Payment Password';
$L['send_email_exist'] = 'Exsited email address.  Please enter a new one.';
$L['send_email_success'] = 'Email has been updated.';
$L['send_email_mail'] = $DT['sitename'].'Amend Email Address';
$L['send_email_title'] = 'Amend Email';
$L['send_mobile_exist'] = 'Exsited mobile phone number.  Please enter a new one.';
$L['send_mobile_fail'] = '短信發送失敗，請重試';
$L['send_mobile_success'] = 'Mobile phone number has been updated.';
$L['send_mobile_code_error'] = 'Incorrect code.';
$L['send_mobile_bad'] = 'Incorrect mobile phone number.';
$L['send_mobile_record'] = 'Amend mobile phone number';
$L['send_mobile_title'] = 'Amend mobile phone number';
$L['send_password_success'] = 'Password has been updated.';
$L['send_password_checking'] = 'Your account is pending.';
$L['send_password_error'] = 'The information does not match.';
$L['send_password_mail'] = $DT['sitename'].' - Find Password';
$L['send_password_title'] = 'Find Password';

$L['sendmail_title'] = 'Send Email';
$L['sendmail_content'] = 'Your friend, <strong><a href="{V0}" target="_blank">{V1}</a></strong>, recommend the following information to you: <br/><br/>{V2}<br/><a href="{V3}" target="_blank">{V3}</a><br/><br/>Remark: ';
$L['sendmail_title_new'] = 'Recommend《{V0}》';
$L['sendmail_pass_mailto'] = 'Enter a valid email address.';
$L['sendmail_success'] = 'Mail has been sent to {V0}.';
$L['sendmail_fail'] = 'Failed. Please try again.';

$L['sms_msg_validate'] = 'Please verify your mobile phone number.';
$L['sms_msg_buy'] = 'Please purchase SMS.';
$L['sms_msg_mobile'] = 'Please enter your mobile phone number.';
$L['sms_msg_content'] = 'Please fill in content.';
$L['sms_add_record'] = 'Manual';
$L['sms_add_success'] = 'The message is sent.';
$L['sms_add_title'] = 'Send message';
$L['sms_msg_no_price'] = 'Unit price is unavailable.';
$L['sms_msg_buy_num'] = 'Please enter amount';
$L['sms_buy_note'] = 'SMS purchase';
$L['sms_buy_record'] = 'Online purchase';
$L['sms_buy_success'] = 'Completed';
$L['sms_buy_title'] = 'SMS purchase';
$L['sms_record_title'] = 'History SMS';
$L['sms_send_title'] = 'SMS sending history';
$L['sms_title'] = 'SMS history';
$L['sms_sfields'] = array($L['search_by'], 'Amount', 'Reason', $L['search_by_note']);

$L['type_title'] = '{V0} Category';
$L['type_names'] = array('friend'=>'Group', 'favorite'=>'Favorite', 'product'=>'Product', 'news'=>'News');
$L['type_msg_limit'] = 'Maximum of {V0} new categories.';

$L['style_title'] = 'Template settings';
$L['style_title_buy'] = 'Template Purchase';
$L['style_sfields'] = array($L['search_by'], 'Name', 'By');
$L['style_sorder'] = array($L['order_by'], 'Descending released date', 'Ascending released date', 'Descending popularity', 'Ascending popularity');
$L['style_record_buy'] = 'Template {V0} is ordered for {V1} month(s)';
$L['style_msg_not_exist'] = 'The template is not found.';
$L['style_msg_group'] = 'Sorry, the template is not available for your member group.';
$L['style_msg_month'] = 'Please choose duration.';
$L['style_msg_buy_success'] = 'Template Ordered';
$L['style_msg_use_success'] = 'Template Activated';
$L['style_pass_title'] = 'Enter a template name.';
$L['style_pass_skin'] = 'Enter a style directory.';
$L['style_pass_skin_match'] = 'Only letters (A-Z, a-z), numbers (0-9), dash(-) or underscore (_) in file name.';
$L['style_pass_css'] = 'CSS documents don`t exsit.';
$L['style_pass_template'] = 'Please enter template catalogue.';
$L['style_pass_template_match'] = 'Only letters (A-Z, a-z), numbers (0-9), dash(-) or unerscore (_) in file name.';
$L['style_pass_dir'] = 'Template catalogue doesn`t exist.';
$L['style_pass_groupid'] = 'Please select member group.';

$L['trade_status'] = array(
	'<span style="color:#0000FF;">Buyer sent order.<br/>Await buyer`s confirmation.</span>',
	'<span style="color:#FF6600;">Seller confirmed the order.<br/>Await buyer`s payment.</span>',
	'<span style="color:#008080;">Buyer completed the payment. <br/>Await seller`s shipment.</span>',
	'<span style="color:#FF0000;">Shipment`s been arranged.<br/>Await buyer\'s confirmation.</span>',
	'<span style="color:#008000;">Deal completed</span>',
	'<span style="color:#FF0000;text-decoration:underline;">Refund requested by buyer</span>',
	'<span style="color:#0000FF;text-decoration:underline;">Refunded to buyer.</span>',
	'<span style="color:#FF6600;text-decoration:underline;">Paid to seller</span>',
	'<span style="color:#888888;text-decoration:line-through;">Deal closed by buyer</span>',
	'<span style="color:#888888;text-decoration:line-through;">Deal closed by seller</span>',
);
$L['trade_dstatus'] = array(
	'Buyer sent order.  Await buyer\'s confirmation.',
	'Seller\'s confirmed the order.  Await buyer\'s payment.',
	'Buyer\'s completed the payment.  Await seller\'s shipment.',
	'Shipment\'s been arranged.  Await buyer\'s confirmation.',
	'Deal completed',
	'Refund requested by buyer',
	'Refunded to buyer.',
	'Paid to seller',
	'Deal closed by buyer',
	'Deal closed by seller',
);
$L['trade_msg_deny'] = 'You\'ve not been authorized for this operation.';
$L['trade_msg_null'] = 'The order doesn\'t exsit.';
$L['trade_price_fee_null'] = 'Please enter additional cost.';
$L['trade_price_fee_name'] = 'Please enter the items';
$L['trade_price_edit_success'] = 'The order has been amended';
$L['trade_price_title'] = 'Amend Price';
$L['trade_detail_title'] = 'Detail';
$L['trade_confirm_success'] = 'The order has been confirmed.  Please wait for the payment.';
$L['trade_pay_order_success'] = 'Payment completed and the money is frozen for the moment. Please wait for the shipment.';
$L['trade_pay_order_title'] = 'Pay for the order.';
$L['trade_refund_reason'] = 'Please enter reason and proof.';
$L['trade_refund_success'] = 'Your request has been submitted and under processing.';
$L['trade_refund_title'] = 'Refund request';
$L['trade_send_success'] = 'Shipment arranged.  Please wait for consignee\'s confirmation.';
$L['trade_send_title'] = 'Shipment arranged';
$L['trade_receive_title'] = '確認到貨';
$L['trade_addtime_null'] = 'Please enter extension days.';
$L['trade_addtime_success'] = 'The duration has been extended.';
$L['trade_addtime_title'] = 'Extend the duration for buyer\'s confirmation.';
$L['trade_success'] = 'Congratulations! The order has been completed.';
$L['trade_close_success'] = 'The deal is closed.';
$L['trade_delete_success'] = 'The deal is deleted.';
$L['trade_pay_seller'] = 'Please enter the beneficiary member.';
$L['trade_pay_self'] = 'You cannot be the beneficiary.';
$L['trade_pay_seller_bad'] = 'The member doesn\'t exsit.  Please check.';
$L['trade_pay_amount'] = 'Please enter payment amount.';
$L['trade_pay_note'] = 'Please enter payment description.';
$L['trade_pay_goods'] = 'Please enter product or service items.';
$L['trade_pay_title'] = 'Pay';
$L['trade_pay1_success'] = 'Payment completed.  Member {V0}] will receive the money directly.';
$L['trade_pay0_success'] = 'The order is sent and waiting for seller\'s confirmation.';
$L['trade_order_sfields'] = array('Sort by', 'Product/service', 'Amount', 'Additional cost', 'Additional Item', 'Buyer', 'Shipment method', 'Tracking number', 'Remark');
$L['trade_order_title'] = 'Orders sent';
$L['trade_sfields'] = array('Sort by', 'Product/service', 'Amount', 'Additional cost', 'Additional Item', 'Buyer', 'Buyer\'s name', 'Buyer\'s address', 'Buyer\'s ZIP code', 'Buyer\'s telephone', 'Shippment method', 'Tracking Number', 'Remark');
$L['trade_title'] = 'Orders sent';
$L['trade_record_pay'] = 'Payment on delivery';
$L['trade_record_payfor'] = 'Internal payment';
$L['trade_record_receive'] = 'Payment collection';
$L['trade_record_new'] = 'Notify seller to confirm the order.';
$L['trade_order_id'] = 'Order number:';
$L['trade_buyer_timeout'] = 'Order number {V0}[Expiry order awaiting buyer\'s confirmation.]';
$L['trade_sms_confirm'] = 'Notify buyer to pay.';
$L['trade_sms_pay'] = 'Notify seller for shipping.';
$L['trade_sms_send'] = 'Notify buyer of shippment';
$L['trade_sms_income'] = 'Internal payment notification';
$L['trade_sms_receive'] = '通知賣家已收貨';
$L['trade_message_t1'] = 'Internal reminder! You have a deal awaiting payment.(T{V0})';
$L['trade_message_c1'] = 'Seller <a href="{V0}" class="t">{V1}</a> confirmed your order on <span class="f_gray">{V2}</span> <br/><a href="{V3}" class="t" target="_blank">&raquo; Please click here for further details.</a>';
$L['trade_message_t2'] = 'Internal reminder! You have a deal awaiting shipment.(T{V0})';
$L['trade_message_c2'] = 'Buyer <a href="{V0}" class="t">{V1}</a> paid this order on <span class="f_gray">{V2}</span> <br/><a href="{V3}" class="t" target="_blank">&raquo; Please click here for further details.</a>';
$L['trade_message_t3'] = 'Internal reminder! You have a deal awaiting consignment.(T{V0})';
$L['trade_message_c3'] = 'The shipment has been arranged <a href="{V0}" class="t">{V1}</a> on <span class="f_gray">{V2}</span>. <br/><a href="{V3}" class="t" target="_blank">&raquo; Please click here for further details.</a>';
$L['trade_message_t4'] = 'Internal reminder! You have a deal completed.(T{V0})';
$L['trade_message_c4'] = 'Buyer received the shipment <a href="{V0}" class="t">{V1}</a> on <span class="f_gray">{V2}</span>，and the deal is completed.  <br/><a href="{V3}" class="t" target="_blank">&raquo; Please click here for further details.</a>';
$L['trade_message_t5'] = 'Income reminder! You\'ve received payment';
$L['trade_message_c5'] = '<a href="{V0}" class="t">{V1}</a> made the amount of <span class="f_blue">{V3}'.$DT['money_unit'].'</span> internal payment on <span class="f_gray">{V2}</span>. <br/>Remark：<span class="f_gray">{V4}</span>';
$L['trade_message_t6'] = 'Internal reminder! You have a deal awaiting confirmation.(T{V0})';
$L['trade_message_c6'] = '<a href="{V0}" class="t">{V1}</a> ordered ：<br/>{V3}<br/> on <span class="f_gray">{V2}</span> Order number：<span class="f_red">T{V4}</span> &nbsp;Order amount：<span class="f_blue f_b">{V5}'.$DT['money_unit'].'</span><br/><a href="{V6}" class="t" target="_blank">&raquo; Please click here for further details.</a>';

$L['group_status'] = array(
	'<span style="color:#0000FF;">已付款</span>',
	'<span style="color:#FF0000;">已發貨</span>',
	'<span style="color:#FF6600;">已消費</span>',
	'<span style="color:#008000;">交易成功</span>',
	'<span style="color:#888888;text-decoration:line-through;">已退款</span>',
);
$L['group_dstatus'] = array(
	'已付款',
	'已發貨',
	'已消費',
	'交易成功',
	'已退款',
);
$L['group_detail_title'] = '訂單詳情';

$L['group_title'] = '收到的團購訂單';
$L['group_sfields'] = array('按條件', '商品', '金額', '密碼', '買家', '買家姓名', '買家地址', '買家郵編', '買家手機', '買家電話', '發貨方式', '物流號碼', '備註');

$L['group_order_title'] = '團購訂單';
$L['group_order_sfields'] = array('按條件', '商品', '金額', '密碼', '賣家', '發貨方式', '物流號碼', '備註');
$L['group_send_title'] = '商家發貨';

$L['validate_email_exist'] = 'Exsited email address.  Please enter a new one.';
$L['validate_email_success'] = 'Your email has been verified.';
$L['validate_email_bad'] = 'Incorrect email address';
$L['validate_email_mail'] = $DT['sitename'].'Verified by user email';
$L['validate_email_title'] = 'Verify by email';
$L['validate_mobile_exist'] = 'Exsited mobile phone number.  Please enter a new one.';
$L['validate_mobile_title'] = 'Verify by mobile phone number';
$L['validate_mobile_success'] = 'Your mobile phone number has been verified.';
$L['validate_mobile_fail'] = '短信發送失敗，請重試';
$L['validate_mobile_code_error'] = 'Wrong verication code.';
$L['validate_mobile_bad'] = 'Incorrect mobile phone number';
$L['validate_mobile_record'] = 'Verify by mobile phone';
$L['validate_truename_title'] = 'Verify by real name';
$L['validate_truename_name'] = 'Please enter real name';
$L['validate_truename_image'] = 'Please upload ID card/Passport';
$L['validate_truename_success'] = 'Sent';
$L['validate_company_title'] = 'Certificate';
$L['validate_company_name'] = 'Please enter company name';
$L['validate_company_image'] = 'Please upload the picture';
$L['validate_company_success'] = 'Sent';
$L['validate_bank_title'] = 'Verify by bank account';

$L['oauth_title'] = '一鍵登錄';
$L['oauth_quit'] = '解除成功';

$L['support_title'] = '客服專員';
$L['support_error_1'] = '系統暫未為您分配客服專員';
$L['support_error_2'] = '客服專員不存在，請與網站聯繫';
?>