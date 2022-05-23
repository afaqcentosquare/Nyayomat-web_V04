<style>
    @media only screen and (max-width: 600px) {
        .footer-subscribe-input {
            width:150px !important;
        }
    }
</style>
<!-- FOOTER -->
<div class="main-footer">
  <div class="container">
    <div class="col-xs-12 col-sm-6 col-md-6">
      <div class="footer-subscribe-form">
        <h3>@lang('theme.subscription')</h3>
        {!! Form::open(['route' => 'newsletter.subscribe', 'class' => 'form-inline']) !!}
          <div class="form-group">
            <input name="email" class="footer-subscribe-input" placeholder="@lang('theme.placeholder.email')" type="email" required>
            <button class="footer-subscribe-submit" type="submit">@lang('theme.button.subscribe')</button>
            <div class="help-block with-errors"></div>
          </div>
        {!! Form::close() !!}

        <p class="tips">Subscribe now to get updates on promotions</p>
      </div>

      <div class="footer-social-networks">
        @if($social_media_links = get_social_media_links())
          <h3>@lang('theme.stay_connected')</h3>
          <ul class="footer-social-list">
            @foreach($social_media_links as $social_media => $link)
              <li><a class="fa fa-{{$social_media}}" href="{{$link}}" target="_blank"></a></li>
            @endforeach
          </ul>
        @endif
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
              <h3>@lang('theme.nav.make_money') With Us</h3>
              <ul class="footer-link-list">
                <li>
                  <a class="navbar-item-mergin-top" href="{{ url('/selling') }}">{{ trans('theme.nav.sell_on', ['platform' => get_platform_title()]) }}</a>
                </li>
                <!--<li><a href="{{ url('/selling#pricing') }}" rel="nofollow">@lang('theme.nav.become_merchant')</a></li>-->
                <li><a href="{{ url('/selling#howItWorks') }}" rel="nofollow">@lang('theme.nav.how_it_works')</a></li>
                @foreach($pages->where('position', 'footer_2nd_column') as $page)
                  <!--<li><a href="{{ get_page_url($page->slug) }}" rel="nofollow" target="_blank">{{ $page->title }}</a></li>-->
                @endforeach
                <li><a href="{{ url('/selling#faqs') }}" rel="nofollow">@lang('theme.nav.faq')</a></li>
                <li><a href="{{ url('/login') }}" rel="nofollow">Merchant Login</a></li>
                <li><a href="{{ url('/contact_us') }}" rel="nofollow">Contact Us</a></li>

              </ul>
            </div>

            {{-- <div class="col-xs-6 col-sm-6 col-md-6">
              <h3>Tusaidiane</h3>
              <ul class="footer-link-list">
                <!--<li><a href="{{ route('account', 'disputes') }}" rel="nofollow">@lang('theme.nav.refunds_disputes')</a></li>-->
                <!--<li><a href="{{ route('account', 'orders') }}" rel="nofollow">@lang('theme.nav.contact_seller')</a></li>-->
                <li><a href="#" rel="nofollow">Contact Us</a></li>
                <li><a href="#" rel="nofollow">Contact Seller</a></li>
                <li><a href="#" rel="nofollow">Resources</a></li>

              </ul> --}}
            </div>
        </div>
    </div>

  </div>
</div><!-- /.container -->

