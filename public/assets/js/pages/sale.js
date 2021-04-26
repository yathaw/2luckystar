$(document).ready(function() {

    datefn();
    cartNoti();
    shoppingCart();

    // Search
    $('#search').on('keyup',function(){
        var value=$(this).val();

        searchData(value)
    });

    $('.input-group').on('click','.searchBtn', function()
    {
        var value=$("#search").val();

        searchData(value);
    });

    function searchData(value)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
                type:'POST',
                url:'salesearch',
                data:{
                    seach:value
                },
                success:function(data)
                {
                    console.log(data.length);
                    $('#spaDiv').hide();
                    $('#itemDiv').hide();

                    var searchResult='';

                    if (data.length > 0) {
                    	$.each(data,function (i,v) 
	                    {
	                        if (v) 
	                        {
	                            var id = v.id;
	                            var codeno = v.codeno;
	                            var name = v.name;
	                            var price = v.price;

	                            var stockdatas = v.stocks;

	                            if (v.category_id) 
                                {
                                    var status = "item";
                                }
                                else
                                {
                                    var status = "spa";
                                }

	                            var stock = 0;
	                            $.each(stockdatas,function(stock_i, stock_v) {
	                            	stock += stock_v.qty;
	                            });
							    
	                            var saledetaildatas = v.saledetails;
							    var sale = 0;
	                            $.each(saledetaildatas,function(saledetail_i, saledetail_v) {
	                            	sale += saledetail_v.qty;
	                            });

        						var currentstock = stock - sale;


	                            searchResult +=`<div class="col-6 my-2">`;
	                            if (v.category_id) 
                                {
	                            	if(currentstock <= 0){
	                            		searchResult +=`<button class="btn btn-light-primary btn-block disabled">`;
	                            	}else{
	                            		searchResult +=`<button class="btn btn-light-primary btn-block shoppingcartBtn" data-id="${id}" data-codeno="${codeno}" data-name="${name}" data-price="${price}" data-status="${status}">
	                                                    `;
	                            	}
	                            }else{
	                            	searchResult +=`<button class="btn btn-light-primary btn-block shoppingcartBtn" data-id="${id}" data-codeno="${codeno}" data-name="${name}" data-price="${price}" data-status="${status}">`;
	                            }
	                                                
	                               	searchResult += `<h5> ${codeno} </h5>
	                                                    <small> ${name} </small>`;
	                                
	                                if (status == 'spa') {
	                                	searchResult += `<p> ${price} </p>`;
	                                }else{
	                                	searchResult += `<p> ${price} 
	                                						<span class="badge bg-light-danger float-end mmfont "> ${currentstock} ခု </span>
	                                					</p>`;

	                                }
	                                searchResult += `</button>
	                                               </div>`;
	                        }

	                    });

                    }else{
                    	searchResult += `<div class="col-12 justify-content-center my-2 text-center">
                    							<h5 class="mmfont mt-4"> တောင်းပန်ပါတယ် ရှာဖွေမှုရလဒ်မရှိပါ။ </h5>
                        						<p> မင်းရှာနေတဲ့ရလဒ်မရသည့် အတွက်စိတ်မကောင်းပါ။ <br> ကျေးဇူးပြု၍ ထပ်မံကြိုးစားပါ  </p>
                    							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500"><g id="freepik--background-simple--inject-41"><path d="M429.25,152.55l0-.13c-5.38-18.57-21.62-30.63-37.65-39.83-32.35-18.57-62.35-6.76-109,5s-75-.32-117.34-13.35C102,84.79,54.35,144.79,63,204.37c4.09,28.07,16.75,53.93,21.88,81.77,7.51,40.81-22.07,59.66,1.39,94.08S173,422.5,215.21,415.85c25.57-4,47.71-18.31,71.88-26.65,22.67-7.82,47.31-6.12,70,.69,21.05,6.31,46,12.52,63.84-4.52C441.22,366,448,343.08,438.05,316.78c-8.62-22.77-24.8-42.13-32.15-65.41-6.2-19.59,5.6-30.51,14.72-46.36C429.44,189.68,434.23,169.91,429.25,152.55Z" style="fill:#76AADB"></path><path d="M429.25,152.55l0-.13c-5.38-18.57-21.62-30.63-37.65-39.83-32.35-18.57-62.35-6.76-109,5s-75-.32-117.34-13.35C102,84.79,54.35,144.79,63,204.37c4.09,28.07,16.75,53.93,21.88,81.77,7.51,40.81-22.07,59.66,1.39,94.08S173,422.5,215.21,415.85c25.57-4,47.71-18.31,71.88-26.65,22.67-7.82,47.31-6.12,70,.69,21.05,6.31,46,12.52,63.84-4.52C441.22,366,448,343.08,438.05,316.78c-8.62-22.77-24.8-42.13-32.15-65.41-6.2-19.59,5.6-30.51,14.72-46.36C429.44,189.68,434.23,169.91,429.25,152.55Z" style="fill:#fff;opacity:0.7000000000000001"></path></g><g id="freepik--Files--inject-41"><polygon points="266.74 286.7 238.74 286.7 238.74 249.19 258.4 249.19 266.74 256.83 266.74 286.7"></polygon><polygon points="268.38 285.43 240.38 285.43 240.38 247.93 260.04 247.93 268.38 255.57 268.38 285.43" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="260.04 247.93 257.99 256.9 268.38 255.57 260.04 247.93" style="stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="260.04 247.93 260.04 255.57 268.38 255.57 260.04 247.93" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><line x1="245.73" y1="261.08" x2="261.69" y2="261.08" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="245.73" y1="264.99" x2="261.69" y2="264.99" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="245.73" y1="268.9" x2="261.69" y2="268.9" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="245.73" y1="272.82" x2="261.69" y2="272.82" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="245.73" y1="276.73" x2="261.69" y2="276.73" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><polygon points="401.41 286.7 373.41 286.7 373.41 249.19 393.07 249.19 401.41 256.83 401.41 286.7"></polygon><polygon points="403.04 285.43 375.04 285.43 375.04 247.93 394.7 247.93 403.04 255.57 403.04 285.43" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="394.7 247.93 392.66 256.9 403.04 255.57 394.7 247.93" style="stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="394.7 247.93 394.7 255.57 403.04 255.57 394.7 247.93" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><line x1="380.4" y1="261.08" x2="396.36" y2="261.08" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="380.4" y1="264.99" x2="396.36" y2="264.99" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="380.4" y1="268.9" x2="396.36" y2="268.9" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="380.4" y1="272.82" x2="396.36" y2="272.82" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="380.4" y1="276.73" x2="396.36" y2="276.73" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><polygon points="129.73 286.7 101.73 286.7 101.73 249.19 121.39 249.19 129.73 256.83 129.73 286.7"></polygon><polygon points="131.37 285.43 103.37 285.43 103.37 247.93 123.03 247.93 131.37 255.57 131.37 285.43" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="123.03 247.93 120.98 256.9 131.37 255.57 123.03 247.93" style="stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="123.03 247.93 123.03 255.57 131.37 255.57 123.03 247.93" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><line x1="108.73" y1="261.08" x2="124.69" y2="261.08" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="108.73" y1="264.99" x2="124.69" y2="264.99" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="108.73" y1="268.9" x2="124.69" y2="268.9" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="108.73" y1="272.82" x2="124.69" y2="272.82" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="108.73" y1="276.73" x2="124.69" y2="276.73" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><polygon points="266.74 380.42 238.74 380.42 238.74 342.91 258.4 342.91 266.74 350.55 266.74 380.42"></polygon><polygon points="268.38 379.15 240.38 379.15 240.38 341.65 260.04 341.65 268.38 349.29 268.38 379.15" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="260.04 341.65 257.99 350.62 268.38 349.29 260.04 341.65" style="stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="260.04 341.65 260.04 349.29 268.38 349.29 260.04 341.65" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><line x1="245.73" y1="354.8" x2="261.69" y2="354.8" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="245.73" y1="358.71" x2="261.69" y2="358.71" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="245.73" y1="362.63" x2="261.69" y2="362.63" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="245.73" y1="366.54" x2="261.69" y2="366.54" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="245.73" y1="370.45" x2="261.69" y2="370.45" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><polygon points="401.41 380.42 373.41 380.42 373.41 342.91 393.07 342.91 401.41 350.55 401.41 380.42"></polygon><polygon points="403.04 379.15 375.04 379.15 375.04 341.65 394.7 341.65 403.04 349.29 403.04 379.15" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="394.7 341.65 392.66 350.62 403.04 349.29 394.7 341.65" style="stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="394.7 341.65 394.7 349.29 403.04 349.29 394.7 341.65" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><line x1="380.4" y1="354.8" x2="396.36" y2="354.8" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="380.4" y1="358.71" x2="396.36" y2="358.71" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="380.4" y1="362.63" x2="396.36" y2="362.63" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="380.4" y1="366.54" x2="396.36" y2="366.54" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="380.4" y1="370.45" x2="396.36" y2="370.45" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><polygon points="129.73 380.42 101.73 380.42 101.73 342.91 121.39 342.91 129.73 350.55 129.73 380.42"></polygon><polygon points="131.37 379.15 103.37 379.15 103.37 341.65 123.03 341.65 131.37 349.29 131.37 379.15" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="123.03 341.65 120.98 350.62 131.37 349.29 123.03 341.65" style="stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="123.03 341.65 123.03 349.29 131.37 349.29 123.03 341.65" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><line x1="108.73" y1="354.8" x2="124.69" y2="354.8" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="108.73" y1="358.71" x2="124.69" y2="358.71" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="108.73" y1="362.63" x2="124.69" y2="362.63" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="108.73" y1="366.54" x2="124.69" y2="366.54" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="108.73" y1="370.45" x2="124.69" y2="370.45" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><polygon points="197.06 331.75 169.06 331.75 169.06 294.25 188.73 294.25 197.06 301.89 197.06 331.75"></polygon><polygon points="198.7 330.49 170.7 330.49 170.7 292.98 190.36 292.98 198.7 300.62 198.7 330.49" style="fill:#76AADB;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="190.36 292.98 188.32 301.95 198.7 300.62 190.36 292.98" style="stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="190.36 292.98 190.36 300.62 198.7 300.62 190.36 292.98" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><line x1="176.06" y1="306.14" x2="192.02" y2="306.14" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="176.06" y1="310.05" x2="192.02" y2="310.05" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="176.06" y1="313.96" x2="192.02" y2="313.96" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="176.06" y1="317.87" x2="192.02" y2="317.87" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="176.06" y1="321.78" x2="192.02" y2="321.78" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><polygon points="266.74 192.98 238.74 192.98 238.74 155.47 258.4 155.47 266.74 163.11 266.74 192.98"></polygon><polygon points="268.38 191.71 240.38 191.71 240.38 154.21 260.04 154.21 268.38 161.85 268.38 191.71" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="260.04 154.21 257.99 163.18 268.38 161.85 260.04 154.21" style="stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="260.04 154.21 260.04 161.85 268.38 161.85 260.04 154.21" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><line x1="245.73" y1="167.36" x2="261.69" y2="167.36" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="245.73" y1="171.27" x2="261.69" y2="171.27" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="245.73" y1="175.18" x2="261.69" y2="175.18" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="245.73" y1="179.09" x2="261.69" y2="179.09" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="245.73" y1="183.01" x2="261.69" y2="183.01" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><polygon points="334.07 144.31 306.07 144.31 306.07 106.81 325.74 106.81 334.07 114.44 334.07 144.31"></polygon><polygon points="335.71 143.05 307.71 143.05 307.71 105.54 327.37 105.54 335.71 113.18 335.71 143.05" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="327.37 105.54 325.33 114.51 335.71 113.18 327.37 105.54" style="stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="327.37 105.54 327.37 113.18 335.71 113.18 327.37 105.54" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><line x1="313.07" y1="118.69" x2="329.03" y2="118.69" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="313.07" y1="122.61" x2="329.03" y2="122.61" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="313.07" y1="126.52" x2="329.03" y2="126.52" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="313.07" y1="130.43" x2="329.03" y2="130.43" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="313.07" y1="134.34" x2="329.03" y2="134.34" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><polygon points="401.41 192.98 373.41 192.98 373.41 155.47 393.07 155.47 401.41 163.11 401.41 192.98"></polygon><polygon points="403.04 191.71 375.04 191.71 375.04 154.21 394.7 154.21 403.04 161.85 403.04 191.71" style="fill:#76AADB;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="394.7 154.21 392.66 163.18 403.04 161.85 394.7 154.21" style="stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="394.7 154.21 394.7 161.85 403.04 161.85 394.7 154.21" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><line x1="380.4" y1="167.36" x2="396.36" y2="167.36" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="380.4" y1="171.27" x2="396.36" y2="171.27" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="380.4" y1="175.18" x2="396.36" y2="175.18" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="380.4" y1="179.09" x2="396.36" y2="179.09" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="380.4" y1="183.01" x2="396.36" y2="183.01" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><polygon points="129.73 192.98 101.73 192.98 101.73 155.47 121.39 155.47 129.73 163.11 129.73 192.98"></polygon><polygon points="131.37 191.71 103.37 191.71 103.37 154.21 123.03 154.21 131.37 161.85 131.37 191.71" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="123.03 154.21 120.98 163.18 131.37 161.85 123.03 154.21" style="stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><polygon points="123.03 154.21 123.03 161.85 131.37 161.85 123.03 154.21" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></polygon><line x1="108.73" y1="167.36" x2="124.69" y2="167.36" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="108.73" y1="171.27" x2="124.69" y2="171.27" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="108.73" y1="175.18" x2="124.69" y2="175.18" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="108.73" y1="179.09" x2="124.69" y2="179.09" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line><line x1="108.73" y1="183.01" x2="124.69" y2="183.01" style="fill:#fff;stroke:#263238;stroke-linecap:round;stroke-linejoin:round"></line></g><g id="freepik--character-2--inject-41"><ellipse cx="320.64" cy="369.59" rx="49.74" ry="9.56" style="fill:#76AADB"></ellipse><ellipse cx="320.64" cy="369.59" rx="49.74" ry="9.56" style="fill:#fff;opacity:0.5"></ellipse><path d="M282.91,238.51a.71.71,0,0,1-.22.15.85.85,0,0,1-1.13-.41l-2-4.21a.86.86,0,0,1,1.55-.73l2,4.21A.85.85,0,0,1,282.91,238.51Z" style="fill:#fff;stroke:#263238;stroke-miterlimit:10"></path><path d="M284.71,248.9a11.66,11.66,0,0,1,5.84,2.54c2.8,2.29,8.9,5.34,16.79,7.12s9.91,2,9.91,2l-2-10.93s-11.19.25-16-.51-10.43-5.08-13-7.37S284.71,248.9,284.71,248.9Z" style="fill:#76AADB;stroke:#263238;stroke-miterlimit:10"></path><path d="M288.22,249.38a1.51,1.51,0,0,1-.32.22,1.29,1.29,0,0,1-1.71-.61l-5-10.55a1.28,1.28,0,1,1,2.32-1.1l5,10.55A1.3,1.3,0,0,1,288.22,249.38Z" style="fill:#fff;stroke:#263238;stroke-miterlimit:10"></path><path d="M284.56,231.49a13.35,13.35,0,1,1,.68-18.87A13.37,13.37,0,0,1,284.56,231.49Zm-16.44-17.68a10.79,10.79,0,1,0,15.24.55A10.8,10.8,0,0,0,268.12,213.81Z"></path><path d="M286.46,238.74s1.39-.74,2,.4,2.12,3.51,1.83,4.37-1.91,1-2.7.11a16.6,16.6,0,0,1-1.88-3.68Z" style="fill:#fff;stroke:#263238;stroke-miterlimit:10"></path><path d="M281.12,240.44l5.34-1.7a1.54,1.54,0,0,1,.7,1.12c.11.8,2.36,5.25,2.11,6.37s-5.13,3.17-5.62,2.56-3.37-7.56-3.37-7.56S280.2,240.7,281.12,240.44Z" style="fill:#fff;stroke:#263238;stroke-miterlimit:10"></path><line x1="287.27" y1="240.66" x2="282.45" y2="242.16" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-miterlimit:10"></line><line x1="287.97" y1="242.74" x2="283.58" y2="244.44" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-miterlimit:10"></line><line x1="288.78" y1="244.67" x2="284.62" y2="247.02" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-miterlimit:10"></line><path d="M308.61,219.66s-4.33,8.13-4.83,16.27,6.86,9.15,7.88,9.91,4.83,32.8,4.83,32.8-26.7,34.33-26.7,38.14S286,358,286,358l5.59.26S300,334.58,302,329s2.79-14.24,2.79-14.24l24.67-23.14s2.79,22.63,5.34,27.46,20.08,39.67,20.08,39.67a27,27,0,0,0,4.58.76,7.94,7.94,0,0,0,3.05-.76l-15-43s.76-39.16-2.54-45.52-11.7-15.51-11.7-15.51-7.12-29.49-8.14-34.07-6.86-8.39-9.66-8.39S308.61,219.66,308.61,219.66Z" style="fill:#76AADB;stroke:#263238;stroke-miterlimit:10"></path><path d="M304,214.57l3.56,5.59s-2,8.65-.25,6.62,4.57-9.41,6.1-10.94a8.59,8.59,0,0,0,2-3.56L307.84,208Z" style="fill:#fff;stroke:#263238;stroke-miterlimit:10"></path><path d="M288.21,195.92s-.45,4.67,1.07,7,2,3.05,1.53,4.57-2.8,1.53-2.29,2.8,3.31,1.78,3.31,1.78,3.05,7.12,5.84,7.12,9.94-7,10.95-9.55-9.42-9.27-11.2-10.79S290.24,193.12,288.21,195.92Z" style="fill:#fff;stroke:#263238;stroke-miterlimit:10"></path><path d="M294.43,204.78c.28.85.19,1.65-.21,1.78s-1-.45-1.23-1.3-.2-1.65.2-1.79S294.14,203.92,294.43,204.78Z"></path><path d="M293.65,212.72s2.46,0,3.28-3.55" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-miterlimit:10"></path><path d="M289.47,184.06h-5.26c-3.38,0-3.75,6.75,3.38,14.26s21.39,16.51,29.65,16.51,15.39,2.25,18.39,10.51,7.88,15.76,22.52,12.76,18.39-22.89,7.88-39.78-24.4-13.89-31.53-10.51-19.14,4.5-21.39,0-7.57-7.53-13.2-7.53S289.47,184.06,289.47,184.06Z"></path><path d="M362.51,358.74l-15-43s.76-39.16-2.54-45.52c-2.84-5.45-9.4-12.94-11.21-15L314.25,261c1.16,8.6,2.24,17.65,2.24,17.65s-26.7,34.33-26.7,38.14S286,358,286,358l5.59.26S300,334.58,302,329s2.79-14.24,2.79-14.24l24.67-23.14s2.79,22.63,5.34,27.46,20.08,39.67,20.08,39.67a27,27,0,0,0,4.58.76A7.94,7.94,0,0,0,362.51,358.74Z" style="stroke:#263238;stroke-miterlimit:10"></path><path d="M319.29,219.91a4.75,4.75,0,0,0-5.6,3.05c-1.52,4.07,4.83,7.63,9.66,13s18.82,16.27,18.82,16.27l8.14,25.94,3.81-.77S349,247.88,349,247.12s-21.35-21.87-22.12-22.63-3.81-4.07-3.81-4.07" style="fill:#76AADB;stroke:#263238;stroke-miterlimit:10"></path><path d="M350.31,278.14l-1.53,6.61,2.54,4.83s2,.76,2.55-.26l.5-1s2.55-.26,2.8-2.55-3.05-8.39-3.05-8.39Z" style="fill:#fff;stroke:#263238;stroke-miterlimit:10"></path><path d="M286,358s-12.46,9.16-13,10.68,16.78-2.54,18.31-2.8.25-7.62.25-7.62Z" style="fill:#76AADB;stroke:#263238;stroke-miterlimit:10"></path><path d="M274.28,367.21a5.53,5.53,0,0,0-1.27,1.44c-.51,1.53,16.78-2.54,18.31-2.8.52-.08.71-1,.74-2.19Z" style="fill:#fff;stroke:#263238;stroke-miterlimit:10"></path><path d="M354.88,358.74s-10.42,1.78-9.15,3.3a10.82,10.82,0,0,0,7.12,3c2.54,0,3.56.76,5.85,2s3.81,1.27,4.57-.77-.76-7.62-.76-7.62S356.41,360,354.88,358.74Z" style="fill:#76AADB;stroke:#263238;stroke-miterlimit:10"></path><path d="M358.7,367.13c2.28,1.27,3.81,1.27,4.57-.77a2.84,2.84,0,0,0,.16-.72c-3.79,1.91-7.28-2.63-10.46-2.63-2,0-4.79-1.11-6.64-2-.6.34-.88.68-.6,1a10.82,10.82,0,0,0,7.12,3C355.39,365.09,356.41,365.85,358.7,367.13Z" style="fill:#fff;stroke:#263238;stroke-miterlimit:10"></path><path d="M296.59,196.44c2,4,4.89,8.77,8.23,10.72" style="fill:none;stroke:#fff;stroke-miterlimit:10;stroke-width:0.75px"></path><path d="M293.74,189.75s.45,1.31,1.27,3.24" style="fill:none;stroke:#fff;stroke-miterlimit:10;stroke-width:0.75px"></path><path d="M366.31,204.68a12.4,12.4,0,0,1,2.34,2.48" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-miterlimit:10;stroke-width:0.75px"></path><path d="M287.23,188.52s3.52,12,15.3,17.58S319.06,210.5,334,204c11.44-5,22.68-4.7,29.61-1.07" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-miterlimit:10;stroke-width:0.75px"></path><path d="M345.43,228.25c-.19-3.87,3.77-3.31,4.23-3.16" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-miterlimit:10;stroke-width:0.75px"></path><path d="M325.57,207.51s6.86-1.23,20.22-1.06,21.63,13.9,19,22.16c-2.42,7.58-14.9,7.62-18.3,3" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-miterlimit:10;stroke-width:0.75px"></path></g><g id="freepik--character-1--inject-41"><ellipse cx="182.99" cy="252.85" rx="49.74" ry="9.56" style="fill:#76AADB"></ellipse><ellipse cx="182.99" cy="252.85" rx="49.74" ry="9.56" style="fill:#fff;opacity:0.5"></ellipse><path d="M207.67,99.77s0-5,0-8.18,4.53-8.72,11.38-9,18,8.68,16.22,13.48-4.34,2-4.34,2,1.83,2.06-.68,3.2S226,97.72,226,97.72s-3.43-3.2-6.63-3.2-2.28.23-4.57,3.42-4.34,2.29-4.34,3.43,1.6,3-.91,3S207.67,99.77,207.67,99.77Z" style="stroke:#263238;stroke-miterlimit:10"></path><path d="M109.69,211.45s-7.47-2.13-8.54-1.49-2.35,17.09-1.92,18.58,7-11.11,7-11.11l3.2-.42Z" style="fill:#76AADB;stroke:#263238;stroke-miterlimit:10"></path><path d="M102.27,209.85a2.24,2.24,0,0,0-1.12.11c-1.07.64-2.35,17.09-1.92,18.58.1.35.54-.08,1.16-.94Z" style="fill:#fff;stroke:#263238;stroke-miterlimit:10"></path><path d="M171.43,157.2a55.58,55.58,0,0,0-5.13,9c-1.92,4.48-4.06,9.18-4.06,9.18l-12.6,27.77s-23.5,5.56-26.49,6.41-13.46,1.92-13.46,1.92l-.21,5.56s29.26.85,36.1.85,8.12,1.28,10.68-.64S177.83,183,177.83,183l7.48-.42s21.15,24.35,22.86,26.91,7.47,19.65,10.46,25.21a54.32,54.32,0,0,0,6.41,9.39l4.7-5.34s-10-32.25-11.32-39.09-18.37-28.83-18.37-28.83l1.71-11.32S174.2,160.4,171.43,157.2Z" style="stroke:#263238;stroke-miterlimit:10"></path><path d="M208.57,114.33s-15.49-.89-17.72-.74-4.32.44-4.61,1.78-15.78,41.38-15.78,44.06,8.63,6.26,16.67,6.26a23.68,23.68,0,0,0,14.29-4.92c.74-.59,20.84-38.25,21.29-39.15s.29-2.23-1.19-3.57S208.57,114.33,208.57,114.33Z" style="fill:#76AADB;stroke:#263238;stroke-miterlimit:10"></path><path d="M209.46,112s-4,.89-5.06,2.23-4.17,13.4-4.17,13.4l8-1.64,4.61,7s3.13-10.12,3.28-14.44S211.69,111.5,209.46,112Z" style="fill:#76AADB;stroke:#263238;stroke-miterlimit:10"></path><path d="M186.38,114.26a57.91,57.91,0,0,0-12.6,5.55c-5.35,3.42-20.94,12.82-20.94,12.82l10,2.56,18.37-7.26S185.1,119.81,186.38,114.26Z" style="fill:#76AADB;stroke:#263238;stroke-miterlimit:10"></path><path d="M182.11,134.77s-9.83-1.07-14.32-2.35-8.75-3.85-13.24-1.07-4.06,6-1.28,8.12,18.8.21,22,0a11.5,11.5,0,0,0,5.34-1.71Z" style="fill:#76AADB;stroke:#263238;stroke-miterlimit:10"></path><path d="M179.76,135s9.82-3.63,10.46-3.63,1.93,0,2.14,1.49,1.07,5.13.21,5.34-5.34,1.93-6.41,1.93a6.59,6.59,0,0,1-2.13-.43,5.05,5.05,0,0,1-4.91-.85C176.77,136.9,178.47,135.62,179.76,135Z" style="fill:#fff;stroke:#263238;stroke-miterlimit:10"></path><line x1="184.03" y1="139.68" x2="183.17" y2="137.12" style="fill:none;stroke:#263238;stroke-miterlimit:10"></line><line x1="186.81" y1="134.13" x2="188.3" y2="139.68" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-miterlimit:10"></line><line x1="189.37" y1="132.42" x2="190.86" y2="138.18" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-miterlimit:10"></line><line x1="184.67" y1="135.19" x2="186.16" y2="140.11" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-miterlimit:10"></line><path d="M222,118.69a19.66,19.66,0,0,1,4.72,6.46c2.29,4.58,9,19.26,9,19.26s2.15,5-2.29,6.6-5-2.69-6.87-5.12-8.75-14.95-8.75-14.95Z" style="fill:#76AADB;stroke:#263238;stroke-miterlimit:10"></path><path d="M226.88,143.33a7,7,0,0,1,5.52-1.61c3.5.4,4.72,5.79,3.37,8.62s-5,3.9-6.2,3.36S224.46,151,226.88,143.33Z" style="fill:#76AADB;stroke:#263238;stroke-miterlimit:10"></path><path d="M228.55,142.63a.73.73,0,0,1-.25,0,.85.85,0,0,1-.56-1.07l1.4-4.45a.84.84,0,0,1,1.07-.55.85.85,0,0,1,.56,1.07l-1.4,4.45A.87.87,0,0,1,228.55,142.63Z" style="fill:#fff;stroke:#263238;stroke-miterlimit:10"></path><path d="M225,154.21a1.21,1.21,0,0,1-.38-.06,1.29,1.29,0,0,1-.84-1.61l3.51-11.15a1.28,1.28,0,0,1,2.44.77l-3.51,11.15A1.27,1.27,0,0,1,225,154.21Z" style="fill:#fff;stroke:#263238;stroke-miterlimit:10"></path><path d="M234.55,138.61a13.35,13.35,0,1,1,13.35-13.35A13.37,13.37,0,0,1,234.55,138.61Zm0-24.14a10.79,10.79,0,1,0,10.78,10.79A10.8,10.8,0,0,0,234.55,114.47Z"></path><path d="M225.27,142.26s-1.49-.54-1.89.67-1.62,3.77-1.21,4.58,2,.67,2.69-.27a16.83,16.83,0,0,0,1.35-3.91Z" style="fill:#fff;stroke:#263238;stroke-miterlimit:10"></path><path d="M230.79,143.2l-5.52-.94a1.55,1.55,0,0,0-.54,1.21c0,.81-1.62,5.52-1.22,6.6s5.53,2.42,5.93,1.75,2.29-7.95,2.29-7.95S231.73,143.33,230.79,143.2Z" style="fill:#fff;stroke:#263238;stroke-miterlimit:10"></path><line x1="224.73" y1="144.28" x2="229.71" y2="145.08" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-miterlimit:10"></line><line x1="224.32" y1="146.43" x2="228.9" y2="147.51" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-miterlimit:10"></line><line x1="223.78" y1="148.45" x2="228.23" y2="150.2" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-miterlimit:10"></line><path d="M209,108.82s-1.93,7.74-1.93,11.17,0,6.25,1.19,6,5.21-8,5.95-11S212.29,106.14,209,108.82Z" style="fill:#fff;stroke:#263238;stroke-miterlimit:10"></path><path d="M208.58,100.23s-1.6-2.74-2.51-.92-1.83,6.17-.46,7.54,1.83-.68,1.83-.68.23,6.17,2.51,8.45,4.8,3.43,8.46,1.83,8.22-8.23,9.59-12.79a41.59,41.59,0,0,0,1.6-6.86s-.91-3.65-6.17-4.8-10.73.92-10.73,3.2,1.14,2.52-.23,3.2a5.65,5.65,0,0,1-2.29.69S209.27,103.88,208.58,100.23Z" style="fill:#fff;stroke:#263238;stroke-miterlimit:10"></path><path d="M223.11,105c-.23.8-.69,1.36-1,1.26s-.43-.82-.2-1.61.69-1.36,1-1.26S223.34,104.2,223.11,105Z"></path><line x1="214.82" y1="101.97" x2="218.09" y2="103.96" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-miterlimit:10"></line><path d="M222.21,101.12s2.27-2.13,3,.43" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-miterlimit:10"></path><path d="M219.08,100.84s-.43-3.13-3.13-2.28" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-miterlimit:10"></path><path d="M221.36,103.39a4,4,0,0,0-1.57,2.85c0,1.7,1.42,3.27.14,3.55s-3.27-1.13-3.27-1.13" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-miterlimit:10"></path><path d="M217.8,112.21s-3.7.57-4.12-2.13" style="fill:none;stroke:#263238;stroke-linecap:round;stroke-miterlimit:10"></path><path d="M225,244.13s2.14,6,3.63,6,13.46-11.75,13.89-13-11.11,3-11.11,3l-1.71-1.29Z" style="fill:#76AADB;stroke:#263238;stroke-miterlimit:10"></path><path d="M240.16,237.21l-12.5,12.2c.35.42.69.71,1,.71,1.5,0,13.46-11.75,13.89-13C242.69,236.68,241.65,236.83,240.16,237.21Z" style="fill:#fff;stroke:#263238;stroke-miterlimit:10"></path></g></svg>
                        						
                        					</div>
                        					`;
                    }
                    

                    $('#searchresultDiv').html(searchResult);



                }
            });
    }
     

    function cartNoti()
    {
        var itemString=localStorage.getItem("itemlist");

        if (itemString) 
        {
            var itemArray = JSON.parse(itemString);
            noti = itemArray.length;

            $('.noti').html(noti);

        }

        else
        {
            $('.noti').html(0);

        }
    }


    // Shopping Cart Btn
    $(".tab-pane").on('click','.shoppingcartBtn',function(e){
        e.preventDefault();

        var id = $(this).data('id');
        var name = $(this).data('name');
        var price = $(this).data('price');
        var codeno = $(this).data('codeno');
        var status = $(this).data('status');

        var qty = 1;

        var item = {id:id, codeno:codeno, name:name, price:price, qty:qty, status:status};
        
        var itemString=localStorage.getItem("itemlist");
        var itemArray;

        if (itemString==null) {
            itemArray=Array();
        }
        else{
            itemArray=JSON.parse(itemString);
        }

        console.log(itemArray);

        var status=false;

        $.each(itemArray,function(i,v){
            if (id==v.id){
                status=true;
                v.qty++;
            }
        })

        if (!status){
            itemArray.push(item);
        }

        var itemData=JSON.stringify(itemArray);

        localStorage.setItem("itemlist",itemData);

        cartNoti();
        shoppingCart();
        
    });

    function shoppingCart()
    {
        var itemString=localStorage.getItem("itemlist");

        if (itemString) 
        {
            $('#shoppingcart_div').show();
            $('#noneshoppingcart_div').hide();

            var itemArray = JSON.parse(itemString);
            var shoppingCart_data = '';


            // console.log(itemArray.length);

            if(itemArray.length > 0)
            {
                var shoppingCart_total =0;
                
                $.each(itemArray, function(i,v)
                {
                    if (v) 
                    {
                        var id = v.id;
                        var codeno = v.codeno;
                        var name = v.name;
                        var num_price = v.price;
                        var qty = v.qty;

                        var subtotal = num_price * qty;

                        var str_price = CommaFormatted(num_price.toString());

                        var str_subtotal = CommaFormatted(subtotal.toString());

                        console.log(str_subtotal);

                        shoppingCart_data += `<div class="row border-bottom mt-3" style="border-color: #9E9E9E;">
                            <div class="col-1">
                                <button class="btn btn-outline-danger btn-sm removeBtn" data-id=${i}> 
                                    <i class="fas fa-times"> </i> 
                                    </button>
                            </div>
                            <div class="col-5">
                                <p class="mb-0"> ${codeno} </p>
                                <small> ${name} </small>
                                <p> ${str_price} Ks </p>
                            </div>
                            <div class="col-4 mt-2">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-secondary btn-sm plusBtn" data-id=${i}> + </button>
                                    <button type="button" disabled="" class="btn btn-secondary btn-sm"> 
                                        ${qty}
                                    </button>
                                    <button type="button" class="btn btn-secondary btn-sm minusBtn" data-id=${i}> - </button>
                                </div>
                            </div>
                            <div class="col-2 mt-2 text-right">
                                ${str_subtotal} Ks
                            </div>
                        </div>`;
                    }

                    shoppingCart_total += subtotal++;


                });


                $('#shoppingcart_lists').html(shoppingCart_data);
                $('#totalInput').val(shoppingCart_total);

                $('.shoppingcart_subtotal').html(CommaFormatted(shoppingCart_total.toString())+' Ks');
                $('.shoppingcart_total').html(CommaFormatted(shoppingCart_total.toString())+' Ks');

            }
            else
            {
                $('#shoppingcart_div').hide();
                $('#noneshoppingcart_div').show();

            }
        }
        else
        {
            $('#shoppingcart_div').hide();
            $('#noneshoppingcart_div').show();

        }

    }

    // Add Quantity
    $('#shoppingcart_lists').on('click','.plusBtn', function()
    {
        var id = $(this).data('id');

        var itemString=localStorage.getItem("itemlist");
        var itemArray = JSON.parse(itemString);
        
        $.each(itemArray,function (i,v) 
        {
            console.log(i);
            if (i == id) 
            {
                v.qty++;
            }
        })
        
        var itemData = JSON.stringify(itemArray);
        localStorage.setItem('itemlist',itemData);
        shoppingCart();
        cartNoti();

    });

    // Sub Quantity
    $('#shoppingcart_lists').on('click','.minusBtn', function()
    {
        var id = $(this).data('id');

        var itemString=localStorage.getItem("itemlist");
        var itemArray = JSON.parse(itemString);
        
        $.each(itemArray,function (i,v) 
        {
            if (i == id) 
            {
                v.qty--;
                if (v.qty == 0) 
                {
                    itemArray.splice(id,1);
                }
            }
        })
        
        var itemData = JSON.stringify(itemArray);
        localStorage.setItem('itemlist',itemData);
        shoppingCart();
        cartNoti();

    });


    // Remove Item
    $('#shoppingcart_lists').on('click','.removeBtn', function()
    {
        var id = $(this).data('id');

        var itemString=localStorage.getItem("itemlist");
        var itemArray = JSON.parse(itemString);

        $.each(itemArray,function (i,v) 
        {
            if (i == id) 
            {
                itemArray.splice(id,1);
            }
        })

        var itemData=JSON.stringify(itemArray);

        localStorage.setItem("itemlist",itemData);
        
        shoppingCart();
        cartNoti();

    });

    // Charge Money
    $("#shoppingcart_div").on("focus","#changemoney",function(event)
    {
            event.preventDefault();
            var total=$("#totalInput").val();
            var discount=$("#discount").val();
            var paymoney=$("#paymoney").val();

            console.log("Totla "+total+" Discount "+discount+" Paymoney "+paymoney);

            var finaltotal = total - discount;

            var changemoney = paymoney - finaltotal;

            console.log(finaltotal);

            $("#changemoney").val(changemoney);
                
            if(changemoney<0)
            {
                $("#paymoney").focus();
            }

            $('.shoppingcart_total').html(CommaFormatted(finaltotal.toString())+' Ks');
            $('.totalInput').val(finaltotal);



    });


    // Checkout
    $('#shoppingcart_div').on('click', '.checkoutBtn', function()
    {   
        var total=$("#totalInput").val();
        var discount=$("#discount").val();
        var paymoney=$("#paymoney").val();
        var changemoney=$("#changemoney").val();

        var invoiceno=$("#invoiceInput").val();

        var name=$("#name").val();
        var phone=$("#phone").val();
        var address=$("#address").val();

        var itemString=localStorage.getItem("itemlist");
        var itemArray = JSON.parse(itemString);

        console.log(name);
        console.log(phone);
        console.log(address);
        console.log(paymoney);
        console.log(changemoney);

        console.log(paymoney != 0 & changemoney != 0 & name != 0 && phone != 0 && address != 0);
        if (paymoney && name && phone && address) {
        	console.log('hello');
        	$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });

		    console.log(salestore);

		    $.ajax({
		            type:'POST',
		            url:salestore,
		            data:{
		                cart:itemArray,
		                invoiceno:invoiceno,
		                total:total,
		                discount:discount,
		                name:name,
		                phone:phone,
		                address:address,
		                paymoney:paymoney
		            },
		            success:function(data)
		            {
		                // $('#print_div').show();

		                var vocuhertable;
		                var j=1;
		                var eachtotal =0;


		                $.each(itemArray,function (i,v) 
		                {
		                    if (v) 
		                    {
		                        var id = v.id;
		                        var codeno = v.codeno;
		                        var name = v.name;
		                        var price = v.price;
		                        var qty = v.qty;

		                        var subtotal = price * qty;



		                        vocuhertable +=`<tr>
		                                <td class="text-center">${j++}</td>
		                                <td>
		                                    <p class="mb-0"> ${codeno} </p>
		                                    <small> ${name} </small>
		                                </td>
		                                <td class="text-right"> ${qty} </td>
		                                <td class="text-right"> ${CommaFormatted(price.toString())} Ks </td>
		                                <td class="text-right"> ${CommaFormatted(subtotal.toString())} Ks </td>
		                            </tr>`;
		                        eachtotal += subtotal++;
		                    }

		                });
		                $('tbody').html(vocuhertable);

		                $('#print_cname').text(name);
		                $('#print_cphone').text(phone);
		                $('#print_caddress').text(address);


		                $('#print_total').text(CommaFormatted(eachtotal.toString())+" Ks");
		                $('#print_discount').text(CommaFormatted(discount.toString())+" Ks");
		                $('#print_paymoney').text(CommaFormatted(paymoney.toString())+" Ks");
		                $('#print_charge').text(CommaFormatted(changemoney.toString())+" Ks");
		                $('#print_finaltotal').text(CommaFormatted(total.toString())+" Ks");


		                var printContents =$('#print_div').html();
		                // var originalContents = document.body.innerHTML;
		                document.body.innerHTML=printContents;
		                window.print();

		                localStorage.clear();
		                location.reload(); 

		            }
		        });
        }else{
            $('#errorDiv').html('');
            $('#errorDiv').addClass('d-none');

			
            $('#name').removeClass('border border-danger');
            $('#phone').removeClass('border border-danger');
            $('#address').removeClass('border border-danger');

            $('#paymoney').removeClass('border border-danger');
            $('#changemoney').removeClass('border border-danger');

            $(".paymoney_err").html('');
            $(".changemoney_err").html('');


			if(name == ''){
				$("#errorDiv").removeClass("d-none");
                $('#errorDiv').append('<p> <i class="bi bi-exclamation-circle"></i> Customer နာမည် ဖြည့်ရန် လိုပါသည်။ </p> ');

               	$('#name').addClass('border border-danger');

            }

            if(phone == ''){
				$("#errorDiv").removeClass("d-none");
                $('#errorDiv').append('<p> <i class="bi bi-exclamation-circle"></i> Customer ဖုန်းနံပါတ် ဖြည့်ရန် လိုပါသည်။ </p>');

               	$('#phone').addClass('border border-danger');

            }

            if(address == ''){
				$("#errorDiv").removeClass("d-none");
                $('#errorDiv').append('<p> <i class="bi bi-exclamation-circle"></i> Customer လိပ်စာ ဖြည့်ရန် လိုပါသည်။ </p>');

               	$('#address').addClass('border border-danger');

            }

            if(paymoney == ''){
				$(".paymoney_err").html("Customer ပေးသည့် ပိုက်ဆံ amount ဖြည့်ရန် လိုပါသည်။");

               	$('#paymoney').addClass('border border-danger');

            }

            if(changemoney == ''){
				$(".changemoney_err").html("Customerကို ပြန်အမ်းမည့် ပိုက်ဆံ amount ဖြည့်ရန် လိုပါသည်။");

               	$('#changemoney').addClass('border border-danger');

            }
        }
        

    });

    
    // Voucher
    function datefn()
    {
        var now = new Date();
        var months = new Array('January','February','March','April','May','June','July','August','September','October','November','December');
        var date = ((now.getDate()<10) ? "0" : "")+ now.getDate();
        
        function fourdigits(number) 
        {
            return (number < 1000) ? number + 1900 : number;
        }
        today =  months[now.getMonth()] + " " + date + ", " + (fourdigits(now.getYear()));
        invoiceno = Date.now();

        $('#invoiceInput').val('#'+invoiceno);

        $('#print_invoice').text('#'+invoiceno);
        $('#invoiceno').text('#'+invoiceno);

        $('#print_date').text(today);
    }

    function CommaFormatted(amount) 
    {
        var delimiter = ","; // replace comma if desired
        var a = amount.split('.',2)
        var i = parseInt(a[0]);
        
        if(isNaN(i)) 
        {
            return ''; 
        }
        
        var minus = '';
        
        if(i < 0) 
        {
            minus = '-'; 
        }
        
        i = Math.abs(i);
        var n = new String(i);

        var a = [];
        
        while(n.length > 3) {
            var nn = n.substr(n.length-3);
            a.unshift(nn);
            n = n.substr(0,n.length-3);
        }

        if(n.length > 0) 
        { 
            a.unshift(n); 
        }
        n = a.join(delimiter);

        amount = minus + amount;

        // console.log(n);

        return n;

    }

});