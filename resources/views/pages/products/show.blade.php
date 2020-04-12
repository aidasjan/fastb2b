@extends('layouts.app')

@section('content')
    <div class='container'>

        <div class='row pt-1'>
            @if(count($images) > 0)
            <div class='col-md pt-3'>
                    <div id="carouselProductImages" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                @if (!Auth::guest() && Auth::user()->isAdmin()) <a href="{{url('/product_files'.'/'.$images->first()->id.'/edit')}}"> @endif
                                <img class="mw-100 mh-100" src="{{url('uploads/productfiles/'.$images->first()->file_name)}}">
                                @if (!Auth::guest() && Auth::user()->isAdmin()) </a> @endif
                            </div>
                            @foreach ($images->slice(1) as $image)
                                <div class="carousel-item">
                                    @if (!Auth::guest() && Auth::user()->isAdmin()) <a href="{{url('/product_files'.'/'.$image->id.'/edit')}}"> @endif
                                    <img class="mw-100 mh-100" src="{{url('uploads/productfiles/'.$image->file_name)}}">
                                    @if (!Auth::guest() && Auth::user()->isAdmin()) </a> @endif
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselProductImages" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselProductImages" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
            </div>

            <div class='col-md text-left pt-3'>
            @else
            <div class='col-md pt-3'>
            @endif
                <div class='row pt-4 pb-2'>
                    <div class='col-md'>
                        <h4>{{$product->code}}</h4>
                    </div>
                </div>
                <div class='row py-1'>
                    <div class='col-md'>
                        <h1>{{$product->name}}</h1>
                    </div>
                </div>
                <div class='row pb-2'>
                    <div class='col-md'>
                        <h3>{{number_format($product->price, 2, '.', '').' '.$product->currency.' / '.$product->unit}}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class='row form_box mt-5'>
            <div class='col-md'>
                <div class='container'>
                    <div class='row py-2'>
                        <div class='col-md text-uppercase'><h2>Product info</h2></div>
                    </div>

                    @if (count($documents) > 0)
                        <?php $counter=0; ?>
                        @foreach ($documents as $file)
                            <div class='col-md py-2 px-3'>
                                @if (!Auth::guest() && Auth::user()->isAdmin())
                                    <a href="{{url('/product_files'.'/'.$file->id.'/edit')}}"><div class='button_big py-4 px-2'>{{$file->name}}</div></a>
                                @else
                                    <a href="{{url('uploads/productfiles/'.$file->file_name)}}" target="_blank"><div class='button_big py-4 px-2'>{{$file->name}}</div></a>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class='row pt-3'>
                            <div class='col-md'>
                                <h5>No product info</h5>
                            </div>
                        </div>
                    @endif

                    @if(!Auth::guest() && Auth::user()->isAdmin())
                        <a href="{{url('/product_files/create/'.$product->id)}}"><div class='btn btn-primary'>ADD FILE</div></a>
                    @endif
                </div>
            </div>
        </div>

        <div class='row'>
            <div class='col-md'>
                <br>
                @if(!Auth::guest() && Auth::user()->isAdmin())
                    <div class='mt-3'><a href="{{url('/products'.'/'.$product->id.'/edit')}}" class='link_main'>EDIT THIS PRODUCT</a></div>

                    <form action='{{ action('ProductsController@update', $product->id)}}' method='POST'>
                        <input type='hidden' name='_method' value='DELETE'>
                        {{csrf_field()}}
                        <button type='submit' class='btn btn-link link_red my-3' href='#'>DELETE THIS PRODUCT</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection