<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar" style="margin-top: 45px;">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
      <ul class="sidebar-menu">
        @if(Auth::user()->isMerchant())
        <li class=" {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
          <a href="{{ url('admin/dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Overview</span>
          </a>
        </li>
        <li class=" {{ Request::is('admin/order/order*') ? 'active' : '' }}">
          <a href="{{ url('admin/order/order') }}">
            <i class="fa fa-angle-double-right"></i>Transaction
          </a>
        </li>
        <li class=" {{ Request::is('admin/stock/inventory*') ? 'active' : '' }}">
          <a href="{{ url('admin/stock/inventory') }}">
            <i class="fa fa-angle-double-right"></i>Stock
          </a>
        </li>
        <li class=" {{ Request::is('admin/catalog/product*') ? 'active' : '' }}">
          <a href="{{ url('admin/catalog/product') }}">
            <i class="fa fa-angle-double-right"></i> {{ trans('nav.products') }}
          </a>
        </li>

        <li class=" {{ Request::is('admin/support/dispute*') ? 'active' : '' }}">
          <a href="{{ url('admin/support/dispute') }}">
            <i class="fa fa-angle-double-right"></i>Disputes
          </a>
        </li>
        <li class=" {{ Request::is('admin/shop/report/kpi*') ? 'active' : '' }}">
          <a href="{{ route('admin.shop-kpi') }}">
            <i class="fa fa-angle-double-right"></i>Statistics
          </a>
        </li>
        {{-- <li class=" {{ Request::is('admin/promotion/coupon*') ? 'active' : '' }}">
          <a href="{{ url('admin/promotion/coupon') }}">
            <i class="fa fa-angle-double-right"></i>Coupons
          </a>
        </li> --}}
        <!--<li class=" {{ Request::is('admin/setting/paymentMethod*') ? 'active' : '' }}">-->
        <!--    <a href="{{ url('admin/setting/paymentMethod') }}">-->
        <!--      <i class="fa fa-angle-double-right"></i> {{ trans('nav.payment_methods') }}-->
        <!--    </a>-->
        <!--  </li>-->
        @endif
        @if(Auth::user()->isAdmin())
            <li class=" {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
              <a href="{{ url('admin/dashboard') }}">
                <i class="fa fa-dashboard"></i> <span>Overview</span>
              </a>
            </li>
            <li class=" {{ Request::is('admin/admin/user*') ? 'active' : '' }}">
              <a href="{{ url('admin/admin/user') }}">
                <i class="fa fa-angle-double-right"></i>Associates
              </a>
            </li>
            <li class=" {{ Request::is('admin/admin/customer*') || Request::is('address/addresses/customer*') ? 'active' : '' }}">
              <a href="{{ url('admin/admin/customer') }}">
                <i class="fa fa-angle-double-right"></i> {{ trans('nav.customers') }}
              </a>
            </li>
            <li class=" {{ Request::is('admin/vendor/merchant*') ? 'active' : '' }}">
              <a href="{{ url('admin/vendor/merchant') }}">
                <i class="fa fa-angle-double-right"></i> {{ trans('nav.merchants') }}
              </a>
            </li>
            <li class="treeview {{ Request::is('admin/catalog*') ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-tags"></i>
              <span>Categories</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">

                  <li class="{{ Request::is('admin/catalog/categoryGroup*') ? 'active' : '' }}">
                    <a href="{{ route('admin.catalog.categoryGroup.index') }}">
                      <i class="fa fa-angle-right"></i>{{ trans('nav.groups') }}
                    </a>
                  </li>
                  <li class="{{ Request::is('admin/catalog/categorySubGroup*') ? 'active' : '' }}">
                    <a href="{{ route('admin.catalog.categorySubGroup.index') }}">
                      <i class="fa fa-angle-right"></i>{{ trans('nav.sub-groups') }}
                    </a>
                  </li>
                  <li class="{{ Request::is('admin/catalog/category') ? 'active' : '' }}">
                    <a href="{{ url('admin/catalog/category') }}">
                      <i class="fa fa-angle-right"></i>{{ trans('nav.categories') }}
                    </a>
                  </li>

              </ul>
          </li>
          <li class=" {{ Request::is('admin/catalog/product*') ? 'active' : '' }}">
              <a href="{{ url('admin/catalog/product') }}">
                <i class="fa fa-angle-double-right"></i> {{ trans('nav.products') }}
              </a>
            </li>
            <li class=" {{ Request::is('admin/support/dispute*') ? 'active' : '' }}">
          <a href="{{ url('admin/support/dispute') }}">
            <i class="fa fa-angle-double-right"></i>Dispute
          </a>
        </li>
        <li class=" {{ Request::is('admin/report/kpi*') ? 'active' : '' }}">
          <a href="{{ route('admin.kpi') }}">
            <i class="fa fa-angle-double-right"></i> Reviews
          </a>
        </li>
        <li class=" {{ Request::is('admin/report/visitors*') ? 'active' : '' }}">
          <a href="{{ route('admin.report.visitors') }}">
            <i class="fa fa-angle-double-right"></i> Reports
          </a>
        </li>
        <li class="treeview {{ Request::is('admin/setting*') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-gears"></i>
            <span>{{ trans('nav.settings') }}</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            @can('index', \App\SubscriptionPlan::class)
              <li class=" {{ Request::is('admin/setting/subscriptionPlan*') ? 'active' : '' }}">
                <a href="{{ url('admin/setting/subscriptionPlan') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.subscription_plans') }}
                </a>
              </li>
            @endcan

            @can('index', \App\Role::class)
              <li class=" {{ Request::is('admin/setting/role*') ? 'active' : '' }}">
                <a href="{{ url('admin/setting/role') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.user_roles') }}
                </a>
              </li>
            @endcan

            @can('index', \App\Tax::class)
              <li class=" {{ Request::is('admin/setting/tax*') ? 'active' : '' }}">
                <a href="{{ url('admin/setting/tax') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.taxes') }}
                </a>
              </li>
            @endcan

            @can('index', \App\EmailTemplate::class)
              <li class=" {{ Request::is('admin/setting/emailTemplate*') ? 'active' : '' }}">
                <a href="{{ url('admin/setting/emailTemplate') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.email_templates') }}
                </a>
              </li>
            @endcan

            @can('view', \App\Config::class)
              <li class=" {{ Request::is('admin/setting/general*') ? 'active' : '' }}">
                <a href="{{ url('admin/setting/general') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.general') }}
                </a>
              </li>

              <li class=" {{ Request::is('admin/setting/config*') ? 'active' : '' }}">
                <a href="{{ url('admin/setting/config') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.config') }}
                </a>
              </li>

              <li class=" {{ Request::is('admin/setting/paymentMethod*') ? 'active' : '' }}">
                <a href="{{ url('admin/setting/paymentMethod') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.payment_methods') }}
                </a>
              </li>
            @endcan

            @can('view', \App\System::class)
              <li class=" {{ Request::is('admin/setting/system/general*') ? 'active' : '' }}">
                <a href="{{ url('admin/setting/system/general') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.system_settings') }}
                </a>
              </li>
            @endcan

            @can('view', \App\SystemConfig::class)
              <li class=" {{ Request::is('admin/setting/system/config*') ? 'active' : '' }}">
                <a href="{{ url('admin/setting/system/config') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.config') }}
                </a>
              </li>
            @endcan

            @if(Auth::user()->isAdmin())
              <li class=" {{ Request::is('admin/setting/announcement*') ? 'active' : '' }}">
                <a href="{{ url('admin/setting/announcement') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.announcements') }}
                </a>
              </li>
            @endif
          </ul>
        </li>
        <li class="treeview {{ Request::is('admin/utility*') ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-asterisk"></i>
              <span>{{ trans('nav.utilities') }}</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              {{-- @can('index', \App\Currency::class)
                <li class=" {{ Request::is('admin/utility/currency*') ? 'active' : '' }}">
                  <a href="{{ url('admin/utility/currency') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.currencies') }}
                  </a>
                </li>
              @endcan --}}

              @can('index', \App\OrderStatus::class)
                <li class=" {{ Request::is('admin/utility/orderStatus*') ? 'active' : '' }}">
                  <a href="{{ url('admin/utility/orderStatus') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.order_statuses') }}
                  </a>
                </li>
              @endcan

              @can('index', \App\Page::class)
                <li class=" {{ Request::is('admin/utility/page*') ? 'active' : '' }}">
                  <a href="{{ url('admin/utility/page') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.pages') }}
                  </a>
                </li>
              @endcan

              @can('index', \App\Blog::class)
                <li class=" {{ Request::is('admin/utility/blog*') ? 'active' : '' }}">
                  <a href="{{ url('admin/utility/blog') }}">
                    <i class="fa fa-angle-double-right"></i> <span>{{ trans('nav.blogs') }}</span>
                  </a>
                </li>
              @endcan

              @can('index', \App\Faq::class)
                <li class=" {{ Request::is('admin/utility/faq*') ? 'active' : '' }}">
                  <a href="{{ url('admin/utility/faq') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.faqs') }}
                  </a>
                </li>
              @endcan
              @if(Auth::user()->isAdmin() || Auth::user()->isAdmin())
                <li class=" {{ Request::is('admin/utility/city*') ? 'active' : '' }}">
                  <a href="{{ url('admin/utility/city') }}">
                    <i class="fa fa-angle-double-right"></i> Cities
                  </a>
                </li>

                <li class=" {{ Request::is('admin/utility/region*') ? 'active' : '' }}">
                  <a href="{{ url('admin/utility/region') }}">
                    <i class="fa fa-angle-double-right"></i> Region
                  </a>
                </li>

                <li class=" {{ Request::is('admin/utility/location*') ? 'active' : '' }}">
                  <a href="{{ url('admin/utility/location') }}">
                    <i class="fa fa-angle-double-right"></i> Location
                  </a>
                </li>
              @endif
            </ul>
          </li>
          <li class="treeview {{ Request::is('admin/appearance*') ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-paint-brush"></i>
              <span>{{ trans('nav.appearance') }}</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li class=" {{ Request::is('admin/appearance/theme') ? 'active' : '' }}">
                  <a href="{{ url('admin/appearance/theme') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.themes') }}
                  </a>
                </li>

                <li class=" {{ Request::is('admin/appearance/banner*') ? 'active' : '' }}">
                  <a href="{{ url('admin/appearance/banner') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.banners') }}
                  </a>
                </li>

                <li class=" {{ Request::is('admin/appearance/slider*') ? 'active' : '' }}">
                  <a href="{{ url('admin/appearance/slider') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.sliders') }}
                  </a>
                </li>

                <li class=" {{ Request::is('admin/appearance/theme/option*') ? 'active' : '' }}">
                  <a href="{{ url('admin/appearance/theme/option') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.theme_options') }}
                  </a>
                </li>
            </ul>
          </li>

        @endif


        <!--
        <li class="header">LABELS</li>
        <li><a href="#">
        <i class="fa fa-circle-o text-red"></i> <span>Important</span></a>
        </li>
        <li><a href="#">
        <i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a>
        </li>
        <li><a href="#">
        <i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a>
        </li>
        -->
      </ul>
  </section>
  <!-- /.sidebar -->
</aside>
