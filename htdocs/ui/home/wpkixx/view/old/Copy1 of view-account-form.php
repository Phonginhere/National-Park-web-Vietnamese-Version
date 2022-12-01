<div class="g-container">
   <section id="g-breadcrumb">
      <div class="g-grid">
         <div class="g-block size-100">
            <div class="g-content">
               <div class="platform-content">
                  <div class="moduletable ">
                     <ul itemscope="" itemtype="https://schema.org/BreadcrumbList" class="breadcrumb">
                        <li>
                           Bạn đang ở đây: &nbsp;
                        </li>
                        <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                           <a itemprop="item" href="/home-blog.php" class="pathway"><span itemprop="name">Trang Chủ</span></a>
                           <span class="divider">
                           <img src="/ui/home/news_joomla_19351868/template_files/arrow.png" alt="" width="9" height="9">	</span>
                           <meta itemprop="position" content="1">
                        </li>
                        <!-- 
                        <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                           <a itemprop="item" href="#" class="pathway"><span itemprop="name">More</span></a>
                           <span class="divider">
                           <img src="/ui/home/news_joomla_19351868/template_files/arrow.png" alt="" width="9" height="9">	</span>
                           <meta itemprop="position" content="2">
                        </li>
                        -->
                        <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem" class="active">
                           <span itemprop="name">Đăng Kí</span>
                           <meta itemprop="position" content="3">
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>

<!-- Báo Lỗi Đăng Kí -->
<?php if ($error_text) { ?>
<div class="g-container">
   <section id="g-system-messages">
      <div class="g-grid">
         <div class="g-block size-100">
            <div class="g-system-messages">
               <div id="system-message-container">
                  <div id="system-message">
                     <div class="alert alert-warning">
                        <a class="close" data-dismiss="alert">×</a>
                        <h4 class="alert-heading">Lỗi Đăng Nhập</h4>
                        <div>
                           <p><?php echo $error_text; ?></p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<?php }?>
<?php //unset($_SESSION['ERROR_TEXT']);?>


