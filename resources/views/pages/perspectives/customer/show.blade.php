@if ($service_provider -> type == 'merchant'))
    @include('pages.perspectives.merchant.show')
@endif

@if ($service_provider -> type == 'asset_provider'))
    @include('pages.perspectives.asset-provider.show')
@endif