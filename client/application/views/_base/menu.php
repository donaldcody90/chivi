<header>
  <div class="top-bar header-menu-top">
    <div class="menu-utility">
      <div class="container">
        <div class="pull-left" id="show-user-top">
          <span class="welcome hello-user">Chào mừng quý khách đến với ChiVi</span>
          <ul class="login-signup">
            <li>
              <a href="#" title="Đăng nhập"><i class="glyphicon glyphicon-log-in"></i> Đăng nhập</a>                        
            </li>
            <li>
              <a href="#" title="Đăng ký"><i class="glyphicon glyphicon-user"></i> Đăng ký</a>                        
            </li>
          </ul>
        </div>
        <div class="pull-right">
          <ul>
            <li>
              <a href="#" title="Sản phẩm yêu thích"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Yêu thích</a>                        
            </li>
            <li class="notify" id="show-notification-new">
              <a class="item-notify" href="#" title="Thông báo"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> Thông báo</a>                            <!--                            <a href="#">-->
              <div class="notify-content">
              </div>
            </li>
            <li>
              <a href="#" title="Trợ giúp"><i class="glyphicon glyphicon-question-sign"></i> Trợ giúp</a>                        
            </li>
            <li>
              <a href="<?php echo site_url('cart');?>" title="Trợ giúp"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Giỏ hàng
              <strong class="count">(<b id="booking-quantity">0</b>)</strong></a>                        
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- /Menu Utility -->
  </div>
  <div class="middle-bar">
    <div class="container p-full">
      <div class="logo pull-left">
        <h1><a href="#" title="20/10"><img src="static/images/e68e7bcaf0949441630248451a84795f.png" alt="20/10"></a>        </h1>
      </div>
      <div class="search">
        <div class="search-box">
          <form id="main-search" class="search-form" action="#" method="get">
            <div class="btn-group  filter-search btComboBox" id="filter-search">
              <button type="button" class="btn btn-filter-search dropdown-toggle" data-toggle="dropdown"
                name="fruit" id="filter-search-tog" aria-expanded="false">
              <span
                class="label">Sản phẩm</span>
              <span class="caret"></span>
              </button>
              <ul class="dropdown-menu select-type-search" role="menu"
                style="min-width: 100px; width: 102px;">
                <li class="default active">
                  <a href="#" data-type="product">Sản phẩm</a>
                </li>
                <li class="default ">
                  <a href="#" data-type="shop">Cửa hàng</a>
                </li>
              </ul>
            </div>
            <input class="form-control" type="text" name="keyword" value=""
              placeholder="Nhập tên hoặc mã sản phẩm..." id="txtSearchKeyword">
            <button type="submit" class="btn btn-search pull-right" type="button">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
          </form>
          <div class="search-tags">
            <span>Tìm kiếm nhiều:</span>
            <a href="#">váy</a>, <a href="#">đầm</a>, 
            <a href="#">túi xách</a>, 
            <a href="#">giày nữ</a>, 
            <a href="#">giày nam</a>, 
            <a href="#">áo sơ mi</a>, 
            <a href="#">áo thun</a>
          </div>
        </div>
      </div>
      <div class="hotline">
        <strong>Hà Nội: <span>04.7303 1999</span></strong>
        <strong>Tp.HCM: <span>08.7302 8666</span></strong>
      </div>
      <div class="account">
      </div>
    </div>
  </div>
  <div class="block-nav">
    <div class="container p-full">
      <div class="category pull-left">
        <div class="category-title">
          <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
          <strong>Danh mục sản phẩm</strong>
        </div>
        <div class="category-list">
          <ul class="main-menu">
			<?php if(isset($category_lists) && $category_lists!= array('') && $category_lists!= '' ){
			foreach($category_lists as $cat0){ ?>
            <li>
              <a href="<?php echo site_url().url_title(cleanVietnamese($cat0['name']),'-',true).'-c'.$cat0['id'];?>">
                <span class="icon">
				  <img src="<?php echo $cat0['icon_link'];?>" alt="<?php echo $cat0['name'];?>" max-height="32px" max-weight="32px">
			    </span> <?php echo $cat0['name'];?></a>
              <div class="sub-category" id="msmn1000001">
                <div class="sub-category-list">
                  <ul>
					<?php if(isset($cat0['children']) && $cat0['children']!= array('') && $cat0['children']!= '' ){
					foreach($cat0['children'] as $cat1){ ?>
                    <li>
                      <h3><a href="<?php echo site_url().url_title(cleanVietnamese($cat1['name']),'-',true).'-c'.$cat1['id'];?>" title="<?php echo $cat1['name'];?>"><?php echo $cat1['name'];?></a></h3>
                      <ul>
						<?php if(isset($cat1['children']) && $cat1['children']!= array('') && $cat1['children']!= '' ){
						foreach($cat1['children'] as $cat2){ ?>
                        <li>
                          <a href="<?php echo site_url().url_title(cleanVietnamese($cat2['name']),'-',true).'-c'.$cat2['id'];?>" title="<?php echo $cat2['name'];?>"><?php echo $cat2['name'];?></a>
                        </li>
                        <?php } } ?>
                      </ul>
                    </li>
					<?php } } ?>
                  </ul>
                </div>
              </div>
            </li>
			<?php } } ?>
          </ul>
        </div>
      </div>
      <!--/Category -->
      <ul class="nav navbar-nav navbar-main">
        <li>
          <a href="#" title="Quần áo">Quần áo</a>
        </li>
        <li>
          <a href="#" title="Giày dép">Giày dép</a>
        </li>
        <li>
          <a href="#" title="Túi xách, ví da">Túi xách, ví da</a>
        </li>
        <li>
          <a href="#" title="Phụ kiện">Phụ kiện</a>
        </li>
        <li>
          <a href="#" title="Cửa hàng">Cửa hàng</a>
        </li>
      </ul>
      <!-- /Nav Right -->
    </div>
  </div>
  <!--/Nav Main -->
</header>
