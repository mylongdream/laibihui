<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['domain' => 'zhihui.hztbg.com'], function () {

    Route::get('/', ['as' => 'index', 'uses' => 'Brand\IndexController@index']);
    Route::get('/promotion/{fromuser}', ['as' => 'promotion', 'uses' => 'Brand\IndexController@promotion']);

    Route::get('allcity.html', ['as' => 'page.allcity', 'uses' => 'Brand\PageController@allcity']);
    Route::get('card', ['as' => 'brand.card.index', 'uses' => 'Brand\CardController@index']);
    Route::any('card/order.html', ['as' => 'brand.card.order', 'uses' => 'Brand\CardController@order'])->middleware('auth');
    Route::any('card/address/info.html', ['as' => 'brand.card.addressinfo', 'uses' => 'Brand\CardController@addressinfo'])->middleware('auth');
    Route::any('card/address/list.html', ['as' => 'brand.card.addresslist', 'uses' => 'Brand\CardController@addresslist'])->middleware('auth');
    Route::any('card/pay/{id}.html', ['as' => 'brand.card.pay', 'uses' => 'Brand\CardController@pay'])->middleware('auth');
    Route::any('card/active.html', ['as' => 'brand.card.active', 'uses' => 'Brand\CardController@active']);

    Route::get('shop', ['as' => 'brand.shop.index', 'uses' => 'Brand\ShopController@index']);
    Route::get('shop/{id}.html', ['as' => 'brand.shop.show', 'uses' => 'Brand\ShopController@show'])->where('id', '[0-9]+');
    Route::get('shop/{id}/product', ['as' => 'brand.shop.product', 'uses' => 'Brand\ShopController@product'])->where('id', '[0-9]+');
    Route::any('shop/{id}/comment', ['as' => 'brand.shop.comment', 'uses' => 'Brand\ShopController@comment'])->where('id', '[0-9]+');
    Route::any('shop/{id}/appoint', ['as' => 'brand.shop.appoint', 'uses' => 'Brand\ShopController@appoint'])->where('id', '[0-9]+');
    Route::get('shop/{id}/collection', ['as' => 'brand.shop.collection', 'uses' => 'Brand\ShopController@collection'])->where('id', '[0-9]+');
    Route::get('shop/{id}/qrcode', ['as' => 'brand.shop.qrcode', 'uses' => 'Brand\ShopController@qrcode'])->where('id', '[0-9]+');
    Route::get('product', ['as' => 'brand.product.index', 'uses' => 'Brand\ProductController@index'])->where('id', '[0-9]+');
    Route::get('product/{id}.html', ['as' => 'brand.product.detail', 'uses' => 'Brand\ProductController@detail'])->where('id', '[0-9]+');

    Route::get('farm', ['as' => 'brand.farm.index', 'uses' => 'Brand\FarmController@index']);
    Route::get('farm/lists.html', ['as' => 'brand.farm.lists', 'uses' => 'Brand\FarmController@lists']);
    Route::get('farm/{id}.html', ['as' => 'brand.farm.show', 'uses' => 'Brand\FarmController@show'])->where('id', '[0-9]+');
    Route::any('farm/{id}/order.html', ['as' => 'brand.farm.order', 'uses' => 'Brand\FarmController@order'])->where('id', '[0-9]+')->middleware('auth');
    Route::any('farm/pay/{id}.html', ['as' => 'brand.farm.pay', 'uses' => 'Brand\FarmController@pay'])->middleware('auth');

    Route::get('announce', ['as' => 'announce.index', 'uses' => 'Brand\AnnounceController@index']);
    Route::get('announce/{id}.html', ['as' => 'announce.show', 'uses' => 'Brand\AnnounceController@show'])->where('id', '[0-9]+');
    Route::get('faq.html', ['as' => 'about.faq', 'uses' => 'Brand\AboutController@faq']);
    Route::get('join.html', ['as' => 'about.join', 'uses' => 'Brand\AboutController@join']);
    Route::get('legal.html', ['as' => 'about.legal', 'uses' => 'Brand\AboutController@legal']);
    Route::get('contact.html', ['as' => 'about.contact', 'uses' => 'Brand\AboutController@contact']);

    Route::post('util/smscode', ['as' => 'util.smscode', 'uses' => 'Util\SmscodeController@index']);
    Route::get('util/district', ['as' => 'util.district', 'uses' => 'Util\DistrictController@index']);
    Route::get('upload/image/{month}/{day}/{name}', ['as' => 'upload.image', 'uses' => 'Util\UploadController@image']);
    Route::get('upload/thumb/{month}/{day}/{name}', ['as' => 'upload.thumb', 'uses' => 'Util\UploadController@thumb']);
    Route::get('upload/video/{url}', ['as' => 'upload.video', 'uses' => 'Util\UploadController@video']);
    Route::get('check/username', ['as' => 'check.username', 'uses' => 'Util\CheckController@username']);
    Route::get('check/mobile/register', ['as' => 'check.mobile.register', 'uses' => 'Util\CheckController@mobileRegister']);
    Route::get('check/mobile/reset', ['as' => 'check.mobile.reset', 'uses' => 'Util\CheckController@mobileReset']);
    Route::get('check/card/number', ['as' => 'check.card.number', 'uses' => 'Util\CheckController@cardNumber']);
    Route::get('check/card/password', ['as' => 'check.card.password', 'uses' => 'Util\CheckController@cardPassword']);
    Route::get('check/smscode', ['as' => 'check.smscode', 'uses' => 'Util\CheckController@smscode']);

    Route::group(['prefix' => 'mall', 'as' => 'mall.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Mall\IndexController@index']);
    Route::get('product', ['as' => 'product.index', 'uses' => 'Mall\ProductController@index']);
    Route::get('product/{id}.html', ['as' => 'product.detail', 'uses' => 'Mall\ProductController@detail'])->where('id', '[0-9]+');
    });

    Route::group(['prefix' => 'auth'], function () {
        Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
        Route::post('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@register']);
        Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
        Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
        Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
        //Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
        //Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
        //Route::get('password/reset/{token}', ['as' => 'password.reseturl', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
        //Route::post('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@reset']);
        Route::get('forgotpwd/reset', ['as' => 'forgotpwd.reset', 'uses' => 'Auth\MobilePasswordController@showLinkRequestForm']);
        Route::post('forgotpwd/mobile', ['as' => 'forgotpwd.mobile', 'uses' => 'Auth\MobilePasswordController@sendResetLinkMobile']);
        Route::get('forgotpwd/reset/{token}', ['as' => 'forgotpwd.reseturl', 'uses' => 'Auth\MobilePasswordController@showResetForm']);
        Route::post('forgotpwd/reset', ['as' => 'forgotpwd.reset', 'uses' => 'Auth\MobilePasswordController@reset']);

        Route::group(['as' => 'auth.'], function () {
            Route::get('qq', ['as' => 'qq.index', 'uses' => 'Auth\QqController@index']);
            Route::get('qq/callback', ['as' => 'qq.callback', 'uses' => 'Auth\QqController@callback']);
            Route::post('qq/login', ['as' => 'qq.login', 'uses' => 'Auth\QqController@login']);
            Route::post('qq/register', ['as' => 'qq.register', 'uses' => 'Auth\QqController@register']);
            Route::get('wxweb', ['as' => 'wxweb.index', 'uses' => 'Auth\WeixinWebController@index']);
            Route::get('wxweb/callback', ['as' => 'wxweb.callback', 'uses' => 'Auth\WeixinWebController@callback']);
            Route::post('wxweb/login', ['as' => 'wxweb.login', 'uses' => 'Auth\WeixinWebController@login']);
            Route::post('wxweb/register', ['as' => 'wxweb.register', 'uses' => 'Auth\WeixinWebController@register']);
            Route::get('weibo', ['as' => 'weibo.index', 'uses' => 'Auth\WeiboController@index']);
            Route::get('weibo/callback', ['as' => 'weibo.callback', 'uses' => 'Auth\WeiboController@callback']);
            Route::post('weibo/login', ['as' => 'weibo.login', 'uses' => 'Auth\WeiboController@login']);
            Route::post('weibo/register', ['as' => 'weibo.register', 'uses' => 'Auth\WeiboController@register']);
        });
    });

    Route::group(['prefix' => 'user', 'middleware' => ['auth.user'], 'as' => 'user.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'User\IndexController@index']);
        Route::get('sign', ['as' => 'sign.index', 'uses' => 'User\SignController@index']);
        Route::post('sign', ['as' => 'sign.store', 'uses' => 'User\SignController@store']);
        Route::any('bindcard', ['as' => 'bindcard.index', 'uses' => 'User\BindCardController@index']);
        Route::get('ordercard', ['as' => 'ordercard.index', 'uses' => 'User\OrderCardController@index']);
        Route::get('ordercard/{id}', ['as' => 'ordercard.show', 'uses' => 'User\OrderCardController@show']);
        Route::any('ordercard/{id}/cancel', ['as' => 'ordercard.cancel', 'uses' => 'User\OrderCardController@cancel']);
        Route::get('ordermeal', ['as' => 'ordermeal.index', 'uses' => 'User\OrderMealController@index']);
        Route::get('ordermeal/{id}', ['as' => 'ordermeal.show', 'uses' => 'User\OrderMealController@show']);
        Route::get('orderfarm', ['as' => 'orderfarm.index', 'uses' => 'User\OrderFarmController@index']);
        Route::get('orderfarm/{id}', ['as' => 'orderfarm.show', 'uses' => 'User\OrderFarmController@show']);
        Route::any('orderfarm/{id}/cancel', ['as' => 'orderfarm.cancel', 'uses' => 'User\OrderFarmController@cancel']);
        Route::get('promotion', ['as' => 'promotion.index', 'uses' => 'User\PromotionController@index']);
        Route::get('promotion/card', ['as' => 'promotion.card', 'uses' => 'User\PromotionController@card']);
        Route::get('promotion/user', ['as' => 'promotion.user', 'uses' => 'User\PromotionController@user']);
        Route::get('appoint', ['as' => 'appoint.index', 'uses' => 'User\AppointController@index']);
        Route::get('appoint/{id}', ['as' => 'appoint.show', 'uses' => 'User\AppointController@show'])->where('id', '[0-9]+');
        Route::any('appoint/{id}/cancel', ['as' => 'appoint.cancel', 'uses' => 'User\AppointController@cancel'])->where('id', '[0-9]+');
        Route::get('score', ['as' => 'score.index', 'uses' => 'User\ScoreController@index']);
        Route::any('score/exchange', ['as' => 'score.exchange', 'uses' => 'User\ScoreController@exchange']);
        Route::any('score/transfer', ['as' => 'score.transfer', 'uses' => 'User\ScoreController@transfer']);
        Route::get('consume', ['as' => 'consume.index', 'uses' => 'User\ConsumeController@index']);
        Route::get('consume/{id}', ['as' => 'consume.show', 'uses' => 'User\ConsumeController@show'])->where('id', '[0-9]+');
        Route::get('consume/{id}/pay', ['as' => 'consume.pay', 'uses' => 'User\ConsumeController@pay'])->where('id', '[0-9]+');
        Route::get('collection', ['as' => 'collection.index', 'uses' => 'User\CollectionController@index']);
        Route::delete('collection/{id}', ['as' => 'collection.delete', 'uses' => 'User\CollectionController@delete'])->where('id', '[0-9]+');
        Route::get('history', ['as' => 'history.index', 'uses' => 'User\HistoryController@index']);
        Route::delete('history/{id}', ['as' => 'history.delete', 'uses' => 'User\HistoryController@delete'])->where('id', '[0-9]+');
        Route::get('profile', ['as' => 'profile.index', 'uses' => 'User\ProfileController@index']);
        Route::post('profile/face', ['as' => 'profile.face', 'uses' => 'User\ProfileController@face']);
        Route::post('profile/store', ['as' => 'profile.store', 'uses' => 'User\ProfileController@store']);
        Route::put('profile/update', ['as' => 'profile.update', 'uses' => 'User\ProfileController@update']);
        Route::any('profile/mobile', ['as' => 'profile.mobile', 'uses' => 'User\ProfileController@mobile']);
        Route::resource('mobile', 'User\MobileController', ['except' => 'show']);
        Route::get('password', ['as' => 'password.index', 'uses' => 'User\PasswordController@index']);
        Route::put('password/update', ['as' => 'password.update', 'uses' => 'User\PasswordController@update']);
        Route::get('binding', ['as' => 'binding.index', 'uses' => 'User\BindingController@index']);
        Route::resource('address', 'User\AddressController', ['except' => 'show']);
        Route::post('upload/image', ['as' => 'upload.image', 'uses' => 'User\UploadController@image']);
        Route::post('upload/editor', ['as' => 'upload.editor', 'uses' => 'User\UploadController@editor']);
        Route::post('upload/video', ['as' => 'upload.video', 'uses' => 'User\UploadController@video']);
        Route::get('survey', ['as' => 'survey.index', 'uses' => 'User\SurveyController@index']);
        Route::put('survey/store', ['as' => 'survey.store', 'uses' => 'User\SurveyController@store']);
        Route::get('cardreward', ['as' => 'cardreward.index', 'uses' => 'User\CardRewardController@index']);
        Route::any('cardreward/myreward', ['as' => 'cardreward.myreward', 'uses' => 'User\CardRewardController@myreward']);
        Route::any('cardreward/exchange', ['as' => 'cardreward.exchange', 'uses' => 'User\CardRewardController@exchange']);
    });
});

