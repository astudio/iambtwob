<?php
/*
	[Destoon B2B System] Copyright (c) 2008-2011 Destoon.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_DESTOON') or exit('Access Denied');
$L['bad_data'] = '數據發送自未被信任的域名，如有疑問，請聯繫管理員';
$L['info_add'] = '發佈信息';
$L['info_manage'] = '管理信息';
$L['error_password'] = '您的密碼不正確';
$L['error_payword'] = '您的支付密碼不正確';
$L['money_not_enough'] = '帳戶餘額不足，請充值';
$L['credit_not_enough'] = '您的'.$DT['credit_name'].'不足，請購買';
$L['pay_in_site'] = '站內支付';
$L['in_site'] = '站內';
$L['month'] = '月';
$L['forever'] = '永久';
$L['buy'] = '購買';
$L['guest'] = '遊客';
$L['status'] = '狀態';
$L['feature_close'] = '此功能暫未開啟';
$L['limit_add'] = '最多可添加{V0}條記錄,當前已添加{V1}條記錄';
$L['default_type'] = '默認';
$L['all_type'] = '所有分類';
$L['choose_type'] = '請選擇分類';
$L['check_auth'] = '您的請求未通過系統驗證';//global.func
$L['auth_time'] = '您的請求已經過期';
$L['check_sign'] = '數據校驗失敗';
$L['goto'] = '轉到';
$L['job_name'] = '招聘';
$L['resume_name'] = '簡歷';
$L['module_name'] = '模塊';
$L['individual_sign'] = '(個人)';

$L['search_by'] = '按條件';
$L['search_by_title'] = '標題';
$L['search_by_note'] = '備註';
$L['order_by'] = '結果排序方式';

$L['op_add_success'] = '添加成功';
$L['op_checking'] = '請等待審核';
$L['op_del_success'] = '刪除成功';
$L['op_edit_success'] = '修改成功';
$L['op_set_success'] = '設置成功';
$L['op_update_success'] = '更新成功';

$L['pass_title'] = '請填寫標題';
$L['pass_content'] = '請填寫內容';
$L['pass_typeid'] = '請選擇分類';
$L['pass_url'] = '請填寫網址';

$L['alert_pass'] = '您至少選擇"關鍵字"或"所在行業"其中的一項';
$L['alert_title'] = '貿易提醒';
$L['alert_add_title'] = '添加提醒';

$L['ask_status'] = array('待受理', '<span style="color:blue;">受理中</span>', '<span style="color:green;">已解決</span>', '<span style="color:red;">未解決</span>');
$L['ask_title'] = '問題及解答';
$L['ask_title_show'] = '問題查看';
$L['ask_title_edit'] = '修改問題';
$L['ask_title_add'] = '提交新問題';
$L['ask_msg_edit'] = '此問題不可再修改';
$L['ask_msg_star'] = '請選擇您的滿意程度';
$L['ask_star_type'] = array('', '<span style="color:red;">不滿意</span>', '基本滿意', '<span style="color:green;">非常滿意</span>');
$L['ask_star_success'] = '評分成功';
$L['ask_add_success'] = '提交成功';

$L['cash_status'] = array('<span style="color:blue;">等待受理</span>', '<span style="color:#666666;">拒絕申請</span>', '<span style="color:red;">支付失敗</span>', '<span style="color:green;">付款成功</span>');
$L['cash_title_record'] = '提現記錄';
$L['cash_title_setting'] = '帳號設置';
$L['cash_title_confirm'] = '提現確認';
$L['cash_title'] = '申請提現';
$L['cash_pass_bank'] = '請選擇收款方式';
$L['cash_pass_account'] = '請填寫收款帳號';
$L['cash_pass_amount'] = '請填寫提現金額';
$L['cash_pass_amount_min'] = '單次提現最小金額為:';
$L['cash_pass_amount_max'] = '單次提現最大金額為:';
$L['cash_pass_amount_day'] = '24小時內最多可提現{v0}次，請稍候再操作';
$L['cash_pass_amount_large'] = '提現金額大於可用餘額';
$L['cash_msg_success'] = '您的提現申請已經提交，請等待工作人員的處理<br/>在此期間，該筆'.$DT['money_name'].'將被凍結';
$L['cash_msg_account'] = '請先設置收款帳號';

$L['charge'] = '充值';
$L['charge_online'] = '在線充值';
$L['charge_card'] = '充值卡充值';
$L['charge_reward'] = '充值獎勵';
$L['charge_card_name'] = '充值卡';
$L['charge_card_number'] = '卡號';
$L['charge_status'] = array('<span style="color:blue;">未知</span>', '<span style="color:red;">失敗</span>', '<span style="color:#FF00FF;">作廢</span>', '<span style="color:green;">成功</span>', '<span style="color:green;">人工</span>');
$L['charge_title_record'] = '充值記錄';
$L['charge_title_confirm'] = '充值確認';
$L['charge_title_pay'] = '帳戶充值';
$L['charge_title'] = '完成充值';
$L['charge_pass_card_number'] = '請填寫正確的充值卡卡號';
$L['charge_pass_card_password'] = '請填寫正確的充值卡密碼';
$L['charge_pass_card_used'] = '充值卡無效';
$L['charge_pass_card_expired'] = '充值卡已過有效期';
$L['charge_pass_card_error_password'] = '充值卡密碼錯誤';
$L['charge_pass_card_error_number'] = '無效的充值卡卡號';
$L['charge_pass_type_amount'] = '請填寫支付金額';
$L['charge_pass_choose_amount'] = '請選擇充值金額';
$L['charge_pass_amount_min'] = '充值金額最少:';
$L['charge_pass_bank'] = '請選擇支付平台';
$L['charge_pass_bank_close'] = '此支付平台尚未啟用';
$L['charge_msg_card_success'] = '充值卡充值成功';
$L['charge_msg_order_fail'] = '訂單狀態為失敗，ID:';
$L['charge_msg_order_cancel'] = '訂單狀態為作廢，ID:';
$L['charge_msg_not_order'] = '未找到充值紀錄';

$L['honor_title_add'] = '添加證書';
$L['honor_title_edit'] = '修改證書';
$L['honor_title'] = '榮譽資質';
$L['honor_pass_title'] = '請填寫證書名稱';
$L['honor_pass_authority'] = '請填寫發證機構';
$L['honor_pass_thumb'] = '請上傳證書圖片';
$L['honor_pass_fromdate'] = '請選擇證書發證時間';
$L['honor_pass_fromdate_error'] = '證書發證時間必須在當前時間之前';
$L['honor_pass_todate'] = '請選擇證書到期時間';
$L['honor_pass_todate_error'] = '證書到期時間必須在當前時間之後';
$L['honor_reward_reason'] = '證書上傳';
$L['honor_punish_reason'] = '證書刪除';

$L['credit_exchange_title'] = $DT['credit_name'].'兌換';
$L['credit_buy_title'] = $DT['credit_name'].'購買';
$L['credit_title'] = $DT['credit_name'].'記錄';
$L['credit_pass_ex_min'] = '兌換額度不足';
$L['credit_pass_ex_max'] = '最多可兌換:';
$L['credit_msg_amount'] = '兌換成功';
$L['credit_msg_active'] = '您的帳號未在論壇激活';
$L['credit_msg_buy_amount'] = '請選擇購買額度';
$L['credit_msg_buy_success'] = '購買成功';
$L['credit_fields'] = array($L['search_by'], '金額', '事由', $L['search_by_note']);

$L['edit_title'] = '修改資料';
$L['edit_invite'] = '會員推廣';
$L['edit_profile'] = '完善資料';
$L['edit_msg_success'] = '資料保存成功';

$L['favorite_title_add'] = '添加收藏';
$L['favorite_title_edit'] = '修改收藏';
$L['favorite_title'] = '我的收藏';
$L['favorite_msg_choose'] = '請選擇收藏';
$L['favorite_sfields'] = array($L['search_by'], $L['search_by_title'], '網址', $L['search_by_note']);

$L['friend_title_add'] = '添加商友';
$L['friend_title_edit'] = '修改商友';
$L['friend_title'] = '我的商友';
$L['friend_pass_truename'] = '請填寫真實姓名';
$L['friend_msg_add_again'] = '該會員已經是您的商友了';
$L['friend_msg_choose'] = '請選擇商友';
$L['friend_sfields'] = array($L['search_by'], '姓名', '公司', '職位', '電話', '手機', '主頁', 'Email', 'QQ', '阿里旺旺', 'MSN', 'Skype', '會員', $L['search_by_note']);

$L['grade_title'] = '會員升級';
$L['grade_fail'] = '您的會員組升級({V0})失敗';
$L['grade_success'] = '您的會員組升級({V0})成功';
$L['grade_return'] = '升級失敗返款';
$L['grade_upto'] = '升級為:';
$L['grade_pass_balance'] = '會員餘額不足';
$L['grade_pass_company'] = '請填寫公司名';
$L['grade_pass_truename'] = '請填寫聯繫人';
$L['grade_pass_telephone'] = '請填寫電話號碼';
$L['grade_msg_bad_promo'] = '無效的優惠碼';
$L['grade_msg_time_promo'] = '可獲有效期:{V0}天';
$L['grade_msg_money_promo'] = '可充抵金額:{V0}'.$DT['money_unit'];
$L['grade_msg_success'] = '您的申請已經成功提交，請等待工作人員處理';

$L['home_title'] = '商舖設置';
$L['home_msg_reset'] = '恢復成功';
$L['home_msg_save'] = '保存成功';

$L['index_msg_logout'] = '註銷成功';
$L['index_msg_note_limit'] = '便箋限1000字';

$L['invite_title'] = $DT['credit_name'].'推廣';

$L['link_title'] = '友情鏈接';
$L['link_title_add'] = '添加鏈接';
$L['link_title_edit'] = '修改鏈接';
$L['link_pass_username'] = '會員名不能為空';
$L['link_pass_title'] = '請填寫網站名稱';
$L['link_pass_linkurl'] = '請填寫網站地址';
$L['link_msg_choose'] = '請選擇鏈接';

$L['login_title'] = '會員登錄';
$L['login_title_reg'] = '註冊成功，請登錄';
$L['login_msg_username'] = '請輸入登錄名稱';
$L['login_msg_password'] = '請輸入密碼';
$L['login_msg_not_member'] = '登錄名稱不存在';
$L['login_msg_success'] = '登錄成功';

$L['logout_msg_success'] = '退出成功';

$L['mail_title'] = '我的訂閱';
$L['mail_title_list'] = '郵件列表';
$L['mail_msg_not_add'] = '您尚未訂閱任何商機';
$L['mail_msg_cancel'] = '退訂成功';
$L['mail_msg_update'] = '訂閱更新成功';
$L['mail_msg_choose'] = '請選擇商機分類，如果要取消訂閱，請直接點擊退訂按鈕';
$L['mail_msg_not_item'] = '郵件列表不存在';

$L['member_username_match'] = '會員名應為小寫字母(a-z)、數字(0-9)、下劃線(_)、中劃線(-)組合';
$L['member_username_len'] = '會員登錄名長度應在{V0}-{V1}之間';
$L['member_username_ban'] = '此登錄名已經被禁止註冊';
$L['member_username_reg'] = '會員登錄名已經被註冊';
$L['member_passport_len'] = '通行證長度應在{V0}-{V1}之間';
$L['member_passport_char'] = '通行證名不能含有特殊符號';
$L['member_passport_ban'] = '此通行證名已經被禁止註冊';
$L['member_passport_reg'] = '通行證名已經被註冊';
$L['member_password_null'] = '會員登錄密碼不能為空';
$L['member_password_match'] = '兩次輸入的密碼不一致';
$L['member_password_len'] = '登錄密碼長度應在{V0}-{V1}之間';
$L['member_payword_null'] = '支付密碼不能為空';
$L['member_payword_match'] = '兩次輸入的密碼不一致';
$L['member_payword_len'] = '支付密碼長度應在{V0}-{V1}之間';
$L['member_groupid_null'] = '請選擇會員組';
$L['member_truename_null'] = '請填寫真實姓名';
$L['member_email_null'] = 'Email格式不正確';
$L['member_email_ban'] = '此郵件域名已經被禁止註冊';
$L['member_email_reg'] = '郵件地址已經存在';
$L['member_areaid_null'] = '請選擇所在地區';
$L['member_company_null'] = '請填寫公司名稱';
$L['member_company_bad'] = '無效的公司名稱';
$L['member_company_reg'] = '公司名稱已經存在';
$L['member_company_ban'] = '此公司名已經被禁止註冊';
$L['member_type_null'] = '請選擇公司類型';
$L['member_telephone_null'] = '請填寫公司電話';
$L['member_regyear_null'] = '請填寫公司註冊年份';
$L['member_address_null'] = '請填寫公司地址';
$L['member_introduce_null'] = '公司介紹不能少於5字';
$L['member_business_null'] = '請填寫公司主要經營範圍';
$L['member_catid_null'] = '請選擇公司主營行業';
$L['member_login_username_bad'] = '用戶名格式錯誤';
$L['member_login_password_bad'] = '密碼錯誤,請重試';
$L['member_login_not_member'] = '會員不存在';
$L['member_login_ban'] = '累計{V0}次錯誤嘗試 您在{V1}小時內不能登錄系統';
$L['member_login_member_ban'] = '該帳號已被禁止訪問';
$L['member_login_ok'] = '成功';
$L['member_founder_del'] = '創始人不可刪除';
$L['member_founder_move'] = '創始人不可移動';
$L['member_rename_not_member'] = '當前會員名不存在';
$L['member_record_reg'] = '註冊獎勵';
$L['member_record_login'] = '登錄獎勵';

$L['message_title'] = '站內信';
$L['message_title_black'] = '黑名單';
$L['message_title_inbox'] = '收件箱';
$L['message_title_outbox'] = '已發送';
$L['message_title_draft'] = '草稿箱';
$L['message_title_recycle'] = '回收站';
$L['message_limit'] = '今日可發送{V0}次 當前已發送{V1}次';
$L['message_send_max'] = '最多同時給{V0}個人發送信件';
$L['message_list_date'] = 'Y年m月d日 H:i';
$L['message_from_system'] = '系統信使';
$L['message_from_notice'] = '系統廣播';
$L['message_names'] = array(1=>'草稿箱', 2=>'已發送', 3=>'收件箱', 4=>'回收站');
$L['message_feedback_title'] = '您的來信 [{V0}] 已經閱讀';
$L['message_feedback_content'] = '{V0} 於 <small style="color:blue;">{V1}</small> 閱讀了您發送的信件<br/><div style="padding:10px;margin:10px 10px 0 0;border-left:#E5EBFA 3px solid;line-height:180%;background:#FFFFFF;"><strong>標題:</strong>{V2}<br/><strong>時間:</strong>{V3}<br/><strong>原文:</strong><br/>{V4}</div>';
$L['message_msg_edit'] = '信件不存在或無權修改';
$L['message_msg_null'] = '指定範圍暫無信件';
$L['message_msg_save_draft'] = '草稿保存成功';
$L['message_msg_edit_draft'] = '草稿修改成功';
$L['message_msg_send'] = '信件發送成功';
$L['message_msg_choose'] = '請選擇信件';
$L['message_msg_deny'] = '信件不存在或無權限';
$L['message_msg_clear'] = '成功清空';
$L['message_msg_mark'] = '已標記為已讀';
$L['message_msg_restore'] = '成功還原';
$L['message_msg_empty'] = '清理成功';
$L['message_msg_inbox_limit'] = '收件箱已滿，請清理信件';
$L['message_black_username'] = '請指定要加入黑名單的會員';
$L['message_black_not_member'] = '會員不存在，請檢查';
$L['message_black_exist'] = '會員已經位於黑名單';
$L['message_black_update'] = '黑名單更新成功';
$L['message_pass_groupid'] = '請選擇會員組';
$L['message_pass_touser'] = '收件人不能為空';
$L['message_pass_title'] = '標題或內容不能為空';

$L['news_title'] = '公司新聞';
$L['news_title_add'] = '添加新聞';
$L['news_title_edit'] = '修改新聞';
$L['news_record_add'] = '新聞發佈';
$L['news_record_del'] = '新聞刪除';
$L['news_msg_choose'] = '請選擇新聞';

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

$L['pay_title'] = '站內支付';
$L['pay_record_view'] = '信息查看';
$L['pay_msg_fee'] = '支付金額錯誤';

$L['record_title'] = $DT['money_name'].'流水';
$L['record_title_login'] = '登錄記錄';
$L['record_title_pay'] = '信息查看記錄';
$L['record_sfields'] = array($L['search_by'], '金額', '銀行', '事由', $L['search_by_note']);

$L['register_title'] = '會員註冊';
$L['register_msg_close'] = '管理員關閉了用戶註冊';
$L['register_msg_agent'] = '您的客戶端信息已經被網站屏蔽<br/>如有疑問，請與我們聯繫';
$L['register_msg_ip'] = '同一IP{V0}小時內只能註冊一次';
$L['register_msg_passport'] = '通行證名已經存在\n\n如果此通行證名是您註冊的，請填寫正確的密碼\n\n如果不是您註冊的，請更換通行證名';
$L['register_msg_activate'] = $DT['sitename'].'用戶註冊激活信';
$L['register_msg_welcome'] = '歡迎加入'.$DT['sitename'];
$L['register_pass_groupid'] = '請選擇會員組';

/*2010-10-25<<*/
$L['register_msg_emailcode'] = $DT['sitename'].'用戶註冊郵件驗證碼';
$L['register_pass_emailcode'] = '郵件驗證碼錯誤';
/*2010-10-25>>*/

