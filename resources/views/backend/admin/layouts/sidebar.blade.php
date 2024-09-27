<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{route('admin.dashboard')}}"> {{$settings->site_name}}</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="javascript:;">Sa</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="dropdown {{setActive(['admin.dashboard'])}}">
          <a href="{{route('admin.dashboard')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
          <li class="menu-header">E-Commerce</li>
          <li class="dropdown {{setActive([
            'admin.category.*',
            'admin.sub-category.*',
            'admin.child-category.*'
          ])}}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-list"></i> <span>Manage Categories</span></a>
            <ul class="dropdown-menu">
              <li class="{{setActive(['admin.category.*'])}}"><a class="nav-link" href="{{route('admin.category.index')}}">Category </a></li>
              <li class="{{setActive(['admin.sub-category.*'])}}"><a class="nav-link" href="{{route('admin.sub-category.index')}}">Sub Category </a></li>
              <li class="{{setActive(['admin.child-category.*'])}}"><a class="nav-link" href="{{route('admin.child-category.index')}}">Child Category </a></li>

            </ul>
        </li>
            <li class="dropdown {{setActive([
                'admin.brand.*',
                'admin.products.*',
                'admin.products-image-gallery.*',
                'admin.product-variant.*',
                'admin.products-variant-item.*',
                'admin.seller-product.*',
                'admin.seller-product-pending.*',
                'admin.reviews.index',
                ])}}">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-box"></i> <span>Manage Products</span></a>
              <ul class="dropdown-menu">
                <li class="{{setActive(['admin.brand.*'])}}"><a class="nav-link" href="{{route('admin.brand.index')}}">Brands</a></li>
                <li class="{{setActive([
                'admin.products.*',
                'admin.products-image-gallery.*',
                'admin.product-variant.*',
                'admin.products-variant-item.*',
                ])}}"><a class="nav-link" href="{{route('admin.products.index')}}">Products</a></li>
                <li class="{{setActive(['admin.seller-product.*'])}}"><a class="nav-link" href="{{route('admin.seller-product.index')}}">Seller Products</a></li>
                <li class="{{setActive(['admin.seller-product-pending.*'])}}"><a class="nav-link" href="{{route('admin.seller-product-pending.index')}}">Pending Products</a></li>
                <li class="{{setActive(['admin.reviews.index'])}}"><a class="nav-link" href="{{route('admin.reviews.index')}}">Product Reviews</a></li>
              </ul>
            </li>
            <li class="dropdown {{setActive([
                'admin.order.*',
                'admin.pending-orders',
                'admin.processed-orders',
                'admin.dropped-off-orders',
                'admin.shipped-orders',
                'admin.out-for-delivery-orders',
                'admin.delivered-orders',
                'admin.cancelled-orders'
              ])}}">
                 <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cart-plus"></i></i> <span>Orders</span></a>
                <ul class="dropdown-menu">
                  <li class="{{setActive(['admin.order.*'])}}"><a class="nav-link" href="{{route('admin.order.index')}}">All Orders </a></li>
                   <li class="{{setActive(['admin.pending-orders'])}}"><a class="nav-link" href="{{route('admin.pending-orders')}}">All Pending Orders</a></li>
                  <li class="{{setActive(['admin.processed-orders'])}}"><a class="nav-link" href="{{route('admin.processed-orders')}}">All Processed Orders</a></li>
                  <li class="{{setActive(['admin.dropped-off-orders'])}}"><a class="nav-link" href="{{route('admin.dropped-off-orders')}}">All Dropped Off Orders</a></li>
                  <li class="{{setActive(['admin.shipped-orders'])}}"><a class="nav-link" href="{{route('admin.shipped-orders')}}">All Shipped Orders</a></li>
                  <li class="{{setActive(['admin.out-for-delivery-orders'])}}"><a class="nav-link" href="{{route('admin.out-for-delivery-orders')}}">All Out For Delivery Orders</a></li>
                  <li class="{{setActive(['admin.delivered-orders'])}}"><a class="nav-link" href="{{route('admin.delivered-orders')}}">All Delivered Orders</a></li>
                  <li class="{{setActive(['admin.cancelled-orders'])}}"><a class="nav-link" href="{{route('admin.cancelled-orders')}}">All Cancelled Orders</a></li>

                </ul>
            </li>

            <li class="{{setActive(['admin.transaction'])}}"><a class="nav-link" href="{{route('admin.transaction')}}"><i class="fas fa-money-bill-alt"></i><span>Transactions</span></a></li>

            <li class="dropdown {{setActive([
            'admin.vendor-profile.*',
            'admin.coupons.*',
            'admin.shipping-rule.*',
            'admin.flash-sale.*',
            'admin.payment-settings.*'
            ])}}">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>E-commerce</span></a>
              <ul class="dropdown-menu">
                <li class="{{setActive(['admin.vendor-profile.*'])}}"><a class="nav-link" href="{{route('admin.vendor-profile.index')}}">Vendor Profile</a></li>
                <li class="{{setActive(['admin.flash-sale.*'])}}"><a class="nav-link" href="{{route('admin.flash-sale.index')}}">Flash Sale</a></li>
                <li class="{{setActive(['admin.shipping-rule.*'])}}"><a class="nav-link" href="{{route('admin.shipping-rule.index')}}">Shipping Rule</a></li>
                <li class="{{setActive(['admin.coupons.*'])}}"><a class="nav-link" href="{{route('admin.coupons.index')}}">Coupons</a></li>
                <li class="{{setActive(['admin.payment-settings.*'])}}"><a class="nav-link" href="{{route('admin.payment-settings.index')}}">Payment Setting</a></li>
              </ul>
            </li>
            <li class="dropdown {{setActive([
                'admin.withdraw-method.*',
                'admin.withdraw.index',
                'admin.withdraw.show',
            ])}} ">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-wallet"></i> <span>Withdraw Payments</span></a>
              <ul class="dropdown-menu">
                <li class="{{setActive(['admin.withdraw-method.*'])}}"><a class="nav-link" href="{{route('admin.withdraw-method.index')}}">Withdraw Method</a></li>
                <li class="{{setActive(['admin.withdraw.index'])}}"><a class="nav-link" href="{{route('admin.withdraw.index', 'admin.withdraw.show')}}">Withdraw List</a></li>
              </ul>
            </li>
        <li class="dropdown {{setActive([
            'admin.slider.*',
            'admin.home-page-setting.index',
            'admin.vendor-condition.index',
            'admin.about',
            'admin.terms-and-condition',
        ])}} ">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i> <span>Manage Website</span></a>
          <ul class="dropdown-menu">
            <li class="{{setActive(['admin.slider.*'])}}"><a class="nav-link" href="{{route('admin.slider.index')}}">Slider </a></li>
            <li class="{{setActive(['admin.home-page-setting.index'])}}"><a class="nav-link" href="{{route('admin.home-page-setting.index')}}">Home Page Setting</a></li>
            <li class="{{setActive(['admin.vendor-condition.index'])}}"><a class="nav-link" href="{{route('admin.vendor-condition.index')}}">Vendor Condition</a></li>
            <li class="{{setActive(['admin.about'])}}"><a class="nav-link" href="{{route('admin.about')}}">About Page</a></li>
            <li class="{{setActive(['admin.terms-and-condition'])}}"><a class="nav-link" href="{{route('admin.terms-and-condition')}}">Terms and Conditions</a></li>

          </ul>
        </li>
        <li class="{{setActive(['admin.adv..index'])}}"><a class="nav-link" href="{{route('admin.adv.index')}}"><i class="fas fa-ad"></i><span>Advertisement</span></a></li>
        <li class="dropdown {{setActive([
            'admin.blog-category.*',
            'admin.blog.*',
            'admin.blog-comment.index',
        ])}} ">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fab fa-blogger-b"></i> <span>Manage Blog</span></a>
          <ul class="dropdown-menu">
            <li class="{{setActive(['admin.blog-category.*'])}}"><a class="nav-link" href="{{route('admin.blog-category.index')}}">Categories</a></li>
            <li class="{{setActive(['admin.blog.*'])}}"><a class="nav-link" href="{{route('admin.blog.index')}}">Blogs</a></li>
            <li class="{{setActive(['admin.blog-comment.index'])}}"><a class="nav-link" href="{{route('admin.blog-comment.index')}}">Blogs Comments</a></li>
          </ul>
        </li>

        <li class="menu-header">Settings & More</li>
        <li class="dropdown {{setActive([
            'admin.footer-info.*',
            'admin.footer-socials.*',
            'admin.footer-grid-two.*',
            'admin.footer-grid-three.*',
        ])}} ">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th-large"></i> <span>Footer</span></a>
          <ul class="dropdown-menu">
            <li class="{{setActive(['admin.footer-info.*'])}}"><a class="nav-link" href="{{route('admin.footer-info.index')}}">Footer Info </a></li>
            <li class="{{setActive(['admin.footer-socials.*'])}}"><a class="nav-link" href="{{route('admin.footer-socials.index')}}">Footer Social </a></li>
            <li class="{{setActive(['admin.footer-grid-two.*'])}}"><a class="nav-link" href="{{route('admin.footer-grid-two.index')}}">Footer Grid Two </a></li>
            <li class="{{setActive(['admin.footer-grid-three.*'])}}"><a class="nav-link" href="{{route('admin.footer-grid-three.index')}}">Footer Grid Three </a></li>
          </ul>
        </li>
        <li class="dropdown {{setActive([
            'admin.vendor-request.index',
            'admin.customer.index',
            'admin.vendor.index',
            'admin.manage-user.index',
            'admin.admin-list.index'
        ])}} ">
         <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Users</span></a>
         <ul class="dropdown-menu">
            <li class="{{setActive(['admin.customer.index'])}}"><a class="nav-link" href="{{route('admin.customer.index')}}">Customer list</a></li>
            <li class="{{setActive(['admin.vendor.index'])}}"><a class="nav-link" href="{{route('admin.vendor.index')}}">Vendor list</a></li>
            <li class="{{setActive(['admin.admin-list.index'])}}"><a class="nav-link" href="{{route('admin.admin-list.index')}}">Admin list</a></li>
            <li class="{{setActive(['admin.vendor-request.index'])}}"><a class="nav-link" href="{{route('admin.vendor-request.index')}}">Pending Vendors </a></li>
            <li class="{{setActive(['admin.manage-user.index'])}}"><a class="nav-link" href="{{route('admin.manage-user.index')}}">Manager User </a></li>
          </ul>
        </li>
        <li class="{{setActive(['admin.subscribers.index'])}}"><a class="nav-link" href="{{route('admin.subscribers.index')}}"><i class="fas fa-user-plus"></i><span>Subscribers</span></a></li>
        <li class="{{setActive(['admin.setting.index'])}}"><a class="nav-link" href="{{route('admin.setting.index')}}"><i class="fas fa-wrench"></i><span>Settings</span></a></li>

          {{-- for later copy --}}
          {{-- drop down menu for later work :
             <ul class="dropdown-menu">
            <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
            <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
            <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
            <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>
          </ul> --}}
        </li>

      </ul>
     </aside>
  </div>