Route::group(['domain' => 'zhihui.hztbg.com', 'prefix' => 'mobile', 'as' => 'mobile.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Mobile\IndexController@index']);
    Route::get('/search', ['as' => 'search', 'uses' => 'Mobile\IndexController@search']);
    Route::get('/promotion/{fromuser}', ['as' => 'promotion', 'uses' => 'Mobile\IndexController@promotion']);
    Route::any('/sellcard/{fromuser}', ['as' => 'sellcard', 'uses' => 'Mobile\IndexController@sellcard']);
    Route::get('faq', ['as' => 'brand.faq.index', 'uses' => 'Mobile\Brand\FaqController@index']);
    Route::get('faq/{id}.html', ['as' => 'brand.faq.show', 'uses' => 'Mobile\Brand\FaqController@show'])->where('id', '[0-9]+');
    Route::get('card', ['as' => 'brand.card.index', 'uses' => 'Mobile\Brand\CardController@index']);
    Route::any('card/order.html', ['as' => 'brand.card.order', 'uses' => 'Mobile\Brand\CardController@order'])->middleware('auth.mobile');
    Route::any('card/address/info.html', ['as' => 'brand.card.addressinfo', 'uses' => 'Mobile\Brand\CardController@addressinfo'])->middleware('auth.mobile');
    Route::any('card/address/list.html', ['as' => 'brand.card.addresslist', 'uses' => 'Mobile\Brand\CardController@addresslist'])->middleware('auth.mobile');
    Route::any('card/pay/{id}.html', ['as' => 'brand.card.pay', 'uses' => 'Mobile\Brand\CardController@pay'])->middleware('auth.mobile');
    Route::any('card/active.html', ['as' => 'brand.card.active', 'uses' => 'Mobile\Brand\CardController@active']);
    Route::get('category', ['as' => 'brand.category.index', 'uses' => 'Mobile\Brand\CategoryController@index']);
    Route::get('shop', ['as' => 'brand.shop.index', 'uses' => 'Mobile\Brand\ShopController@index']);
    Route::get('shop/{id}.html', ['as' => 'brand.shop.show', 'uses' => 'Mobile\Brand\ShopController@show'])->where('id', '[0-9]+');
    Route::get('shop/{id}/map', ['as' => 'brand.shop.map', 'uses' => 'Mobile\Brand\ShopController@map'])->where('id', '[0-9]+');
    Route::get('shop/{id}/zizhi', ['as' => 'brand.shop.zizhi', 'uses' => 'Mobile\Brand\ShopController@zizhi'])->where('id', '[0-9]+');
    Route::any('shop/{id}/comment', ['as' => 'brand.shop.comment', 'uses' => 'Mobile\Brand\ShopController@comment'])->where('id', '[0-9]+');
    Route::any('shop/{id}/comment/create', ['as' => 'brand.shop.comment.create', 'uses' => 'Mobile\Brand\ShopController@commentcreate'])->where('id', '[0-9]+');
    Route::any('shop/{id}/appoint', ['as' => 'brand.shop.appoint', 'uses' => 'Mobile\Brand\ShopController@appoint'])->where('id', '[0-9]+');
    Route::get('shop/{id}/collection', ['as' => 'brand.shop.collection', 'uses' => 'Mobile\Brand\ShopController@collection'])->where('id', '[0-9]+');
    Route::any('shop/{id}/pay', ['as' => 'brand.shop.pay', 'uses' => 'Mobile\Brand\ShopController@pay'])->where('id', '[0-9]+');
    Route::any('shop/{id}/payback', ['as' => 'brand.shop.payback', 'uses' => 'Mobile\Brand\ShopController@payback'])->where('id', '[0-9]+');
    Route::get('shop/{id}/meal', ['as' => 'brand.shop.meal', 'uses' => 'Mobile\Brand\MealController@index'])->where('id', '[0-9]+')->middleware('auth.mobile');
    Route::get('shop/{id}/meal/show', ['as' => 'brand.shop.meal.show', 'uses' => 'Mobile\Brand\MealController@show'])->where('id', '[0-9]+')->middleware('auth.mobile');
    Route::any('shop/{id}/meal/order', ['as' => 'brand.shop.meal.order', 'uses' => 'Mobile\Brand\MealController@order'])->where('id', '[0-9]+')->middleware('auth.mobile');
    Route::get('shop/{id}/meal/addcart', ['as' => 'brand.shop.meal.addcart', 'uses' => 'Mobile\Brand\MealController@addcart'])->where('id', '[0-9]+')->middleware('auth.mobile');
    Route::get('shop/{id}/meal/updatecart', ['as' => 'brand.shop.meal.updatecart', 'uses' => 'Mobile\Brand\MealController@updatecart'])->where('id', '[0-9]+')->middleware('auth.mobile');
    Route::get('shop/{id}/meal/delcart', ['as' => 'brand.shop.meal.delcart', 'uses' => 'Mobile\Brand\MealController@delcart'])->where('id', '[0-9]+')->middleware('auth.mobile');
    Route::any('shop/{id}/meal/pay/{orderid}', ['as' => 'brand.shop.meal.pay', 'uses' => 'Mobile\Brand\MealController@pay'])->where('id', '[0-9]+')->middleware('auth.mobile');
    Route::get('recommend', ['as' => 'brand.recommend.index', 'uses' => 'Mobile\Brand\RecommendController@index']);
    Route::get('comment', ['as' => 'brand.comment.index', 'uses' => 'Mobile\Brand\CommentController@index']);

    Route::get('farm', ['as' => 'brand.farm.index', 'uses' => 'Mobile\Brand\FarmController@index']);
    Route::get('farm/search', ['as' => 'brand.farm.search', 'uses' => 'Mobile\Brand\FarmController@search']);
    Route::get('farm/lists.html', ['as' => 'brand.farm.lists', 'uses' => 'Mobile\Brand\FarmController@lists']);
    Route::get('farm/{id}.html', ['as' => 'brand.farm.show', 'uses' => 'Mobile\Brand\FarmController@show'])->where('id', '[0-9]+');
    Route::get('farm/{id}/map', ['as' => 'brand.farm.map', 'uses' => 'Mobile\Brand\FarmController@map'])->where('id', '[0-9]+');
    Route::any('farm/{id}/comment', ['as' => 'brand.farm.comment', 'uses' => 'Mobile\Brand\FarmController@comment'])->where('id', '[0-9]+');
    Route::any('farm/{id}/order', ['as' => 'brand.farm.order', 'uses' => 'Mobile\Brand\FarmController@order'])->where('id', '[0-9]+');
    Route::any('farm/{id}/pay', ['as' => 'brand.farm.pay', 'uses' => 'Mobile\Brand\FarmController@pay']);

    Route::post('upload/image', ['as' => 'upload.image', 'uses' => 'Mobile\User\UploadController@image']);

    Route::group(['prefix' => 'auth'], function () {
        Route::get('register', ['as' => 'register', 'uses' => 'Mobile\Auth\RegisterController@showRegistrationForm']);
        Route::post('register', ['as' => 'register', 'uses' => 'Mobile\Auth\RegisterController@register']);
        Route::get('register/fast', ['as' => 'register.fast', 'uses' => 'Mobile\Auth\RegisterFastController@showRegistrationForm']);
        Route::post('register/fast', ['as' => 'register.fast', 'uses' => 'Mobile\Auth\RegisterFastController@register']);
        Route::get('login', ['as' => 'login', 'uses' => 'Mobile\Auth\LoginController@showLoginForm']);
        Route::post('login', ['as' => 'login', 'uses' => 'Mobile\Auth\LoginController@login']);
        Route::get('login/fast', ['as' => 'login.fast', 'uses' => 'Mobile\Auth\LoginFastController@showLoginForm']);
        Route::post('login/fast', ['as' => 'login.fast', 'uses' => 'Mobile\Auth\LoginFastController@login']);
        Route::get('logout', ['as' => 'logout', 'uses' => 'Mobile\Auth\LoginController@logout']);
        //Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
        //Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
        //Route::get('password/reset/{token}', ['as' => 'password.reseturl', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
        //Route::post('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@reset']);
        Route::get('forgotpwd/reset', ['as' => 'forgotpwd.reset', 'uses' => 'Mobile\Auth\MobilePasswordController@showLinkRequestForm']);
        Route::post('forgotpwd/mobile', ['as' => 'forgotpwd.mobile', 'uses' => 'Mobile\Auth\MobilePasswordController@sendResetLinkMobile']);
        Route::get('forgotpwd/reset/{token}', ['as' => 'forgotpwd.reseturl', 'uses' => 'Mobile\Auth\MobilePasswordController@showResetForm']);
        Route::post('forgotpwd/reset', ['as' => 'forgotpwd.reset', 'uses' => 'Mobile\Auth\MobilePasswordController@reset']);
    });

    Route::group(['prefix' => 'user', 'middleware' => ['auth.mobile'], 'as' => 'user.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'Mobile\User\IndexController@index']);
        Route::get('setting', ['as' => 'setting', 'uses' => 'Mobile\User\IndexController@setting']);
        Route::get('progress', ['as' => 'progress', 'uses' => 'Mobile\User\IndexController@progress']);
        Route::get('present', ['as' => 'present.index', 'uses' => 'Mobile\User\PresentController@index']);
        Route::get('account', ['as' => 'account.index', 'uses' => 'Mobile\User\AccountController@index']);
        Route::get('sign', ['as' => 'sign.index', 'uses' => 'Mobile\User\SignController@index']);
        Route::post('sign', ['as' => 'sign.store', 'uses' => 'Mobile\User\SignController@store']);
        Route::any('bindcard', ['as' => 'bindcard.index', 'uses' => 'Mobile\User\BindCardController@index']);
        Route::get('ordercard/', ['as' => 'ordercard.index', 'uses' => 'Mobile\User\OrderCardController@index']);
        Route::get('ordercard/{id}', ['as' => 'ordercard.show', 'uses' => 'Mobile\User\OrderCardController@show']);
        Route::get('ordercard/{id}/cancel', ['as' => 'ordercard.cancel', 'uses' => 'Mobile\User\OrderCardController@cancel']);
        Route::get('ordermeal', ['as' => 'ordermeal.index', 'uses' => 'Mobile\User\OrderMealController@index']);
        Route::get('ordermeal/{id}', ['as' => 'ordermeal.show', 'uses' => 'Mobile\User\OrderMealController@show']);
        Route::get('orderfarm/', ['as' => 'orderfarm.index', 'uses' => 'Mobile\User\OrderFarmController@index']);
        Route::get('orderfarm/{id}', ['as' => 'orderfarm.show', 'uses' => 'Mobile\User\OrderFarmController@show']);
        Route::get('orderfarm/{id}/cancel', ['as' => 'orderfarm.cancel', 'uses' => 'Mobile\User\OrderFarmController@cancel']);
        Route::get('promotion', ['as' => 'promotion.index', 'uses' => 'Mobile\User\PromotionController@index']);
        Route::get('promotion/qrcode', ['as' => 'promotion.qrcode', 'uses' => 'Mobile\User\PromotionController@qrcode']);
        Route::get('promotion/rule', ['as' => 'promotion.rule', 'uses' => 'Mobile\User\PromotionController@rule']);
        Route::get('promotion/first', ['as' => 'promotion.first', 'uses' => 'Mobile\User\PromotionController@first']);
        Route::get('promotion/second', ['as' => 'promotion.second', 'uses' => 'Mobile\User\PromotionController@second']);
        Route::get('appoint', ['as' => 'appoint.index', 'uses' => 'Mobile\User\AppointController@index']);
        Route::get('appoint/{id}', ['as' => 'appoint.show', 'uses' => 'Mobile\User\AppointController@show'])->where('id', '[0-9]+');
        Route::any('appoint/{id}/cancel', ['as' => 'appoint.cancel', 'uses' => 'Mobile\User\AppointController@cancel'])->where('id', '[0-9]+');
        Route::get('score', ['as' => 'score.index', 'uses' => 'Mobile\User\ScoreController@index']);
        Route::any('score/exchange', ['as' => 'score.exchange', 'uses' => 'Mobile\User\ScoreController@exchange']);
        Route::any('score/transfer', ['as' => 'score.transfer', 'uses' => 'Mobile\User\ScoreController@transfer']);
        Route::get('consume', ['as' => 'consume.index', 'uses' => 'Mobile\User\ConsumeController@index']);
        Route::get('consume/{id}', ['as' => 'consume.show', 'uses' => 'Mobile\User\ConsumeController@show'])->where('id', '[0-9]+');
        Route::get('consume/{id}/pay', ['as' => 'consume.pay', 'uses' => 'Mobile\User\ConsumeController@pay'])->where('id', '[0-9]+');
        Route::get('collection', ['as' => 'collection.index', 'uses' => 'Mobile\User\CollectionController@index']);
        Route::get('collection/{id}', ['as' => 'collection.delete', 'uses' => 'Mobile\User\CollectionController@delete'])->where('id', '[0-9]+');
        Route::delete('collection/{id}', ['as' => 'collection.delete', 'uses' => 'Mobile\User\CollectionController@delete'])->where('id', '[0-9]+');
        Route::get('history', ['as' => 'history.index', 'uses' => 'Mobile\User\HistoryController@index']);
        Route::delete('history/{id}', ['as' => 'history.delete', 'uses' => 'Mobile\User\HistoryController@delete'])->where('id', '[0-9]+');
        Route::get('consume', ['as' => 'consume.index', 'uses' => 'Mobile\User\ConsumeController@index']);
        Route::get('profile', ['as' => 'profile.index', 'uses' => 'Mobile\User\ProfileController@index']);
        Route::post('profile/store', ['as' => 'profile.store', 'uses' => 'Mobile\User\ProfileController@store']);
        Route::put('profile/update', ['as' => 'profile.update', 'uses' => 'Mobile\User\ProfileController@update']);
        Route::any('profile/mobile', ['as' => 'profile.mobile', 'uses' => 'Mobile\User\ProfileController@mobile']);
        Route::get('password', ['as' => 'password.index', 'uses' => 'Mobile\User\PasswordController@index']);
        Route::put('password.update', ['as' => 'password.update', 'uses' => 'Mobile\User\PasswordController@update']);
        Route::get('binding', ['as' => 'binding.index', 'uses' => 'Mobile\User\BindingController@index']);
        Route::resource('address', 'Mobile\User\AddressController', ['except' => 'show']);
        Route::get('feedback', ['as' => 'feedback.index', 'uses' => 'Mobile\User\FeedbackController@index']);
        Route::post('feedback', ['as' => 'feedback.store', 'uses' => 'Mobile\User\FeedbackController@store']);
        Route::get('cardreward', ['as' => 'cardreward.index', 'uses' => 'Mobile\User\CardRewardController@index']);
        Route::any('cardreward/myreward', ['as' => 'cardreward.myreward', 'uses' => 'Mobile\User\CardRewardController@myreward']);
        Route::any('cardreward/exchange', ['as' => 'cardreward.exchange', 'uses' => 'Mobile\User\CardRewardController@exchange']);
        Route::get('sellcard', ['as' => 'sellcard.index', 'uses' => 'Mobile\User\SellCardController@index']);
        Route::get('sellcard/order', ['as' => 'sellcard.order', 'uses' => 'Mobile\User\SellCardController@order']);
    });
});