$L['renew_title'] = VIP.'服務續費';
$L['renew_msg_fee'] = '支付金額錯誤';
$L['renew_msg_success'] = '續費成功';
$L['renew_record'] = '{V0}年,{V1}到期';

$L['send_mail_close'] = '系統未開啟郵件發送';
$L['send_sms_close'] = '系統未開啟短信發送';

$L['send_check_success'] = '您的帳號激活成功';
$L['send_check_email_bad'] = '請填寫正確的郵件地址';
$L['send_check_email_repeat'] = '您填寫的郵件地址已經被使用，請更換';
$L['send_check_username_bad'] = '您的會員名輸入錯誤';
$L['send_check_password_bad'] = '您的會員名和密碼不匹配';
$L['send_check_deny'] = '您的帳號無需發送驗證信';
$L['send_check_mail'] = $DT['sitename'].'用戶註冊激活信';
$L['send_check_username_null'] = '您輸入會員名不存在';
$L['send_check_title'] = '重發驗證信';
$L['send_payword_success'] = '支付密碼重設成功';
$L['send_payword_mail'] = $DT['sitename'].'用戶修改支付密碼';
$L['send_payword_title'] = '支付密碼';
$L['send_email_exist'] = 'Email地址已經被使用，請更換';
$L['send_email_success'] = 'Email重設成功';
$L['send_email_mail'] = $DT['sitename'].'用戶修改Email';
$L['send_email_title'] = '修改Email';
$L['send_mobile_exist'] = '手機號碼已經被佔用，請更換';
$L['send_mobile_fail'] = '短信發送失敗，請重試';
$L['send_mobile_success'] = '手機修改成功';
$L['send_mobile_code_error'] = '認證碼錯誤';
$L['send_mobile_bad'] = '手機號碼格式不正確';
$L['send_mobile_record'] = '修改手機';
$L['send_mobile_title'] = '修改手機';
$L['send_password_success'] = '登錄密碼重設成功';
$L['send_password_checking'] = '您的帳號尚未通過審核';
$L['send_password_error'] = '提供的信息不匹配';
$L['send_password_mail'] = $DT['sitename'].'用戶找回密碼';
$L['send_password_title'] = '找回密碼';

