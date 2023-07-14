base_url = '/imagefootage/backend/admin/';
api_path = '/admin/';
image_path ='/';
small_price = '500';
medium_price = '2500';
large_price = '2500';
extra_large_price = '4600';

app = angular.module('imageFootage', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});
app.controller('quotatationController', function($scope, $http, $location, fileReader) {
    $scope.title = "Send Quotation";
    $scope.quotation = {};
    $scope.po = '';
    $scope.subsc_expiry_time = '30';
    $scope.expiry_time = '30';
    $scope.download_expiry = '30';

    //$scope.uid
    $scope.quotation.product = [{
        name: "",
        pro_size: "",
        pro_type: "",
        id: "",
        image: "",
        price: "",
        footage: "",
        type: "Image"
    }];
    $scope.quotation_type_var = 'custom';
    $scope.addProduct = function() {
        var newProduct = { name: "", pro_size: "", pro_type: "", id: "", image: "", price: "", footage: "", type:"Image" };
        $scope.quotation.product.push(newProduct);
    }
     
    $scope.$on("fileProgress", function(e, progress) {
        $scope.progress = progress.loaded / progress.total;
      });
      
    $scope.removeProduct = function(product) {
        var index = $scope.quotation.product.indexOf(product);
        $scope.quotation.product.splice(index, 1);
    }
    $scope.prices = [];
    $scope.getproduct = function(product) {
    if(product.name != ''){
        $('#loading').show();
            var index = $scope.quotation.product.indexOf(product);
            $http({
                method: 'GET',
                url:  image_path+'api/product/' + product.name +'?type='+ product.type,
            }).then(function(response) {
               // console.log(response);
                if (response.status == '200') {
                    $('#loading').hide();
                    if(product.type == 'Image'){
                            $scope.quotation.product[index].name = response.data[0].product_code;
                            $scope.quotation.product[index].id = response.data[0].id;
                            if (response.data[0].type == "Royalty Free") {
                                $scope.quotation.product[index].pro_type = "royalty_free";
                            } else {
                                $scope.quotation.product[index].pro_type = "right_managed";
                            }
                            $scope.quotation.product[index].image = response.data[0].thumbnail_image;
                            $scope.prices[index] = response.data[0];
                    } else {
                        $scope.quotation.product[index].name = response.data[0].clip_data.id;
                        $scope.quotation.product[index].id = response.data[0].clip_data.n;
                        $scope.quotation.product[index].image = "https://p5iconsp.s3-accelerate.amazonaws.com/"+response.data[2];
                        $scope.quotation.product[index].footage = "https://p5resellerp.s3-accelerate.amazonaws.com/"+response.data[1];
                        $scope.prices[index] = response.data[0].clip_data.versions;
                      //  console.log($scope.prices[index]);
                        //$scope.quotation.product[index] = response.data[0];
                    }
                }
            }, function(error) {
                $('#loading').hide();
            });
        }    
    }

    $scope.getThetotalAmount = function(product) {
        var index = $scope.quotation.product.indexOf(product);
       // console.log($scope.prices);
        if(product.type == 'Image') {
            if (product.pro_type == "royalty_free") {
                var amount = 0;
                if (product.pro_size == "Small") {
                    //amount = $scope.prices[index].small_size;
                    amount = small_price;
                } else if (product.pro_size == "Medium") {
                    //amount = $scope.prices[index].medium_size;
                    amount = medium_price;
                } else if (product.pro_size == "Large") {
                    //amount = $scope.prices[index].large_size;
                    amount = large_price;
                } else if (product.pro_size == "X-Large") {
                    //amount = $scope.prices[index].x_large_size;
                    amount = extra_large_price;
                } else {
                    amount = 1;
                }
            } 
        } else {
            for(let i=0; i< $scope.prices[index].length; i++) {
                if(product.pro_size == $scope.prices[index][i].size){
                    amount = $scope.prices[index][i].pr;
                }
            } 
          //  console.log(amount);
        }
        $scope.quotation.product[index].price = amount;
        $scope.getTheTotal();
    }
    /* Subscription and Download  */
    $scope.tax = 0;
    $scope.prod_type_var = '';
    $scope.plan_type_var ='';
    $scope.search = false;
    $scope.taxdownload = 0;

    $scope.quotation_type_set = function(type) {
        $scope.search = false;
        $scope.quotation_type_var = type;        
    }
    $scope.getTheTotal = function() {
        var subtotal = $scope.quotation.product;
        var subtotalvalue = 0;
        var total = 0;
        for (var j = 0; j < subtotal.length; j++) {
            subtotalvalue += Number(subtotal[j].price);
        }  
        subtotal = Number(subtotalvalue);
        $scope.total = subtotal;
    }
    $scope.checkThetax = function(tax_percent, type) {

        var subtotal = $scope.quotation.product;
        //console.log(subtotal);
        var subtotalvalue = 0;
        var total = 0;
        for (var j = 0; j < subtotal.length; j++) {
            subtotalvalue += Number(subtotal[j].price);

        }
        //var intialtotal = $scope.tax;
        // if (type == 'SGST') {
        //     total = (subtotalvalue * (6) / 100);
        // } else if (type == 'CGST') {
        //     total = (subtotalvalue * (6) / 100);
        // } else if (type == 'IGST') {
        //     total = (subtotalvalue * (12) / 100);
        // } else if (type == 'IGSTT') {
        //     total = (subtotalvalue * (18) / 100);
        // }

        if (tax_percent == true) {
            //total = intialtotal + total;
            if (type == 'GST') {
                total = (subtotalvalue * (12) / 100);
            }
        } else {

            // if (intialtotal > total) {
            //     total = intialtotal - total;
            // } else {
                total = 0;
            //}

        }
        subtotal = Number(subtotalvalue);
        total = Number(total);
        $scope.tax = total;
        $scope.total = total + subtotal;
    }

    $scope.prod_type =   function(type){
        $scope.prod_type_var = type;
        
    }
    $scope.plan_type_select = function(type){
        $scope.plan_type_var = type;
    }
    
    $scope.getPlans = function(){
        $scope.plansData = [];
        //console.log(product); 
        $('#loading').show();
            $http({
                method: 'POST',
                url: api_path + 'plans',
                data: { "quotation_type" : $scope.quotation_type_var, "prod_type" : $scope.prod_type_var, "product_dur" : $scope.plan_type_var }
            }).then(function(response) {
                $('#loading').hide();
                if (response.data.status == 'success') {
                    $scope.search = true;
                    $scope.plansData = response.data.data;
                    if($scope.prod_type_var == 'foot') {
                        angular.forEach(response.data.data, function(value, key) {
                            if(value.footage_tier == '1'){
                                var licence_type = "Commercial";
                            } else if(value.footage_tier == '2') {
                                var licence_type = "Non Commercial";
                            } else if(value.footage_tier == '3') {
                                var licence_type = "Web Only";
                            } else {
                                var licence_type = "FULL RF";
                            }
                            $scope.plansData[key]['package_description'] =  value.package_description+' ( '+licence_type+' )';
                          });
                         // console.log($scope.plansData);
                    }
                } else{
                    alert("There is no Plan for selection");
                }
            }, function(error) {
                $('#loading').hide();
            });
            
    }

    $scope.selectPlanfromlist = function(selectedPlanData, type){
        selectedPlanData = JSON.parse(selectedPlanData);
      //  console.log(selectedPlanData);
      //  console.log(type);
        $scope.selected_plan = selectedPlanData;
        if(type == 'download'){
            $scope.downloadprice = selectedPlanData["package_price"];
            $scope.total_download = selectedPlanData["package_price"];
        }else {
            $scope.subscriptionprice = selectedPlanData["package_price"];
            $scope.subsc_total =  selectedPlanData["package_price"];
        }
        
       
    }
    
    $scope.checkDownloadtax = function(tax_percent, type) {
        
        var subtotalvalue = $scope.downloadprice;
        
        // var intialtotal = $scope.taxdownload;
        // if (type == 'SGST') {
        //     total = (subtotalvalue * (6) / 100);
        // } else if (type == 'CGST') {
        //     total = (subtotalvalue * (6) / 100);
        // } else if (type == 'IGST') {
        //     total = (subtotalvalue * (12) / 100);
        // } else if (type == 'IGSTT') {
        //     total = (subtotalvalue * (18) / 100);
        // }

        if (tax_percent == true) {
            //total = intialtotal + total;
            if (type == 'GST') {
                total = (subtotalvalue * (12) / 100);
            }
        } else {
            // if (intialtotal > total) {
            //     total = intialtotal - total;
            // } else {
                total = 0;
            //}
        }
        
        subtotal = Number(subtotalvalue);
        total = Number(total);
        $scope.taxdownload = total;
        $scope.total_download = total + subtotal;
    }

    $scope.checksubsctax = function(tax_percent, type) {
       // console.log(type);
      //  console.log(tax_percent);
        var subtotalvalue = $scope.subscriptionprice;
        
        //var intialtotal = $scope.subscriptionprice;
        
        // if (type == 'SGST') {
        //     total = (subtotalvalue * (6) / 100);
        // } else if (type == 'CGST') {
        //     total = (subtotalvalue * (6) / 100);
        // } else if (type == 'IGST') {
        //     total = (subtotalvalue * (12) / 100);
        // } else if (type == 'IGSTT') {
        //     total = (subtotalvalue * (18) / 100);
        // }

        if (tax_percent == true) {
            //total = intialtotal + total;
            if (type == 'GST') {
                total = (subtotalvalue * (12) / 100);
            }
        } else {
            // if (intialtotal > total) {
            //     total = intialtotal - total;
            // } else {
                total = 0;
            //}
        }
      //  console.log(total);
        subtotal = Number(subtotalvalue);
        total = Number(total);
        $scope.subsc_tax = total;
        $scope.subsc_total = total + subtotal;
    }
    
    $scope.submitQuotation = function() {
       // console.log($scope.quotation);
       // console.log($scope);
        if($scope.quotation_type_var == 'subscription'){
            $scope.submitSubscription();
        } else if($scope.quotation_type_var == 'download'){
            $scope.submitDownload();
        } else {
            $scope.submitCustom();    
        }
    }

    $scope.submitDownload = function(){
       // console.log($scope.quotation);
       // console.log($scope);
        if(!$scope.selected_plan){
            alert("Please select Plan"); 
            return false;  
        } else if (!$scope.downloadprice) {
            alert("Please enter Subtotal"); 
            return false;
        } else {

        $('#loading').show();
      
        var sendData = {
            "uid": $('#uid').val(),
            "quotation_type": $scope.quotation_type_var,
            "plan_id": $scope.selected_plan,
            "plan_type_var": $scope.plan_type_var,
            //"po": $scope.poDownload,
            //"poDate": $scope.downloadpoDate,
            "expiry_date": $scope.download_expiry,
            "tax": $scope.taxdownload,
            "total": $scope.total_download,
            "subscription_subtotal": $scope.downloadprice,
            "GSTS": $scope.GSTD,            
            "email": $('#download_email_id').val(),   
        }
       // console.log(sendData);
      //  console.log($scope.quotation);
        var fd = new FormData();
        // angular.forEach($scope.quotation[0],function(file){
        //     fd.append('file',file);
        // });
            $http({
                method: 'POST',
                url: base_url + 'saveDownloadInvoice',
                data: sendData,
                headers: { 'Content-Type': undefined },
            }).then(function(response) {
                $('#loading').hide();
                if (response.data.this.statuscode == '1') {
                    alert(response.data.this.statusdesc);
                } else {
                    alert(response.data.this.statusdesc);
                }
                window.location = api_path + 'users/invoices/' + $('#uid').val();
            
            }, function(error) {
                $('#loading').hide();
            });
        }
    }

    $scope.submitSubscription = function(){
      //  console.log($scope.quotation);
       // console.log($scope);
        if(!$scope.selected_plan){
            alert("Please select Plan"); 
            return false;  
        } else if (!$scope.subscriptionprice) {
            alert("Please enter Subtotal"); 
            return false;
        } else {
        $('#loading').show();
      
        var sendData = {
            "uid": $('#uid').val(),
            "quotation_type": $scope.quotation_type_var,
            "plan_id": $scope.selected_plan,
            "plan_type_var": $scope.plan_type_var,
            //"po": $scope.subsc_po,
            //"poDate": $scope.subsc_poDate,
            "expiry_date": $scope.subsc_expiry_time,
            "tax": $scope.subsc_tax,
            "total": $scope.subsc_total,
            "subscription_subtotal": $scope.subscriptionprice,
            "GSTS": $scope.GSTS,            
            "email": $('#subsc_email_id').val(),            
        }
       // console.log(sendData);
      //  console.log($scope.quotation);
        var fd = new FormData();
        // angular.forEach($scope.quotation[0],function(file){
        //     fd.append('file',file);
        // });
            $http({
                method: 'POST',
                url: base_url + 'saveSubscriptionInvoice',
                data: sendData,
                headers: { 'Content-Type': undefined },
            }).then(function(response) {
                $('#loading').hide();
                if (response.data.this.statuscode == '1') {
                    alert(response.data.this.statusdesc);
                } else {
                    alert(response.data.this.statusdesc);
                }
                window.location = api_path + 'users/invoices/' + $('#uid').val();
                // $scope.quotation.product[index].name = response.data[0].product_code;
                // $scope.quotation.product[index].id = response.data[0].id;
                // if(response.data[0].type =="Royalty Free"){
                //     $scope.quotation.product[index].pro_type = "royalty_free";
                // }else{
                //     $scope.quotation.product[index].pro_type = "right_managed";
                // }
                // $scope.quotation.product[index].image = response.data[0].thumbnail_image;
                // $scope.prices[index] = response.data[0];
                //}
            }, function(error) {
                $('#loading').hide();
            });
        }
    }

    $scope.submitCustom = function(){
      //  console.log($scope.quotation);
      //  console.log($scope);
        $('#loading').show();
      
        var sendData = {
            "uid": $('#uid').val(),
            "quotation_type": $scope.quotation_type_var,
            "products": $scope.quotation,
            "promoCode": $scope.promoCode,
            //"po": $scope.po,
            //"poDate": $scope.poDate,
            "expiry_date": $scope.expiry_time,
            "tax": $scope.tax,
            "total": $scope.total,
            "GST": $scope.SGST,
            "email": $('#email_id').val(),
            "flag": '0'
        }
       // console.log(sendData);
       // console.log($scope.quotation);
        var fd = new FormData();
        // angular.forEach($scope.quotation[0],function(file){
        //     fd.append('file',file);
        // });
        $http({
            method: 'POST',
            url: api_path + 'saveInvoice',
            data: sendData,
            headers: { 'Content-Type': undefined },
        }).then(function(response) {
            $('#loading').hide();
            if (response.data.this.statuscode == '1') {
                alert(response.data.this.statusdesc);
            } else {
                alert(response.data.this.statusdesc);
            }
            window.location = api_path + 'users/invoices/' + $('#uid').val();
            // $scope.quotation.product[index].name = response.data[0].product_code;
            // $scope.quotation.product[index].id = response.data[0].id;
            // if(response.data[0].type =="Royalty Free"){
            //     $scope.quotation.product[index].pro_type = "royalty_free";
            // }else{
            //     $scope.quotation.product[index].pro_type = "right_managed";
            // }
            // $scope.quotation.product[index].image = response.data[0].thumbnail_image;
            // $scope.prices[index] = response.data[0];
            //}
        }, function(error) {
            $('#loading').hide();
        });
    }

    $scope.checkProduct = function(product_type){
       // console.log(product_type);
    }
});
app.controller('PromotionController', function($scope, $http, $location, fileReader) {
    $scope.title = "Promotion";
    $scope.promotion = {};
    $scope.po = '';
    $scope.product = {};
    $scope.subsc_expiry_time = '30';
    $scope.expiry_time = '30';
    $scope.download_expiry = '30';

    //$scope.uid
    $scope.promotion.product = [{
        name: "",
        pro_size: "",
        pro_type: "",
        id: "",
        image: "",
        price: "",
        footage: "",
        type: "Image"
    }];
    $scope.promotion_type_var = 'custom';
    $scope.addProduct = function() {
        var newProduct = { name: "", pro_size: "", pro_type: "", id: "", image: "", price: "", footage: "", type:"Image" };
        $scope.promotion.product.push(newProduct);
    }
     
    $scope.$on("fileProgress", function(e, progress) {
        $scope.progress = progress.loaded / progress.total;
      });
      
    $scope.removeProduct = function(product) {
        var index = $scope.promotion.product.indexOf(product);
        $scope.promotion.product.splice(index, 1);
    }
    $scope.prices = [];
    $scope.getproduct = function(product) {
        // console.log(product); return;
    if(product.name != ''){
        $('#loading').show();
            var index = $scope.promotion.product.indexOf(product);
            $http({
                method: 'GET',
                url:  image_path+'api/product/' + product.name +'?type='+ product.type,
            }).then(function(response) {
               console.log("==>", response);
                if (response.status == '200') {
                    $('#loading').hide();
                    if(product.type == 'Image'){
                        $scope.promotion.product[0].image = response.data[0].thumbnail_image;
                        $("#image_url").val($scope.promotion.product[0].image);
                        if($scope.promotion.product[0].image != ""){
                            $("#product_image").attr("src", $scope.promotion.product[0].image);
                            $("#product_image_container").show();
                        } else{
                            $("#product_image").removeAttr("src");
                            $("#product_image_container").hide();
                        }
                    } else {
                        if(response.data[1] != ""){
                        $("#footage_url").val(response.data[1]);
                        let url = "https://p5resellerp.s3-accelerate.amazonaws.com/"+ response.data[1];
                        $("#product_footage").attr("src", url);
                        $("#product_footage").show();
                        }else{
                            $("#product_footage").removeAttr("src");
                            $("#product_footage").hide();
                        }
                    }
                }
            }, function(error) {
                $('#loading').hide();
            });
        }   
    }  

    $scope.checkProduct = function(product) {
        console.log("**", product);
        $scope.getproduct(product)
    }
});
app.directive('ngFileModel', ['$parse', function($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.ngFileModel);
            var isMultiple = attrs.multiple;
            var modelSetter = model.assign;
            element.bind('change', function() {
                var values = [];

                angular.forEach(element[0].files, function(item) {
                  //  console.log(item);
                    var value = {
                        // File Name 
                        name: item.name,
                        //File Size 
                        size: item.size,
                        //File URL to view 
                        url: URL.createObjectURL(item),
                        // File Input Value 
                        _file: item
                    };
                    values.push(value);
                });
                scope.$apply(function() {
                    if (isMultiple) {
                        modelSetter(scope, values);
                    } else {
                        modelSetter(scope, values[0]);
                    }
                });
            });
        }
    };
}]);