Route::group(['domain' => 'zhihui.hztbg.com', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', function () {
        return redirect()->route('admin.index');
    });
    Route::get('login', ['as' => 'login', 'uses' => 'Admin\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login', 'uses' => 'Admin\LoginController@login']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'Admin\LoginController@logout']);
    Route::post('upload/editor', ['as' => 'upload.editor', 'uses' => 'Admin\UploadController@editor']);

    Route::group(['middleware' => ['auth.admin']], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'Admin\IndexController@index']);
        Route::get('updatecache', ['as' => 'updatecache', 'uses' => 'Admin\IndexController@updatecache']);

        Route::any('district/select', ['as' => 'district.select', 'uses' => 'Admin\DistrictController@select']);
        Route::post('district/batch', ['as' => 'district.batch', 'uses' => 'Admin\DistrictController@batch']);
        Route::resource('district', 'Admin\DistrictController');
        Route::any('subweb/select', ['as' => 'subweb.select', 'uses' => 'Admin\SubwebController@select']);
        Route::post('subweb/batch', ['as' => 'subweb.batch', 'uses' => 'Admin\SubwebController@batch']);
        Route::resource('subweb', 'Admin\SubwebController');

        Route::post('upload/image', ['as' => 'upload.image', 'uses' => 'Admin\UploadController@image']);
        Route::post('upload/video', ['as' => 'upload.video', 'uses' => 'Admin\UploadController@video']);

        Route::group(['prefix' => 'extend', 'as' => 'extend.'], function () {
            Route::post('friendlink/batch', ['as' => 'friendlink.batch', 'uses' => 'Admin\Extend\FriendlinkController@batch']);
            Route::resource('friendlink', 'Admin\Extend\FriendlinkController');
            Route::post('faq/batch', ['as' => 'faq.batch', 'uses' => 'Admin\Extend\FaqController@batch']);
            Route::resource('faq', 'Admin\Extend\FaqController');
            Route::post('feedback/batch', ['as' => 'feedback.batch', 'uses' => 'Admin\Extend\FeedbackController@batch']);
            Route::resource('feedback', 'Admin\Extend\FeedbackController');
            Route::post('announce/batch', ['as' => 'announce.batch', 'uses' => 'Admin\Extend\AnnounceController@batch']);
            Route::resource('announce', 'Admin\Extend\AnnounceController');
            Route::post('appoint/batch', ['as' => 'appoint.batch', 'uses' => 'Admin\Extend\AppointController@batch']);
            Route::resource('appoint', 'Admin\Extend\AppointController');
            Route::post('ordercard/batch', ['as' => 'ordercard.batch', 'uses' => 'Admin\Extend\OrderCardController@batch']);
            Route::any('ordercard/send/{id}', ['as' => 'ordercard.send', 'uses' => 'Admin\Extend\OrderCardController@send']);
            Route::any('ordercard/refund/{id}', ['as' => 'ordercard.refund', 'uses' => 'Admin\Extend\OrderCardController@refund']);
            Route::any('ordercard/close/{id}', ['as' => 'ordercard.close', 'uses' => 'Admin\Extend\OrderCardController@close']);
            Route::resource('ordercard', 'Admin\Extend\OrderCardController');
            Route::post('card/batch', ['as' => 'card.batch', 'uses' => 'Admin\Extend\CardController@batch']);
            Route::any('card/export', ['as' => 'card.export', 'uses' => 'Admin\Extend\CardController@export']);
            Route::resource('card', 'Admin\Extend\CardController');
            Route::post('bindcard/batch', ['as' => 'bindcard.batch', 'uses' => 'Admin\Extend\BindCardController@batch']);
            Route::resource('bindcard', 'Admin\Extend\BindCardController');
            Route::post('reward/batch', ['as' => 'reward.batch', 'uses' => 'Admin\Extend\RewardController@batch']);
            Route::resource('reward', 'Admin\Extend\RewardController');
            Route::post('sellcard/batch', ['as' => 'sellcard.batch', 'uses' => 'Admin\Extend\SellCardController@batch']);
            Route::resource('sellcard', 'Admin\Extend\SellCardController');
        });
        Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
            Route::post('menu/batch', ['as' => 'menu.batch', 'uses' => 'Admin\Admin\MenuController@batch']);
            Route::resource('menu', 'Admin\Admin\MenuController');
            Route::post('user/batch', ['as' => 'user.batch', 'uses' => 'Admin\Admin\UserController@batch']);
            Route::resource('user', 'Admin\Admin\UserController');
            Route::post('group/batch', ['as' => 'group.batch', 'uses' => 'Admin\Admin\GroupController@batch']);
            Route::resource('group', 'Admin\Admin\GroupController');
            Route::post('log/batch', ['as' => 'log.batch', 'uses' => 'Admin\Admin\LogController@batch']);
            Route::get('log', ['as' => 'log.index', 'uses' => 'Admin\Admin\LogController@index']);
        });
        Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
            Route::get('basic', ['as' => 'basic.index', 'uses' => 'Admin\Setting\BasicController@index']);
            Route::put('basic.update', ['as' => 'basic.update', 'uses' => 'Admin\Setting\BasicController@update']);
            Route::get('watermark', ['as' => 'watermark.index', 'uses' => 'Admin\Setting\WatermarkController@index']);
            Route::put('watermark.update', ['as' => 'watermark.update', 'uses' => 'Admin\Setting\WatermarkController@update']);
            Route::get('ucenter', ['as' => 'ucenter.index', 'uses' => 'Admin\Setting\UcenterController@index']);
            Route::put('ucenter.update', ['as' => 'ucenter.update', 'uses' => 'Admin\Setting\UcenterController@update']);
            Route::get('style', ['as' => 'style.index', 'uses' => 'Admin\Setting\StyleController@index']);
            Route::put('style.update', ['as' => 'style.update', 'uses' => 'Admin\Setting\StyleController@update']);
            Route::get('template', ['as' => 'template.index', 'uses' => 'Admin\Setting\TemplateController@index']);
            Route::put('template.update', ['as' => 'template.update', 'uses' => 'Admin\Setting\TemplateController@update']);
            Route::get('mobile', ['as' => 'mobile.index', 'uses' => 'Admin\Setting\MobileController@index']);
            Route::put('mobile.update', ['as' => 'mobile.update', 'uses' => 'Admin\Setting\MobileController@update']);
            Route::get('wechat', ['as' => 'wechat.index', 'uses' => 'Admin\Setting\WechatController@index']);
            Route::put('wechat.update', ['as' => 'wechat.update', 'uses' => 'Admin\Setting\WechatController@update']);
            Route::post('nav/batch', ['as' => 'nav.batch', 'uses' => 'Admin\Setting\NavController@batch']);
            Route::resource('nav', 'Admin\Setting\NavController');
        });
        Route::group(['prefix' => 'attr', 'as' => 'attr.'], function () {
            Route::post('attr/batch', ['as' => 'attr.batch', 'uses' => 'Admin\Attr\AttrController@batch']);
            Route::resource('attr', 'Admin\Attr\AttrController');
            Route::post('value/batch', ['as' => 'value.batch', 'uses' => 'Admin\Attr\ValueController@batch']);
            Route::resource('value', 'Admin\Attr\ValueController');
        });
        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::post('user/batch', ['as' => 'user.batch', 'uses' => 'Admin\User\UserController@batch']);
            Route::any('user/{id}/group', ['as' => 'user.group', 'uses' => 'Admin\User\UserController@group']);
            Route::resource('user', 'Admin\User\UserController');
            Route::post('group/batch', ['as' => 'group.batch', 'uses' => 'Admin\User\GroupController@batch']);
            Route::resource('group', 'Admin\User\GroupController');
            Route::post('address/batch', ['as' => 'address.batch', 'uses' => 'Admin\User\AddressController@batch']);
            Route::resource('address', 'Admin\User\AddressController');
            Route::post('score/batch', ['as' => 'score.batch', 'uses' => 'Admin\User\ScoreController@batch']);
            Route::resource('score', 'Admin\User\ScoreController');
            Route::post('sign/batch', ['as' => 'sign.batch', 'uses' => 'Admin\User\SignController@batch']);
            Route::get('sign', ['as' => 'sign.index', 'uses' => 'Admin\User\SignController@index']);
        });
        Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
            Route::post('shop/batch', ['as' => 'shop.batch', 'uses' => 'Admin\Brand\ShopController@batch']);
            Route::get('shop/recycle', ['as' => 'shop.recycle', 'uses' => 'Admin\Brand\ShopController@recycle']);
            Route::get('shop/nearby', ['as' => 'shop.nearby', 'uses' => 'Admin\Brand\ShopController@nearby']);

            Route::post('shop/{shopid}/allot/batch', ['as' => 'allot.batch', 'uses' => 'Admin\Brand\AllotController@batch']);
            Route::get('shop/{shopid}/allot', ['as' => 'allot.index', 'uses' => 'Admin\Brand\AllotController@index']);
            Route::get('shop/{shopid}/allot/create', ['as' => 'allot.create', 'uses' => 'Admin\Brand\AllotController@create']);
            Route::post('shop/{shopid}/allot', ['as' => 'allot.store', 'uses' => 'Admin\Brand\AllotController@store']);
            Route::get('shop/{shopid}/allot/{id}/cardlist', ['as' => 'allot.cardlist', 'uses' => 'Admin\Brand\AllotController@cardlist']);
            Route::get('shop/{shopid}/allot/{id}/edit', ['as' => 'allot.edit', 'uses' => 'Admin\Brand\AllotController@edit']);
            Route::put('shop/{shopid}/allot/{id}', ['as' => 'allot.update', 'uses' => 'Admin\Brand\AllotController@update']);
            Route::delete('shop/{shopid}/allot/{id}', ['as' => 'allot.destroy', 'uses' => 'Admin\Brand\AllotController@destroy']);

            Route::get('shop/{id}/restore', ['as' => 'shop.restore', 'uses' => 'Admin\Brand\ShopController@restore']);
            Route::get('shop/{id}/qrcode', ['as' => 'shop.qrcode', 'uses' => 'Admin\Brand\ShopController@qrcode']);
            Route::get('shop/{id}/getqrcode', ['as' => 'shop.getqrcode', 'uses' => 'Admin\Brand\ShopController@getqrcode']);
            Route::get('shop/{id}/admin', ['as' => 'shop.admin', 'uses' => 'Admin\Brand\ShopController@admin']);

            Route::resource('shop', 'Admin\Brand\ShopController');
            Route::post('product/batch', ['as' => 'product.batch', 'uses' => 'Admin\Brand\ProductController@batch']);
            Route::get('product/recycle', ['as' => 'product.recycle', 'uses' => 'Admin\Brand\ProductController@recycle']);
            Route::get('product/{id}/restore', ['as' => 'product.restore', 'uses' => 'Admin\Brand\ProductController@restore']);
            Route::resource('product', 'Admin\Brand\ProductController');
            Route::any('category/{id}/move', ['as' => 'category.move', 'uses' => 'Admin\Brand\CategoryController@move']);
            Route::post('category/batch', ['as' => 'category.batch', 'uses' => 'Admin\Brand\CategoryController@batch']);
            Route::resource('category', 'Admin\Brand\CategoryController');
            Route::post('comment/batch', ['as' => 'comment.batch', 'uses' => 'Admin\Brand\CommentController@batch']);
            Route::resource('comment', 'Admin\Brand\CommentController');
            Route::post('collection/batch', ['as' => 'collection.batch', 'uses' => 'Admin\Brand\CollectionController@batch']);
            Route::resource('collection', 'Admin\Brand\CollectionController');
            Route::post('meal/batch', ['as' => 'meal.batch', 'uses' => 'Admin\Brand\MealController@batch']);
            Route::get('meal/getcate', ['as' => 'meal.getcate', 'uses' => 'Admin\Brand\MealController@getcate']);
            Route::resource('meal', 'Admin\Brand\MealController');
            Route::post('mealcate/batch', ['as' => 'mealcate.batch', 'uses' => 'Admin\Brand\MealCategoryController@batch']);
            Route::resource('mealcate', 'Admin\Brand\MealCategoryController');
            Route::post('ordermeal/batch', ['as' => 'ordermeal.batch', 'uses' => 'Admin\Brand\OrderMealController@batch']);
            Route::resource('ordermeal', 'Admin\Brand\OrderMealController');
            Route::post('consume/batch', ['as' => 'consume.batch', 'uses' => 'Admin\Brand\ConsumeController@batch']);
            Route::resource('consume', 'Admin\Brand\ConsumeController');
            Route::post('withdraw/batch', ['as' => 'withdraw.batch', 'uses' => 'Admin\Brand\WithdrawController@batch']);
            Route::resource('withdraw', 'Admin\Brand\WithdrawController');
            Route::post('appoint/batch', ['as' => 'appoint.batch', 'uses' => 'Admin\Brand\AppointController@batch']);
            Route::resource('appoint', 'Admin\Brand\AppointController');
        });
        Route::group(['prefix' => 'farm', 'as' => 'farm.'], function () {
            Route::post('farm/batch', ['as' => 'farm.batch', 'uses' => 'Admin\Farm\FarmController@batch']);
            Route::get('farm/recycle', ['as' => 'farm.recycle', 'uses' => 'Admin\Farm\FarmController@recycle']);
            Route::get('farm/{id}/restore', ['as' => 'farm.restore', 'uses' => 'Admin\Farm\FarmController@restore']);
            Route::post('farm/{farm_id}/package/batch', ['as' => 'package.batch', 'uses' => 'Admin\Farm\PackageController@batch']);
            Route::resource('farm/{farm_id}/package', 'Admin\Farm\PackageController', ['parameters' => ['package' => 'id']]);
            Route::resource('farm', 'Admin\Farm\FarmController');
            Route::post('order/batch', ['as' => 'order.batch', 'uses' => 'Admin\Farm\OrderController@batch']);
            Route::post('order/{id}/finish', ['as' => 'order.finish', 'uses' => 'Admin\Farm\OrderController@finish']);
            Route::resource('order', 'Admin\Farm\OrderController');
            Route::post('comment/batch', ['as' => 'comment.batch', 'uses' => 'Admin\Farm\CommentController@batch']);
            Route::resource('comment', 'Admin\Farm\CommentController');
        });
        Route::group(['prefix' => 'mall', 'as' => 'mall.'], function () {
            Route::any('category/{id}/move', ['as' => 'category.move', 'uses' => 'Admin\Mall\CategoryController@move']);
            Route::post('category/batch', ['as' => 'category.batch', 'uses' => 'Admin\Mall\CategoryController@batch']);
            Route::resource('category', 'Admin\Mall\CategoryController');
            Route::post('product/batch', ['as' => 'product.batch', 'uses' => 'Admin\Mall\ProductController@batch']);
            Route::get('product/recycle', ['as' => 'product.recycle', 'uses' => 'Admin\Mall\ProductController@recycle']);
            Route::get('product/{id}/restore', ['as' => 'product.restore', 'uses' => 'Admin\Mall\ProductController@restore']);
            Route::resource('product', 'Admin\Mall\ProductController');
            Route::post('order/batch', ['as' => 'order.batch', 'uses' => 'Admin\Mall\OrderController@batch']);
            Route::any('order/send/{id}', ['as' => 'order.send', 'uses' => 'Admin\Mall\OrderController@send']);
            Route::any('order/refund/{id}', ['as' => 'order.refund', 'uses' => 'Admin\Mall\OrderController@refund']);
            Route::any('order/close/{id}', ['as' => 'order.close', 'uses' => 'Admin\Mall\OrderController@close']);
            Route::resource('order', 'Admin\Mall\OrderController');
        });
        Route::group(['prefix' => 'wechat', 'as' => 'wechat.'], function () {
            Route::post('response/batch', ['as' => 'response.batch', 'uses' => 'Admin\Wechat\ResponseController@batch']);
            Route::resource('response', 'Admin\Wechat\ResponseController');
            Route::post('menu/batch', ['as' => 'menu.batch', 'uses' => 'Admin\Wechat\MenuController@batch']);
            Route::get('menu/publish', ['as' => 'menu.publish', 'uses' => 'Admin\Wechat\MenuController@publish']);
            Route::resource('menu', 'Admin\Wechat\MenuController');
            Route::post('message/batch', ['as' => 'message.batch', 'uses' => 'Admin\Wechat\MessageController@batch']);
            Route::resource('message', 'Admin\Wechat\MessageController');
            Route::get('user/import', ['as' => 'user.import', 'uses' => 'Admin\Wechat\UserController@import']);
            Route::get('user/upall', ['as' => 'user.upall', 'uses' => 'Admin\Wechat\UserController@upall']);
            Route::post('user/batch', ['as' => 'user.batch', 'uses' => 'Admin\Wechat\UserController@batch']);
            Route::resource('user', 'Admin\Wechat\UserController', ['only' =>['index', 'update', 'destroy']]);
            Route::post('redpack/batch', ['as' => 'redpack.batch', 'uses' => 'Admin\Wechat\RedpackController@batch']);
            Route::resource('redpack', 'Admin\Wechat\RedpackController');

            Route::any('ownervote', ['as' => 'ownervote.index', 'uses' => 'Admin\Wechat\OwnervoteController@index']);
            Route::any('ownervote/apply', ['as' => 'ownervote.apply', 'uses' => 'Admin\Wechat\OwnervoteController@apply']);
            Route::any('ownervote/vote', ['as' => 'ownervote.vote', 'uses' => 'Admin\Wechat\OwnervoteController@vote']);
            Route::any('ownervote/visit', ['as' => 'ownervote.visit', 'uses' => 'Admin\Wechat\OwnervoteController@visit']);
            Route::any('ownervote/share', ['as' => 'ownervote.share', 'uses' => 'Admin\Wechat\OwnervoteController@share']);
        });
        Route::group(['prefix' => 'crm', 'as' => 'crm.'], function () {
            Route::post('user/batch', ['as' => 'user.batch', 'uses' => 'Admin\CRM\UserController@batch']);
            Route::resource('user', 'Admin\CRM\UserController');
            Route::get('group', ['as' => 'group.index', 'uses' => 'Admin\CRM\GroupController@index']);
            Route::post('customer/batch', ['as' => 'customer.batch', 'uses' => 'Admin\CRM\CustomerController@batch']);
            Route::resource('customer', 'Admin\CRM\CustomerController');
            Route::post('archive/batch', ['as' => 'archive.batch', 'uses' => 'Admin\CRM\ArchiveController@batch']);
            Route::resource('archive', 'Admin\CRM\ArchiveController');
            Route::post('reward/batch', ['as' => 'reward.batch', 'uses' => 'Admin\CRM\RewardController@batch']);
            Route::resource('reward', 'Admin\CRM\RewardController');
            Route::post('personnel/batch', ['as' => 'personnel.batch', 'uses' => 'Admin\CRM\PersonnelController@batch']);
            Route::resource('personnel', 'Admin\CRM\PersonnelController');
        });
    });
});