$L['sendmail_title'] = '發送電子郵件';
$L['sendmail_content'] = '您的好友 <strong><a href="{V0}" target="_blank">{V1}</a></strong> 向您推薦如下信息:<br/><br/>{V2}<br/><a href="{V3}" target="_blank">{V3}</a><br/><br/>附言：';
$L['sendmail_title_new'] = '推薦《{V0}》';
$L['sendmail_pass_mailto'] = '請填寫正確的收件人地址';
$L['sendmail_success'] = '郵件已發送至{V0}';
$L['sendmail_fail'] = '郵件發送失敗，請重試';

$L['sms_msg_validate'] = '請先認證您的手機號碼';
$L['sms_msg_buy'] = '請先購買短信';
$L['sms_msg_mobile'] = '請填寫正確的手機號碼';
$L['sms_msg_content'] = '請填寫短信內容';
$L['sms_add_record'] = '手動';
$L['sms_add_success'] = '成功發送{V0}條短信';
$L['sms_add_title'] = '發送短信';
$L['sms_msg_no_price'] = '系統未設置單價，無法購買';
$L['sms_msg_buy_num'] = '請填寫購買數量';
$L['sms_buy_note'] = '購買短信';
$L['sms_buy_record'] = '在線購買';
$L['sms_buy_success'] = '購買成功';
$L['sms_buy_title'] = '短信購買';
$L['sms_record_title'] = '接收記錄';
$L['sms_send_title'] = '發送記錄';
$L['sms_title'] = '短信記錄';
$L['sms_sfields'] = array($L['search_by'], '金額', '事由', $L['search_by_note']);