app.directive('ngFile', ['$parse', function($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            element.bind('change', function() {

                $parse(attrs.ngFile).assign(scope, element[0].files)
                scope.$apply();
            });
        }
    };
}]);

app.controller('ordersController', function($scope, $http, $location) {
    $scope.orderslist = {};
    $scope.products = {};
    $('#loading').show();
    var userid = window.location.pathname.split("/").pop();
    $http({
        method: 'GET',
        url: base_url + 'userListapi/' + userid,

    }).then(function(response) {
        $('#loading').hide();
        $scope.orderslist = response.data;
    }, function(error) {
        $('#loading').hide();
    });
    $scope.showProduct = function(products) {
        $scope.products = products;
       // console.log($scope.products);
        $('#modal-default').modal('show');
    }
});

app.controller('editquotatationController', function($scope, $http, $location) {
    $scope.title = "Edit Quotation";
    $scope.quotation = {};
    $scope.tax = 0;
    var path = window.location.pathname.split("/").pop();
    $('#loading').show();
    $http({
        method: 'POST',
        url: api_path + 'edit_quotation_data',
        data: { quotation: path }
    }).then(function(result) {
        $('#loading').hide();
        response = result.data;
       // console.log(response.user_id);
        $scope.uid = response.user_id;
        $scope.quotation_type = response.invoice_type;
        $scope.promoCode = response.promo_code;
        $scope.tax = response.tax;
        $scope.total = response.total;
        $scope.total = response.total;
        $scope.po = response.job_number;
        $scope.poDate = response.po_detail;
        $scope.email = response.email_id;
        $scope.expiry_time = response.expiry_invoices;
        $scope.quotation.product = [];
        var tax_selected = angular.fromJson(response.tax_selected);
        $scope.tax_selected = tax_selected;
        angular.forEach(tax_selected, function(value, key) {
            $scope[key] = value;
        });
        angular.forEach(response.items, function(value, key) {
            var obj = {
                name: value.product_id,
                pro_size: value.product_size,
                pro_type: value.product_type,
                id: value.id,
                image: value.product_image,
                price: value.subtotal,
                footage: "",
                type: value.type
            };
            $scope.quotation.product.push(obj);
        });

    }, function(error) {
        $('#loading').hide();
    });

    $scope.addProduct = function() {
        var newProduct = { name: "", pro_size: "", pro_type: "", id: "", image: "", price: "" };
        $scope.quotation.product.push(newProduct);
    }

    $scope.removeProduct = function(product) {
        var index = $scope.quotation.product.indexOf(product);
        $scope.quotation.product.splice(index, 1);
        $scope.calculatePrice();
    }
    $scope.prices = [];
    $scope.getproduct = function(product) {
       // console.log(product);
        $('#loading').show();
        var index = $scope.quotation.product.indexOf(product);
        $http({
            method: 'GET',
            url: + 'product/' + product.name,
        }).then(function(response) {

            if (response.status == '200' && response.statusText == 'OK') {
                $('#loading').hide();
                $scope.quotation.product[index].name = response.data[0].product_code;
                $scope.quotation.product[index].id = response.data[0].id;
                if (response.data[0].type == "Royalty Free") {
                    $scope.quotation.product[index].pro_type = "royalty_free";
                } else {
                    $scope.quotation.product[index].pro_type = "right_managed";
                }
                $scope.quotation.product[index].image = response.data[0].thumbnail_image;
                $scope.prices[index] = response.data[0];
            }
        }, function(error) {
            $('#loading').hide();
        });
    }

    $scope.getThetotalAmount = function(product) {
        var index = $scope.quotation.product.indexOf(product);
      //  console.log($scope.prices);
        if (product.pro_type == "royalty_free") {
            var amount = 0;
            if (product.pro_size == "Small") {
                //amount = $scope.prices[index].small_size;
                amount = '550';
            } else if (product.pro_size == "Medium") {
                //amount = $scope.prices[index].medium_size;
                amount = '2500';
            } else if (product.pro_size == "Large") {
                //amount = $scope.prices[index].large_size;
                amount = '3500';
            } else if (product.pro_size == "X-Large") {
                //amount = $scope.prices[index].x_large_size;
                amount = '4600';
            } else {
                amount = 1;
            }
        } else {

            // var priceList = vm.formData.priceList;
            // if(value=="Small"){
            //     amount=priceList[0].small;
            // }else if(value=="Medium"){
            //     amount=priceList[1].medium;
            // }else if(value=="Large"){
            //     amount=priceList[2].large;
            // }else if(value=="X-Large"){
            //     amount=priceList[3].xlarge;
            // }else{
            //     amount=0;
            // }
        }
        $scope.quotation.product[index].price = amount;
        $scope.calculatePrice();
        // $scope.getTheTotal(vm.formData.names,index);
    }
    $scope.calculatePrice = function() {

        var subtotal = $scope.quotation.product;
        var subtotalvalue = 0;
        var total = 0;
        for (var j = 0; j < subtotal.length; j++) {
            subtotalvalue += Number(subtotal[j].price);

        }
        var intialtotal = $scope.tax;

        if ($scope['SGST'] == 1) {
            total = total + 6;
        } else if ($scope['CGST'] == 1) {
            total = total + 6;
        } else if ($scope['IGST'] == 1) {
            total = total + 12;
        } else if ($scope['IGSTT'] == 1) {
            total = total + 18;
        }
        var intialtotal = (subtotalvalue * (total) / 100);
        subtotal = Number(subtotalvalue);
        intialtotal = Number(intialtotal);
        $scope.tax = intialtotal;
        $scope.total = intialtotal + subtotal;
    }

    $scope.checkThetax = function(tax_percent, type) {

        var subtotal = $scope.quotation.product;
        //console.log(subtotal);
        var subtotalvalue = 0;
        var total = 0;
        for (var j = 0; j < subtotal.length; j++) {
            subtotalvalue += Number(subtotal[j].price);

        }
        var intialtotal = $scope.tax;
        if (type == 'SGST') {
            total = (subtotalvalue * (6) / 100);
        } else if (type == 'CGST') {
            total = (subtotalvalue * (6) / 100);
        } else if (type == 'IGST') {
            total = (subtotalvalue * (12) / 100);
        } else if (type == 'IGSTT') {
            total = (subtotalvalue * (18) / 100);
        }

        if (tax_percent == true) {
            total = intialtotal + total;
        } else {

            if (intialtotal > total) {
                total = intialtotal - total;
            } else {
                total = 0;
            }

        }
        subtotal = Number(subtotalvalue);
        total = Number(total);
        $scope.tax = total;
        $scope.total = total + subtotal;
    }

    
    $scope.submitQuotation = function() {
      //  console.log($scope.quotation);
        $('#loading').show();
        var sendData = {
            "uid": $('#uid').val(),
            "quotation_type": $scope.quotation_type,
            "products": $scope.quotation,
            "promoCode": $scope.promoCode,
            "po": $scope.po,
            "poDate": $scope.poDate,
            "expiry_date": $scope.expiry_time,
            "tax": $scope.tax,
            "total": $scope.total,
            "GST": $scope.GST,
            "CGST": $scope.CGST,
            "IGST": $scope.IGST,
            "IGSTT": $scope.IGSTT,
            "email": $scope.email,
            "old_quotation": path,
            "image1": $('#file1')[0].files[0],
            "flag": '0'

        }

     //   console.log($scope.quotation);
        var fd = new FormData();
        // angular.forEach($scope.quotation[0],function(file){
        //     fd.append('file',file);
        // });
        $http({
            method: 'POST',
            url: api_path + 'saveInvoice',
            data: sendData,
            headers: { 'Content-Type': undefined },
        }).then(function(response) {
            $('#loading').hide();
            if (response.data.this.statuscode == '1') {
                alert(response.data.this.statusdesc);
            } else {
                alert(response.data.this.statusdesc);
            }
            window.location = api_path + 'users/invoices/' + $('#uid').val();
            // $scope.quotation.product[index].name = response.data[0].product_code;
            // $scope.quotation.product[index].id = response.data[0].id;
            // if(response.data[0].type =="Royalty Free"){
            //     $scope.quotation.product[index].pro_type = "royalty_free";
            // }else{
            //     $scope.quotation.product[index].pro_type = "right_managed";
            // }
            // $scope.quotation.product[index].image = response.data[0].thumbnail_image;
            // $scope.prices[index] = response.data[0];
            //}
        }, function(error) {
            $('#loading').hide();
        });

    }
});
app.controller('invoiceController', function($scope, $http, $location) {
    $scope.quotationObj = {};
    $scope.payment_method = '';
    $scope.create_invoice = function(quotation, user_id) {
      //  console.log(quotation);
        $scope.quotationObjCus = quotation;
        $scope.quotation_user_cus = user_id;
    //  console.log($scope.quotationObjCus);
        // if (confirm('Do you want to send invoice for this quotation ?')) {
        //     $('#loading').show();
        //     $http({
        //         method: 'POST',
        //         url: base_url + 'create_invoice',
        //         data: { quotation_id: quotation_id, user_id: user_id }
        //     }).then(function(result) {
        //         $('#loading').hide();
        //         if (result.data.resp.statuscode == '1') {
        //             alert(result.data.resp.statusdesc);
        //         } else {
        //             alert(result.data.resp.statusdesc);
        //         }
        //     }, function(error) {
        //         $('#loading').hide();
        //     });
        // }
    }

    $scope.create_invoice_subscription = function(quotation, user_id) {
       // console.log(quotation);
        $scope.quotationObj = quotation;
        $scope.quotation_user = user_id;
       
    }

    $scope.send_invoice = function(quotation_id, user_id) {
        var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;   
        var reggst = /^([0-9]{2}[a-zA-Z]{4}([a-zA-Z]{1}|[0-9]{1})[0-9]{4}[a-zA-Z]{1}([a-zA-Z]|[0-9]){3}){0,15}$/;
        var panno = $('#gstNocus').val().substr(2, 10);
        var regmob = /^[0-9]{1,10}$/;
        
        if(!$('#gstNocus').val()) { 
            alert("Please add gst no.");
        } else if(!reggst.test($('#gstNocus').val())) {
            alert("Please enter valid GST no.");
        } else if(!$('#panNocus').val()) {
            alert("Please add pan no.");
        } else if(!regex.test($('#panNocus').val())){
            alert("Please enter valid pan no.");
        } else if(panno != $('#panNocus').val()) {
            alert("Please enter valid pan no or GST Number.");
        } else if(!$('#phonecus').val()) {
            alert("Please add phone no .");
        } else if(!regmob.test($('#phonecus').val())){
            alert("Please enter 10 digit mobile no .");
        } else if(!$scope.payment_method){
            alert("Please select payment method.");
        } else {
        if (confirm('Do you want to send invoice for this quotation ?')) {
            $('#loading').show();
                $http({
                    method: 'POST',
                    url: api_path + 'create_invoice_subcription',
                    data: { quotation_id: quotation_id, user_id : user_id, po: $scope.po, po_date : $scope.poDate, payment_method : $scope.payment_method,  gst : $('#gstNo').val(), pan: $('#panNo').val(), phone: $('#phone').val()}
                }).then(function(result) {
                    $('#loading').hide();
                    if (result.data.resp.statuscode == '1') {
                        alert(result.data.resp.statusdesc);
                    } else {
                        alert(result.data.resp.statusdesc);
                    }
                    window.location.reload();
                }, function(error) {
                    $('#loading').hide();
                });
            }
        }
    }

    $scope.send_invoice_cus = function(quotation_id, user_id) {
        var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;   
        var reggst = /^([0-9]{2}[a-zA-Z]{4}([a-zA-Z]{1}|[0-9]{1})[0-9]{4}[a-zA-Z]{1}([a-zA-Z]|[0-9]){3}){0,15}$/;
        var panno = $('#gstNocus').val().substr(2, 10);
        var regmob = /^[0-9]{1,10}$/;
        
        if(!$('#gstNocus').val()) { 
            alert("Please add gst no.");
        } else if(!reggst.test($('#gstNocus').val())) {
            alert("Please enter valid GST no.");
        } else if(!$('#panNocus').val()) {
            alert("Please add pan no.");
        } else if(!regex.test($('#panNocus').val())){
            alert("Please enter valid pan no.");
        } else if(panno != $('#panNocus').val()) {
            alert("Please enter valid pan no or GST Number.");
        } else if(!$('#phonecus').val()) {
            alert("Please add phone no .");
        } else if(!regmob.test($('#phonecus').val())){
            alert("Please enter 10 digit mobile no .");
        } else if(!$scope.payment_method){
           alert("Please select payment method.");
        } else {
        if (confirm('Do you want to send invoice for this quotation ?')) {
            $('#loading').show();
                $http({
                    method: 'POST',
                    url: api_path + 'create_invoice',
                    data: { quotation_id: quotation_id, user_id : user_id, po: $scope.poCustom, po_date : $scope.poDateCustom, payment_method : $scope.payment_method, gst : $('#gstNocus').val(), pan: $('#panNocus').val(), phone: $('#phonecus').val()}
                }).then(function(result) {
                    $('#loading').hide();
                    if (result.data.resp.statuscode == '1') {
                        alert(result.data.resp.statusdesc);
                    } else {
                        alert(result.data.resp.statusdesc);
                    }
                    window.location.reload();
                }, function(error) {
                    $('#loading').hide();
                });
            }
        }
    }


    $scope.change_status = function(status, quotation_id) {
        if (confirm('Do you want to change the status of invoice/quotation')) {
          //  console.log(status);
          //  console.log(quotation_id);
            //$('#loading').show();
            // $http({
            //     method: 'POST',
            //     url: base_url+'change_invoice_status',
            //     data:{quotation_id:quotation_id}
            // }).then(function (result){
            //     $('#loading').hide();
            //     if(result.data.resp.statuscode=='1'){
            //         alert(result.data.resp.statusdesc);
            //     }else{
            //         alert(result.data.resp.statusdesc);
            //     }
            // },function (error){
            //     $('#loading').hide();
            // });
        }

    }
});

