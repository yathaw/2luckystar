<x-backend>

    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 class="mmfont">ကားပစ္စည်း အသစ်ထည့်ရန် </h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item mmfont"><a href="{{ route('dashboard') }}">ပင်မစာမျက်နှာ</a></li>
                        <li class="breadcrumb-item mmfont active" aria-current="page">ကားပစ္စည်း</li>
                    </ol>
                </nav>
            </div>
        </div>


    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Create New Item
                <a href="{{ route('item.index') }}" class="btn btn-primary float-end createBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="အသစ်ထည့်မည်">
                    <i class="bi bi-skip-backward btnicon"></i>
                </a>
            </div>
            <div class="card-body wizard-content">
                
                <form id="example-form" action="{{route('item.update', $item->id)}}" class="tab-wizard wizard-circle wizard clearfix g-3" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                    
                    <!-- Step 1 -->
                    <h6 class="mmfont"> ကားပစ္စည်းဓာတ်ပုံများ </h6>
                    <section>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group my-3">
                                    <label for="firstName1"> Images :</label>
                                    <div class="input-images"></div>                                   
                                    
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Step 2 -->
                    <h6 class="mmfont"> ကားပစ္စည်း အချက်အလက် </h6>
                    <section>
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="form-group my-3">
                                    <label for="i_name" class="mmfont"> ကားပစ္စည်းအမည် </label>
                                    <input type="text" class="form-control @if($errors->has('name')) border border-danger @endif" id="i_name" name="name" value="{{ $item->name }}">
                                    @if($errors->has('name'))
                                        <span class="text-danger mmfont"> {{ $errors->first('name') }} </span>
                                    @endif
                                </div>
                                
                            </div>

                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="form-group my-3">
                                    <label for="i_price" class="mmfont"> ရောင်းစျေး </label>
                                    <input type="text" class="form-control @if($errors->has('price')) border border-danger @endif" id="i_price" name="price" value="{{ $item->price }}">

                                    @if($errors->has('price'))
                                        <span class="text-danger mmfont"> {{ $errors->first('price') }} </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="form-group my-3">
                                    <label for="i_liter"> Liter </label>
                                    <input type="text" class="form-control" id="i_liter" name="liter" value="{{ $item->liter }}">
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="form-group my-3">
                                    <label for="i_color" class="mmfont"> အရောင် </label>
                                    <select class="colorchoice form-control" name="color" id="i_color">
                                        @foreach($colors as $color)
                                        <option @if($color->id == $item->color_id) selected  @endif value="{{ $color->id }}"> 
                                            {{ $color->name }}
                                        </option>
                                        @endforeach
                                    </select>


                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12">

                                <div class="form-group my-3">
                                    <label for="i_car" class="mmfont"> ကားအမျိုးအစား </label>
                                    <select class="form-control carchoice " id="i_car" name="car">
                                        @foreach($cars as $car)
                                        <option @if($car->id == $item->car_id) selected  @endif value="{{ $car->id }}"> 
                                            {{ $car->name }}
                                        </option>
                                        @endforeach
                                    </select>


                                </div>
                                
                            </div>

                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="form-group my-3">
                                    <label for="i_category" class="mmfont"> ပစ္စည်းအမျိုးအစား </label>
                                    <select class="form-control categorychoice" id="i_category" name="category">
                                        @foreach($categories as $category)
                                        <option @if($category->id == $item->category_id) selected  @endif value="{{ $category->id }}"> 
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>


                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="form-group my-3">
                                    <label for="i_country" class="mmfont"> ထုတ်လုပ်သည့်နိုင်ငံ </label>
                                    <select class="form-control countrychoice " id="i_country" name="country">
                                        @foreach($countries as $country)
                                        <option @if($country->id == $item->country_id) selected  @endif value="{{ $country->id }}"> 
                                            {{ $country->name }}
                                        </option>
                                        @endforeach
                                    </select>


                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group my-3">
                                    <label for="i_description"> အသေးစိတ်ဖော်ပြချက် </label>

                                    <textarea class="form-control d-none" id="hiddenArea" name="description"></textarea>

                                    <div id="full"></div>
                                    <span class="n_err_description error d-block text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>

            </div>
        </div>

    </section>

@section('script_content')
    
    <script type="text/javascript">
        $(document).ready(function() {

            var form = $("#example-form");

            form.steps({
                headerTag: "h6",
                bodyTag: "section",
                transitionEffect: "fade",
                titleTemplate: '<span class="step">#index#</span> #title#',
                onFinished: function (event, currentIndex)
                {
                    var about = document.querySelector('textarea[name=description]');

                    var quillData = quill.getContents();
                    var quillText = quill.getText();
                    var quillHtml = quill.root.innerHTML.trim();

                    about.value =  quillHtml;
                    form.submit();

                }
            });

            var quill = new Quill("#full", { 
            bounds: "#full-container .editor", 
            modules: { 
                toolbar: [
                    [{ font: [] }, { size: [] }], 
                    ["bold", "italic", "underline", "strike"], 
                    [
                        { color: [] }, 
                        { background: [] }
                    ], 
                    [
                        { script: "super" }, 
                        { script: "sub" }
                    ], 
                    [
                        { list: "ordered" }, 
                        { list: "bullet" }, 
                        { indent: "-1" }, 
                        { indent: "+1" }
                    ], 
                    ["direction", { align: [] }], 
                    ["link", "image", "video"], 
                    ["clean"]] 
                }, 
                theme: "snow" 
            });

            

            quill.clipboard.dangerouslyPasteHTML(`{!! $item->description !!}`);

            var images = <?= json_encode($item->photo) ?>;
            var img_array = $.parseJSON(images);
            console.log(img_array);

            var imgpre_arr=[];


            for (i = 0; i < img_array.length; i++) 
            {
                var imgpre_obj={};

                imgpre_obj.id = i;
                imgpre_obj.src = img_array[i];

                imgpre_arr.push(imgpre_obj);

            }


            $('.input-images').imageUploader({
               preloaded: imgpre_arr,
               preloadedInputName: 'oldPhoto',
            });

            


            new Choices('.colorchoice', {
               delimiter: ',',
               editItems: true,
               maxItemCount: 5,
               removeItemButton: true,
            });

            new Choices('.carchoice', {
               delimiter: ',',
               editItems: true,
               maxItemCount: 5,
               removeItemButton: true,
            });

            new Choices('.categorychoice', {
               delimiter: ',',
               editItems: true,
               maxItemCount: 5,
               removeItemButton: true,
            });

            new Choices('.countrychoice', {
               delimiter: ',',
               editItems: true,
               maxItemCount: 5,
               removeItemButton: true,
            });
            


        });

    </script>

@endsection

</x-backend>