@if(!Auth::guest() && Auth::user()->isClient() && Session::has('current_order'))
    <div class='w-100'>
        <div class='container'>
            <div class='row py-1'>
                <div class='col-md py-3'>
                    <h5 class='my-0'>Now making: <b class='text-uppercase'>ORDER {{session('current_order')}}</b></h5>
                </div>
                <div class='col-md text-right py-3'>
                    <a href="{{url('/orders'.'/'.session('current_order'))}}" class='h5 link_main my-0 mx-3 text-uppercase'>View order</a>
                    <a href="{{url('/orders/cancel')}}" class='h5 link_red my-0 mx-3 text-uppercase'>Discard</a>
                </div>
            </div>
        </div>
    </div>
@endif