app.directive("ngFileSelect", function(fileReader, $timeout) {
    return {
      scope: {
        ngModel: '='
      },
      link: function($scope, el) {
        function getFile(file) {
          fileReader.readAsDataUrl(file, $scope)
            .then(function(result) {
              $timeout(function() {
                $scope.ngModel = result;
              });
            });
        }

        el.bind("change", function(e) {
          var file = (e.srcElement || e.target).files[0];
          getFile(file);
        });
      }
    };
  });

app.factory("fileReader", function($q, $log) {
    var onLoad = function(reader, deferred, scope) {
        return function() {
            scope.$apply(function() {
            deferred.resolve(reader.result);
            });
        };
    };

    var onError = function(reader, deferred, scope) {
        return function() {
        scope.$apply(function() {
            deferred.reject(reader.result);
        });
        };
    };

    var onProgress = function(reader, scope) {
        return function(event) {
        scope.$broadcast("fileProgress", {
            total: event.total,
            loaded: event.loaded
        });
        };
    };

    var getReader = function(deferred, scope) {
        var reader = new FileReader();
        reader.onload = onLoad(reader, deferred, scope);
        reader.onerror = onError(reader, deferred, scope);
        reader.onprogress = onProgress(reader, scope);
        return reader;
    };

    var readAsDataURL = function(file, scope) {
        var deferred = $q.defer();
    
        var reader = getReader(deferred, scope);
        reader.readAsDataURL(file);
    
        return deferred.promise;
    };

    return {
        readAsDataUrl: readAsDataURL
    };
});

