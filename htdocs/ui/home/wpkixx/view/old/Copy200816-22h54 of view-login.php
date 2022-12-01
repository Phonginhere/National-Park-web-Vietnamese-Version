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
                           <span itemprop="name">Đăng Nhập</span>
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
                              <div class="login">
                                 <form action="/login.php" method="post" class="form-validate form-horizontal well">
                                    <fieldset>
                                       <div class="control-group">
                                          <div class="control-label">
                                             <label id="username-lbl" for="username" class="required invalid">
                                             Email<span class="star">&nbsp;*</span></label>
                                          </div>
                                          <div class="controls">
                                             <input type="text" name="email" id="username" value="<?php echo $email;?>" class="validate-username required invalid" size="25" required="required" aria-required="true" autofocus="" aria-invalid="true">
                                          </div>
                                       </div>
                                       <div class="control-group">
                                          <div class="control-label">
                                             <label id="password-lbl" for="password" class="required">
                                             Password<span class="star">&nbsp;*</span></label>
                                          </div>
                                          <div class="controls">
                                             <input type="password" name="password" id="password" value="<?php echo $password;?>" class="validate-password required" size="25" maxlength="99" required="required" aria-required="true">	
                                          </div>
                                       </div>
                                       <div class="control-group">
                                          <div class="control-label">
                                             <label for="remember">
                                             Remember me						</label>
                                          </div>
                                          <div class="controls">
                                             <input id="remember" type="checkbox" name="remember" class="inputbox" value="yes">
                                          </div>
                                       </div>
                                       <div class="control-group">
                                          <div class="controls">
                                             <button type="submit" class="btn btn-primary">
                                             Log in					</button>
                                          </div>
                                       </div>
                                       <!-- input type="hidden" name="return" value="aHR0cDovL2RlbW8uaW5zcGlyZXRoZW1lLmNvbS90ZW1wbGF0ZXMvaGVhZGxpbmVzL2luZGV4LnBocC9tb3JlL3JlZ2lzdHJhdGlvbi1mb3Jt" -->
                                       <input type="hidden" name="ru" value="<?php echo $_GET['ru'];?>">
                                       <input type="hidden" name="68cadd43b7c1da429caf849ebe8fe5f8" value="1">	
                                    </fieldset>
                                 </form>
                              </div>
                              <!-- 
                              <div>
                                 <ul class="nav nav-tabs nav-stacked">
                                    <li>
                                       <a href="/templates/headlines/index.php/more/registration-form?view=reset">
                                       Forgot your password?			</a>
                                    </li>
                                    <li>
                                       <a href="/templates/headlines/index.php/more/registration-form?view=remind">
                                       Forgot your username?			</a>
                                    </li>
                                    <li>
                                       <a href="/templates/headlines/index.php/more/registration-form">
                                       Don't have an account?				</a>
                                    </li>
                                 </ul>
                              </div>
                               -->
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
                                       <li class="item-181"><a href="/register.php">Đăng Kí</a></li>
                                       <li class="item-178 current active"><a href="/login.php">Đăng Nhập</a></li>
                                    </ul>
                                 </li>
                              <?php foreach (post_categoryGetAllForMenuHomePage() as $category) { ?>
	                              <?php if ($category['children']) { ?>
	                              <li class="deeper parent">
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