Route::group(['domain' => '{domain}.zhihui.hztbg.com','middleware' => ['subweb'], 'as' => 'subweb.'], function () {

    Route::get('/', ['as' => 'index', 'uses' => 'Subweb\IndexController@index']);
    Route::get('case', ['as' => 'case.index', 'uses' => 'Subweb\CaseController@index']);
    Route::get('case/{id}.html', ['as' => 'case.detail', 'uses' => 'Subweb\CaseController@detail'])->where('id', '[0-9]+');
    Route::get('xiaoqu', ['as' => 'community.index', 'uses' => 'Subweb\CommunityController@index']);
    Route::get('xiaoqu/{id}.html', ['as' => 'community.detail', 'uses' => 'Subweb\CommunityController@detail'])->where('id', '[0-9]+');
    Route::get('designer', ['as' => 'designer.index', 'uses' => 'Subweb\DesignerController@index']);
    Route::get('designer/{id}.html', ['as' => 'designer.detail', 'uses' => 'Subweb\DesignerController@detail'])->where('id', '[0-9]+');
    Route::get('live', ['as' => 'worksite.index', 'uses' => 'Subweb\WorksiteController@index']);
    Route::get('live/{id}.html', ['as' => 'worksite.detail', 'uses' => 'Subweb\WorksiteController@detail'])->where('id', '[0-9]+');
    Route::get('news', ['as' => 'article.index', 'uses' => 'Subweb\ArticleController@index']);
    Route::get('news/{id}.html', ['as' => 'article.detail', 'uses' => 'Subweb\ArticleController@detail'])->where('id', '[0-9]+');

    Route::get('admin', function () {
        return redirect()->route('admin.index');
    });
    Route::get('admin/login', ['as' => 'admin.login', 'uses' => 'Admin\LoginController@showLoginForm']);
    Route::post('admin/login', ['as' => 'admin.login', 'uses' => 'Admin\LoginController@login']);
    Route::get('admin/logout', ['as' => 'admin.logout', 'uses' => 'Admin\LoginController@logout']);

    Route::group(['prefix' => 'admin', 'middleware' => ['auth.admin:admin'], 'as' => 'admin.'], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'Admin\IndexController@index']);

        Route::post('appoint/batch', ['as' => 'appoint.batch', 'uses' => 'Admin\AppointController@batch']);
        Route::resource('appoint', 'Admin\AppointController');
        Route::post('activity/batch', ['as' => 'activity.batch', 'uses' => 'Admin\ActivityController@batch']);
        Route::resource('activity', 'Admin\ActivityController');
        Route::post('friendlink/batch', ['as' => 'friendlink.batch', 'uses' => 'Admin\FriendlinkController@batch']);
        Route::resource('friendlink', 'Admin\FriendlinkController');

        Route::post('adminuser/batch', ['as' => 'adminuser.batch', 'uses' => 'Admin\FounderController@batch']);
        Route::resource('adminuser', 'Admin\FounderController');
        Route::post('admingroup/batch', ['as' => 'admingroup.batch', 'uses' => 'Admin\FounderController@batch']);
        Route::resource('admingroup', 'Admin\FounderController');
        Route::post('adminlog/batch', ['as' => 'adminlog.batch', 'uses' => 'Admin\FounderController@batch']);
        Route::resource('adminlog', 'Admin\FounderController');
    });
});

