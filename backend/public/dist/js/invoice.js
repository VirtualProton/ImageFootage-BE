app= angular.module('imageFootage', []);
app.controller('quotatationController', function($scope, $http) {
    $scope.title = "Send Quotation";
    $scope.quotation ={};
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
        var index = $scope.quotation.product.indexOf(product);
        $http({
            method: 'GET',
            url: 'http://ec2-18-218-68-194.us-east-2.compute.amazonaws.com/backend/admin/product/'+product.name,
     }).then(function (response){
            
            if(response.status=='200' && response.statusText=='OK'){
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
                amount=0;
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
    $scope.SGST ="6";
    $scope.CGST ="6";
    $scope.IGST ="12";
    $scope.IGSTT ="18";
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
                    total  = (subtotalvalue*($scope.SGST)/100);
                   }
                   else if(type=='CGST'){
                    total  = (subtotalvalue*($scope.CGST)/100);
                   }
                   else if(type=='IGST'){
                    total  = (subtotalvalue*($scope.IGST)/100);
                   }
                   else if(type=='IGSTT'){
                    total  = (subtotalvalue*($scope.IGSTT)/100);
                   }
                    
				if(tax_percent==true){
                      total=intialtotal+total;
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



  });