$L['type_title'] = '{V0}分類管理';
$L['type_names'] = array('friend'=>'商友', 'favorite'=>'收藏', 'product'=>'供應', 'mall'=>'商品', 'news'=>'新聞');
$L['type_msg_limit'] = '最多可添加{V0}個分類';

$L['style_title'] = '模板設置';
$L['style_title_buy'] = '模板購買';
$L['style_sfields'] = array($L['search_by'], '名稱', '作者');
$L['style_sorder'] = array($L['order_by'], '添加時間降序', '添加時間升序', '人氣指數降序', '人氣指數升序');
$L['style_record_buy'] = '{V0}模板購買{V1}月';
$L['style_msg_not_exist'] = '模板不存在';
$L['style_msg_group'] = '抱歉！此模板未對您所在的會員組開放';
$L['style_msg_month'] = '請選擇購買時長';
$L['style_msg_buy_success'] = '模板購買成功';
$L['style_msg_use_success'] = '模板啟用成功';
$L['style_pass_title'] = '請填寫模板名稱';
$L['style_pass_skin'] = '請填寫風格目錄';
$L['style_pass_skin_match'] = '只能使用字母(A-Z,a-z)、數字(0-9)、中劃線(-)、下劃線(_)作為風格目錄名稱';
$L['style_pass_css'] = 'CSS文件不存在';
$L['style_pass_template'] = '請填寫模板目錄';
$L['style_pass_template_match'] = '只能使用字母(A-Z,a-z)、數字(0-9)、中劃線(-)、下劃線(_)作為模板目錄名稱';
$L['style_pass_dir'] = '模板目錄不存在';
$L['style_pass_groupid'] = '請選擇會員組';

