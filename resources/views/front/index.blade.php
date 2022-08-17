@extends('front/layout')

@section('cointainer')

<!-- Start slider -->
<section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas">
            <!-- single slide item -->
            @foreach ($bannerImages as $list)
              <li>
                <div class="seq-model">
                  <img data-seq src="{{asset('/storage/media/bannerImages/'.$list->image)}}" alt="{{$list->bannerTitle}}" />
                </div>
                <div class="seq-title">
                  <span data-seq>Save Up to 75% Off</span>                
                  <h2 data-seq>{{$list->bannerTitle}}</h2>                
                  <p data-seq>{{$list->bannerTxt}}</p>
                  <a data-seq href="{{$list->btnLink}}" class="aa-shop-now-btn aa-secondary-btn">{{$list->btnTxt}}</a>
                </div>
              </li>    
            @endforeach
          </ul>
        </div>
        <!-- slider navigation btn -->
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
      </div>
    </div>
  </section>
  <!-- / slider -->
  <!-- Start Promo section -->
  <section id="aa-promo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-promo-area">
            <div class="row">
              <!-- promo right -->
              <div class="col-md-12 no-padding">
                <div class="aa-promo-right">
                  @foreach ($homeCategories as $item)
                  <div class="aa-single-promo-right">
                    <div class="aa-promo-banner">                      
                      <img src="{{asset('storage/media/categoryImages/'.$item->categoryImage)}}" alt="img">                      
                      <div class="aa-prom-content">
                        <h4><a href="{{url('category/'.$item->categorySlug)}}">{{$item->categoryName}}</a></h4>                        
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Promo section -->
  <!-- Products section -->
  <section id="aa-product">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-product-area">
              <div class="aa-product-inner">
                <!-- start prduct navigation -->
                 <ul class="nav nav-tabs aa-products-tab">
                  @php
                    $loopCount=1;
                  @endphp
                  @foreach ($homeCategories as $item)
                    @php
                    $catClass = "";
                    if ($loopCount == 1) {
                      $catClass = "active";
                      $loopCount++;
                    }   
                    @endphp
                    <li class="{{$catClass}}"><a href="#cat{{$item->id}}" data-toggle="tab">{{$item->categoryName}}</a></li>
                  @endforeach
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    @php
                      $loopCount=1;
                    @endphp
                    @foreach ($homeCategories as $item)
                    @php
                    $catClass = "";
                     if ($loopCount == 1) {
                      $catClass = "active";
                      $loopCount++;
                     }   
                    @endphp
                      <div class="tab-pane fade in {{$catClass}}" id="cat{{$item->id}}">
                        <ul class="aa-product-catg">
                          <!-- start single product item -->
                          @if (isset($homeCategoriesProducts[$item->id][0]))                              
                            @foreach ($homeCategoriesProducts[$item->id] as $prodArr)
                              <li>
                                <figure>
                                  <a class="aa-product-img" href="{{url('product/'.$prodArr->slug)}}"><img src="{{asset('storage/media/productImages/'.$prodArr->image)}}" alt="polo shirt img"></a>
                                  <a class="aa-add-card-btn"href="{{url('product/'.$prodArr->slug)}}"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                    <figcaption>
                                    <h4 class="aa-product-title"><a href="{{url('product/'.$prodArr->slug)}}">{{$prodArr->name}}</a></h4>
                                    <span class="aa-product-price">${{$homeCategoriesProductsAttr[$prodArr->id][0]->price}}</span>
                                    <span class="aa-product-price"><del>${{$homeCategoriesProductsAttr[$prodArr->id][0]->mrp}}</del></span>
                                  </figcaption>
                                </figure>                        
                                <!-- product badge -->
                                <span class="aa-badge aa-sale" href="#">SALE!</span>
                              </li>
                            @endforeach     
                          @else
                            <li>
                              <figure>
                                  <figcaption>
                                  <h4 class="aa-product-title">No Products Available For This Category</h4>
                                </figcaption>
                              </figure>                        
                            </li>
                          @endif
                        </ul>
                      </div>
                    @endforeach
                  </div>              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Products section -->
  <!-- popular section -->
  <section id="aa-popular-category">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-popular-category-area">
              <!-- start prduct navigation -->
             <ul class="nav nav-tabs aa-products-tab">
               <li class="active"><a href="#featured" data-toggle="tab">Featured</a></li>
               <li><a href="#trending" data-toggle="tab">Trending</a></li>                    
                <li><a href="#discounted" data-toggle="tab">Discounted</a></li>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <!-- Start men popular category -->
                <div class="tab-pane fade in active" id="featured">
                  <ul class="aa-product-catg aa-popular-slider">
                    <!-- start single product item -->
                    @if (isset($featured[0]))                              
                      @foreach ($featured as $item)
                        <li>
                          <figure>
                            <a class="aa-product-img" href="/product/{{$item->slug}}"><img src="{{asset('storage/media/productImages/'.$item->image)}}" alt="{{$item->name}}"></a>
                            <a class="aa-add-card-btn"href="/product/{{$item->slug}}"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                            <figcaption>
                              <h4 class="aa-product-title"><a href="/product/{{$item->slug}}">{{$item->name}}</a></h4>
                              <span class="aa-product-price">${{$homeFeaturedProductsAttr[$item->id][0]->price}}</span>
                              <span class="aa-product-price"><del>$${{$homeFeaturedProductsAttr[$item->id][0]->mrp}}</del></span>
                            </figcaption>
                          </figure>             
                        </li>                            
                      @endforeach
                    @endif                                                       
                  </ul>
                </div>
                <!-- / popular product category -->
                
                <!-- start featured product category -->
                <div class="tab-pane fade" id="trending">
                 <ul class="aa-product-catg aa-featured-slider">
                    <!-- start single product item -->
                    @if (isset($trending[0]))                              
                      @foreach ($trending as $item)
                        <li>
                          <figure>
                            <a class="aa-product-img" href="/product/{{$item->slug}}"><img src="{{asset('storage/media/productImages/'.$item->image)}}" alt="{{$item->name}}"></a>
                            <a class="aa-add-card-btn"href="/product/{{$item->slug}}"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                            <figcaption>
                              <h4 class="aa-product-title"><a href="/product/{{$item->slug}}">{{$item->name}}</a></h4>
                              <span class="aa-product-price">${{$homeTrendingProductsAttr[$item->id][0]->price}}</span>
                              <span class="aa-product-price"><del>$${{$homeTrendingProductsAttr[$item->id][0]->mrp}}</del></span>
                            </figcaption>
                          </figure>             
                        </li>                            
                      @endforeach  
                    @else
                    <li>
                      <figure>
                          <figcaption>
                          <h4 class="aa-product-title">No Products Available For This Category</h4>
                        </figcaption>
                      </figure>                        
                    </li>                                           
                  @endif                                                                                                            
                  </ul>
                </div>
                <!-- / featured product category -->

                <!-- start latest product category -->
                <div class="tab-pane fade" id="discounted">
                  <ul class="aa-product-catg aa-latest-slider">
                    <!-- start single product item -->
                    @if (isset($discounted[0]))                              
                    @foreach ($discounted as $item)
                      <li>
                        <figure>
                          <a class="aa-product-img" href="/product/{{$item->slug}}"><img src="{{asset('storage/media/productImages/'.$item->image)}}" alt="{{$item->name}}"></a>
                          <a class="aa-add-card-btn"href="/product/{{$item->slug}}"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                          <figcaption>
                            <h4 class="aa-product-title"><a href="/product/{{$item->slug}}">{{$item->name}}</a></h4>
                            <span class="aa-product-price">${{$homeDiscountedProductsAttr[$item->id][0]->price}}</span>
                            <span class="aa-product-price"><del>$${{$homeDiscountedProductsAttr[$item->id][0]->mrp}}</del></span>
                          </figcaption>
                        </figure>             
                      </li>   
                    @endforeach 
                    @else
                      <li>
                        <figure>
                            <figcaption>
                            <h4 class="aa-product-title">No Products Available For This Category</h4>
                          </figcaption>
                        </figure>                        
                      </li>                                           
                    @endif                                 
                  </ul>
                </div>
                <!-- / latest product category -->              
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </section>
  <!-- / popular section -->

@endsection

@section('brand')
 <!-- Client Brand -->
 <section id="aa-client-brand">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-client-brand-area">
            <ul class="aa-client-brand-slider">
              @foreach ($homeBrands as $item)
                <li><a href="#"><img src="{{asset('storage/media/brandImages/'.$item->image)}}" alt="{{$item->brand}}"></a></li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Client Brand -->
@endsection