base_url = '/imagefootage/backend/admin/';
small_price = '500';
medium_price = '2500';
large_price = '2500';
extra_large_price = '4600';

app = angular.module('imageFootage', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});
app.controller('quotatationController', function($scope, $http, $location) {
    $scope.title = "Send Quotation";
    $scope.quotation = {};
    $scope.po = '';

    //$scope.uid
    $scope.quotation.product = [{
        name: "",
        pro_size: "",
        pro_type: "",
        id: "",
        image: "",
        price: "",
        type: "Image"
    }];
    $scope.quotation_type_var = 'custom';
    $scope.addProduct = function() {
        var newProduct = { name: "", pro_size: "", pro_type: "", id: "", image: "", price: "", type:"Image" };
        $scope.quotation.product.push(newProduct);
    }

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
                url: base_url + 'product/' + product.name +'?type='+ product.type,
            }).then(function(response) {

                if (response.status == '200' && response.statusText == 'OK') {
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
                        
                    }
                }
            }, function(error) {
                $('#loading').hide();
            });
        }    
    }

    $scope.getThetotalAmount = function(product) {
        console.log(product);
        var index = $scope.quotation.product.indexOf(product);
        console.log($scope.prices);
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

        //$scope.getTheTotal(vm.formData.names,index);
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
                url: base_url + 'plans',
                data: { "quotation_type" : $scope.quotation_type_var, "prod_type" : $scope.prod_type_var, "product_dur" : $scope.plan_type_var }
            }).then(function(response) {
                $('#loading').hide();
                if (response.data.status == 'success') {
                    $scope.search = true;
                    $scope.plansData = response.data.data;
                } else{
                    alert("There is no Plan for selection");
                }
            }, function(error) {
                $('#loading').hide();
            });
            
    }

    $scope.selectPlanfromlist = function(selectedPlanData, type){
        selectedPlanData = JSON.parse(selectedPlanData);
        console.log(selectedPlanData);
        console.log(type);
        $scope.selected_plan = selectedPlanData;
        if(type == 'download'){
            $scope.downloadprice = selectedPlanData["package_price"];
        }else {
            $scope.subscriptionprice = selectedPlanData["package_price"];
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
        console.log(type);
        console.log(tax_percent);
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
        console.log(total);
        subtotal = Number(subtotalvalue);
        total = Number(total);
        $scope.subsc_tax = total;
        $scope.subsc_total = total + subtotal;
    }
    
    $scope.submitQuotation = function() {
        console.log($scope.quotation);
        console.log($scope);
        if($scope.quotation_type_var == 'subscription'){
            $scope.submitSubscription();
        } else if($scope.quotation_type_var == 'download'){
            $scope.submitDownload();
        } else {
            $scope.submitCustom();    
        }
    }

    $scope.submitDownload = function(){
        console.log($scope.quotation);
        console.log($scope);
        $('#loading').show();
      
        var sendData = {
            "uid": $('#uid').val(),
            "quotation_type": $scope.quotation_type_var,
            "plan_id": $scope.selected_plan,
            "plan_type_var": $scope.plan_type_var,
            "po": $scope.poDownload,
            "poDate": $scope.downloadpoDate,
            "expiry_date": $scope.download_expiry,
            "tax": $scope.taxdownload,
            "total": $scope.total_download,
            "subscription_subtotal": $scope.downloadprice,
            "GSTS": $scope.GSTD,            
            "email": $scope.download_email_id,    
        }
        console.log(sendData);
        console.log($scope.quotation);
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
            window.location = base_url + 'users/invoices/' + $('#uid').val();
           
        }, function(error) {
            $('#loading').hide();
        });
    }

    $scope.submitSubscription = function(){
        console.log($scope.quotation);
        console.log($scope);
        $('#loading').show();
      
        var sendData = {
            "uid": $('#uid').val(),
            "quotation_type": $scope.quotation_type_var,
            "plan_id": $scope.selected_plan,
            "plan_type_var": $scope.plan_type_var,
            "po": $scope.subsc_po,
            "poDate": $scope.subsc_poDate,
            "expiry_date": $scope.subsc_expiry_time,
            "tax": $scope.subsc_tax,
            "total": $scope.subsc_total,
            "subscription_subtotal": $scope.subscriptionprice,
            "GSTS": $scope.GSTS,            
            "email": $scope.subsc_email_id,            
        }
        console.log(sendData);
        console.log($scope.quotation);
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
            window.location = base_url + 'users/invoices/' + $('#uid').val();
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

    $scope.submitCustom = function(){
        console.log($scope.quotation);
        console.log($scope);
        $('#loading').show();
      
        var sendData = {
            "uid": $('#uid').val(),
            "quotation_type": $scope.quotation_type_var,
            "products": $scope.quotation,
            "promoCode": $scope.promoCode,
            "po": $scope.po,
            "poDate": $scope.poDate,
            "expiry_date": $scope.expiry_time,
            "tax": $scope.tax,
            "total": $scope.total,
            "SGST": $scope.SGST,
            "CGST": $scope.CGST,
            "IGST": $scope.IGST,
            "IGSTT": $scope.IGSTT,
            "email": $scope.email,
            "image1": $('#file1')[0].files[0]
        }
        console.log(sendData);
        console.log($scope.quotation);
        var fd = new FormData();
        // angular.forEach($scope.quotation[0],function(file){
        //     fd.append('file',file);
        // });
        $http({
            method: 'POST',
            url: base_url + 'saveInvoice',
            data: sendData,
            headers: { 'Content-Type': undefined },
        }).then(function(response) {
            $('#loading').hide();
            if (response.data.this.statuscode == '1') {
                alert(response.data.this.statusdesc);
            } else {
                alert(response.data.this.statusdesc);
            }
            window.location = base_url + 'users/invoices/' + $('#uid').val();
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
        console.log(product_type);
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
                    console.log(item);
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
        console.log($scope.products);
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
        url: base_url + 'edit_quotation_data',
        data: { quotation: path }
    }).then(function(result) {
        $('#loading').hide();
        response = result.data;
        console.log(response.user_id);
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
                price: value.subtotal
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
        console.log(product);
        $('#loading').show();
        var index = $scope.quotation.product.indexOf(product);
        $http({
            method: 'GET',
            url: base_url + 'product/' + product.name,
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
        console.log($scope.prices);
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
        //console.log(subtotal);
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
        console.log($scope.quotation);
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
            "SGST": $scope.SGST,
            "CGST": $scope.CGST,
            "IGST": $scope.IGST,
            "IGSTT": $scope.IGSTT,
            "email": $scope.email,
            "old_quotation": path,
            "image1": $('#file1')[0].files[0]

        }

        console.log($scope.quotation);
        var fd = new FormData();
        // angular.forEach($scope.quotation[0],function(file){
        //     fd.append('file',file);
        // });
        $http({
            method: 'POST',
            url: base_url + 'saveInvoice',
            data: sendData,
            headers: { 'Content-Type': undefined },
        }).then(function(response) {
            $('#loading').hide();
            if (response.data.this.statuscode == '1') {
                alert(response.data.this.statusdesc);
            } else {
                alert(response.data.this.statusdesc);
            }
            window.location = base_url + 'users/invoices/' + $('#uid').val();
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

    $scope.create_invoice = function(quotation_id, user_id) {
        if (confirm('Do you want to send invoice for this quotation ?')) {
            $('#loading').show();
            $http({
                method: 'POST',
                url: base_url + 'create_invoice',
                data: { quotation_id: quotation_id, user_id: user_id }
            }).then(function(result) {
                $('#loading').hide();
                if (result.data.resp.statuscode == '1') {
                    alert(result.data.resp.statusdesc);
                } else {
                    alert(result.data.resp.statusdesc);
                }
            }, function(error) {
                $('#loading').hide();
            });
        }
    }

    $scope.create_invoice_subscription = function(quotation_id, user_id) {
        if (confirm('Do you want to send invoice for this quotation ?')) {
            $('#loading').show();
            $http({
                method: 'POST',
                url: base_url + 'create_invoice_subcription',
                data: { quotation_id: quotation_id, user_id: user_id }
            }).then(function(result) {
                $('#loading').hide();
                if (result.data.resp.statuscode == '1') {
                    alert(result.data.resp.statusdesc);
                } else {
                    alert(result.data.resp.statusdesc);
                }
            }, function(error) {
                $('#loading').hide();
            });
        }
    }

    $scope.change_status = function(status, quotation_id) {
        if (confirm('Do you want to change the status of invoice/quotation')) {
            console.log(status);
            console.log(quotation_id);
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
        console.log($scope.products);
        $('#modal-default').modal('show');
    }

});