$L['trade_status'] = array(
	'<span style="color:#0000FF;">買家發起訂單<br/>等待賣家確認</span>',
	'<span style="color:#FF6600;">賣家已確認訂單<br/>等待買家付款</span>',
	'<span style="color:#008080;">買家已付款<br/>等待賣家發貨</span>',
	'<span style="color:#FF0000;">賣家已發貨<br/>等待買家確認</span>',
	'<span style="color:#008000;">交易成功</span>',
	'<span style="color:#FF0000;text-decoration:underline;">買家申請退款</span>',
	'<span style="color:#0000FF;text-decoration:underline;">已退款給買家</span>',
	'<span style="color:#FF6600;text-decoration:underline;">已付款給賣家</span>',
	'<span style="color:#888888;text-decoration:line-through;">買家關閉交易</span>',
	'<span style="color:#888888;text-decoration:line-through;">賣家關閉交易</span>',
);
$L['trade_dstatus'] = array(
	'買家發起訂單,等待賣家確認',
	'賣家已確認訂單,等待買家付款',
	'買家已付款,等待賣家發貨',
	'賣家已發貨,等待買家確認',
	'交易成功',
	'買家申請退款',
	'已退款給買家',
	'已付款給賣家',
	'買家關閉交易',
	'賣家關閉交易',
);
$L['trade_msg_deny'] = '您無權進行此操作';
$L['trade_msg_null'] = '訂單不存在';
$L['trade_price_fee_null'] = '請填寫附加金額';
$L['trade_price_fee_name'] = '請填寫附加金額名稱';
$L['trade_price_edit_success'] = '訂單修改成功';
$L['trade_price_title'] = '修改價格';
$L['trade_detail_title'] = '訂單詳情';
$L['trade_confirm_success'] = '訂單已確認，請等待買家付款';
$L['trade_pay_order_success'] = '支付成功，金額暫時被鎖定，請等待賣家發貨';
$L['trade_pay_order_title'] = '訂單支付';
$L['trade_refund_reason'] = '請填寫理由及證據';
$L['trade_refund_success'] = '您的退款申請已經提交，請等待網站處理';
$L['trade_refund_title'] = '申請退款';
$L['trade_send_success'] = '已經確認發貨，請等待買家確認收貨';
$L['trade_send_title'] = '確認發貨';
$L['trade_receive_title'] = '確認到貨';
$L['trade_addtime_null'] = '請填寫延長的時間';
$L['trade_addtime_success'] = '買家確認時間延長成功';
$L['trade_addtime_title'] = '延長買家確認時間';
$L['trade_success'] = '恭喜！此訂單交易成功';
$L['trade_close_success'] = '交易已關閉';
$L['trade_delete_success'] = '訂單刪除成功';
$L['trade_pay_seller'] = '請填寫收款會員名';
$L['trade_pay_self'] = '收款人不能是自己';
$L['trade_pay_seller_bad'] = '收款會員名不存在，請確認';
$L['trade_pay_amount'] = '請填寫付款金額';
$L['trade_pay_note'] = '請填寫付款說明';
$L['trade_pay_goods'] = '請填寫商品或服務名稱';
$L['trade_pay_title'] = '我要付款';
$L['trade_pay1_success'] = '直接付款成功，會員[{V0}]將直接收到您的付款';
$L['trade_pay0_success'] = '訂單已經發出，請等待賣家確認';
$L['trade_order_sfields'] = array('按條件', '商品', '金額', '附加金額', '附加名稱', '賣家', '發貨方式', '物流號碼', '備註');
$L['trade_order_title'] = '發出的訂單';
$L['trade_sfields'] = array('按條件', '商品', '金額', '附加金額', '附加名稱', '買家', '買家姓名', '買家地址', '買家郵編', '買家手機', '買家電話', '發貨方式', '物流號碼', '備註');
$L['trade_title'] = '收到的訂單';
$L['trade_record_pay'] = '訂單貨到付款';
$L['trade_record_payfor'] = '站內付款';
$L['trade_record_receive'] = '站內收款';
$L['trade_record_new'] = '通知賣家確認訂單';
$L['trade_order_id'] = '訂單號:';
$L['trade_buyer_timeout'] = '訂單號{V0}[買家超時]';
$L['trade_sms_confirm'] = '通知買家付款';
$L['trade_sms_pay'] = '通知賣家發貨';
$L['trade_sms_send'] = '通知買家已發貨';
$L['trade_sms_income'] = '站內付款通知';
$L['trade_sms_receive'] = '通知賣家已收貨';
$L['trade_message_t1'] = '站內交易提醒，您有一筆交易需要付款(T{V0})';
$L['trade_message_c1'] = '賣家 <a href="{V0}" class="t">{V1}</a> 於 <span class="f_gray">{V2}</span> 確認了您的訂單<br/><a href="{V3}" class="t" target="_blank">&raquo; 請點這裡立即處理或查看詳情</a>';
$L['trade_message_t2'] = '站內交易提醒，您有一筆交易需要發貨(T{V0})';
$L['trade_message_c2'] = '買家 <a href="{V0}" class="t">{V1}</a> 於 <span class="f_gray">{V2}</span> 支付了您的訂單<br/><a href="{V3}" class="t" target="_blank">&raquo; 請點這裡立即處理或查看詳情</a>';
$L['trade_message_t3'] = '站內交易提醒，您有一筆交易需要收貨(T{V0})';
$L['trade_message_c3'] = '賣家 <a href="{V0}" class="t">{V1}</a> 於 <span class="f_gray">{V2}</span> 已經發貨<br/><a href="{V3}" class="t" target="_blank">&raquo; 請點這裡立即處理或查看詳情</a>';
$L['trade_message_t4'] = '站內交易提醒，您有一筆交易已經成功(T{V0})';
$L['trade_message_c4'] = '買家 <a href="{V0}" class="t">{V1}</a> 於 <span class="f_gray">{V2}</span> 確認收貨，交易完成<br/><a href="{V3}" class="t" target="_blank">&raquo; 請點這裡立即處理或查看詳情</a>';
$L['trade_message_t5'] = '站內收入提醒，您收到一筆付款';
$L['trade_message_c5'] = '<a href="{V0}" class="t">{V1}</a> 於 <span class="f_gray">{V2}</span> 向您支付了 <span class="f_blue">{V3}'.$DT['money_unit'].'</span> 的站內付款<br/>備註：<span class="f_gray">{V4}</span>';
$L['trade_message_t6'] = '站內交易提醒，您有一筆交易需要確認(T{V0})';
$L['trade_message_c6'] = '<a href="{V0}" class="t">{V1}</a> 於 <span class="f_gray">{V2}</span> 向您訂購了：<br/>{V3}<br/>訂單編號：<span class="f_red">T{V4}</span> &nbsp;訂單金額為：<span class="f_blue f_b">{V5}'.$DT['money_unit'].'</span><br/><a href="{V6}" class="t" target="_blank">&raquo; 請點這裡立即處理或查看詳情</a>';

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