<!-- Form Register -->
<div class="g-container">
   <section id="g-container-main" class="g-wrapper">
      <div class="g-grid">
         <div class="g-block size-67">
            <section id="g-mainbody">
               <div class="g-grid">
                  <div class="g-block size-100">
                     <div class="g-content">
                        <div class="platform-content row-fluid">
                           <div class="span12">
                              <div class="registration">
                                 <form id="member-registration" action="/register.php" method="post" class="form-validate form-horizontal well" enctype="multipart/form-data">
                                    <fieldset>
                                       <legend>Đăng Kí Tài Khoản</legend>
                                       <div class="control-group field-spacer">
                                          <div class="control-label">
                                             <span class="spacer"><span class="before"></span><span class="text"><label id="jform_spacer-lbl" class=""><strong class="red">*</strong> Bắt Buộc</label></span><span class="after"></span></span>	
                                          </div>
                                          <div class="controls"></div>
                                       </div>
                                       <div class="control-group">
                                          <div class="control-label">
                                             <label id="jform_name-lbl" for="jform_name" class="hasPopover required" title="" data-content="Enter your full name." data-original-title="Name">
                                             Tên Đầy Đủ<span class="star">&nbsp;*</span></label>
                                          </div>
                                          <div class="controls">
                                             <input type="text" name="fullname" id="jform_name" value="<?php echo $fullname; ?>" class="required" size="30" required="required" aria-required="true">
                                          </div>
                                       </div>
                                       
                                       <div class="control-group">
                                          <div class="control-label">
                                             <label id="jform_email1-lbl" for="jform_email1" class="hasPopover required" title="" data-content="Enter your email address." data-original-title="Email Address">
                                             Email Address<span class="star">&nbsp;*</span></label>
                                          </div>
                                          <div class="controls">
                                             <input type="email" name="email" class="validate-email required" id="jform_email1" value="<?php echo $email; ?>" size="30" autocomplete="email" required="required" aria-required="true">	
                                          </div>
                                       </div>
                                       
                                       <div class="control-group">
                                          <div class="control-label">
                                             <label id="jform_password1-lbl" for="jform_password1" class="hasPopover required" title="" data-content="Enter your desired password." data-original-title="Password">
                                             Mật Khẩu<span class="star">&nbsp;*</span></label>
                                          </div>
                                          <div class="controls">
                                             <input type="password" name="password" id="jform_password1" value="<?php echo $password; ?>" autocomplete="off" class="validate-password required" size="30" maxlength="99" required="required" aria-required="true">	
                                          </div>
                                       </div>
                                       <div class="control-group">
                                          <div class="control-label">
                                             <label id="jform_password2-lbl" for="jform_password2" class="hasPopover required" title="" data-content="Confirm your password." data-original-title="Confirm Password">
                                             Xác Nhận Mật Khẩu<span class="star">&nbsp;*</span></label>
                                          </div>
                                          <div class="controls">
                                             <input type="password" name="confirm_password" id="jform_password2"  value="<?php echo $confirm_password;?>" autocomplete="off" class="validate-password required" size="30" maxlength="99" required="required" aria-required="true">	
                                          </div>
                                       </div>
                                       
                                       <div class="control-group">
                                          <div class="control-label">
                                             <label id="jform_email2-lbl" for="jform_addr" class="hasPopover required" title="" data-content="Địa chỉ..." data-original-title="Địa chỉ...">
                                             Address<span class="star"></span></label>
                                          </div>
                                          <div class="controls">
                                             <input type="text" name="address" class="" id="jform_addr" value="<?php echo $address; ?>" size="30" aria-required="true">	
                                          </div>
                                       </div>
                                       
                                       <div class="control-group">
                                          <div class="control-label">
                                             <label id="jform_email2-lbl" for="jform_phone" class="hasPopover required" title="" data-content="Điện Thoại" data-original-title="Điện thoại">
                                             Điện Thoại<span class="star"></span></label>
                                          </div>
                                          <div class="controls">
                                             <input type="tel" name="telephone" class="" id="jform_phone" value="<?php echo $telephone; ?>" size="30" >	
                                          </div>
                                       </div>
                                       
                                       
                                    </fieldset>
                                    <div class="control-group">
                                       <div class="controls">
                                          <button type="submit" class="btn btn-primary validate">Đăng Kí</button>
                                          <a class="btn" href="/templates/headlines/" title="Cancel">Hủy</a>
                                          <input type="hidden" name="option" value="com_users">
                                          <!-- input type="hidden" name="task" value="registration.register" -->
                                       </div>
                                    </div>
                                    <input type="hidden" name="3ee494a9cab8fb366bad8529b64c3841" value="1">	
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
         </div>
         <div class="g-block size-33">
            <aside id="g-aside">
               <div class="g-grid">
                  <div class="g-block size-100">
                     <div class="g-content">
                        <div class="platform-content">
                           <div class="moduletable  box2">
                              <h3 class="g-title"><span>Main Menu</span></h3>
                             <ul class="nav menu mod-list" id=" box2">
                              <li class="item-150 active deeper parent">
                                    <a href="#">Home</a>
                                    <ul class="nav-child unstyled small">
                                       <li class="item-181 current active"><a href="/register.php">Đăng Kí</a></li>
                                       <li class="item-178"><a href="/login.php">Đăng Nhập</a></li>
                                    </ul>
                                 </li>
                              <?php foreach (post_categoryGetAllForMenuHomePage() as $category) { ?>
	                              <?php if ($category['children']) { ?>
	                              <li class="active deeper parent">
	                                    <a href="<?php echo $category['href']?>"><?php echo $category['name']?></a>
	                                    <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
	                                    <ul class="nav-child unstyled small">
	                                       <?php foreach ($children as $child) { ?>
	                                       <li class="item-168"><a href="<?php echo $child['href']?>"><?php echo $child['name']?></a></li>
	                                       <?php } ?>
	                                    </ul>
	                                    <?php } ?>
	                                 </li>
	                              <?php } else { ?>
	                              <li class=""><a href="<?php echo $category['href']?>"><?php echo $category['name']?></a></li>
	                              <?php } ?>
	                          <?php } ?>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </aside>
         </div>
      </div>
   </section>
</div>