Route::group(['domain' => 'crm.hztbg.com', 'prefix' => '', 'as' => 'crm.'], function () {
    Route::get('/', function () {
        return redirect()->route('crm.index');
    });
    Route::get('login', ['as' => 'login', 'uses' => 'CRM\LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login', 'uses' => 'CRM\LoginController@login']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'CRM\LoginController@logout']);
    Route::group(['middleware' => ['auth.crm']], function () {
        Route::get('index', ['as' => 'index', 'uses' => 'CRM\IndexController@index']);
        Route::get('shop/nearby', ['as' => 'shop.nearby', 'uses' => 'CRM\ShopController@nearby']);

        Route::get('customer', ['as' => 'customer.index', 'uses' => 'CRM\CustomerController@index', 'allow' => ['zhaoshang']]);
        Route::get('customer/referlist', ['as' => 'customer.referlist', 'uses' => 'CRM\CustomerController@referlist', 'allow' => ['zhaoshang']]);
        Route::get('customer/create', ['as' => 'customer.create', 'uses' => 'CRM\CustomerController@create', 'allow' => ['zhaoshang']]);
        Route::post('customer', ['as' => 'customer.store', 'uses' => 'CRM\CustomerController@store', 'allow' => ['zhaoshang']]);
        Route::get('customer/{id}', ['as' => 'customer.show', 'uses' => 'CRM\CustomerController@show', 'allow' => ['zhaoshang']]);
        Route::get('customer/{id}/edit', ['as' => 'customer.edit', 'uses' => 'CRM\CustomerController@edit', 'allow' => ['zhaoshang']]);
        Route::put('customer/{id}', ['as' => 'customer.update', 'uses' => 'CRM\CustomerController@update', 'allow' => ['zhaoshang']]);
        Route::delete('customer/{id}', ['as' => 'customer.destroy', 'uses' => 'CRM\CustomerController@destroy', 'allow' => ['zhaoshang']]);
        Route::any('customer/{id}/refer', ['as' => 'customer.refer', 'uses' => 'CRM\CustomerController@refer', 'allow' => ['zhaoshang']]);
        Route::get('shop', ['as' => 'shop.index', 'uses' => 'CRM\ShopController@index', 'allow' => ['zhaoshang']]);
        Route::get('shop/checkcard', ['as' => 'shop.checkcard', 'uses' => 'CRM\ShopController@checkcard', 'allow' => ['zhaoshang']]);
        Route::get('shop/{id}/edit', ['as' => 'shop.edit', 'uses' => 'CRM\ShopController@edit', 'allow' => ['zhaoshang']]);
        Route::put('shop/{id}', ['as' => 'shop.update', 'uses' => 'CRM\ShopController@update', 'allow' => ['zhaoshang']]);
        Route::get('shop/{id}/allot', ['as' => 'shop.allot', 'uses' => 'CRM\ShopController@allot', 'allow' => ['zhaoshang']]);
        Route::get('shop/{id}/card', ['as' => 'shop.card', 'uses' => 'CRM\ShopController@card', 'allow' => ['zhaoshang']]);
        Route::any('shop/{id}/addcard', ['as' => 'shop.addcard', 'uses' => 'CRM\ShopController@addcard', 'allow' => ['zhaoshang']]);
        Route::get('archive', ['as' => 'archive.index', 'uses' => 'CRM\ArchiveController@index', 'allow' => ['zhaoshang']]);
        Route::get('archive/{id}', ['as' => 'archive.show', 'uses' => 'CRM\ArchiveController@show', 'allow' => ['zhaoshang']]);

        Route::get('checkcustomer', ['as' => 'checkcustomer.index', 'uses' => 'CRM\CheckCustomerController@index', 'allow' => ['kefu']]);
        Route::get('checkcustomer/{id}', ['as' => 'checkcustomer.show', 'uses' => 'CRM\CheckCustomerController@show', 'allow' => ['kefu']]);
        Route::any('checkcustomer/{id}/check', ['as' => 'checkcustomer.check', 'uses' => 'CRM\CheckCustomerController@check', 'allow' => ['kefu']]);

        Route::get('consume', ['as' => 'consume.index', 'uses' => 'CRM\ConsumeController@index', 'allow' => ['shangjia']]);
        Route::get('consume/balance', ['as' => 'consume.balance', 'uses' => 'CRM\ConsumeController@balance', 'allow' => ['shangjia']]);
        Route::get('consume/{id}', ['as' => 'consume.show', 'uses' => 'CRM\ConsumeController@show', 'allow' => ['shangjia']]);
        Route::get('ordercard', ['as' => 'ordercard.index', 'uses' => 'CRM\OrderCardController@index', 'allow' => ['shangjia']]);
        Route::get('ordercard/remain', ['as' => 'ordercard.remain', 'uses' => 'CRM\OrderCardController@remain', 'allow' => ['shangjia']]);
        Route::get('appoint', ['as' => 'appoint.index', 'uses' => 'CRM\AppointController@index', 'allow' => ['shangjia']]);
        Route::get('appoint/{id}', ['as' => 'appoint.show', 'uses' => 'CRM\AppointController@show', 'allow' => ['shangjia']]);
        Route::get('appoint/{id}/edit', ['as' => 'appoint.edit', 'uses' => 'CRM\AppointController@edit', 'allow' => ['shangjia']]);
        Route::put('appoint/{id}', ['as' => 'appoint.update', 'uses' => 'CRM\AppointController@update', 'allow' => ['shangjia']]);
        Route::get('ordermeal', ['as' => 'ordermeal.index', 'uses' => 'CRM\OrderMealController@index', 'allow' => ['shangjia']]);
        Route::get('ordermeal/create', ['as' => 'ordermeal.create', 'uses' => 'CRM\OrderMealController@create', 'allow' => ['shangjia']]);
        Route::post('ordermeal', ['as' => 'ordermeal.store', 'uses' => 'CRM\OrderMealController@store', 'allow' => ['shangjia']]);
        Route::get('ordermeal/{id}', ['as' => 'ordermeal.show', 'uses' => 'CRM\OrderMealController@show', 'allow' => ['shangjia']]);
        Route::get('ordermeal/{id}/edit', ['as' => 'ordermeal.edit', 'uses' => 'CRM\OrderMealController@edit', 'allow' => ['shangjia']]);
        Route::put('ordermeal/{id}', ['as' => 'ordermeal.update', 'uses' => 'CRM\OrderMealController@update', 'allow' => ['shangjia']]);
        Route::get('withdraw', ['as' => 'withdraw.index', 'uses' => 'CRM\WithdrawController@index', 'allow' => ['shangjia']]);
        Route::get('checkout', ['as' => 'checkout.index', 'uses' => 'CRM\CheckoutController@index', 'allow' => ['shangjia']]);
        Route::post('checkout/check', ['as' => 'checkout.check', 'uses' => 'CRM\CheckoutController@check', 'allow' => ['shangjia']]);
        Route::post('checkout/pay', ['as' => 'checkout.pay', 'uses' => 'CRM\CheckoutController@pay', 'allow' => ['shangjia']]);
        Route::post('checkout/userinfo', ['as' => 'checkout.userinfo', 'uses' => 'CRM\CheckoutController@userinfo', 'allow' => ['shangjia']]);

        Route::get('account', ['as' => 'account.index', 'uses' => 'CRM\AccountController@index']);
        Route::any('account/password', ['as' => 'account.password', 'uses' => 'CRM\AccountController@password']);
    });
    Route::post('upload/image', ['as' => 'upload.image', 'uses' => 'CRM\UploadController@image']);
    Route::post('upload/video', ['as' => 'upload.video', 'uses' => 'CRM\UploadController@video']);

});