app.controller('ordersController', function($scope, $http, $location) {
    $scope.subscriberlist = {};
    $scope.products = {};
    $('#loading').show();
    $http({
        method: 'GET',
        url: base_url + 'getSubscribers',
    }).then(function(response) {
        $('#loading').hide();
        $scope.subscriberlist = response.data;
    }, function(error) {
        $('#loading').hide();
    });
    $scope.showProduct = function(products) {
        $scope.products = products;
       // console.log($scope.products);
        $('#modal-default').modal('show');
    }

});

app.controller('quotatationWithoutApiController', function($scope, $http, $location, fileReader) {
    $scope.title = "Send Quotation";
    $scope.quotation = {};
    $scope.po = '';
    $scope.subsc_expiry_time = '30';
    $scope.expiry_time = '30';
    $scope.download_expiry = '30';

    //$scope.uid
    $scope.quotation.product = [{
        name: "",
        pro_size: "",
        pro_type: "",
        id: "",
        image: "",
        price: "",
        footage: "",
        type: "Image",
        licence_type: ""
    }];
    $scope.quotation_type_var = 'custom';
    $scope.addProduct = function() {
        var newProduct = { name: "", pro_size: "", pro_type: "", id: "", image: "", price: "", footage: "", type:"Image", licence_type:""};
        $scope.quotation.product.push(newProduct);
    }
     
    $scope.$on("fileProgress", function(e, progress) {
        $scope.progress = progress.loaded / progress.total;
      });
      
    $scope.removeProduct = function(product) {
        var index = $scope.quotation.product.indexOf(product);
        $scope.quotation.product.splice(index, 1);
    }
    $scope.prices = [];
    $scope.getproduct = function(product) {  
    if(product.name != ''){
        $('#loading').show();
            var index = $scope.quotation.product.indexOf(product);
            $http({
                method: 'GET',
                url:  image_path+'api/product/' + product.name +'?type='+ product.type,
                //url:  'http://localhost/imagefootage/backend/api/product/' + product.name +'?type='+ product.type,
            }).then(function(response) {
               // console.log(response);
                if (response.status == '200') {
                    $('#loading').hide();
                    if(product.type == 'Image'){
                            $scope.quotation.product[index].name = response.data[0].product_code;
                            $scope.quotation.product[index].id = response.data[0].id;
                            if (response.data[0].type == "Royalty Free") {
                                $scope.quotation.product[index].pro_type = "royalty_free";
                            } else {
                                $scope.quotation.product[index].pro_type = "right_managed";
                            }
                            $scope.quotation.product[index].image = response.data[0].thumbnail_image;
                            $scope.prices[index] = response.data[0];
                    } else {
                        $scope.quotation.product[index].name = response.data[0].clip_data.id;
                        $scope.quotation.product[index].id = response.data[0].clip_data.n;
                        $scope.quotation.product[index].image = "https://p5iconsp.s3-accelerate.amazonaws.com/"+response.data[2];
                        $scope.quotation.product[index].footage = "https://p5resellerp.s3-accelerate.amazonaws.com/"+response.data[1];
                        $scope.prices[index] = [{size : "4K", pr: "16500" },{size : "HD (1080)", pr: "11500"}];
                        //$scope.prices[index] = response.data[0].clip_data.versions;
                       // console.log($scope.prices[index]);
                        //$scope.quotation.product[index] = response.data[0];
                    }
                }
            }, function(error) {
                $('#product_1').val('');
                alert('image not found');
                $('#loading').hide();
            });
        }    
    }

    $scope.getThetotalAmount = function(product) {
       // console.log(product);
        var index = $scope.quotation.product.indexOf(product);
       // console.log($scope.prices);
        if(product.type == 'Image') {
            if (product.pro_type == "royalty_free") {
                var amount = 0;
                if (product.pro_size == "Small") {
                    //amount = $scope.prices[index].small_size;
                    amount = small_price;
                } else if (product.pro_size == "Medium") {
                    //amount = $scope.prices[index].medium_size;
                    amount = medium_price;
                } else if (product.pro_size == "Large") {
                    //amount = $scope.prices[index].large_size;
                    amount = large_price;
                } else if (product.pro_size == "X-Large") {
                    //amount = $scope.prices[index].x_large_size;
                    amount = extra_large_price;
                } else {
                    amount = 1;
                }
            }
        } else {
            for(let i=0; i< $scope.prices[index].length; i++) {
                if(product.pro_size == $scope.prices[index][i].size){
                    amount = $scope.prices[index][i].pr;
                }
            } 
           // console.log(amount);
        }
        $scope.quotation.product[index].price = amount;
        $scope.getTheTotal();
    }
    /* Subscription and Download  */
    $scope.tax = 0;
    $scope.prod_type_var = '';
    $scope.plan_type_var ='';
    $scope.search = false;
    $scope.taxdownload = 0;

    $scope.quotation_type_set = function(type) {
        $scope.search = false;
        $scope.quotation_type_var = type;        
    }
    $scope.getTheTotal = function() {
        var subtotal = $scope.quotation.product;
        var subtotalvalue = 0;
        var total = 0;
        for (var j = 0; j < subtotal.length; j++) {
            subtotalvalue += Number(subtotal[j].price);
        }  
        subtotal = Number(subtotalvalue);
        $scope.total = subtotal;
    }
    $scope.checkThetax = function(tax_percent, type) {

        var subtotal = $scope.quotation.product;
        //console.log(subtotal);
        var subtotalvalue = 0;
        var total = 0;
        for (var j = 0; j < subtotal.length; j++) {
            subtotalvalue += Number(subtotal[j].price);

        }
        //var intialtotal = $scope.tax;
        // if (type == 'SGST') {
        //     total = (subtotalvalue * (6) / 100);
        // } else if (type == 'CGST') {
        //     total = (subtotalvalue * (6) / 100);
        // } else if (type == 'IGST') {
        //     total = (subtotalvalue * (12) / 100);
        // } else if (type == 'IGSTT') {
        //     total = (subtotalvalue * (18) / 100);
        // }

        if (tax_percent == true) {
            //total = intialtotal + total;
            if (type == 'GST') {
                total = (subtotalvalue * (12) / 100);
            }
        } else {

            // if (intialtotal > total) {
            //     total = intialtotal - total;
            // } else {
                total = 0;
            //}

        }
        subtotal = Number(subtotalvalue);
        total = Number(total);
        $scope.tax = total;
        $scope.total = total + subtotal;
    }

    $scope.prod_type =   function(type){
        $scope.prod_type_var = type;
        
    }
    $scope.plan_type_select = function(type){
        $scope.plan_type_var = type;
    }
    
    $scope.getPlans = function(){
        $scope.plansData = [];
        //console.log(product); 
        $('#loading').show();
            $http({
                method: 'POST',
                url: api_path + 'plans',
                data: { "quotation_type" : $scope.quotation_type_var, "prod_type" : $scope.prod_type_var, "product_dur" : $scope.plan_type_var }
            }).then(function(response) {
                $('#loading').hide();
                if (response.data.status == 'success') {
                    $scope.search = true;
                    $scope.plansData = response.data.data;
                    if($scope.prod_type_var == 'foot') {
                        angular.forEach(response.data.data, function(value, key) {
                            if(value.footage_tier == '1'){
                                var licence_type = "Commercial";
                            } else if(value.footage_tier == '2') {
                                var licence_type = "Non Commercial";
                            } else if(value.footage_tier == '3') {
                                var licence_type = "Web Only";
                            } else {
                                var licence_type = "FULL RF";
                            }
                            $scope.plansData[key]['package_description'] =  value.package_description+' ( '+licence_type+' )';
                          });
                         // console.log($scope.plansData);
                    }
                } else{
                    alert("There is no Plan for selection");
                }
            }, function(error) {
                $('#loading').hide();
            });
            
    }

    $scope.selectPlanfromlist = function(selectedPlanData, type){
        selectedPlanData = JSON.parse(selectedPlanData);
       // console.log(selectedPlanData);
       // console.log(type);
        $scope.selected_plan = selectedPlanData;
        if(type == 'download'){
            $scope.downloadprice = selectedPlanData["package_price"];
            $scope.total_download = selectedPlanData["package_price"];
        }else {
            $scope.subscriptionprice = selectedPlanData["package_price"];
            $scope.subsc_total =  selectedPlanData["package_price"];
        }
        
       
    }
    
    $scope.checkDownloadtax = function(tax_percent, type) {
        
        var subtotalvalue = $scope.downloadprice;
        
        // var intialtotal = $scope.taxdownload;
        // if (type == 'SGST') {
        //     total = (subtotalvalue * (6) / 100);
        // } else if (type == 'CGST') {
        //     total = (subtotalvalue * (6) / 100);
        // } else if (type == 'IGST') {
        //     total = (subtotalvalue * (12) / 100);
        // } else if (type == 'IGSTT') {
        //     total = (subtotalvalue * (18) / 100);
        // }

        if (tax_percent == true) {
            //total = intialtotal + total;
            if (type == 'GST') {
                total = (subtotalvalue * (12) / 100);
            }
        } else {
            // if (intialtotal > total) {
            //     total = intialtotal - total;
            // } else {
                total = 0;
            //}
        }
        
        subtotal = Number(subtotalvalue);
        total = Number(total);
        $scope.taxdownload = total;
        $scope.total_download = total + subtotal;
    }

    $scope.checksubsctax = function(tax_percent, type) {
      //  console.log(type);
       // console.log(tax_percent);
        var subtotalvalue = $scope.subscriptionprice;
        
        //var intialtotal = $scope.subscriptionprice;
        
        // if (type == 'SGST') {
        //     total = (subtotalvalue * (6) / 100);
        // } else if (type == 'CGST') {
        //     total = (subtotalvalue * (6) / 100);
        // } else if (type == 'IGST') {
        //     total = (subtotalvalue * (12) / 100);
        // } else if (type == 'IGSTT') {
        //     total = (subtotalvalue * (18) / 100);
        // }

        if (tax_percent == true) {
            //total = intialtotal + total;
            if (type == 'GST') {
                total = (subtotalvalue * (12) / 100);
            }
        } else {
            // if (intialtotal > total) {
            //     total = intialtotal - total;
            // } else {
                total = 0;
            //}
        }
       // console.log(total);
        subtotal = Number(subtotalvalue);
        total = Number(total);
        $scope.subsc_tax = total;
        $scope.subsc_total = total + subtotal;
    }
    
    $scope.submitQuotation = function() {
      //  console.log($scope.quotation);
       // console.log($scope);
        if($scope.quotation_type_var == 'subscription'){
            $scope.submitSubscription();
        } else if($scope.quotation_type_var == 'download'){
            $scope.submitDownload();
        } else {
            $scope.submitCustom();    
        }
    }

    $scope.submitDownload = function(){
       // console.log($scope.quotation);
       // console.log($scope);
        if(!$scope.selected_plan){
            alert("Please select Plan"); 
            return false;  
        } else if (!$scope.downloadprice) {
            alert("Please enter Subtotal"); 
            return false;
        } else {

        $('#loading').show();
      
        var sendData = {
            "uid": $('#uid').val(),
            "quotation_type": $scope.quotation_type_var,
            "plan_id": $scope.selected_plan,
            "plan_type_var": $scope.plan_type_var,
            //"po": $scope.poDownload,
            //"poDate": $scope.downloadpoDate,
            "expiry_date": $scope.download_expiry,
            "tax": $scope.taxdownload,
            "total": $scope.total_download,
            "subscription_subtotal": $scope.downloadprice,
            "GSTS": $scope.GSTD,            
            "email": $('#download_email_id').val(),   
        }
       // console.log(sendData);
       // console.log($scope.quotation);
        var fd = new FormData();
        // angular.forEach($scope.quotation[0],function(file){
        //     fd.append('file',file);
        // });
            $http({
                method: 'POST',
                url: base_url + 'saveDownloadInvoice',
                data: sendData,
                headers: { 'Content-Type': undefined },
            }).then(function(response) {
                $('#loading').hide();
                if (response.data.this.statuscode == '1') {
                    alert(response.data.this.statusdesc);
                } else {
                    alert(response.data.this.statusdesc);
                }
                window.location = api_path + 'users/invoices/' + $('#uid').val();
            
            }, function(error) {
                $('#loading').hide();
            });
        }
    }

    $scope.submitSubscription = function(){
      //  console.log($scope.quotation);
      //  console.log($scope);
        if(!$scope.selected_plan){
            alert("Please select Plan"); 
            return false;  
        } else if (!$scope.subscriptionprice) {
            alert("Please enter Subtotal"); 
            return false;
        } else {
        $('#loading').show();
      
        var sendData = {
            "uid": $('#uid').val(),
            "quotation_type": $scope.quotation_type_var,
            "plan_id": $scope.selected_plan,
            "plan_type_var": $scope.plan_type_var,
            //"po": $scope.subsc_po,
            //"poDate": $scope.subsc_poDate,
            "expiry_date": $scope.subsc_expiry_time,
            "tax": $scope.subsc_tax,
            "total": $scope.subsc_total,
            "subscription_subtotal": $scope.subscriptionprice,
            "GSTS": $scope.GSTS,            
            "email": $('#subsc_email_id').val(),            
        }
      //  console.log(sendData);
      //  console.log($scope.quotation);
        var fd = new FormData();
        // angular.forEach($scope.quotation[0],function(file){
        //     fd.append('file',file);
        // });
            $http({
                method: 'POST',
                url: base_url + 'saveSubscriptionInvoice',
                data: sendData,
                headers: { 'Content-Type': undefined },
            }).then(function(response) {
                $('#loading').hide();
                if (response.data.this.statuscode == '1') {
                    alert(response.data.this.statusdesc);
                } else {
                    alert(response.data.this.statusdesc);
                }
                window.location = api_path + 'users/invoices/' + $('#uid').val();
                // $scope.quotation.product[index].name = response.data[0].product_code;
                // $scope.quotation.product[index].id = response.data[0].id;
                // if(response.data[0].type =="Royalty Free"){
                //     $scope.quotation.product[index].pro_type = "royalty_free";
                // }else{
                //     $scope.quotation.product[index].pro_type = "right_managed";
                // }
                // $scope.quotation.product[index].image = response.data[0].thumbnail_image;
                // $scope.prices[index] = response.data[0];
                //}
            }, function(error) {
                $('#loading').hide();
            });
        }
    }

    $scope.submitCustom = function(){
      //  console.log($scope.quotation);
       // console.log($scope);
        $('#loading').show();
      
        var sendData = {
            "uid": $('#uid').val(),
            "end_client": $('#end_client').val(),
            "quotation_type": $scope.quotation_type_var,
            "products": $scope.quotation,
            "promoCode": $scope.promoCode,
            //"po": $scope.po,
            //"poDate": $scope.poDate,
            "expiry_date": $scope.expiry_time,
            "tax": $scope.tax,
            "total": $scope.total,
            "GST": $scope.SGST,
            "email": $('#email_id').val(),
            "flag": $('#flag').val()
        }
      //  console.log(sendData);
      //  console.log($scope.quotation);
        var fd = new FormData();
        // angular.forEach($scope.quotation[0],function(file){
        //     fd.append('file',file);
        // });
        $http({
            method: 'POST',
            url: api_path + 'saveInvoice',
            data: sendData,
            headers: { 'Content-Type': undefined },
        }).then(function(response) {
            $('#loading').hide();
            if (response.data.this.statuscode == '1') {
                alert(response.data.this.statusdesc);
            } else {
                alert(response.data.this.statusdesc);
            }
            window.location = api_path + 'users/invoices/' + $('#uid').val();
            // $scope.quotation.product[index].name = response.data[0].product_code;
            // $scope.quotation.product[index].id = response.data[0].id;
            // if(response.data[0].type =="Royalty Free"){
            //     $scope.quotation.product[index].pro_type = "royalty_free";
            // }else{
            //     $scope.quotation.product[index].pro_type = "right_managed";
            // }
            // $scope.quotation.product[index].image = response.data[0].thumbnail_image;
            // $scope.prices[index] = response.data[0];
            //}
        }, function(error) {
            $('#loading').hide();
        });
    }

    $scope.checkProduct = function(product_type){
      //  console.log(product_type);
    }
});