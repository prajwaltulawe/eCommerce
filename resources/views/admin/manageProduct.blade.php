@extends('admin/layout')

@section('activeLinkProduct','active')
@section('pageTitle','Manage Product')

@if($id>0)
    {{$imageRequired = ""}}
@else
    {{$imageRequired = "required"}}
@endif

@section('cointainer')
<div class="card">
    <div class="card-header">{{$buttonStatus}}</div>
    <div class="card-body">
        <form action="{{route('product.manage')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="categoryId" class="control-label mb-1">Category</label>
                <select id="categoryId" name="categoryId" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                    <option value="0" selected>Select Category</option>                
                    @foreach($category as $list)
                        @if($categoryId == $list->id)
                            <option value="{{$list->id}}" selected>{{$list->categoryName}}</option>                
                        @else
                            <option value="{{$list->id}}">{{$list->categoryName}}</option>
                        @endif    
                    @endforeach
                </select>             
                @error('categoryId')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="name" class="control-label mb-1">Name</label>
                <input id="name" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$name}}">
                @error('name')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group" style="display: flex;justify-content: space-between;">
                <div class="form-group">
                    <label for="slug" class="control-label mb-1">Slug</label>
                    <input id="slug" name="slug" type="text" class="form-control col-12" aria-required="true" aria-invalid="false" value="{{$slug}}">
                    @error('slug')
                        {{$message}}
                    @enderror
                </div>
                <div class="form-group">
                    <label for="brand" class="control-label mb-1">Brand</label>
                    <select id="brand" name="brand" type="text" class="form-control col-12" aria-required="true" aria-invalid="false">
                        <option value="0" selected>Select Brand</option>                
                        @foreach($brands as $list)
                            @if($brand == $list->id)
                                <option value="{{$list->id}}" selected>{{$list->brand}}</option>                
                            @else
                                <option value="{{$list->id}}">{{$list->brand}}</option>                
                            @endif    
                        @endforeach
                    </select>             
                    @error('brandId')
                        {{$message}}
                    @enderror
                </div>

                <div class="form-group">
                    <label for="model" class="control-label mb-1">Model</label>
                    <input id="model" name="model" type="text" class="form-control col-12" aria-required="true" aria-invalid="false" value="{{$model}}">
                    @error('model')
                        {{$message}}
                    @enderror
                </div>
            </div>
            <div class="productImagesContainer" style="display: flex;justify-content: space-between; align-items: center;">
                <div class="form-group col-8" style="padding: 0;">
                    <label for="image" class="control-label mb-1 mt-1">Image</label>
                    <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" {{$imageRequired}}>
                    @error('image')
                    {{$message}}
                    @enderror
                </div>
                <img src="{{asset('storage/media/productAttrImages/1992148713.jpg')}}" alt="" srcset="" class="mr-6 mt-4" style="width: 100px">
            </div>
            <div class="form-group">
                <label for="shortDesc" class="control-label mb-1">Short Description</label>
                <input id="shortDesc" name="shortDesc" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$shortDesc}}">
                @error('shortDesc')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="desc" class="control-label mb-1">Description</label>
                <input id="desc" name="desc" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$desc}}">
                @error('desc')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="keywords" class="control-label mb-1">Keywords</label>
                <input id="keywords" name="keywords" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$keywords}}">
                @error('keywords')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="technicalSpecs" class="control-label mb-1">Technical Specifications</label>
                <input id="technicalSpecs" name="technicalSpecs" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$technicalSpecs}}">
                @error('technicalSpecs')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="uses" class="control-label mb-1">Uses</label>
                <input id="uses" name="uses" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$uses}}">
                @error('uses')
                    {{$message}}
                @enderror
            </div>
            <div class="form-group">
                <label for="warranty" class="control-label mb-1">Warranty</label>
                <input id="warranty" name="warranty" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$warranty}}">
                @error('warranty')
                    {{$message}}
                @enderror
            </div>

            <div class="card-header">Product Images</div>
            <div class="productImages mt-2">
                @foreach($prodImages as $key=>$val)
                    <?php   $prodImagesArr = (array)$val; ?>
                    <div class="productImagesContainer" style="display: flex;justify-content: space-between; align-items: center;">
                        <input id="prodImageId" name="prodImageId[]" value="{{$prodImagesArr['id']}}" type="hidden">
                        <div class="form-group col-8" style="padding: 0;">
                            <input id="prodImage" name="prodImage[]" type="file" class="form-control" aria-required="true" aria-invalid="false">
                        </div>
                        @if(isset($prodImagesArr['id']))
                            <a href="{{url('admin/product/editProduct/deleteImage')}}/{{$prodImagesArr['id']}}"><button class="btn btn-outline-danger form-group mt-2" type="button" >Delete Image</button></a>
                        @endif 
                        <img src="{{asset('storage/media/productImages/'.$prodImagesArr['image'])}}" alt="" srcset="" class="mr-6 mt-4" style="width: 100px">
                    </div>
                @endforeach
            </div>

            <button class="btn btn-outline-success form-group" id="addAttriBtn" type="button" onclick="addMoreImages()">Add</button>

            <div class="card-header">Product Attributes</div>
            <div class="qualityAttributesCointainer">
                @foreach($prodAttr as $key=>$val)
                <?php   $pAttArr = (array)$val; ?>
                <div class="qualityAttributes mt-2" id="pAttArr{{$pAttArr['id']}}">
                    <div class="form-group" style="display: flex;justify-content: space-between;">
                        <input type="hidden" class="identifier" name="pAttId[]" value="{{$pAttArr['id']}}">
                        <div class="form-group">
                            <label for="sku" class="control-label mb-1">SKU</label>
                            <input id="sku" name="sku[]" value="{{$pAttArr['sku']}}" type="text" class="form-control col-10" aria-required="true" aria-invalid="false" required>
                            @error('slug')
                                {{$message}}
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="mrp" class="control-label mb-1">MRP</label>
                            <input id="mrp" name="mrp[]" value="{{$pAttArr['mrp']}}" type="text" class="form-control col-10" aria-required="true" aria-invalid="false">
                            @error('model')
                                {{$message}}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price" class="control-label mb-1">Price</label>
                            <input id="price" name="price[]" value="{{$pAttArr['price']}}" type="text" class="form-control  col-10" aria-required="true" aria-invalid="false">
                            @error('brand')
                                {{$message}}
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="qty" class="control-label mb-1">Qty</label>
                            <input id="qty" name="qty[]" value="{{$pAttArr['qty']}}" type="text" class="form-control col-10" aria-required="true" aria-invalid="false">
                            @error('qty')
                                {{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group" style="display: flex;justify-content: space-between;">
                        <div class="form-group col-3" style="padding: 0;">
                            <label for="size" class="control-label mb-1">Sizes</label>
                            <select id="size" name="size[]" type="text" class="form-control col-12" aria-required="true" aria-invalid="false">
                                <option value="0" selected>Select Size</option>                
                                @foreach($size as $list)
                                    @if($pAttArr['size'] == $list->id)
                                        <option value="{{$list->id}}" selected>{{$list->size}}</option>                
                                    @else
                                        <option value="{{$list->id}}">{{$list->size}}</option>
                                    @endif    
                                @endforeach
                            </select>             
                            @error('sizeId')
                                {{$message}}
                            @enderror
                        </div>

                        <div class="form-group col-3">
                            <label for="color" class="control-label mb-1">Color</label>
                            <select id="color" name="color[]" type="text" class="form-control col-12" aria-required="true" aria-invalid="false">
                                <option value="0" selected>Select Color</option>                
                                @foreach($color as $list)
                                    @if($pAttArr['color'] == $list->id)
                                        <option value="{{$list->id}}" selected>{{$list->color}}</option>                
                                    @else
                                        <option value="{{$list->id}}">{{$list->color}}</option>                
                                    @endif    
                                @endforeach
                            </select>             
                            @error('colorId')
                                {{$message}}
                            @enderror
                        </div>
                        
                        <img src="{{asset('storage/media/productAttrImages/'.$pAttArr['attrImage'])}}" alt="" srcset="" style="width: 100px">
                        <div class="form-group col-3">
                            <label for="attrImage" class="control-label mb-1">Attribute Image</label>
                            <input id="attrImage" name="attrImage[]" type="file" class="form-control col-12" aria-required="true" aria-invalid="false">
                        </div>
                    </div>
                    <a href="{{url('admin/product/editProduct/deleteAttr')}}/{{$pAttArr['id']}}"><button class="btn btn-outline-danger form-group" type="button" value="{{$pAttArr['id']}}">Delete Attribute</button></a>
                    <hr>
                </div>
                @endforeach
                    {{session('skuError')}}
                @error('attrImage.*')
                    {{$message}}
                @enderror
            </div>
            
            <button class="btn btn-outline-success form-group" id="addAttriBtn" type="button" onclick="addMore()">Add More</button>

            <input type="hidden" name="id" value="{{$id}}">
            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                <span id="payment-button-amount">{{$buttonStatus}}</span>
            </button>
            {{session('message')}}
        </form>
    </div>
</div>

<a href="{{url('admin/product')}}">
    <button type="button" class="btn btn-success btn-lg">Back</button>
</a>

<script>
    var loopCountAttrImages = document.getElementsByClassName('qualityAttributes').length;
    function addMore(){
        loopCountAttrImages++;
        var attriHtml = `<div class="qualityAttributes mt-2" id="pAttArr${loopCountAttrImages}">`;
        attriHtml += document.getElementsByClassName('qualityAttributes')[0].innerHTML;
        attriHtml += "</div>";
        var temp = document.getElementsByClassName('identifier')[0].value; 
        var newElement = attriHtml.replace(`<input type="hidden" class="identifier" name="pAttId[]" value="${temp}">`, `<input type="hidden" class="identifier" name="pAttId[]" value="">`); 
        $('.qualityAttributesCointainer').append(newElement);
    }

    var loopCountImages = document.getElementsByClassName('productImagesContainer').length;
    function addMoreImages(){
        loopCountImages++;
        var attriHtml = `<div class="productImagesContainer" style="display: flex;justify-content: space-between; align-items: center;" id="pImgArr${loopCountImages}">
                            <input id="" name="prodImageId[]" type="hidden">     
                            <div class="form-group col-8" style="padding: 0;">
                                <input id="prodImage" name="prodImage[]" type="file" class="form-control" aria-required="true" aria-invalid="false" {{$imageRequired}}>
                            </div>
                            <button class="btn btn-outline-danger form-group mt-5" type="button" onclick="deleteImage(this.parentElement.id)">Delete Image</button>
                        </div>`;
        var newElement = attriHtml; 
        $('.productImages').append(newElement);
    }

    function deleteImage(ele){
        document.getElementById(ele).remove();
    }
</script>
@endsection