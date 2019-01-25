<?php

return [

	'id' => '编号',
	'yes' => '是',
	'no' => '否',
	'reset' => '重置',
	'ok' => '确定',
	'cancel' => '取消',
	'create' => '添加',
	'edit' => '编辑',
	'update' => '更新',
	'destroy' => '删除',
    'view' => '查看',
	'photo' => '图片',
	'displayorder' => '排序',
	'operation' => '操作',
	'search' => '搜索',
	'recycle' => '回收站',
	'restore' => '恢复',
	'created_at' => '添加时间',
	'updated_at' => '最后修改',
	'deleted_at' => '删除时间',
    'cache.updatesucceed' => '缓存更新成功',
	'undefined.operation' => '未选择对应操作',

    'profileinfo.username' => '用户名',
    'profileinfo.lastlogin' => '上次登录时间',
    'profileinfo.lastip' => '上次登录 IP',
    'profileinfo.logincount' => '登录次数',

    'promotion' => '推荐注册',
    'promotion.tips' => '您可以在此处对推荐注册进行管理',
    'promotion.rule' => '推荐规则',
    'promotion.card' => '推荐办卡记录',
    'promotion.first' => '一级下线',
    'promotion.second' => '二级下线',
    'promotion.username' => '用户名',
    'promotion.consume_money' => '消费金额',
    'promotion.created_at' => '开卡时间',

    'sellcard' => '面对面办卡',
    'sellcard.tips' => '您可以在此处对面对面办卡进行管理',
    'sellcard.pay_type.wechat' => '微信支付',
    'sellcard.pay_type.alipay' => '支付宝支付',

    'bindcard' => '在线绑卡',
    'bindcard.tips' => '您可以在此处对绑卡信息进行管理',
    'bindcard.number' => '卡号',
    'bindcard.password' => '密码',
    'bindcard.passwordwrong' => '密码错误',
    'bindcard.bound' => '此卡号已被绑定',
    'bindcard.created_at' => '时间',
    'bindcard.updatesucceed' => '在线绑卡成功',

    'ordercard' => '我的办卡',
    'ordercard.tips' => '您可以在此处对办卡记录进行管理',
    'ordercard.consignee' => '收货人',
    'ordercard.order_amount' => '实付款',
    'ordercard.remark' => '备注',
    'ordercard.order_type' => '办卡方式',
    'ordercard.order_type_0' => '上门办卡',
    'ordercard.order_type_1' => '邮寄办卡',
    'ordercard.order_sn' => '订单编号',
    'ordercard.status' => '状态',
    /*
     * order_status  	    订单状态：0未确认,1已关闭,2已成功
     * shipping_status  	配送状态：0未发货,1已发货,2已收货,3退货中,4已退货
     * pay_status   	    支付状态：0未付款;1已付款,2退款中,3已退款
     * status = order_status.shipping_status.pay_status
     */
    'ordercard.status_000' => '待付款',
    'ordercard.status_001' => '待发货',
    'ordercard.status_011' => '待收货',
    'ordercard.status_021' => '已收货',
    'ordercard.status_100' => '已关闭',
    'ordercard.status_103' => '已关闭',
    'ordercard.status_113' => '已关闭',
    'ordercard.status_123' => '已关闭',
    'ordercard.status_221' => '已成功',
    'ordercard.postip' => 'IP',
    'ordercard.created_at' => '下单时间',
    'ordercard.pay_at' => '付款时间',
    'ordercard.shipping_at' => '发货时间',
    'ordercard.finish_at' => '完成时间',
    'ordercard.visit.realname' => '业务员姓名',
    'ordercard.visit.mobile' => '手机号码',
    'ordercard.visit.remark' => '备注信息',
    'ordercard.shipping.shipping_id' => '物流公司',
    'ordercard.shipping.waybill' => '运单号码',
    'ordercard.shipping.remark' => '备注信息',
    'ordercard.cancelfailed' => '取消订单失败',
    'ordercard.cancelsucceed' => '取消订单成功',

    'ordermeal' => '点餐管理',
    'ordermeal.tips' => '您可以在此处对点餐记录进行管理',
    'ordermeal.meal' => '点餐菜品',
    'ordermeal.order_amount' => '实付款',
    'ordermeal.remark' => '备注',
    'ordermeal.order_sn' => '订单编号',
    'ordermeal.pay_at' => '付款时间',
    'ordermeal.status' => '状态',
    /*
     * order_status  	    订单状态：0未确认,1已关闭,2已成功
     * pay_status   	    支付状态：0未付款;1已付款,2退款中,3已退款
     * status = order_status.pay_status
     */
    'ordermeal.status_00' => '待付款',
    'ordermeal.status_01' => '待确认',
    'ordermeal.status_10' => '已关闭',
    'ordermeal.status_13' => '已关闭',
    'ordermeal.status_21' => '已成功',
    'ordermeal.postip' => 'IP',
    'ordermeal.created_at' => '时间',

    'orderfarm' => '农家乐管理',
    'orderfarm.tips' => '您可以在此处对农家乐记录进行管理',
    'orderfarm.farm_name' => '农家乐名称',
    'orderfarm.package_name' => '套餐名称',
    'orderfarm.order_amount' => '实付款',
    'orderfarm.remark' => '备注',
    'orderfarm.order_sn' => '订单编号',
    'orderfarm.pay_at' => '付款时间',
    'orderfarm.status' => '状态',
    /*
     * order_status  	    订单状态：0未确认,1已关闭,2已成功
     * pay_status   	    支付状态：0未付款;1已付款,2退款中,3已退款
     * status = order_status.pay_status
     */
    'orderfarm.status_00' => '待付款',
    'orderfarm.status_01' => '待确认',
    'orderfarm.status_10' => '已关闭',
    'orderfarm.status_13' => '已关闭',
    'orderfarm.status_21' => '已成功',
    'orderfarm.postip' => 'IP',
    'orderfarm.created_at' => '时间',

    'consume' => '消费账单',
    'consume.tips' => '您可以在此处对消费账单进行管理',
    'consume.shop' => '消费店铺',
    'consume.consume_money' => '消费金额',
    'consume.order_amount' => '应付金额',
    'consume.status' => '状态',
    'consume.status_0' => '待付款',
    'consume.status_1' => '已付款',
    'consume.created_at' => '时间',
    'consume.updatesucceed' => '消费账单修改成功',

    'collection' => '我的收藏',
    'collection.tips' => '您可以在此处对收藏记录进行管理',
    'collection.shop' => '收藏店铺',
    'collection.shop.phone' => '店铺电话',
    'collection.shop.address' => '店铺地址',
    'collection.shop.discount' => '店铺折扣',
    'collection.created_at' => '时间',
    'collection.updatesucceed' => '收藏记录修改成功',
    'collection.deletesucceed' => '取消收藏成功',

    'history' => '浏览历史',
    'history.tips' => '您可以在此处对浏览记录进行管理',
    'history.shop' => '浏览店铺',
    'history.shop.phone' => '店铺电话',
    'history.shop.address' => '店铺地址',
    'history.shop.discount' => '店铺折扣',
    'history.created_at' => '时间',
    'history.updatesucceed' => '浏览记录修改成功',
    'history.deletesucceed' => '取消浏览记录成功',

    'score' => '我的积分',
    'score.tips' => '您可以在此处对积分记录进行管理',
    'score.list' => '积分记录',
    'score.exchange' => '积分换钱',
    'score.transfer' => '积分转让',
    'score.remark' => '备注信息',
    'score.score' => '积分数',
    'score.created_at' => '时间',
    'score.updatesucceed' => '积分记录修改成功',
    'score.exchangesucceed' => '积分兑换成功',
    'score.transfersucceed' => '积分转让成功',

    'cardreward' => '售卡兑奖',
    'cardreward.tips' => '您可以在此处对售卡兑奖记录进行管理',
    'cardreward.list' => '奖品列表',
    'cardreward.myreward' => '我的兑奖',

    'redpack' => '红包管理',
    'redpack.tips' => '您可以在此处对红包进行管理',
    'redpack.list' => '红包列表',
    'redpack.name' => '红包名称',
    'redpack.amount' => '红包金额',
    'redpack.fullamount' => '红包满额',
    'redpack.use_time' => '使用时间',
    'redpack.use_start' => '使用开始时间',
    'redpack.use_end' => '使用结束时间',
    'redpack.remark' => '备注信息',

    'sign' => '签到记录',
    'sign.tips' => '您可以在此处对签到记录进行管理',
    'sign.remark' => '备注信息',
    'sign.score' => '积分数',
    'sign.created_at' => '时间',
    'sign.updatesucceed' => '签到记录修改成功',

    'appoint' => '预约订座',
    'appoint.tips' => '您可以在此处对预约信息进行管理',
    'appoint.cancel' => '取消预约',
    'appoint.shop' => '预约店铺',
    'appoint.number' => '预约人数',
    'appoint.realname' => '姓名',
    'appoint.mobile' => '手机',
    'appoint.appoint_at' => '预约时间',
    'appoint.remark' => '备注要求',
    'appoint.reason' => '处理原因',
    'appoint.status' => '状态',
    'appoint.status_0' => '待处理',
    'appoint.status_1' => '已接受',
    'appoint.status_2' => '已拒绝',
    'appoint.status_3' => '已取消',
    'appoint.created_at' => '时间',
    'appoint.updatesucceed' => '积分记录修改成功',

    'profile' => '个人资料修改',
    'profile.tips' => '您可以在此处对个人资料进行修改',
    'profile.username' => '用户名',
    'profile.realname' => '真实姓名',
    'profile.mobile' => '手机号码',
    'profile.gender' => '性别',
    'profile.email' => '邮箱',
    'profile.birthday' => '出生日期',
    'profile.marry' => '婚姻状况',
    'profile.hobby' => '兴趣爱好',
    'profile.stage' => '正处阶段',
    'profile.occupation' => '职业',
    'profile.workarea' => '工作地区',
    'profile.addsucceed' => '个人资料保存成功',
    'profile.updatesucceed' => '个人资料修改成功',

    'password' => '密码修改',
    'password.tips' => '您必须填写原密码才能修改下面的资料',
    'password.old' => '旧密码',
    'password.new' => '新密码',
    'password.confirm' => '确认新密码',
    'password.updatesucceed' => '密码修改成功',

    'address' => '收货地址管理',
    'address.tips' => '您可以在此处对收货地址进行管理查看。',
    'address.list' => '收货地址列表',
    'address.create' => '添加收货地址',
    'address.edit' => '编辑收货地址',
    'address.destroy' => '删除收货地址',
    'address.realname' => '收货人',
    'address.area' => '所在地区',
    'address.address' => '详细地址',
    'address.zipcode' => '邮政编码',
    'address.mobile' => '手机号码',
    'address.default' => '设为默认',
    'address.limited' => '收货地址数量超出限制',
    'address.editsucceed' => '收货地址编辑成功',
    'address.addsucceed' => '收货地址添加成功',
    'address.updatesucceed' => '收货地址更新成功',
    'address.deletesucceed' => '收货地址删除成功',

    'binding' => '账号绑定',
    'binding.tips' => '您可以在此处查看账号绑定信息',
];
