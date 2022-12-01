<section>
                <div class="gap">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="contact-us">
                                    <div class="bread-crumb">
                                        <ul>
                                            <li><a href="/home.php" title="">Trang Chủ</a></li>
                                            <li><a href="/login.php" title="">Đăng Nhập</a></li>
                                        </ul>
                                    </div>
                                    <!-- 
                                    <div class="gap no-top contact-detail">
                                        <h3>Trang Đăng Kí Tài Khoản</h3>
                                        <p>Chào mừng bạn đến với dịch vụ internet của chúng tôi.</p>
                                        <p>Chúng tôi cam kết đem đến trải nghiệm người dùng tốt với người dùng có tài khoản.</p>
                                    </div>
                                    -->
                                    
                                    <!-- Báo Lỗi Đăng Kí -->
									<?php if ($error_text) { ?>
									<div class="alert alert-warning gap no-top contact-detail" style="padding: 10px">
										<a class="close" data-dismiss="alert">×</a>
									    <h4>Lỗi Đăng Nhập</h4>
									    <p style="color:red"><?php echo $error_text; ?></p>
									</div>
									<?php }?>
                                    
                                    <div class="contact-form">
                                        <div class="single-title">
                                            <h4>Login Form</h4>
                                        </div>
                                        <div class="row">
                                            <form method="post" action="/login.php">
                                                <div class="col-sm-6">
                                                	<label>Thư điện tử</label>
                                                    <input placeholder="Email*" type="text" name="email" value="<?php echo $email; ?>" class="username" style="text-transform: none;">
                                                </div>
                                                <div class="col-sm-12">&nbsp;</div>
                                                <div class="col-sm-6">
                                                    <label>Mật Khẩu</label>
                                                    <input placeholder="Password*" type="password" name="password" value="<?php echo $password; ?>" style="text-transform: none;">
                                                </div>
                                                <!-- 
                                                <div class="col-sm-12">
                                                    <textarea cols="30" rows="10" placeholder="your comment*"></textarea>
                                                </div>
                                                 -->
                                                <div class="col-sm-12">
                                                    <button type="submit">Đăng Nhập</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <aside>
                                    <div class="widget">
                                        <div class="widget-title">
                                            <h4>Liên Hệ</h4>
                                        </div>
                                        <ul class="contact-widget">
                                            <li>
                                                <span>Điện Thoại</span>
                                                <ins><?php echo web_telephone();?></ins>
                                            </li>
                                            <li>
                                                <span>Email</span>
                                                <ins><?php echo web_email(); ?></ins>
                                            </li>
                                            <li>
                                                <b><?php echo store_address(); ?></b>
                                            </li>
                                        </ul>
                                    </div><!-- contact info widget -->
                                    <div class="widget">
                                        <div class="widget-title">
                                            <h4>Tin Thư</h4>
                                        </div>
                                        <div class="subscribe-us">
                                            <i class="fa fa-envelope-o"></i>
                                            <span>Hãy đăng kí nhận tin từ chúng tôi để luôn cập nhật với tin tức hằng ngày.</span>
                                            <form method="post" action="/contact.php">
                                                <input type="text" placeholder="Your Email*">
                                                <button><i class="fa fa-reply"></i></button>
                                                
                                                <input type="hidden" name="subject" value="Nhận Tin Thư"/>
                                                <input type="hidden" name="message" value="Tôi muốn nhận tin thư hằng ngày"/>
                                            </form>
                                        </div>
                                    </div><!-- subscribe widget -->
                                </aside>
                            </div><!-- side-widgets -->
                        </div>
                    </div>
                </div>
            </section>