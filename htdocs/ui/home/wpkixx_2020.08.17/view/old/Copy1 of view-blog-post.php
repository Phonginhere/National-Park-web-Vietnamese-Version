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
                        <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                           <a itemprop="item" href="/blog.php" class="pathway"><span itemprop="name">Blog</span></a>
                           <span class="divider">
                           <img src="/ui/home/news_joomla_19351868/template_files/arrow.png" alt="" width="9" height="9">	</span>
                           <meta itemprop="position" content="2">
                        </li>
                        <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem" class="active">
                           <span itemprop="name"><?php echo $post_info['title']; ?></span>
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
                              <article class="item item-page" itemscope="" itemtype="https://schema.org/Article">
                                 <meta itemprop="inLanguage" content="en-GB">
                                 <div class="pull-none item-image"> <img src="<?php echo $post_info['image']?>" alt="" itemprop="image" width="1000" height="500"> </div>
                                 <div class="g-article-header">
                                    <div class="page-header">
                                       <h2 itemprop="name">
                                          <?php echo $post_info['title']; ?>
                                       </h2>
                                    </div>
                                    <dl class="article-info muted">
                                       <dt class="article-info-term">
                                          Details							
                                       </dt>
                                       <dd class="createdby" itemprop="author" itemscope="" itemtype="http://schema.org/Person">
                                          <span itemprop="name" data-uk-tooltip="" title="Written by "><i class="fa fa-user"></i><?php echo $post_info['author'] ?></span>	
                                       </dd>
                                       <!-- 
                                       <dd class="category-name">
                                          <span data-uk-tooltip="" title="Article Category"><i class="fa fa-folder-open-o"></i><a href="/templates/headlines/index.php/business" itemprop="genre">Business</a></span>	
                                       </dd>
                                       -->
                                       <dd class="published">
                                          <time datetime="2016-09-15T10:11:21+00:00" itemprop="datePublished" data-uk-tooltip="" title="Published Date">
                                          <i class="fa fa-clock-o"></i><?php echo $post_info['date_published']?></time>
                                       </dd>
                                       <!-- 
                                       <dd class="hits">
                                          <meta itemprop="interactionCount" content="UserPageVisits:2851">
                                          <span data-uk-tooltip="" title="Hits: "><i class="fa fa-eye"></i>2851</span>
                                       </dd>
                                       -->
                                    </dl>
                                 </div>
                                 <div itemprop="articleBody">
                                   <?php echo $post_info['content'];?>
                                 </div>
                              </article>
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
                        
                        <?php if (!isset ($_SESSION['CUS_LOGGED'])) { ?>
                        <div class="platform-content">
                           <div class="moduletable box2">
                              <h3 class="g-title"><span>Login Form</span></h3>
                              <form action="/login.php" method="post" id="login-form" class="form-inline">
                                 <div class="userdata">
                                    <div id="form-login-username" class="control-group">
                                       <div class="controls">
                                          <label for="modlgn-username" class="element-invisible">E-mail</label>
                                          <input id="modlgn-username" type="text" name="email" tabindex="0" size="18" placeholder="Email">
                                       </div>
                                    </div>
                                    <div id="form-login-password" class="control-group">
                                       <div class="controls">
                                          <label for="modlgn-passwd" class="element-invisible">Password</label>
                                          <input id="modlgn-passwd" type="password" name="password" tabindex="0" size="18" placeholder="Password">
                                       </div>
                                    </div>
                                    <div id="form-login-remember" class="control-group checkbox">
                                       <label for="modlgn-remember" class="control-label">Remember Me</label> <input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes">
                                    </div>
                                    <div id="form-login-submit" class="control-group">
                                       <div class="controls">
                                          <button type="submit" tabindex="0" name="Submit" class="btn btn-primary">Log in</button>
                                       </div>
                                    </div>
                                    <ul class="unstyled">
                                       <li>
                                          <a href="/register.php">
                                          <i class="fa fa-question-circle"></i>Create an account</a>
                                       </li>
                                       <li>
                                          <a href="#?view=remind">
                                          <i class="fa fa-question-circle"></i>Forgot your username?</a>
                                       </li>
                                       <li>
                                          <a href="#?view=reset">
                                          <i class="fa fa-question-circle"></i>Forgot your password?</a>
                                       </li>
                                    </ul>
                                    
                                 </div>
                              </form>
                           </div>
                        </div>
                        <?php } ?>
                        
                        <div class="platform-content">
                           <div class="moduletable box2">
                              <h3 class="g-title"><span>Who's Online</span></h3>
                              <!--  p>We have 20&nbsp;guests and no members online</p -->
                              <p>We have many guests and members online.</p>
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