Route::group(['domain' => 'zhihui.hztbg.com', 'prefix' => 'wechat', 'as' => 'wechat.'], function () {
    Route::get('/', function () {
        //return redirect()->route('wechat.index');
    });
    Route::any('server', ['as' => 'server', 'uses' => 'Wechat\ServerController@index']);
    Route::group(['middleware' => ['web', 'wechat.oauth']], function () {
        Route::any('login', ['as' => 'login', 'uses' => 'Wechat\LoginController@index']);
        //投票活动
        Route::get('ownervote', ['as' => 'ownervote.index', 'uses' => 'Wechat\OwnervoteController@index']);
        Route::any('ownervote/apply', ['as' => 'ownervote.apply', 'uses' => 'Wechat\OwnervoteController@apply']);
        Route::get('ownervote/detail/{id}', ['as' => 'ownervote.detail', 'uses' => 'Wechat\OwnervoteController@detail'])->where('id', '[0-9]+');
        Route::get('ownervote/rank', ['as' => 'ownervote.rank', 'uses' => 'Wechat\OwnervoteController@rank']);
        Route::post('ownervote/vote', ['as' => 'ownervote.vote', 'uses' => 'Wechat\OwnervoteController@vote']);
        Route::post('ownervote/visit', ['as' => 'ownervote.visit', 'uses' => 'Wechat\OwnervoteController@visit']);
        Route::post('ownervote/share', ['as' => 'ownervote.share', 'uses' => 'Wechat\OwnervoteController@share']);
    });
});
