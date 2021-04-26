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
                
                <form id="example-form" action="{{ route('item.store') }}" class="tab-wizard wizard-circle wizard clearfix g-3" method="POST" enctype="multipart/form-data">
                    @csrf

                        
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
                                        <input type="text" class="form-control @if($errors->has('name')) border border-danger @endif" id="i_name" name="name" value="{{ old('name') }}">
                                        @if($errors->has('name'))
                                            <span class="text-danger mmfont"> {{ $errors->first('name') }} </span>
                                        @endif
                                    </div>
                                    
                                </div>

                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="form-group my-3">
                                        <label for="i_price" class="mmfont"> ရောင်းစျေး </label>
                                        <input type="text" class="form-control @if($errors->has('price')) border border-danger @endif" id="i_price" name="price" value="{{ old('price') }}">

                                        @if($errors->has('price'))
                                            <span class="text-danger mmfont"> {{ $errors->first('price') }} </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="form-group my-3">
                                        <label for="i_liter"> Liter </label>
                                        <input type="text" class="form-control" id="i_liter" name="liter" value="{{ old('liter') }}">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6 col-12">
                                    <div class="form-group my-3">
                                        <label for="i_color" class="mmfont"> အရောင် </label>
                                        <select class="colorchoice form-control" name="color" id="i_color">
                                            @foreach($colors as $color)
                                            <option value="{{ $color->id }}"> 
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
                                            <option value="{{ $car->id }}"> 
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
                                            <option value="{{ $category->id }}"> 
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
                                            <option value="{{ $country->id }}"> 
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
                        <!-- Step 3 -->

                        <h6 class="mmfont"> Supplier အချက်အလက်် </h6>
                        <section>
                            <div class="row">
                                <div class="col-12">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home"
                                                role="tab" aria-controls="home" aria-selected="true">New Supplier</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile"
                                                role="tab" aria-controls="profile" aria-selected="false">Old Supplier</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                                            aria-labelledby="home-tab">
                                            <div class="row mt-3">

                                                <div class="col-lg-4 col-md-6 col-12">
                                                    <div class="form-group my-3">
                                                        <label for="sup_name" class="mmfont"> နာမည် </label>
                                                        <input type="text" class="form-control" id="sup_name" name="sup_name" value="{{ old('sup_name') }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-6 col-12">
                                                    <div class="form-group my-3">
                                                        <label for="sup_phone" class="mmfont"> ဖုန်းနံပါတ် </label>
                                                        <input type="text" class="form-control" id="sup_phone" name="sup_phone" value="{{ old('sup_phone') }}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-6 col-12">
                                                    <div class="form-group my-3">
                                                        <label for="sup_address" class="mmfont"> လိပ်စာ </label>
                                                        <input type="text" class="form-control" id="sup_address" name="sup_address" value="{{ old('sup_address') }}">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group my-3">
                                                        <label for="sup_note"> Note </label>
                                                        <textarea class="form-control" name="sup_note" id="sup_note" rows="6">{{ old('sup_note') }}</textarea>
                                                    </div>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel"
                                            aria-labelledby="profile-tab">
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <div class="form-group my-3">
                                                        <label for="sup_existingsupplier"> Existing Supplier </label>
                                                        <select placeholder="Choose Existing Supplier" data-allow-clear="1" class="form-control supplierchoice " id="sup_existingsupplier" name="sup_existingsupplier">
                                                            @foreach($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}"> 
                                                                {{ $supplier->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 4 -->
                        <h6> Stock </h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group my-3">
                                        <label for="st_price" class="mmfont"> ၀ယ်စျေး :</label>
                                        <input type="number" class="form-control" id="st_price" name="st_price" value="{{ old('st_price') }}"> 
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="st_quantity" class="mmfont"> အရေအတွက် :</label>
                                        <input type="number" class="form-control" id="st_quantity" name="st_quantity" value="{{ old('st_quantity') }}"> 
                                    </div>
                                    <div class="form-group my-3">
                                        <label for="st_pc"> PC / CN :</label>
                                        <input type="number" class="form-control" id="st_pc" name="st_pc" value="{{ old('st_pc') }}"> 
                                    </div>
                                        
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group my-3">
                                        <label for="st_date"> Stock Date :</label>
                                        <input type="date" class="form-control" id="st_date" name="st_date" value="{{ old('st_date') }}">
                                    </div>
                                    <div class="form-group my-3">
                                        <label> Type :</label>
                                        <div class="c-inputs-stacked">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="st_type" id="typeone" value="Supplier" checked>
                                                <label class="form-check-label" for="typeone"> Supplier </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="st_type" id="typetwo" value="Market">
                                                <label class="form-check-label" for="typetwo"> Market </label>
                                            </div>
                                        </div>
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
            })

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

            $('.input-images').imageUploader();

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

            new Choices('.supplierchoice', {
               delimiter: ',',
               editItems: true,
               maxItemCount: 5,
               removeItemButton: true,
            });

        });

    </script>

@endsection

</x-backend>