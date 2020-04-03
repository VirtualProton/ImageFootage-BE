base_url ='/imagefootagenew/backend/admin/';
app= angular.module('imageFootage', []);
app.controller('quotatationController', function($scope, $http,$location) {
    $scope.title = "Send Quotation";
    $scope.quotation ={};
    
    //$scope.uid
    $scope.quotation.product = [
        { 
        name:"",
		pro_size:"",
        pro_type:"",
        id:"",
        image:"",
        price:""
      }
    ]; 
    
    $scope.addProduct = function() {
        var newProduct = { name:"",pro_size:"",pro_type:"",id:"",image:"",price:""};
        $scope.quotation.product.push(newProduct);
    }
    
    $scope.removeProduct = function(product) {
        var index = $scope.quotation.product.indexOf(product);
        $scope.quotation.product.splice(index,1);
    }
     $scope.prices = [];
     $scope.getproduct = function (product){
        console.log(product);  
        $('#loading').show();
        var index = $scope.quotation.product.indexOf(product);
        $http({
            method: 'GET',
            url: base_url+'product/'+product.name,
     }).then(function (response){
            
            if(response.status=='200' && response.statusText=='OK'){
                $('#loading').hide();
                $scope.quotation.product[index].name = response.data[0].product_code;
                $scope.quotation.product[index].id = response.data[0].id;
                if(response.data[0].type =="Royalty Free"){
                    $scope.quotation.product[index].pro_type = "royalty_free";
                }else{
                    $scope.quotation.product[index].pro_type = "right_managed";
                }
                $scope.quotation.product[index].image = response.data[0].thumbnail_image;
                $scope.prices[index] = response.data[0];
            }
    },function (error){
        $('#loading').hide();
    });
    } 
    
    $scope.getThetotalAmount = function (product){
        var index = $scope.quotation.product.indexOf(product);
        console.log($scope.prices);
    if(product.pro_type=="royalty_free"){
		var amount=0;
        if(product.pro_size=="Small"){
                amount = $scope.prices[index].small_size;
            }else if(product.pro_size=="Medium"){
                amount = $scope.prices[index].medium_size;
            }else if(product.pro_size=="Large"){
                amount = $scope.prices[index].large_size;
            }else if(product.pro_size=="X-Large"){
                amount = $scope.prices[index].x_large_size;
            }else{
                amount=1;
            }
        }else{
            
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
       // $scope.getTheTotal(vm.formData.names,index);
    }

    $scope.tax = 0;
   
    $scope.checkThetax = function(tax_percent,type){
      
            var subtotal= $scope.quotation.product;
			 //console.log(subtotal);
             var subtotalvalue=0;
             var total = 0;
			 for (var j=0;j<subtotal.length;j++){
						subtotalvalue +=Number(subtotal[j].price);
				
				}
                var intialtotal = $scope.tax;
                if(type=='SGST'){
                    total  = (subtotalvalue*(6)/100);
                   }
                   else if(type=='CGST'){
                    total  = (subtotalvalue*(6)/100);
                   }
                   else if(type=='IGST'){
                    total  = (subtotalvalue*(12)/100);
                   }
                   else if(type=='IGSTT'){
                    total  = (subtotalvalue*(18)/100);
                   }
                    
				if(tax_percent==true){
                      total = intialtotal+total;
				}else{
                     
                       if(intialtotal>total){
                        total = intialtotal-total;
                       }else{
                        total = 0;
                       }
						
                }
				subtotal = Number(subtotalvalue);
				total = Number(total);
			    $scope.tax = total;
			    $scope.total = total+subtotal;
    }

    
    $scope.submitQuotation = function(){
        console.log($scope.quotation);
        $('#loading').show();
        var sendData = {
            "uid":$('#uid').val(),
            "quotation_type":$scope.quotation_type,
            "products": $scope.quotation,
            "promoCode":$scope.promoCode,
            "po":$scope.po,
            "poDate":$scope.poDate,
            "expiry_date":$scope.expiry_time,
            "tax": $scope.tax,
            "total": $scope.total,
            "SGST":$scope.SGST,
            "CGST":$scope.CGST,
            "IGST":$scope.IGST,
            "IGSTT":$scope.IGSTT,
            "email":$scope.email,
            "image1":$('#file1')[0].files[0] 

        }
        
        console.log($scope.quotation);
        var fd=new FormData();
        // angular.forEach($scope.quotation[0],function(file){
        //     fd.append('file',file);
        // });
        $http({
            method: 'POST',
            url: base_url+'saveInvoice',
            data:sendData,
            headers: {'Content-Type': undefined},
         }).then(function (response){
                $('#loading').hide();
                if(response.data.this.statuscode=='1'){
                    alert(response.data.this.statusdesc);
                 }else{
                  alert(response.data.this.statusdesc);
                 }
                    window.location =base_url+'users/invoices/'+$('#uid').val();
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
    },function (error){
        $('#loading').hide();
    });

    }
});

  app.directive('ngFileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            var model = $parse(attrs.ngFileModel);
            var isMultiple = attrs.multiple;
            var modelSetter = model.assign;
            element.bind('change', function () {
                var values = [];
                
                angular.forEach(element[0].files, function (item) {
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
                scope.$apply(function () {
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

app.directive('ngFile', ['$parse', function ($parse) {
    return {
     restrict: 'A',
     link: function(scope, element, attrs) {
      element.bind('change', function(){
   
       $parse(attrs.ngFile).assign(scope,element[0].files)
       scope.$apply();
      });
     }
    };
   }]);
   