$L['validate_email_exist'] = 'Email地址已經被使用，請更換';
$L['validate_email_success'] = '您的郵件認證成功';
$L['validate_email_bad'] = 'Email格式不正確';
$L['validate_email_mail'] = $DT['sitename'].'用戶郵件認證';
$L['validate_email_title'] = '郵件認證';
$L['validate_mobile_exist'] = '手機號碼已經被佔用，請更換';
$L['validate_mobile_title'] = '手機認證';
$L['validate_mobile_success'] = '您的手機認證成功';
$L['validate_mobile_fail'] = '短信發送失敗，請重試';
$L['validate_mobile_code_error'] = '認證碼錯誤';
$L['validate_mobile_bad'] = '手機號碼格式不正確';
$L['validate_mobile_record'] = '手機認證';
$L['validate_truename_title'] = '實名認證';
$L['validate_truename_name'] = '請填寫真實姓名';
$L['validate_truename_image'] = '請上傳證件圖片';
$L['validate_truename_success'] = '提交成功';
$L['validate_company_title'] = '公司認證';
$L['validate_company_name'] = '請填寫公司名';
$L['validate_company_image'] = '請上傳證件圖片';
$L['validate_company_success'] = '提交成功';
$L['validate_bank_title'] = '銀行帳號認證';

$L['oauth_title'] = '一鍵登錄';
$L['oauth_quit'] = '解除成功';

$L['support_title'] = '客服專員';
$L['support_error_1'] = '系統暫未為您分配客服專員';
$L['support_error_2'] = '客服專員不存在，請與網站聯繫';
?>