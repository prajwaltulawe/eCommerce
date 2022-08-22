@extends('front/layout')

@section('cointainer')
  <!-- product category -->
  <section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area">
            <div class="aa-product-details-content">
              <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">                              
                  <div class="aa-product-view-slider">                                
                    <div id="demo-1" class="simpleLens-gallery-container">
                      <div class="simpleLens-container">
                        <div class="simpleLens-big-image-container">
                            <a data-lens-image="{{asset('storage/media/productImages/'.$productInfo[0]->image)}}" class="simpleLens-lens-image">
                            <img src="{{asset('storage/media/productImages/'.$productInfo[0]->image)}}" class="simpleLens-big-image"></a></div>
                      </div>
                      <div class="simpleLens-thumbnails-container">
                          <a data-big-image="{{asset('storage/media/productImages/'.$productInfo[0]->image)}}" data-lens-image="{{asset('storage/media/productImages/'.$productInfo[0]->image)}}" class="simpleLens-thumbnail-wrapper" href="#">
                            <img src="img/view-slider/thumbnail/polo-shirt-1.png">
                          </a>                                    
                          <a data-big-image="img/view-slider/medium/polo-shirt-3.png" data-lens-image="img/view-slider/large/polo-shirt-3.png" class="simpleLens-thumbnail-wrapper" href="#">
                            <img src="img/view-slider/thumbnail/polo-shirt-3.png">
                          </a>
                          <a data-big-image="img/view-slider/medium/polo-shirt-4.png" data-lens-image="img/view-slider/large/polo-shirt-4.png" class="simpleLens-thumbnail-wrapper" href="#">
                            <img src="img/view-slider/thumbnail/polo-shirt-4.png">
                          </a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">
                    <h3>{{$productInfo[0]->name}}</h3>
                    <div class="aa-price-block">
                      <span class="aa-product-view-price">RS {{$productsAttr[$productInfo[0]->id][0]->price}}</span>
                      <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                    </div>
                    <p>{{$productInfo[0]->shortDesc}}</p>
                    <h4>Size</h4>
                    <div class="aa-prod-view-size">
                    @foreach ($productsAttr as $item)
                        <a href="#">{{$productsAttr[$productInfo[0]->id][0]->size}}</a>
                    @endforeach
                    </div>
                    <h4>Color</h4>
                    <div class="aa-color-tag">
                    @foreach ($productsAttr as $item)
                        <a href="#" class="aa-color-{{strtolower($productsAttr[$productInfo[0]->id][0]->color)}}"></a>               
                    @endforeach
                    
                    </div>
                    <div class="aa-prod-quantity">
                      <form action="">
                        <select id="" name="">
                          <option selected="1" value="0">1</option>
                          <option value="1">2</option>
                          <option value="2">3</option>
                          <option value="3">4</option>
                          <option value="4">5</option>
                          <option value="5">6</option>
                        </select>
                      </form>
                      <p class="aa-prod-category">
                        Category: <a href="#">Polo T-Shirt</a>
                      </p>
                    </div>
                    <div class="aa-prod-view-bottom">
                      <a class="aa-add-to-cart-btn" href="#">Add To Cart</a>
                      <a class="aa-add-to-cart-btn" href="#">Wishlist</a>
                      <a class="aa-add-to-cart-btn" href="#">Compare</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="aa-product-details-bottom">
              <ul class="nav nav-tabs" id="myTab2">
                <li><a href="#description" data-toggle="tab">Description</a></li>
                <li><a href="#technicalSpecs" data-toggle="tab">Technical Specs</a></li>
                <li><a href="#review" data-toggle="tab">Reviews</a></li>                
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane fade in active" id="description">
                  <p>{{$productInfo[0]->description}}</p>
                  <ul>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, culpa!</li>
                  </ul>
                </div>
                <div class="tab-pane fade" id="technicalSpecs">
                    <p>{{$productInfo[0]->technicalSpecs}}</p>
                    <ul>
                      <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, culpa!</li>
                      <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, culpa!</li>
                      <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, culpa!</li>
                    </ul>
                  </div>
                <div class="tab-pane fade " id="review">
                 <div class="aa-product-review-area">
                   <h4>2 Reviews for T-Shirt</h4> 
                   <ul class="aa-review-nav">
                     <li>
                        <div class="media">
                          <div class="media-left">
                            <a href="#">
                              <img class="media-object" src="img/testimonial-img-3.jpg" alt="girl image">
                            </a>
                          </div>
                          <div class="media-body">
                            <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>
                            <div class="aa-product-rating">
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star-o"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="media">
                          <div class="media-left">
                            <a href="#">
                              <img class="media-object" src="img/testimonial-img-3.jpg" alt="girl image">
                            </a>
                          </div>
                          <div class="media-body">
                            <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>
                            <div class="aa-product-rating">
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star-o"></span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                          </div>
                        </div>
                      </li>
                   </ul>
                   <h4>Add a review</h4>
                   <div class="aa-your-rating">
                     <p>Your Rating</p>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                     <a href="#"><span class="fa fa-star-o"></span></a>
                   </div>
                   <!-- review form -->
                   <form action="" class="aa-review-form">
                      <div class="form-group">
                        <label for="message">Your Review</label>
                        <textarea class="form-control" rows="3" id="message"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name">
                      </div>  
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="example@gmail.com">
                      </div>

                      <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                   </form>
                 </div>
                </div>            
              </div>

            </div>
            </div>
            <!-- Related product -->
            <div class="aa-product-related-item">
                <h3>Related Products</h3>
                <ul class="aa-product-catg aa-related-item-slider">
                  <!-- start single product item -->
                  @foreach ($relatedProducts as $prodArr)
                    <li>
                    <figure>
                        <a class="aa-product-img" href="{{url('product/'.$prodArr->slug)}}"><img src="{{asset('storage/media/productImages/'.$prodArr->image)}}" alt="polo shirt img"></a>
                        <a class="aa-add-card-btn"href="{{url('product/'.$prodArr->slug)}}"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                        <figcaption>
                        <h4 class="aa-product-title"><a href="{{url('product/'.$prodArr->slug)}}">{{$prodArr->name}}</a></h4>
                        <span class="aa-product-price">${{$relatedProductsAttr[$prodArr->id][0]->price}}</span>
                        <span class="aa-product-price"><del>${{$relatedProductsAttr[$prodArr->id][0]->mrp}}</del></span>
                        </figcaption>
                    </figure>                        
                    <!-- product badge -->
                    <span class="aa-badge aa-sale" href="#">SALE!</span>
                    </li>
                @endforeach                                            
                </ul>
              </div>              
        </div>
      </div>
    </div>
  </section>
  <!-- / product category -->
@endsection