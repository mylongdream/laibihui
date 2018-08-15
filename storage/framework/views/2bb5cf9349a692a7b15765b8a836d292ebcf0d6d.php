<div class="shead cl">
    <div class="wp">
        <div class="z">
            <h1 class="logo">
                <a title="<?php echo e($setting['sitename']); ?>" href="<?php echo e(route('index')); ?>"><img border="0" alt="<?php echo e($setting['sitename']); ?>" src="<?php echo e(asset('static/image/common/logo.png')); ?>"></a>
            </h1>
            <div class="home"><a href="<?php echo e(route('index')); ?>">首页</a></div>
            <div class="nav trigger-hover">
                <div class="txt">
                    <span><i class="z"></i>导航<i class="y"></i></span>
                </div>
                <div class="sub">
                    <ul>
                        <?php $__currentLoopData = $navs->where('type', 'headernav')->where('parentid', '0'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e(url($nav->url)); ?>" title="<?php echo e($nav->title); ?>" hidefocus="true" <?php if($nav->target): ?> target="_blank" <?php endif; ?>><?php echo e($nav->title); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="y">
            <?php if(auth()->guard()->check()): ?>
                <div class="user trigger-hover">
                    <div class="txt">
                        <div class="info">
                            <div class="avtm z"><img width="20" height="20" src="<?php echo e(auth()->user()->headimgurl ? uploadImage(auth()->user()->headimgurl) : asset('static/image/common/getheadimg.jpg')); ?>"></div>
                            <div class="username"><?php echo e(auth()->user()->username); ?></div>
                            <div class="arrow y"></div>
                        </div>
                    </div>
                    <div class="sub">
                        <ul>
                            <li>
                                <a hidefocus="true" href="<?php echo e(route('user.index')); ?>">个人中心</a>
                            </li>
                            <li>
                                <a hidefocus="true" href="<?php echo e(route('user.profile.index')); ?>">资料修改</a>
                            </li>
                            <li>
                                <a hidefocus="true" href="<?php echo e(route('user.password.index')); ?>">密码安全</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="logout">
                    <a href="<?php echo e(route('logout')); ?>">退出</a>
                </div>
            <?php else: ?>
                <div class="login">
                    <a href="<?php echo e(route('login', ['ReturnUrl' => request()->getUri()])); ?>">登录</a>
                </div>
                <div class="register">
                    <a href="<?php echo e(route('register')); ?>">注册</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>