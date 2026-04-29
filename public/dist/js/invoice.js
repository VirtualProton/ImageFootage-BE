// base_url = '/imagefootage/backend/admin/';
base_url = "/admin/";
api_path = "/admin/";
image_path = "/";
small_price = "500";
medium_price = "2500";
large_price = "2500";
extra_large_price = "4600";

app = angular.module("imageFootage", [], function ($interpolateProvider) {
    $interpolateProvider.startSymbol("<%");
    $interpolateProvider.endSymbol("%>");
});

function sanitizeAmountValue(value) {
    if (value === undefined || value === null) {
        return "";
    }

    var normalized = String(value).replace(/[^0-9.]/g, "");
    if (!normalized) {
        return "";
    }

    var hasDecimal = normalized.indexOf(".") !== -1;
    var parts = normalized.split(".");
    var integerPart = parts.shift() || "";
    var decimalPart = parts.join("");

    integerPart = integerPart.replace(/^0+(?=\d)/, "");
    if (integerPart === "") {
        integerPart = "0";
    }

    if (hasDecimal) {
        return integerPart + "." + decimalPart.slice(0, 2);
    }

    return integerPart;
}

function sanitizeCustomProductPrices(products) {
    angular.forEach(products || [], function (product) {
        if (product) {
            product.price = sanitizeAmountValue(product.price);
        }
    });
}

function parseAmountNumber(value) {
    var amount = parseFloat(value);
    return isNaN(amount) ? 0 : amount;
}

function roundAmountValue(value) {
    return Math.round((parseAmountNumber(value) + Number.EPSILON) * 100) / 100;
}

function createPromoState(promo) {
    if (!promo || !promo.type) {
        return { type: "", discount: 0 };
    }

    return {
        type: String(promo.type).toLowerCase(),
        discount: parseAmountNumber(promo.discount),
    };
}

function hasPromoState(promo) {
    return !!(promo && promo.type);
}

function getProductsSubtotal(products) {
    var subtotal = 0;
    angular.forEach(products || [], function (product) {
        subtotal += parseAmountNumber(product && product.price);
    });
    return roundAmountValue(subtotal);
}

function calculatePromoAdjustedTotals(subtotal, shouldApplyTax, promo, taxRate) {
    var normalizedSubtotal = roundAmountValue(subtotal);
    var normalizedPromo = createPromoState(promo);
    var discountAmount = 0;

    if (normalizedPromo.type === "flat") {
        discountAmount = normalizedPromo.discount;
    } else if (normalizedPromo.type === "percentage") {
        discountAmount =
            normalizedSubtotal * (normalizedPromo.discount / 100);
    }

    discountAmount = roundAmountValue(
        Math.min(Math.max(discountAmount, 0), normalizedSubtotal)
    );

    var discountedSubtotal = roundAmountValue(
        Math.max(normalizedSubtotal - discountAmount, 0)
    );
    var taxAmount = shouldApplyTax
        ? roundAmountValue((discountedSubtotal * parseAmountNumber(taxRate)) / 100)
        : 0;
    var totalAmount = roundAmountValue(discountedSubtotal + taxAmount);

    return {
        subtotal: normalizedSubtotal,
        discount: discountAmount,
        discountedSubtotal: discountedSubtotal,
        tax: taxAmount,
        total: totalAmount,
    };
}

app.directive("twoDecimalAmount", function () {
    return {
        require: "ngModel",
        link: function (scope, element, attrs, ngModelCtrl) {
            function syncSanitizedValue() {
                var currentValue = element.val();
                var sanitizedValue = sanitizeAmountValue(currentValue);

                if (sanitizedValue !== currentValue) {
                    scope.$evalAsync(function () {
                        ngModelCtrl.$setViewValue(sanitizedValue);
                        ngModelCtrl.$render();
                    });
                }
            }

            ngModelCtrl.$parsers.unshift(function (value) {
                return sanitizeAmountValue(value);
            });

            ngModelCtrl.$formatters.push(function (value) {
                return sanitizeAmountValue(value);
            });

            element.on("input", syncSanitizedValue);
            element.on("blur", syncSanitizedValue);
            element.on("paste", syncSanitizedValue);

            scope.$on("$destroy", function () {
                element.off("input", syncSanitizedValue);
                element.off("blur", syncSanitizedValue);
                element.off("paste", syncSanitizedValue);
            });
        },
    };
});

app.controller(
    "quotatationController",
    function ($scope, $http, $location, fileReader) {
        $scope.title = "Send Quotation";
        $scope.quotation = {};
        $scope.po = "";
        $scope.subsc_expiry_time = "30";
        $scope.expiry_time = "30";
        $scope.download_expiry = "30";
        $scope.custom_expiry_time = "";
        $scope.custom_subsc_expiry_time = "";
        $scope.custom_download_expiry = "";
        $scope.selected_currency = "INR";
        $scope.is_display_product_image = false;
        $scope.is_display_product_image_edit_page = true;

        //$scope.uid
        function normalizeExpiryOption(value, defaultMode) {
            var normalized = value == null ? "" : String(value).trim();
            if (["7", "15", "30"].indexOf(normalized) !== -1) {
                return { mode: normalized, custom: "" };
            }
            if (normalized !== "") {
                return { mode: "custom", custom: normalized };
            }
            return { mode: defaultMode || "30", custom: "" };
        }

        function resolveExpiryValue(mode, customValue) {
            var normalizedMode = mode == null ? "" : String(mode).trim();
            if (normalizedMode === "custom") {
                var normalizedCustom = customValue == null ? "" : String(customValue).trim();
                if (!/^\d+$/.test(normalizedCustom) || parseInt(normalizedCustom, 10) <= 0) {
                    return "";
                }
                return normalizedCustom;
            }

            if (["7", "15", "30"].indexOf(normalizedMode) !== -1) {
                return normalizedMode;
            }

            return "";
        }

        function createEmptyCustomProduct() {
            return {
                name: "",
                pro_size: "",
                pro_type: "",
                id: "",
                image: "",
                price: "",
                footage: "",
                type: "Image",
                licence_type: "",
                extra_details: "",
                currency: $scope.selected_currency || "INR",
            };
        }
        $scope.syncCustomProductCurrencies = function () {
            var currency = $scope.selected_currency || "INR";
            $scope.selected_currency = currency;
            angular.forEach($scope.quotation.product || [], function (product) {
                product.currency = currency;
            });
        };
        $scope.sanitizeProductPrice = function (product) {
            if (!product) {
                return;
            }
            product.price = sanitizeAmountValue(product.price);
        };
        $scope.normalizeCustomProductPrices = function () {
            sanitizeCustomProductPrices($scope.quotation.product);
        };
        $scope.discount_amount_display = "";
        $scope.subsc_discount_amount_display = "";
        $scope.download_discount_amount_display = "";
        $scope.customPromo = createPromoState();
        $scope.subscriptionPromo = createPromoState();
        $scope.downloadPromo = createPromoState();

        function recalculateCustomTotals() {
            var calculation = calculatePromoAdjustedTotals(
                getProductsSubtotal($scope.quotation.product),
                !!$scope.GST,
                $scope.customPromo,
                gst_value
            );

            $scope.tax = calculation.tax;
            $scope.total = calculation.total.toFixed(2);
            $scope.discount_amount_display =
                calculation.discount > 0
                    ? calculation.discount.toFixed(2)
                    : "";
        }

        function recalculateSubscriptionTotals() {
            var calculation = calculatePromoAdjustedTotals(
                $scope.subscriptionprice,
                !!$scope.GSTS,
                $scope.subscriptionPromo,
                gst_value
            );

            $scope.subsc_tax = calculation.tax;
            $scope.subsc_total = calculation.total.toFixed(2);
            $scope.subsc_discount_amount_display =
                calculation.discount > 0
                    ? calculation.discount.toFixed(2)
                    : "";
        }

        function recalculateDownloadTotals() {
            var calculation = calculatePromoAdjustedTotals(
                $scope.downloadprice,
                !!$scope.GSTD,
                $scope.downloadPromo,
                gst_value
            );

            $scope.taxdownload = calculation.tax;
            $scope.total_download = calculation.total.toFixed(2);
            $scope.download_discount_amount_display =
                calculation.discount > 0
                    ? calculation.discount.toFixed(2)
                    : "";
        }

        $scope.clearCustomPromo = function () {
            $scope.customPromo = createPromoState();
            recalculateCustomTotals();
        };

        $scope.clearSubscriptionPromo = function () {
            $scope.subscriptionPromo = createPromoState();
            recalculateSubscriptionTotals();
        };

        $scope.clearDownloadPromo = function () {
            $scope.downloadPromo = createPromoState();
            recalculateDownloadTotals();
        };
        $scope.applyCustomPromo = function (promo, countryId) {
            if (hasPromoState(promo)) {
                $scope.customPromo = createPromoState(promo);
            }

            if (!!$scope.GST && countryId !== 101) {
                alert('This user is belongs to other country are you sure want to apply tax?');
            }

            $scope.normalizeCustomProductPrices();
            recalculateCustomTotals();
        };
        $scope.applySubscriptionPromo = function (promo, countryId) {
            if (hasPromoState(promo)) {
                $scope.subscriptionPromo = createPromoState(promo);
            }

            if (!!$scope.GSTS && countryId !== 101) {
                alert('This user is belongs to other country are you sure want to apply tax?');
            }

            recalculateSubscriptionTotals();
        };
        $scope.applyDownloadPromo = function (promo, countryId) {
            if (hasPromoState(promo)) {
                $scope.downloadPromo = createPromoState(promo);
            }

            if (!!$scope.GSTD && countryId !== 101) {
                alert('This user is belongs to other country are you sure want to apply tax?');
            }

            recalculateDownloadTotals();
        };
        $scope.quotation.product = [createEmptyCustomProduct()];
        $scope.quotation_type_var = "custom";
        $scope.addProduct = function () {
            var newProduct = createEmptyCustomProduct();
            $scope.quotation.product.push(newProduct);
            $scope.syncCustomProductCurrencies();
            setTimeout(function () {
                CKEDITOR.replace(
                    "licence_type-" + $scope.quotation.product.length
                );
            }, 0);
        };

        $scope.$on("fileProgress", function (e, progress) {
            $scope.progress = progress.loaded / progress.total;
        });

        $scope.removeProduct = function (product) {
            if (($scope.quotation.product || []).length <= 1) {
                return;
            }
            var index = $scope.quotation.product.indexOf(product);
            if (index === -1) {
                return;
            }
            $scope.quotation.product.splice(index, 1);
            if (!$scope.quotation.product.length) {
                $scope.quotation.product.push(createEmptyCustomProduct());
            }
            $scope.syncCustomProductCurrencies();
            $scope.getTheTotal();
        };
        $scope.prices = [];
        $scope.getproduct = function (product) {
            if (product.name != "") {
                $("#loading").show();
                var index = $scope.quotation.product.indexOf(product);
                let productIndexId = index + 1;
                $("#file" + productIndexId).val('');
                $http({
                    method: "GET",
                    url:
                        image_path +
                        "api/product/" +
                        product.name +
                        "?type=" +
                        product.type,
                }).then(
                    function (response) {
                        // console.log(response);
                        if (response.status == "200") {
                            $("#loading").hide();
                            if (product.type == "Image") {
                                $scope.quotation.product[index].name =
                                    response.data[0].product_code;
                                $scope.quotation.product[index].id =
                                    response.data[0].id;
                                if (response.data[0].type == "Royalty Free") {
                                    $scope.quotation.product[index].pro_type =
                                        "royalty_free";
                                } else {
                                    $scope.quotation.product[index].pro_type =
                                        "right_managed";
                                }
                                $scope.quotation.product[index].image =
                                    response.data[0].thumbnail_image;
                                $scope.prices[index] = response.data[0];
                            } else {
                                if (response.data[0].clip_data) {
                                    $scope.quotation.product[index].name =
                                        response.data[0].clip_data.id;
                                    $scope.quotation.product[index].id =
                                        response.data[0].clip_data.n;
                                    $scope.quotation.product[index].image =
                                        "https://p5iconsp.s3-accelerate.amazonaws.com/" +
                                        response.data[2];
                                    $scope.quotation.product[index].footage =
                                        "https://p5resellerp.s3-accelerate.amazonaws.com/" +
                                        response.data[1];
                                    $scope.prices[index] =
                                        response.data[0].clip_data.versions;
                                } else {
                                    $scope.quotation.product[index].name =
                                        response.data[0].id;
                                    $scope.quotation.product[index].id =
                                        response.data[0].id;
                                    $scope.quotation.product[index].image =
                                        response.data[0].thumbnail
                                    $scope.quotation.product[index].footage =
                                        response.data[0].thumbnail
                                    $scope.prices[index] =
                                        response.data[0].versions;
                                }
                                //  console.log($scope.prices[index]);
                                //$scope.quotation.product[index] = response.data[0];
                            }
                        }
                    },
                    function (error) {
                        $scope.quotation.product[index].image = ''; // Refresh previous display image
                        $scope.quotation.product[index].value = null;
                        $("#product_" + productIndexId).val("");
                        alert("image not found");
                        $("#loading").hide();
                    }
                );
            }
        };

        $scope.getThetotalAmount = function (product) {
            // console.log(product);
            var index = $scope.quotation.product.indexOf(product);
            // console.log($scope.prices);
            if (product.type == "Image") {
                if (product.pro_type == "royalty_free") {
                    var amount = 0;
                    if (product.pro_size == "Small") {
                        //amount = $scope.prices[index].small_size;
                        amount = small_price;
                    } else if (product.pro_size == "Medium") {
                        //amount = $scope.prices[index].medium_size;
                        amount = medium_price;
                    }
                    // else if (product.pro_size == "Large") {
                    //     //amount = $scope.prices[index].large_size;
                    //     amount = large_price;
                    // }
                    else if (product.pro_size == "X-Large") {
                        //amount = $scope.prices[index].x_large_size;
                        amount = extra_large_price;
                    } else {
                        amount = 1;
                    }
                }
            } else if (product.type == "Footage") {
                getFootageSizeDetails.find(function (entry) {
                    if (entry.type === product.pro_size) {
                        amount = entry.price;
                    }
                });
            } else if (product.type == "Music") {
                getMusicLicenceDetails.find(function (entry) {
                    if (entry.value === product.licence_type.trim()) {
                        amount = entry.price;
                    }
                });
            } else {
                for (let i = 0; i < $scope.prices[index].length; i++) {
                    if (product.pro_size == $scope.prices[index][i].size) {
                        amount = $scope.prices[index][i].pr;
                    }
                }
                //  console.log(amount);
            }
            $scope.quotation.product[index].price = amount;
            $scope.getTheTotal();
        };
        /* Subscription and Download  */
        $scope.tax = 0;
        $scope.prod_type_var = "";
        $scope.plan_type_var = "";
        $scope.search = false;
        $scope.taxdownload = 0;

        $scope.quotation_type_set = function (type) {
            $scope.search = false;
            $scope.quotation_type_var = type;
            if (type === "custom") {
                $scope.syncCustomProductCurrencies();
            }
        };
        $scope.getTheTotal = function () {
            if ($scope.quotation_type_var == "subscription") {
                recalculateSubscriptionTotals();
                return;
            }

            if ($scope.quotation_type_var == "download") {
                recalculateDownloadTotals();
                return;
            }

            $scope.normalizeCustomProductPrices();
            recalculateCustomTotals();
        };
        $scope.checkThetax = function (tax_percent, type, promo = {},countryId='') {
            if (hasPromoState(promo)) {
                $scope.customPromo = createPromoState(promo);
            }

            $scope.GST = !!tax_percent;
            if ($scope.GST) {
                if(countryId !== 101){
                    alert('This user is belongs to other country are you sure want to apply tax?')
                }
            }

            $scope.normalizeCustomProductPrices();
            recalculateCustomTotals();
        };

        $scope.prod_type = function (type) {
            $scope.prod_type_var = type;
            $scope.search = false; // Reset loaded data
            $scope.selected_sub_plan = ""; // Reset sub total
            $scope.downloadprice = ""; // Reset total
            $scope.subsc_total = '';
            $scope.subscriptionprice = '';
            $scope.total_download = '';
            $scope.GSTD = false;
            $scope.GSTS = false;
            $scope.taxdownload = 0;
            $scope.subsc_tax="";
        };
        $scope.plan_type_select = function (type) {
            $scope.plan_type_var = type;
            $scope.subscriptionprice = ""; // Reset sub total
            $scope.subsc_total = ""; // Reset total
        };

        $scope.getPlans = function () {
            $scope.plansData = [];
            //console.log(product);
            $("#loading").show();
            $http({
                method: "POST",
                url: api_path + "plans",
                data: {
                    quotation_type: $scope.quotation_type_var,
                    prod_type: $scope.prod_type_var,
                    product_dur: $scope.plan_type_var,
                },
            }).then(
                function (response) {
                    $("#loading").hide();
                    if (response.data.status == "success") {
                        $scope.search = true;
                        $scope.plansData = response.data.data;
                        if ($scope.prod_type_var == "foot") {
                            angular.forEach(
                                response.data.data,
                                function (value, key) {
                                    if (value.footage_tier == "1") {
                                        var licence_type = "Commercial";
                                    } else if (value.footage_tier == "2") {
                                        var licence_type = "Non Commercial";
                                    } else if (value.footage_tier == "3") {
                                        var licence_type = "Web Only";
                                    } else {
                                        var licence_type = "FULL RF";
                                    }
                                    $scope.plansData[key][
                                        "package_description"
                                    ] =
                                        value.package_description +
                                        " ( " +
                                        licence_type +
                                        " )";
                                }
                            );
                            // console.log($scope.plansData);
                        }
                    } else {
                        alert("There is no Plan for selection");
                    }
                },
                function (error) {
                    $("#loading").hide();
                }
            );
        };

        $scope.selectPlanfromlist = function (selectedPlanData, type) {
            if(selectedPlanData){
                selectedPlanData = JSON.parse(selectedPlanData);

            }
            //  console.log(selectedPlanData);
            //  console.log(type);
            $scope.selected_plan = selectedPlanData;
            $scope.GSTS = false;
            $scope.taxdownload = 0;
            $scope.subsc_tax = "";
            $scope.GSTD =  false;

            if (type == "download") {
                $scope.downloadprice = selectedPlanData["package_price"];
                $scope.selected_currency = selectedPlanData["currency"];
                recalculateDownloadTotals();
            } else {
                $scope.subscriptionprice = selectedPlanData["package_price"];
                recalculateSubscriptionTotals();
            }
        };

        $scope.checkDownloadtax = function (tax_percent, type,countryId) {
            $scope.GSTD = !!tax_percent;
            if ($scope.GSTD) {
                if(countryId !== 101){
                    alert('This user is belongs to other country are you sure want to apply tax?')
                }
            }
            recalculateDownloadTotals();
        };

        $scope.checksubsctax = function (tax_percent, type,countryId) {
            $scope.GSTS = !!tax_percent;
            if ($scope.GSTS) {
                if(countryId !== 101){
                    alert('This user is belongs to other country are you sure want to apply tax?')
                }
            }
            recalculateSubscriptionTotals();
        };

        $scope.checkTheSubtax = function (tax_percent, type, promo = {},countryId) {
            if (hasPromoState(promo)) {
                $scope.subscriptionPromo = createPromoState(promo);
            }
            if ($scope.GSTS && countryId !== 101) {
                alert('This user is belongs to other country are you sure want to apply tax?')
            }
            recalculateSubscriptionTotals();
        };

        $scope.checkTheDistax = function (tax_percent, type, promo = {},countryId = 0) {
            if (hasPromoState(promo)) {
                $scope.downloadPromo = createPromoState(promo);
            }
            if ($scope.GSTD && countryId !== 101) {
                alert('This user is belongs to other country are you sure want to apply tax?')
            }
            recalculateDownloadTotals();
        };

        $scope.submitQuotation = function () {
            // console.log($scope.quotation);
            // console.log($scope);
            $scope.quotation.product.map(function (editor, index) {
                for (var i in CKEDITOR.instances) {
                    if (
                        CKEDITOR.instances[i].element.$.classList.contains(
                            "licence_type"
                        )
                    ) {
                        let ci = i[i.length - 1] - 1;
                        if (index == ci) {
                            editor.licence_type =
                                CKEDITOR.instances[i].getData();
                        }
                    }
                }
                return editor;
            });
            if ($scope.quotation_type_var == "subscription") {
                $scope.submitSubscription();
            } else if ($scope.quotation_type_var == "download") {
                $scope.submitDownload();
            } else {
                $scope.submitCustom();
            }
        };

        $scope.submitDownload = function () {
            // console.log($scope.quotation);
            // console.log($scope);
            if (!$scope.selected_plan) {
                alert("Please select Plan");
                return false;
            } else if (!$scope.downloadprice) {
                alert("Please enter Subtotal");
                return false;
            } else {
                $("#loading").show();
                var resolvedDownloadExpiry = resolveExpiryValue(
                    $scope.download_expiry,
                    $scope.custom_download_expiry
                );
                if (!resolvedDownloadExpiry) {
                    $("#loading").hide();
                    alert("Please select a valid expiry period");
                    return false;
                }

                var sendData = {
                    uid: $("#uid").val(),
                    quotation_type: $scope.quotation_type_var,
                    plan_id: $scope.selected_plan,
                    plan_type_var: $scope.plan_type_var,
                    //"po": $scope.poDownload,
                    //"poDate": $scope.downloadpoDate,
                    expiry_date: resolvedDownloadExpiry,
                    tax: $scope.taxdownload,
                    total: $scope.total_download,
                    subscription_subtotal: $scope.downloadprice,
                    GSTS: $scope.GSTD,
                    currency: $scope.selected_currency || "INR",
                    email: $("#download_email_id").val(),
                    promo_code_id: $("#promo_code_id").val(),
                    flag: $("#flag").val(),
                };
                // console.log(sendData);
                //  console.log($scope.quotation);
                var fd = new FormData();
                // angular.forEach($scope.quotation[0],function(file){
                //     fd.append('file',file);
                // });
                $http({
                    method: "POST",
                    url: base_url + "saveDownloadInvoice",
                    data: sendData,
                    headers: { "Content-Type": undefined },
                }).then(
                    function (response) {
                        $("#loading").hide();
                        if (response.data.this.statuscode == "1") {
                            alert(response.data.this.statusdesc);
                        } else {
                            alert(response.data.this.statusdesc);
                        }
                        window.location =
                            api_path + "users/invoices/" + $("#uid").val();
                    },
                    function (error) {
                        $("#loading").hide();
                    }
                );
            }
        };

        $scope.submitSubscription = function () {
            //  console.log($scope.quotation);
            // console.log($scope);
            if (!$scope.selected_plan) {
                alert("Please select Plan");
                return false;
            } else if (!$scope.subscriptionprice) {
                alert("Please enter Subtotal");
                return false;
            } else {
                $("#loading").show();
                var resolvedSubscriptionExpiry = resolveExpiryValue(
                    $scope.subsc_expiry_time,
                    $scope.custom_subsc_expiry_time
                );
                if (!resolvedSubscriptionExpiry) {
                    $("#loading").hide();
                    alert("Please select a valid expiry period");
                    return false;
                }

                var sendData = {
                    uid: $("#uid").val(),
                    quotation_type: $scope.quotation_type_var,
                    plan_id: $scope.selected_plan,
                    plan_type_var: $scope.plan_type_var,
                    //"po": $scope.subsc_po,
                    //"poDate": $scope.subsc_poDate,
                    expiry_date: resolvedSubscriptionExpiry,
                    tax: $scope.subsc_tax,
                    total: $scope.subsc_total,
                    subscription_subtotal: $scope.subscriptionprice,
                    GSTS: $scope.GSTS,
                    email: $("#subsc_email_id").val(),
                    promo_code_id: $("#promo_code_id").val(),
                    flag: $("#flag").val(),
                };
                // console.log(sendData);
                //  console.log($scope.quotation);
                var fd = new FormData();
                // angular.forEach($scope.quotation[0],function(file){
                //     fd.append('file',file);
                // });
                $http({
                    method: "POST",
                    url: base_url + "saveSubscriptionInvoice",
                    data: sendData,
                    headers: { "Content-Type": undefined },
                }).then(
                    function (response) {
                        $("#loading").hide();
                        if (response.data.this.statuscode == "1") {
                            alert(response.data.this.statusdesc);
                        } else {
                            alert(response.data.this.statusdesc);
                        }
                        window.location =
                            api_path + "users/invoices/" + $("#uid").val();
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
                    },
                    function (error) {
                        $("#loading").hide();
                    }
                );
            }
        };

        $scope.submitCustom = function () {
            //  console.log($scope.quotation);
            $scope.syncCustomProductCurrencies();
            $scope.normalizeCustomProductPrices();

            for (var i = 0; i < $scope.quotation.product.length; i++) {
                if ($scope.quotation.product[i].price == undefined || $scope.quotation.product[i].price == "" || $scope.quotation.product[i].price == null) {
                  alert('Sub total cannot be null');
                  return false; // If you want to stop checking after the first null price is found

                }
            }
            $("#loading").show();
            var resolvedCustomExpiry = resolveExpiryValue(
                $scope.expiry_time,
                $scope.custom_expiry_time
            );
            if (!resolvedCustomExpiry) {
                $("#loading").hide();
                alert("Please select a valid expiry period");
                return false;
            }


            var sendData = {
                uid: $("#uid").val(),
                quotation_type: $scope.quotation_type_var,
                products: $scope.quotation,
                promoCode: $scope.promoCode,
                //"po": $scope.po,
                //"poDate": $scope.poDate,
                expiry_date: resolvedCustomExpiry,
                tax: $scope.tax,
                total: $scope.total,
                GST: $scope.GST,
                email: $("#email_id").val(),
                flag: "0",
                promo_code_id: $("#promo_code_id").val(),
            };
            // console.log($scope.quotation);
            var fd = new FormData();
            // angular.forEach($scope.quotation[0],function(file){
            //     fd.append('file',file);
            // });
            $http({
                method: "POST",
                url: api_path + "saveInvoice",
                data: sendData,
                headers: { "Content-Type": undefined },
            }).then(
                function (response) {
                    $("#loading").hide();
                    if (response.data.this.statuscode == "1") {
                        alert(response.data.this.statusdesc);
                    } else {
                        alert(response.data.this.statusdesc);
                    }
                    window.location =
                        api_path + "users/invoices/" + $("#uid").val();
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
                },
                function (error) {
                    $("#loading").hide();
                }
            );
        };

        $scope.checkProduct = function (product_type) {
            // console.log(product_type);
        };

        // CKEditor initialization for all editors
        $scope.initEditors = function () {
            if ($scope.quotation.product) {
                for (var i = 0; i < $scope.quotation.product.length; i++) {
                    if ($scope.quotation.product[i].pro_type == 'right_managed') {
                        setTimeout(
                            function (index) {
                                CKEDITOR.replace("licence_type-" + index, {
                                    readOnly: false,
                                });
                                CKEDITOR.instances[
                                    "licence_type-" + (index + 1)
                                ].setData(
                                    $scope.quotation.product[index].licence_type
                                );
                            },
                            0,
                            i
                        );
                    }
                }
            }
        };
        // Call the initialization function after rendering the editors
        setTimeout($scope.initEditors, 1000);

        $scope.getProductImage = function () {
            productName = $("#product_id").val();
            if(productName == ''){
                return false;
            }
            $("#loading").show();
            $scope.is_display_product_image = false;
            $("#display_image").val('');
            $http({
                method: "GET",
                url:
                    image_path +
                    "api/product/" +
                    productName +
                    "?type=Image",
            }).then(
                function (response) {
                    if (response.status == "200") {
                        $scope.is_display_product_image = true;
                        $("#loading").hide();
                        let img = response.data[0].thumbnail_image;
                        if (img) {
                            $("#image_path").val(img);
                            setTimeout(function () {
                                $("#display_image").attr('src', img);
                            }, 1000);
                        }
                    }
                },
                function (error) {
                    $scope.is_display_product_image = false;
                    $("#display_image").val('');
                    alert("Image not found");
                    $("#loading").hide();
                }
            );
        };

        $scope.getProductImageEditPage = function () {
            productName = $("#product_id").val();
            if (productName) {
                $("#loading").show();
                $scope.is_display_product_image_edit_page = true;
                $("#image_path").val("");
                $http({
                    method: "GET",
                    url:
                        image_path +
                        "api/product/" +
                        productName +
                        "?type=Image",
                }).then(
                    function (response) {
                        if (response.status == "200") {
                            $scope.is_display_product_image_edit_page = true;
                            $("#loading").hide();
                            let img = response.data[0].thumbnail_image;
                            if (img) {
                                $("#image_path").val(img);
                                setTimeout(function () {
                                    $("#display_image").attr('src', img);
                                }, 200);
                            }
                        }
                    },
                    function (error) {
                        $scope.is_display_product_image_edit_page = false;
                        $("#display_image").val('');
                        alert("Image not found");
                        $("#loading").hide();
                    }
                );
            } else {
                $scope.is_display_product_image_edit_page = false;
            }
        };

        $scope.getProductImageEditPageInit = function () {
            productName = $("#product_id").val();
            if (productName) {
                $("#loading").show();
                const existingImage = $("#image_path").val();
                if (existingImage == "") {
                    $scope.is_display_product_image_edit_page = false;
                }
                $("#loading").hide();
            } else {
                $scope.is_display_product_image_edit_page = false;
            }
        };
    }
);
app.controller(
    "PromotionController",
    function ($scope, $http, $location, fileReader) {
        $scope.title = "Promotion";
        $scope.promotion = {};
        $scope.po = "";
        $scope.product = {};
        $scope.subsc_expiry_time = "30";
        $scope.expiry_time = "30";
        $scope.download_expiry = "30";
        $scope.is_display_footage = true;

        //$scope.uid
        $scope.promotion.product = [
            {
                name: "",
                pro_size: "",
                pro_type: "",
                id: "",
                image: "",
                price: "",
                footage: "",
                type: "Image",
                licence_type: "",
            },
        ];
        $scope.promotion_type_var = "custom";
        $scope.addProduct = function () {
            var newProduct = {
                name: "",
                pro_size: "",
                pro_type: "",
                id: "",
                image: "",
                price: "",
                footage: "",
                type: "Image",
                licence_type: "",
            };
            $scope.quotation.product.push(newProduct);
            setTimeout(function () {
                CKEDITOR.replace(
                    "licence_type-" + $scope.quotation.product.length
                );
            }, 0);
        };

        $scope.$on("fileProgress", function (e, progress) {
            $scope.progress = progress.loaded / progress.total;
        });

        $scope.removeProduct = function (product) {
            var index = $scope.promotion.product.indexOf(product);
            $scope.promotion.product.splice(index, 1);
        };
        $scope.prices = [];
        $scope.getproduct = function (product) {
            if (product.name != "") {
                $("#loading").show();
                var index = $scope.promotion.product.indexOf(product);
                $http({
                    method: "GET",
                    url:
                        image_path +
                        "api/product/" +
                        product.name +
                        "?type=" +
                        product.type,
                }).then(
                    function (response) {
                        if (response.status == "200") {
                            $("#loading").hide();
                            if (product.type == "Image") {
                                $scope.promotion.product[0].image =
                                    response.data[0].thumbnail_image;
                                $("#image_url").val(
                                    $scope.promotion.product[0].image
                                );
                                if ($scope.promotion.product[0].image != "") {
                                    $("#product_image").attr(
                                        "src",
                                        $scope.promotion.product[0].image
                                    );
                                    $("#product_image_container").show();
                                } else {
                                    $("#product_image").removeAttr("src");
                                    $("#product_image_container").hide();
                                }
                            } else {
                                if (response.data[1] != "") {
                                    let url = response.data[0].watermarkPreview;
                                    $("#footage_url").val(url);
                                    $("#product_footage").attr("src", url);
                                    $("#product_footage").show();
                                } else {
                                    $("#product_footage").removeAttr("src");
                                    $("#product_footage").hide();
                                }
                            }
                        }
                    },
                    function (error) {
                        $("#loading").hide();
                    }
                );
            }
        };

        $scope.getProductImageEditPage = function () {
            productName = $("#product_id").val();
            if (productName) {
                $("#loading").show();
                $scope.is_display_footage = true;
                $("#image_path").val("");
                $http({
                    method: "GET",
                    url:
                        image_path +
                        "api/product/" +
                        productName +
                        "?type=Image",
                }).then(
                    function (response) {
                        if (response.status == "200") {
                            $scope.is_display_footage = true;
                            $("#loading").hide();
                            let img = response.data[0].thumbnail_image;
                            if (img) {
                                $("#image_path").val(img);
                                setTimeout(function () {
                                    $("#display_image").attr('src', img);
                                }, 200);
                            }
                        }
                    },
                    function (error) {
                        $scope.is_display_footage = false;
                        $("#display_image").val('');
                        alert("Image not found");
                        $("#loading").hide();
                    }
                );
            } else {
                $scope.is_display_footage = false;
            }
        };

        $scope.getProductImageEditPageInit = function () {
            productName = $("#product_id").val();
            if (productName) {
                $("#loading").show();
                const existingImage = $("#image_path").val();
                if (existingImage == "") {
                    $scope.is_display_footage = false;
                }
                $("#loading").hide();
            } else {
                $scope.is_display_footage = false;
            }
        };

        $scope.checkProduct = function (product) {
            $scope.getproduct(product);
        };
    }
);
app.directive("ngFileModel", [
    "$parse",
    function ($parse) {
        return {
            restrict: "A",
            link: function (scope, element, attrs) {
                var model = $parse(attrs.ngFileModel);
                var isMultiple = attrs.multiple;
                var modelSetter = model.assign;
                element.bind("change", function () {
                    var values = [];

                    angular.forEach(element[0].files, function (item) {
                        //  console.log(item);
                        var value = {
                            // File Name
                            name: item.name,
                            //File Size
                            size: item.size,
                            //File URL to view
                            url: URL.createObjectURL(item),
                            // File Input Value
                            _file: item,
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
            },
        };
    },
]);

app.directive("ngFile", [
    "$parse",
    function ($parse) {
        return {
            restrict: "A",
            link: function (scope, element, attrs) {
                element.bind("change", function () {
                    $parse(attrs.ngFile).assign(scope, element[0].files);
                    scope.$apply();
                });
            },
        };
    },
]);

app.controller("ordersController", function ($scope, $http, $location) {
    $scope.orderslist = {};
    $scope.products = {};
    $("#loading").show();
    var userid = window.location.pathname.split("/").pop();
    $http({
        method: "GET",
        url: base_url + "userListapi/" + userid,
    }).then(
        function (response) {
            $("#loading").hide();
            $scope.orderslist = response.data;
        },
        function (error) {
            $("#loading").hide();
        }
    );
    $scope.showProduct = function (products) {
        $scope.products = products;
        // console.log($scope.products);
        $("#modal-default").modal("show");
    };
});

app.controller(
    "editquotatationController",
    function ($scope, $http, $location) {
        $scope.title = "Edit Quotation";
        $scope.quotation = {};
        $scope.tax = 0;
        $scope.is_gst_applied = false;
        $scope.total_saved = 0;
        $scope.prod_type = "";
        $scope.plan_type = "";
        $scope.plansData = [];
        $scope.selected_plan = "";
        $scope.selected_currency = "INR";
        $scope.expiry_time = "30";
        $scope.subsc_expiry_time = "";
        $scope.download_expiry = "30";
        $scope.custom_expiry_time = "";
        $scope.custom_subsc_expiry_time = "";
        $scope.custom_download_expiry = "";
        var path = window.location.pathname.split("/").pop();
        function normalizeExpiryOption(value, defaultMode) {
            var normalized = value == null ? "" : String(value).trim();
            if (["7", "15", "30"].indexOf(normalized) !== -1) {
                return { mode: normalized, custom: "" };
            }
            if (normalized !== "") {
                return { mode: "custom", custom: normalized };
            }
            return { mode: defaultMode || "30", custom: "" };
        }

        function resolveExpiryValue(mode, customValue) {
            var normalizedMode = mode == null ? "" : String(mode).trim();
            if (normalizedMode === "custom") {
                var normalizedCustom = customValue == null ? "" : String(customValue).trim();
                if (!/^\d+$/.test(normalizedCustom) || parseInt(normalizedCustom, 10) <= 0) {
                    return "";
                }
                return normalizedCustom;
            }

            if (["7", "15", "30"].indexOf(normalizedMode) !== -1) {
                return normalizedMode;
            }

            return "";
        }

        function createEmptyCustomProduct() {
            return {
                name: "",
                pro_size: "",
                pro_type: "",
                id: "",
                image: "",
                price: "",
                licence_type: "",
                footage: "",
                type: "Image",
                extra_details: "",
                currency: $scope.selected_currency || "INR",
            };
        }
        $scope.syncCustomProductCurrencies = function () {
            var currency = $scope.selected_currency || "INR";
            $scope.selected_currency = currency;
            angular.forEach($scope.quotation.product || [], function (product) {
                product.currency = currency;
            });
        };
        $scope.sanitizeProductPrice = function (product) {
            if (!product) {
                return;
            }
            product.price = sanitizeAmountValue(product.price);
        };
        $scope.normalizeCustomProductPrices = function () {
            sanitizeCustomProductPrices($scope.quotation.product);
        };
        $scope.discount_amount_display = "";
        $scope.subsc_discount_amount_display = "";
        $scope.download_discount_amount_display = "";
        $scope.customPromo = createPromoState();
        $scope.subscriptionPromo = createPromoState();
        $scope.downloadPromo = createPromoState();

        function recalculateEditCustomTotals() {
            var calculation = calculatePromoAdjustedTotals(
                getProductsSubtotal($scope.quotation.product),
                !!$scope.is_gst_applied,
                $scope.customPromo,
                gst_value
            );

            $scope.tax = calculation.tax;
            $scope.total = calculation.total.toFixed(2);
            $scope.discount_amount_display =
                calculation.discount > 0
                    ? calculation.discount.toFixed(2)
                    : "";
        }

        function recalculateEditSubscriptionTotals() {
            var calculation = calculatePromoAdjustedTotals(
                $scope.subscriptionprice,
                !!$scope.GSTS,
                $scope.subscriptionPromo,
                gst_value
            );

            $scope.subsc_tax = calculation.tax;
            $scope.subsc_total = calculation.total.toFixed(2);
            $scope.subsc_discount_amount_display =
                calculation.discount > 0
                    ? calculation.discount.toFixed(2)
                    : "";
        }

        function recalculateEditDownloadTotals() {
            var calculation = calculatePromoAdjustedTotals(
                $scope.downloadprice,
                !!$scope.GSTD,
                $scope.downloadPromo,
                gst_value
            );

            $scope.taxdownload = calculation.tax;
            $scope.total_download = calculation.total.toFixed(2);
            $scope.download_discount_amount_display =
                calculation.discount > 0
                    ? calculation.discount.toFixed(2)
                    : "";
        }

        $scope.clearCustomPromo = function () {
            $scope.customPromo = createPromoState();
            recalculateEditCustomTotals();
        };

        $scope.clearSubscriptionPromo = function () {
            $scope.subscriptionPromo = createPromoState();
            recalculateEditSubscriptionTotals();
        };

        $scope.clearDownloadPromo = function () {
            $scope.downloadPromo = createPromoState();
            recalculateEditDownloadTotals();
        };
        $scope.applyCustomPromo = function (promo, countryId) {
            if (hasPromoState(promo)) {
                $scope.customPromo = createPromoState(promo);
            }

            if (!!$scope.is_gst_applied && countryId !== 101) {
                alert('This user is belongs to other country are you sure want to apply tax?');
            }

            $scope.normalizeCustomProductPrices();
            recalculateEditCustomTotals();
        };
        $scope.applySubscriptionPromo = function (promo, countryId) {
            if (hasPromoState(promo)) {
                $scope.subscriptionPromo = createPromoState(promo);
            }

            if (!!$scope.GSTS && countryId !== 101) {
                alert('This user is belongs to other country are you sure want to apply tax?');
            }

            recalculateEditSubscriptionTotals();
        };
        $scope.applyDownloadPromo = function (promo, countryId) {
            if (hasPromoState(promo)) {
                $scope.downloadPromo = createPromoState(promo);
            }

            if (!!$scope.GSTD && countryId !== 101) {
                alert('This user is belongs to other country are you sure want to apply tax?');
            }

            recalculateEditDownloadTotals();
        };
        $("#loading").show();
        $http({
            method: "POST",
            url: api_path + "edit_quotation_data",
            data: { quotation: path },
        }).then(
            function (result) {
                $("#loading").hide();
                response = result.data;
                // console.log(response.user_id);
                $scope.uid = response.user_id;
                $scope.quotation_type = response.invoice_type;
                $scope.promoCode = response.promo_code;
                $scope.tax = response.tax;
                $scope.is_gst_applied = $scope.tax > 0 ? true : false;
                $scope.total = response.total;
                $scope.total_saved = response.total;
                $("#promo_code_id").val(response.promo_code_id || "");
                $scope.po = response.job_number;
                $scope.poDate = response.po_detail;
                $scope.email = response.email_id;
                var existingPromo =
                    parseAmountNumber(response.discount_amount) > 0
                        ? {
                              type: "flat",
                              discount: response.discount_amount,
                          }
                        : {};
                var existingDiscountAmount = parseAmountNumber(
                    response.discount_amount
                );
                var normalizedExpiry = normalizeExpiryOption(response.expiry_invoices, "30");
                $scope.expiry_time = normalizedExpiry.mode;
                $scope.custom_expiry_time = normalizedExpiry.custom;
                $scope.flag = response.flag;
                $scope.quotation.product = [];
                $scope.prod_type = response.user_package?.package_type;
                if (response.invoice_type == 1) {
                    // subscription
                    var normalizedSubscriptionExpiry = normalizeExpiryOption(response.expiry_invoices, "30");
                    $scope.subsc_expiry_time = normalizedSubscriptionExpiry.mode;
                    $scope.custom_subsc_expiry_time = normalizedSubscriptionExpiry.custom;
                    $scope.subscriptionprice =
                        response.total - response.tax + existingDiscountAmount;
                    $scope.subsc_tax = response.tax;
                    $scope.subsc_total = response.total;
                    $scope.GSTS = $scope.subsc_tax > 0;
                    $scope.subscriptionPromo = createPromoState(existingPromo);
                    $scope.subsc_discount_amount_display =
                        existingDiscountAmount > 0
                            ? existingDiscountAmount.toFixed(2)
                            : "";
                } else if (response.invoice_type == 2) {
                    // download
                    var normalizedDownloadExpiry = normalizeExpiryOption(response.expiry_invoices, "30");
                    $scope.download_expiry = normalizedDownloadExpiry.mode;
                    $scope.custom_download_expiry = normalizedDownloadExpiry.custom;
                    $scope.downloadprice =
                        response.total - response.tax + existingDiscountAmount;
                    $scope.taxdownload = response.tax;
                    $scope.total_download = response.total;
                    $scope.GSTD = $scope.taxdownload > 0;
                    $scope.downloadPromo = createPromoState(existingPromo);
                    $scope.download_discount_amount_display =
                        existingDiscountAmount > 0
                            ? existingDiscountAmount.toFixed(2)
                            : "";
                    $scope.selected_currency = response.currency || "INR";
                } else {
                    // custom
                    $scope.end_client = response.end_client;
                    $scope.customPromo = createPromoState(existingPromo);
                    $scope.discount_amount_display =
                        existingDiscountAmount > 0
                            ? existingDiscountAmount.toFixed(2)
                            : "";
                    $scope.selected_currency = response.currency || "INR";
                }
                var tax_selected = response.tax_selected; //angular.fromJson(response.tax_selected);
                $scope.tax_selected = tax_selected;
                angular.forEach(tax_selected, function (value, key) {
                    $scope[key] = value;
                });
                angular.forEach(response.items, function (value, key) {
                    var obj = {
                        name: value.product_id,
                        pro_size: value.product_size,
                        pro_type: value.product_type,
                        id: value.id,
                        image: value.product_image,
                        price: value.subtotal,
                        footage: "",
                        type: value.type,
                        licence_type: value.licence_type,
                        extra_details:response.extra_details,
                        currency: response.currency || $scope.selected_currency
                    };
                    $scope.quotation.product.push(obj);
                    if (value.product_type == 'right_managed') {
                        setTimeout(function () {
                            CKEDITOR.replace(
                                "licence_type-" + $scope.quotation.product.length
                            );
                        }, 100);
                    }
                });
                if (
                    response.invoice_type == 3 &&
                    !$scope.quotation.product.length
                ) {
                    $scope.quotation.product.push(createEmptyCustomProduct());
                }
                $scope.syncCustomProductCurrencies();
                if (response.user_package) {
                    get_play_type(response.user_package.package_expiry, response.user_package.package_expiry_yearly);
                    get_plan_data(response.user_package.package_id);
                }
            },
            function (error) {
                $("#loading").hide();
            }
        );

        $scope.getTheTotal = function () {
            if ($scope.quotation_type == 1) {
                recalculateEditSubscriptionTotals();
                return;
            }

            if ($scope.quotation_type == 2) {
                recalculateEditDownloadTotals();
                return;
            }

            $scope.normalizeCustomProductPrices();
            recalculateEditCustomTotals();
        };

        $scope.edit_quotation_type_set = function (type) {
            $scope.quotation_type = type;
            if (type == 3) {
                if (!$scope.quotation.product.length) {
                    $scope.addProduct();
                } else {
                    $scope.syncCustomProductCurrencies();
                }
            }
        };
        $scope.edit_prod_type_set = function (type) {
            $scope.prod_type = type;
        };
        $scope.edit_plan_type_select = function (value) {
            $scope.plan_type = value;
            $scope.plansData = []; // on change set options null
            $scope.subscriptionprice = ""; // Reset sub total
            $scope.subsc_total = ""; // Reset total
            $scope.subsc_tax = ""; // Reset tax
            $scope.GSTS = false; // Reset gst checkbox
        };
        $scope.getPlans = function () {
            $scope.plansData = [];
            $("#loading").show();
            get_plan_data();
            $("#loading").hide();
        };
        /* Call to get quotation_type name for subscription and download only */
        function get_plan_data(get_package_id = '') {
            $http({
                method: "POST",
                url: api_path + "plans",
                data: {
                    quotation_type: $scope.quotation_type == 2 ? "download" : 'subscription',
                    prod_type: $scope.prod_type == "Image" ? 'img' : ($scope.prod_type == 'Footage' ? 'foot' : ''),
                    product_dur: $scope.quotation_type == 1 ? $scope.plan_type : "",
                },
            }).then(
                function (response) {
                    if (response.data.status == "success") {
                        $scope.plansData = response.data.data;
                        if (get_package_id) {
                            $scope.selectedPlanData = $scope.plansData.filter(package => package.package_id == get_package_id);
                            $scope.selected_sub_plan = get_package_id;
                        }
                    }
                }
            );
        }
        function get_play_type(package_expiry, package_expiry_yearly) {
            if (package_expiry == 1) {
                $scope.plan_type = "monthly";
            } else if (package_expiry_yearly == 1) {
                $scope.plan_type = "annual";
            }
        }
        $scope.selectPlanfromlist = function (selectedPlanData, type) {
            if (selectedPlanData) {
                var plan = $scope.plansData.filter(package => package.package_id == selectedPlanData);
                $scope.selected_sub_plan = plan[0].package_id;
                $scope.subsc_tax = ""; // Reset tax
                $scope.GSTS = false; // Reset gst checkbox
                $scope.taxdownload = 0;
                $scope.GSTD = false;
                if (type == "download") {
                    $scope.downloadprice = plan[0].package_price;
                    $scope.selected_currency = plan[0].currency;
                    recalculateEditDownloadTotals();
                } else {
                    $scope.subscriptionprice = plan[0].package_price;
                    recalculateEditSubscriptionTotals();
                }
            }
        };

        $scope.addProduct = function () {
            var newProduct = createEmptyCustomProduct();
            $scope.quotation.product.push(newProduct);
            $scope.syncCustomProductCurrencies();
            setTimeout(function () {
                CKEDITOR.replace(
                    "licence_type-" + $scope.quotation.product.length
                );
            }, 0);
        };

        $scope.removeProduct = function (product) {
            if (($scope.quotation.product || []).length <= 1) {
                return;
            }
            var index = $scope.quotation.product.indexOf(product);
            if (index === -1) {
                return;
            }
            $scope.quotation.product.splice(index, 1);
            if (!$scope.quotation.product.length) {
                $scope.quotation.product.push(createEmptyCustomProduct());
            }
            $scope.syncCustomProductCurrencies();
            $scope.calculatePrice();
        };
        $scope.prices = [];
        $scope.getproduct = function (product) {
            // console.log(product);
            $("#loading").show();
            var index = $scope.quotation.product.indexOf(product);
            $http({
                method: "GET",
                url:
                    image_path +
                    "api/product/" +
                    product.name +
                    "?type=" +
                    product.type,
            }).then(
                function (response) {
                    if (response.status == "200") {
                        $("#loading").hide();
                        if (product.type == "Image") {
                            $scope.quotation.product[index].name =
                                response.data[0].product_code;
                            $scope.quotation.product[index].id =
                                response.data[0].id;
                            if (response.data[0].type == "Royalty Free") {
                                $scope.quotation.product[index].pro_type =
                                    "royalty_free";
                            } else {
                                $scope.quotation.product[index].pro_type =
                                    "right_managed";
                            }
                            $scope.quotation.product[index].image =
                                response.data[0].thumbnail_image;
                            $scope.prices[index] = response.data[0];
                        } else {
                            $scope.quotation.product[index].name =
                                response.data[0].clip_data.id;
                            $scope.quotation.product[index].id =
                                response.data[0].clip_data.n;
                            $scope.quotation.product[index].image =
                                "https://p5iconsp.s3-accelerate.amazonaws.com/" +
                                response.data[2];
                            $scope.quotation.product[index].footage =
                                "https://p5resellerp.s3-accelerate.amazonaws.com/" +
                                response.data[1];
                            $scope.prices[index] =
                                response.data[0].clip_data.versions;
                        }
                    }
                },
                function (error) {
                    $("#loading").hide();
                }
            );
        };

        $scope.getThetotalAmount = function (product) {
            var index = $scope.quotation.product.indexOf(product);
            //  console.log($scope.prices);
            if (product.pro_type == "royalty_free") {
                var amount = 0;
                if (product.pro_size == "Small") {
                    //amount = $scope.prices[index].small_size;
                    amount = "550";
                } else if (product.pro_size == "Medium") {
                    //amount = $scope.prices[index].medium_size;
                    amount = "2500";
                } else if (product.pro_size == "Large") {
                    //amount = $scope.prices[index].large_size;
                    amount = "3500";
                } else if (product.pro_size == "X-Large") {
                    //amount = $scope.prices[index].x_large_size;
                    amount = "4600";
                } else {
                    amount = 1;
                }
            } else if (product.type == "Footage") {
                getFootageSizeDetails.find(function (entry) {
                    if (entry.type === product.pro_size) {
                        amount = entry.price;
                    }
                });
            } else if (product.type == "Music") {
                getMusicLicenceDetails.find(function (entry) {
                    if (entry.value === product.licence_type.trim()) {
                        amount = entry.price;
                    }
                });
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
        };
        $scope.calculatePrice = function () {
            $scope.normalizeCustomProductPrices();
            recalculateEditCustomTotals();
        };

        $scope.checkThetax = function (tax_percent, type, promo = {},countryId) {
            if (hasPromoState(promo)) {
                $scope.customPromo = createPromoState(promo);
            }

            var shouldApplyTax =
                typeof tax_percent === "boolean"
                    ? tax_percent
                    : !!$scope.is_gst_applied;
            $scope.is_gst_applied = shouldApplyTax;
            if ($scope.is_gst_applied && countryId !== 101) {
                alert('This user is belongs to other country are you sure want to apply tax?')
            }

            $scope.normalizeCustomProductPrices();
            recalculateEditCustomTotals();
        };

        $scope.checksubsctax = function (tax_percent, type,countryId) {
            $scope.GSTS = !!tax_percent;
            if ($scope.GSTS && countryId !== 101) {
                alert('This user is belongs to other country are you sure want to apply tax?')
            }
            recalculateEditSubscriptionTotals();
        };

        $scope.checkTheSubtax = function (tax_percent, type, promo = {},countryId = 0) {
            if (hasPromoState(promo)) {
                $scope.subscriptionPromo = createPromoState(promo);
            }
            if ($scope.GSTS && countryId !== 101) {
                alert('This user is belongs to other country are you sure want to apply tax?')
            }
            recalculateEditSubscriptionTotals();
        };

        $scope.checkDownloadtax = function (tax_percent, type,countryId) {
            $scope.GSTD = !!tax_percent;
            if ($scope.GSTD && countryId !== 101) {
                alert('This user is belongs to other country are you sure want to apply tax?')
            }
            recalculateEditDownloadTotals();
        };

        $scope.checkTheDistax = function (tax_percent, type, promo = {},countryId = 0) {
            if (hasPromoState(promo)) {
                $scope.downloadPromo = createPromoState(promo);
            }
            if ($scope.GSTD && countryId !== 101) {
                alert('This user is belongs to other country are you sure want to apply tax?')
            }
            recalculateEditDownloadTotals();
        };

        $scope.submitQuotation = function () {
            $scope.quotation.product.map(function (editor, index) {
                for (var i in CKEDITOR.instances) {
                    if (
                        CKEDITOR.instances[i].element.$.classList.contains(
                            "licence_type"
                        )
                    ) {
                        let ci = i[i.length - 1] - 1;
                        if (index == ci) {
                            editor.licence_type =
                                CKEDITOR.instances[i].getData();
                        }
                    }
                }
                return editor;
            });
            if ($scope.quotation_type == "1") {
                $scope.submitEditSubscription();
            } else if ($scope.quotation_type == "2") {
                $scope.submitEditDownload();
            } else {
                $scope.submitEditCustom();
            }
        };

        $scope.submitEditSubscription = function () {
            if (!$scope.selected_sub_plan) {
                alert("Please select plan");
                return false;
            } else if (!$scope.subscriptionprice) {
                alert("Please enter subtotal");
                return false;
            } else if (!$scope.subsc_expiry_time) {
                alert("Please select expiry period");
                return false;
            } else {
                var resolvedSubscriptionExpiry = resolveExpiryValue(
                    $scope.subsc_expiry_time,
                    $scope.custom_subsc_expiry_time
                );
                if (!resolvedSubscriptionExpiry) {
                    alert("Please select a valid expiry period");
                    return false;
                }
                $("#loading").show();
                var sendData = {
                    uid: $("#uid").val(),
                    quotation_type: $scope.quotation_type,
                    plan_id: $scope.selected_sub_plan,
                    plan_type_var: $scope.plan_type,
                    expiry_date: resolvedSubscriptionExpiry,
                    tax: $scope.subsc_tax,
                    total: $scope.subsc_total,
                    subscription_subtotal: $scope.subscriptionprice,
                    GSTS: $scope.GSTS,
                    email: $("#subsc_email_id").val(),
                    promo_code_id: $("#promo_code_id").val(),
                    flag: $("#flag").val(),
                    old_quotation: path,
                };
                var fd = new FormData();
                $http({
                    method: "POST",
                    url: base_url + "saveSubscriptionInvoice",
                    data: sendData,
                    headers: { "Content-Type": undefined },
                }).then(
                    function (response) {
                        $("#loading").hide();
                        if (response.data.this.statuscode == "1") {
                            alert(response.data.this.statusdesc);
                        } else {
                            alert(response.data.this.statusdesc);
                        }
                        window.location =
                            api_path + "users/invoices/" + $("#uid").val();
                    },
                    function (error) {
                        $("#loading").hide();
                    }
                );
            }
        };

        $scope.submitEditDownload = function () {
            if (!$scope.selected_sub_plan) {
                alert("Please select Plan");
                return false;
            } else if (!$scope.downloadprice) {
                alert("Please enter Subtotal");
                return false;
            } else if (!$scope.download_expiry) {
                alert("Please select expiry period");
                return false;
            } else {
                var resolvedDownloadExpiry = resolveExpiryValue(
                    $scope.download_expiry,
                    $scope.custom_download_expiry
                );
                if (!resolvedDownloadExpiry) {
                    alert("Please select a valid expiry period");
                    return false;
                }
                $("#loading").show();
                var sendData = {
                    uid: $("#uid").val(),
                    quotation_type: $scope.quotation_type,
                    plan_id: $scope.selected_sub_plan,
                    plan_type_var: $scope.plan_type,
                    expiry_date: resolvedDownloadExpiry,
                    tax: $scope.taxdownload,
                    total: $scope.total_download,
                    subscription_subtotal: $scope.downloadprice,
                    GSTS: $scope.GSTD,
                    currency: $scope.selected_currency || "INR",
                    email: $("#download_email_id").val(),
                    promo_code_id: $("#promo_code_id").val(),
                    flag: $("#flag").val(),
                    old_quotation: path,
                };
                var fd = new FormData();
                $http({
                    method: "POST",
                    url: base_url + "saveDownloadInvoice",
                    data: sendData,
                    headers: { "Content-Type": undefined },
                }).then(
                    function (response) {
                        $("#loading").hide();
                        if (response.data.this.statuscode == "1") {
                            alert(response.data.this.statusdesc);
                        } else {
                            alert(response.data.this.statusdesc);
                        }
                        window.location =
                            api_path + "users/invoices/" + $("#uid").val();
                    },
                    function (error) {
                        $("#loading").hide();
                    }
                );
            }
        };

        $scope.submitEditCustom = function () {
            $scope.syncCustomProductCurrencies();
            $scope.normalizeCustomProductPrices();
            var resolvedCustomExpiry = resolveExpiryValue(
                $scope.expiry_time,
                $scope.custom_expiry_time
            );
            if (!resolvedCustomExpiry) {
                alert("Please select expiry period");
                return false;
            }
            for (var i = 0; i < $scope.quotation.product.length; i++) {
                if ($scope.quotation.product[i].price == undefined || $scope.quotation.product[i].price == "" || $scope.quotation.product[i].price == null) {
                  alert('Sub total cannot be null');
                  return false; // If you want to stop checking after the first null price is found

                }
            }

            $("#loading").show();

            var sendData = {
                uid: $("#uid").val(),
                quotation_type: $scope.quotation_type,
                products: $scope.quotation,
                promoCode: $scope.promoCode,
                po: $scope.po,
                poDate: $scope.poDate,
                expiry_date: resolvedCustomExpiry,
                tax: $scope.tax,
                total: $scope.total,
                GST: $scope.GST,
                CGST: $scope.CGST,
                IGST: $scope.IGST,
                IGSTT: $scope.IGSTT,
                email: $scope.email,
                old_quotation: path,
                image1: $("#file1")[0] ? $("#file1")[0].files[0] : "",
                flag: $scope.flag ?? "0",
                promo_code_id: $("#promo_code_id").val(),
                end_client: $scope.end_client,
            };
            var fd = new FormData();
            $http({
                method: "POST",
                url: api_path + "saveInvoice",
                data: sendData,
                headers: { "Content-Type": undefined },
            }).then(
                function (response) {
                    $("#loading").hide();
                    if (response.data.this.statuscode == "1") {
                        alert(response.data.this.statusdesc);
                    } else {
                        alert(response.data.this.statusdesc);
                    }
                    window.location =
                        api_path + "users/invoices/" + $("#uid").val();
                },
                function (error) {
                    $("#loading").hide();
                }
            );
        };

        $scope.submitSubscription = function () {
            if (!$scope.selected_plan) {
                alert("Please select Plan");
                return false;
            } else if (!$scope.subscriptionprice) {
                alert("Please enter Subtotal");
                return false;
            } else {
                $("#loading").show();

                var sendData = {
                    uid: $("#uid").val(),
                    quotation_type: $scope.quotation_type_var,
                    plan_id: $scope.selected_plan,
                    plan_type_var: $scope.plan_type_var,
                    expiry_date: $scope.subsc_expiry_time,
                    tax: $scope.subsc_tax,
                    total: $scope.subsc_total,
                    subscription_subtotal: $scope.subscriptionprice,
                    GSTS: $scope.GSTS,
                    email: $("#subsc_email_id").val(),
                    promo_code_id: $("#promo_code_id").val(),
                    flag: $("#flag").val(),
                };
                var fd = new FormData();
                $http({
                    method: "POST",
                    url: base_url + "saveSubscriptionInvoice",
                    data: sendData,
                    headers: { "Content-Type": undefined },
                }).then(
                    function (response) {
                        $("#loading").hide();
                        if (response.data.this.statuscode == "1") {
                            alert(response.data.this.statusdesc);
                        } else {
                            alert(response.data.this.statusdesc);
                        }
                        window.location =
                            api_path + "users/invoices/" + $("#uid").val();
                    },
                    function (error) {
                        $("#loading").hide();
                    }
                );
            }
        };

        // CKEditor initialization for all editors
        $scope.initEditors = function () {
            if ($scope.quotation.product) {
                for (var i = 0; i < $scope.quotation.product.length; i++) {
                    if ($scope.quotation.product[i].pro_type == 'right_managed') {
                        setTimeout(
                            function (index) {
                                CKEDITOR.replace("licence_type-" + index, {
                                    readOnly: false,
                                });
                                CKEDITOR.instances[
                                    "licence_type-" + (index + 1)
                                ].setData(
                                    $scope.quotation.product[index].licence_type
                                );
                            },
                            0,
                            i
                        );
                    }
                }
            }
        };
        // Call the initialization function after rendering the editors
        setTimeout($scope.initEditors, 1000);
    }
);
app.controller("invoiceController", function ($scope, $http, $location) {
    $scope.quotationObj = {};
    $scope.cusQuotationObj = {};
    $scope.quotation_data = {};
    $scope.payment_method = "";
    $scope.invoice_id = "";
    $scope.download_product_id = "";
    $scope.expiry_due_date = "";

    function getVisibleInvoiceModalBody() {
        return $("#modal-default .modal-body:visible").first();
    }

    function getInvoiceModalFieldValue(container, selector) {
        if (!container || !container.length) {
            return "";
        }

        var field = container.find(selector).first();
        if (!field.length) {
            return "";
        }

        return field.val() || "";
    }

    function clearInvoiceValidationState(container) {
        var target = container && container.length ? container : getVisibleInvoiceModalBody();
        if (!target.length) {
            return;
        }

        target.find(".invoice-field-error").removeClass("invoice-field-error");
        target.find(".invoice-validation-message").hide().text("");
    }

    function showInvoiceValidationMessage(container, message) {
        if (!container || !container.length) {
            alert(message);
            return;
        }

        var messageBox = container.find(".invoice-validation-message").first();
        if (messageBox.length) {
            messageBox.text(message).show();
        } else {
            alert(message);
        }
    }

    function highlightInvoiceField(container, selector, firstInvalidField) {
        var field = container.find(selector).filter(":visible").first();
        if (!field.length) {
            return firstInvalidField;
        }

        field.addClass("invoice-field-error");
        return firstInvalidField || field;
    }

    function showInvoiceFieldError(container, selector, message) {
        clearInvoiceValidationState(container);
        var field = container.find(selector).filter(":visible").first();
        if (field.length) {
            field.addClass("invoice-field-error").focus();
        }
        showInvoiceValidationMessage(container, message);
    }

    function getInvoiceSubmitErrorMessage(error) {
        if (!error) {
            return "";
        }

        var payload = error.data;
        if (!payload && error.responseText) {
            payload = error.responseText;
        }

        if (typeof payload === "string") {
            try {
                payload = JSON.parse(payload);
            } catch (parseError) {
                var statusDescMatch = payload.match(/"statusdesc"\s*:\s*"([^"]+)"/i);
                if (statusDescMatch && statusDescMatch[1]) {
                    return statusDescMatch[1];
                }
                return payload;
            }
        }

        if (!payload) {
            return "";
        }

        if (payload.resp && payload.resp.statusdesc) {
            return payload.resp.statusdesc;
        }

        if (payload.message) {
            return payload.message;
        }

        if (payload.error) {
            return payload.error;
        }

        return "";
    }

    function validateInvoiceModalFields(options) {
        var container = options && options.container && options.container.length
            ? options.container
            : getVisibleInvoiceModalBody();
        var paymentMethod = (
            (options && options.paymentMethod) ||
            getInvoiceModalFieldValue(container, "[name='payment_method']")
        ).toString().trim();
        var missingFields = [];
        var firstInvalidField = null;

        if (!container.length) {
            return true;
        }

        clearInvoiceValidationState(container);

        function requireField(selector, label) {
            var field = container.find(selector).filter(":visible").first();
            if (!field.length) {
                return;
            }

            var value = (field.val() || "").toString().trim();
            if (!value) {
                missingFields.push(label);
                firstInvalidField = highlightInvoiceField(container, selector, firstInvalidField);
            }
        }

        requireField("#payment_method", "Method");
        var visibleExpiryField = container.find("[name='expiry_due_date']").filter(":visible").first();
        if (visibleExpiryField.length) {
            requireField("[name='expiry_due_date']", "How many days");
        }
        requireField(options.countrySelector, "Country");
        requireField(options.stateSelector, "State");
        requireField(options.citySelector, "City");
        requireField(options.addressSelector, "Street");

        if (missingFields.length) {
            showInvoiceValidationMessage(
                container,
                "Please fill the required fields: " + missingFields.join(", ") + "."
            );
            if (firstInvalidField && firstInvalidField.length) {
                firstInvalidField.focus();
            }
            return false;
        }

        return true;
    }

    $(document)
        .off("input.invoiceValidation change.invoiceValidation", "#modal-default input, #modal-default select")
        .on("input.invoiceValidation change.invoiceValidation", "#modal-default input, #modal-default select", function () {
            var field = $(this);
            var container = field.closest(".modal-body");
            field.removeClass("invoice-field-error");

            if (container.length && !container.find(".invoice-field-error").length) {
                container.find(".invoice-validation-message").hide().text("");
            }
        });

    $("#modal-default")
        .off("hidden.bs.modal.invoiceValidation")
        .on("hidden.bs.modal.invoiceValidation", function () {
            clearInvoiceValidationState($("#modal-default .modal-body"));
        });

    function syncDownloadOnBehalfProductId(value) {
        $scope.download_product_id = value || "";
    }

    function buildDownloadOnBehalfPayload(trigger) {
        if (!trigger || !trigger.length) {
            return null;
        }

        var quotationId = trigger.data("quotation-id");
        var total = trigger.data("total");
        var invoiceType = trigger.data("invoice-type");
        var quotationSource = trigger.data("quotation-source");
        var userId = trigger.data("user-id");
        if (!quotationId || !userId) {
            return null;
        }

        return {
            quotationData: {
                id: parseInt(quotationId, 10),
                total: total || 0,
                invoice_type: parseInt(invoiceType, 10) || 0,
                quotation_source: parseInt(quotationSource, 10) || 0,
            },
            userId: parseInt(userId, 10),
        };
    }

    $(document)
        .off("input.invoiceDownloadOnBehalf", "#download-on-behalf-product-id")
        .on("input.invoiceDownloadOnBehalf", "#download-on-behalf-product-id", function () {
            var inputValue = $(this).val();
            $scope.$applyAsync(function () {
                syncDownloadOnBehalfProductId(inputValue);
            });
        });

    $("#modal-download-behalf")
    .off("hidden.bs.modal.invoiceDownloadOnBehalf")
    .on("hidden.bs.modal.invoiceDownloadOnBehalf", function () {
                  
        $scope.$applyAsync(function () {
            $scope.quotation_data = {};
            syncDownloadOnBehalfProductId("");
        });
        $("#download-on-behalf-product-id").val("");
    });

    
    $scope.create_invoice = function (quotation, user_id) {
        $scope.quotationObj = []
        $scope.payment_method = "";
        $scope.expiry_due_date = "";
        $scope.cusQuotationObj = quotation;
        $scope.quotation_user_cus = user_id;
        clearInvoiceValidationState($("#modal-default .modal-body"));

    };

    $scope.create_invoice_subscription = function (quotation, user_id) {
        $scope.cusQuotationObj = []
        $scope.payment_method = "";
        $scope.expiry_due_date = "";
        $scope.quotationObj = quotation;
        $scope.quotation_user = user_id;
        clearInvoiceValidationState($("#modal-default .modal-body"));
    };

    $scope.send_invoice = function (quotation_id, user_id) {
        if (!quotation_id) {
            alert("Quotation ID is missing. Please reopen the invoice modal and try again.");
            return;
        }
        var modalBody = getVisibleInvoiceModalBody();
        var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;

        var reggst =
            /^([0-9]{2}[a-zA-Z]{4}([a-zA-Z]{1}|[0-9]{1})[0-9]{4}[a-zA-Z]{1}([a-zA-Z]|[0-9]){3}){0,15}$/;
        var regmob = /^[0-9]{1,10}$/;
         var gstNo = ($("#gstNo").val() || ($scope.quotationObj && $scope.quotationObj.gst) || "").toString().trim();
        var panNo = ($("#panNo").val() || ($scope.quotationObj && $scope.quotationObj.pan) || "").toString().trim();
        var phoneNo = ($("#phone").val() || ($scope.quotationObj && $scope.quotationObj.mobile) || "").toString().trim();
        var paymentMethod = (getInvoiceModalFieldValue(modalBody, "[name='payment_method']") || $scope.payment_method || "").toString().trim();
        var poDate = getInvoiceModalFieldValue(modalBody, "#po_date");
        var panno = gstNo.length >= 12 ? gstNo.substr(2, 10) : "";
        var currency = ($scope.quotationObj && $scope.quotationObj.currency);
        var expiry_due_date = (getInvoiceModalFieldValue(modalBody, "[name='expiry_due_date']") || $scope.expiry_due_date || "").toString().trim();

        if (!validateInvoiceModalFields({
            container: modalBody,
            paymentMethod: paymentMethod,
            countrySelector: "#country_invoice",
            stateSelector: "#state_invoice",
            citySelector: "#city_invoice",
            addressSelector: "#address_invoice",
        })) {
            return;
        } else if (gstNo && !reggst.test(gstNo)) {
            alert("Please enter valid GST no.");
        } else if (panNo && !regex.test(panNo)) {
            alert("Please enter valid pan no.");
        } else if (gstNo && panNo && panno !== panNo) {
            alert("Please enter valid pan no or GST Number.");
        } else if (phoneNo && !regmob.test(phoneNo)) {
            showInvoiceFieldError(modalBody, "#phone", "Please enter 10 digit mobile no.");
        } else {
            if (confirm("Do you want to send invoice for this quotation ?")) {
                $("#loading").show();
                $http({
                    method: "POST",
                    url: api_path + "create_invoice_subcription",
                    data: {
                        quotation_id: quotation_id,
                        user_id: user_id,
                        po: getInvoiceModalFieldValue(modalBody, "#po") || "",
                        po_date: poDate,
                        payment_method: paymentMethod,
                        gst: gstNo,
                        pan: panNo,
                        phone: phoneNo,
                        country: getInvoiceModalFieldValue(modalBody, "#country_invoice") || "",
                        state: getInvoiceModalFieldValue(modalBody, "#state_invoice") || "",
                        city: getInvoiceModalFieldValue(modalBody, "#city_invoice") || "",
                        address: getInvoiceModalFieldValue(modalBody, "#address_invoice") || "",
                        address2: getInvoiceModalFieldValue(modalBody, "#address2_invoice") || "",
                        postal_code: getInvoiceModalFieldValue(modalBody, "#postal_code_invoice") || "",
                        expiry_due_date: expiry_due_date ?? "",
                        currency: currency,
                    },
                }).then(
                    function (result) {
                        $("#loading").hide();
                        var resp = result && result.data ? result.data.resp : null;
                        var mailMeta = (resp && resp.mail_to) ? (" Recipient: " + resp.mail_to) : "";
                        var traceMeta = (resp && resp.mail_message_id) ? (" Message ID: " + resp.mail_message_id) : "";
                        if (resp && resp.statuscode === "1") {
                            alert((resp.statusdesc || "Invoice sent successfully.") + mailMeta + traceMeta);
                            window.location = api_path + "users/invoices/" + user_id;
                        } else {
                            alert(((resp && resp.statusdesc) || "Invoice submission completed but email was not sent.") + mailMeta + traceMeta);
                        }
                    },
                    function (error) {
                        $("#loading").hide();
                        var errorMessage = getInvoiceSubmitErrorMessage(error) || "Unable to submit invoice. Please check server logs and try again.";
                        if (errorMessage.toLowerCase().indexOf("how many days") > -1) {
                            showInvoiceFieldError(modalBody, "[name='expiry_due_date']", errorMessage);
                        } else {
                            alert(errorMessage);
                        }
                    }
                );
            }
        }
    };

    $scope.send_invoice_cus = function (quotation_id, user_id) {
         if (!quotation_id) {
            alert("Quotation ID is missing. Please reopen the invoice modal and try again.");
            return;
        }
        var modalBody = getVisibleInvoiceModalBody();
        var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;

        var reggst =
            /^([0-9]{2}[a-zA-Z]{4}([a-zA-Z]{1}|[0-9]{1})[0-9]{4}[a-zA-Z]{1}([a-zA-Z]|[0-9]){3}){0,15}$/;
        var regmob = /^[0-9]{1,10}$/;

        var gstNo = ($("#gstNocus").val() || ($scope.cusQuotationObj && $scope.cusQuotationObj.gst) || "").toString().trim();
        var panNo = ($("#panNocus").val() || ($scope.cusQuotationObj && $scope.cusQuotationObj.pan) || "").toString().trim();
        var phoneNo = ($("#phonecus").val() || ($scope.cusQuotationObj && $scope.cusQuotationObj.mobile) || "").toString().trim();
        var paymentMethod = (getInvoiceModalFieldValue(modalBody, "[name='payment_method']") || $scope.payment_method || "").toString().trim();
        var poDate = getInvoiceModalFieldValue(modalBody, "#po_date") || $scope.poDateCustom || $scope.po_date;
        var panno = gstNo.length >= 12 ? gstNo.substr(2, 10) : "";
        var currency = ($scope.cusQuotationObj && $scope.cusQuotationObj.currency);
        var expiry_due_date = (getInvoiceModalFieldValue(modalBody, "[name='expiry_due_date']") || $scope.expiry_due_date || "").toString().trim();

        //var expiry_due_date = ($scope.expiry_due_date || $("#modal-default .modal-body:visible #expiry_due_date").val() || "").toString().trim();

        if (!validateInvoiceModalFields({
            container: modalBody,
            paymentMethod: paymentMethod,
            countrySelector: "#country_invoice_cus",
            stateSelector: "#state_invoice_cus",
            citySelector: "#city_invoice_cus",
            addressSelector: "#address_invoice_cus",
        })) {
            return;
        } else if (gstNo && !reggst.test(gstNo)) {
            alert("Please enter valid GST no.");
        } else if (panNo && !regex.test(panNo)) {
            alert("Please enter valid pan no.");
        } else if (gstNo && panNo && panno !== panNo) {
            alert("Please enter valid pan no or GST Number.");
        } else if (phoneNo && !regmob.test(phoneNo)) {
            showInvoiceFieldError(modalBody, "#phonecus", "Please enter 10 digit mobile no.");
        } else {
            if (confirm("Do you want to send invoice for this quotation ?")) {
                $("#loading").show();
                $http({
                    method: "POST",
                    url: api_path + "create_invoice",
                    data: {
                        quotation_id: quotation_id,
                        user_id: user_id,
                        po: getInvoiceModalFieldValue(modalBody, "#poCustom") || "",
                        po_date: poDate,
                        payment_method: paymentMethod,
                        gst: gstNo,
                        pan: panNo,
                        phone: phoneNo,
                        expiry_due_date: expiry_due_date ?? "",
                        country: getInvoiceModalFieldValue(modalBody, "#country_invoice_cus") || "",
                        state: getInvoiceModalFieldValue(modalBody, "#state_invoice_cus") || "",
                        city: getInvoiceModalFieldValue(modalBody, "#city_invoice_cus") || "",
                        address: getInvoiceModalFieldValue(modalBody, "#address_invoice_cus") || "",
                        address2: getInvoiceModalFieldValue(modalBody, "#address2_invoice_cus") || "",
                        postal_code: getInvoiceModalFieldValue(modalBody, "#postal_code_invoice_cus") || "",
                        currency: currency,
                    },
                }).then(
                    function (result) {
                        $("#loading").hide();
                        var resp = result && result.data ? result.data.resp : null;
                        var mailMeta = (resp && resp.mail_to) ? (" Recipient: " + resp.mail_to) : "";
                        var traceMeta = (resp && resp.mail_message_id) ? (" Message ID: " + resp.mail_message_id) : "";
                        if (resp && resp.statuscode === "1") {
                            alert((resp.statusdesc || "Invoice sent successfully.") + mailMeta + traceMeta);
                            window.location = api_path + "users/invoices/" + user_id;
                        } else {
                            alert(((resp && resp.statusdesc) || "Invoice submission completed but email was not sent.") + mailMeta + traceMeta);
                        }
                    },
                    function (error) {
                        $("#loading").hide();
                        var errorMessage = getInvoiceSubmitErrorMessage(error) || "Unable to submit invoice. Please check server logs and try again.";
                        if (errorMessage.toLowerCase().indexOf("how many days") > -1) {
                            showInvoiceFieldError(modalBody, "[name='expiry_due_date']", errorMessage);
                        } else {
                            alert(errorMessage);
                        }
                    }
                );
            }
        }
    };

    $scope.change_status = function (status, quotation_id) {
        if (confirm("Do you want to change the status of invoice/quotation")) {
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
    };

    $scope.open_modal_update_po = function (id = null, job_number = 0) {
        job_number = job_number == 0 ? '' : job_number;
        $(".modal-body #invoice_id").val(id);
        $(".modal-body #po_no").val(job_number);
        $scope.invoice_id = id;
    };
    $scope.update_po = function () {
        $scope.invoice_id = $(".modal-body #invoice_id").val();
        $scope.po_no = $(".modal-body #po_no").val();
        if (!$scope.invoice_id) {
            return false;
        }
        if (!$scope.po_no) {
            alert("Please enter po #.");
        } else {
            $("#loading").show();
            $http({
                method: "POST",
                url: api_path + "update_po",
                data: { invoice_id: $scope.invoice_id, po_no: $scope.po_no },
            }).then(
                function (result) {
                    $("#loading").hide();
                    if (result.data.resp.statuscode == "1") {
                        alert(result.data.resp.statusdesc);
                    } else {
                        alert(result.data.resp.statusdesc);
                    }
                    window.location.reload();
                },
                function (error) {
                    $("#loading").hide();
                }
            );
        }
    };

    $scope.showModal = function() {
    $('#modal-download-behalf').modal('show');
    };

    // Open Download on Behalf Modal
    $scope.open_download_on_behalf_modal = function(quotationData, userId) {
        $scope.quotation_data = angular.copy(quotationData || {});
        $scope.quotation_data.user_id = parseInt(userId, 10);
        syncDownloadOnBehalfProductId("");
        $("#download-on-behalf-product-id").val("");
    };
    // Download and Send Email using existing getPackageItems method
    $scope.downloadAndSendEmail = function() {
        if (!$scope.download_product_id) {
            syncDownloadOnBehalfProductId($.trim($("#download-on-behalf-product-id").val()));
        }

        if (!$scope.download_product_id) {
            alert('Please enter a Product ID');
            return;
        }

        if (!$scope.quotation_data || !$scope.quotation_data.user_id) {
            alert('User ID not found. Please reload the page.');
            return;
        }
        $("#loading").show();
        $http({
            method: "POST",
            url: api_path + "get-package-items",
            data: {
                product_id: $scope.download_product_id,
                package_id: $scope.quotation_data.id,
                user_id: parseInt($scope.quotation_data.user_id, 10),
                invoice_type: $scope.quotation_data.invoice_type,
                product_web: $scope.quotation_data.quotation_source || 2,
                total: $scope.quotation_data.total || 0
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).then(
            function(result) {
                $("#loading").hide();

                // Check different response status values
                var status = result.data.status;
                var message = result.data.message || 'Operation completed';
                
                if (status == "success" || status === 1 || status === "1") {
                    alert(message + ' - Email notification sent to the user');
                    $('#modal-download-behalf').modal('hide');
                    syncDownloadOnBehalfProductId("");
                    $("#download-on-behalf-product-id").val("");
                    // Reload the page to refresh data
                    setTimeout(function() {
                        window.location.reload();
                    }, 1500);
                } else if (status == "0" || status == "failed") {
                    alert('Error: ' + message);
                } else {
                    // If no status field, show generic error
                    alert('Download processed. Please check your email for download link.');
                    $('#modal-download-behalf').modal('hide');
                    syncDownloadOnBehalfProductId("");
                    $("#download-on-behalf-product-id").val("");
                    setTimeout(function() {
                        window.location.reload();
                    }, 1500);
                }
            },
            function(error) {
                $("#loading").hide();
                var errorMessage = 'An error occurred';
                
                if (error.data && error.data.message) {
                    errorMessage = error.data.message;
                } else if (error.statusText) {
                    errorMessage = error.statusText;
                }
                
                alert('Error: ' + errorMessage);
            }
        );
    };

    // Set up jQuery click handler with scope access (inside controller)
    setTimeout(function() {
        $('#download-on-behalf-submit').on('click', function(e) {
            e.preventDefault();
            $scope.$apply(function() {
                $scope.downloadAndSendEmail();
            });
        });
    }, 100);
});

app.directive("ngFileSelect", function (fileReader, $timeout) {
    return {
        scope: {
            ngModel: "=",
        },
        link: function ($scope, el) {
            function getFile(file) {
                if (!file) {
                    return;
                }
                if (el[0]['id']) { // If upload new file than reset scope product
                    let productId = el[0]['id'].substring(4);
                    $("#product_" + productId).val("").trigger("input").trigger("change");
                    if ($scope.$parent && $scope.$parent.product) {
                        $scope.$parent.product.name = "";
                        $scope.$parent.product.id = "";
                        $scope.$parent.product.pro_size = "";
                        $scope.$parent.product.pro_type = "";
                        $scope.$parent.product.licence_type = "";
                        $scope.$parent.product.footage = "";
                        $scope.$parent.product.price = "";
                    }
                }
                fileReader.readAsDataUrl(file, $scope).then(function (result) {
                    $timeout(function () {
                        $scope.ngModel = result;
                    });
                });
            }

            el.bind("change", function (e) {
                var file = (e.srcElement || e.target).files[0];
                getFile(file);
            });
        },
    };
});

app.factory("fileReader", function ($q, $log) {
    var THUMBNAIL_MAX_DIMENSION = 1200;
    var THUMBNAIL_QUALITY = 0.82;

    var onLoad = function (reader, deferred, scope) {
        return function () {
            scope.$apply(function () {
                deferred.resolve(reader.result);
            });
        };
    };

    var onError = function (reader, deferred, scope) {
        return function () {
            scope.$apply(function () {
                deferred.reject(reader.result);
            });
        };
    };

    var onProgress = function (reader, scope) {
        return function (event) {
            scope.$broadcast("fileProgress", {
                total: event.total,
                loaded: event.loaded,
            });
        };
    };

    var getReader = function (deferred, scope) {
        var reader = new FileReader();
        reader.onload = onLoad(reader, deferred, scope);
        reader.onerror = onError(reader, deferred, scope);
        reader.onprogress = onProgress(reader, scope);
        return reader;
    };

    var readAsOriginalDataURL = function (file, scope) {
        var deferred = $q.defer();

        var reader = getReader(deferred, scope);
        reader.readAsDataURL(file);

        return deferred.promise;
    };

    var resolveDeferred = function (scope, deferred, value) {
        scope.$applyAsync(function () {
            deferred.resolve(value);
        });
    };

    var rejectDeferred = function (scope, deferred, value) {
        scope.$applyAsync(function () {
            deferred.reject(value);
        });
    };

    var readAsThumbnailDataURL = function (file, scope) {
        if (!file || !file.type || file.type.indexOf("image/") !== 0) {
            return readAsOriginalDataURL(file, scope);
        }

        var deferred = $q.defer();
        var urlFactory = window.URL || window.webkitURL;

        if (!urlFactory || typeof document === "undefined") {
            return readAsOriginalDataURL(file, scope);
        }

        var image = new Image();
        var objectUrl = urlFactory.createObjectURL(file);

        var cleanup = function () {
            if (objectUrl) {
                urlFactory.revokeObjectURL(objectUrl);
            }
        };

        image.onload = function () {
            try {
                var width = image.naturalWidth || image.width || 1;
                var height = image.naturalHeight || image.height || 1;
                var ratio = Math.min(
                    1,
                    THUMBNAIL_MAX_DIMENSION / Math.max(width, height)
                );
                var targetWidth = Math.max(1, Math.round(width * ratio));
                var targetHeight = Math.max(1, Math.round(height * ratio));
                var canvas = document.createElement("canvas");
                canvas.width = targetWidth;
                canvas.height = targetHeight;

                var context = canvas.getContext("2d");
                if (!context) {
                    cleanup();
                    readAsOriginalDataURL(file, scope).then(
                        function (result) {
                            resolveDeferred(scope, deferred, result);
                        },
                        function (error) {
                            rejectDeferred(scope, deferred, error);
                        }
                    );
                    return;
                }

                context.drawImage(image, 0, 0, targetWidth, targetHeight);

                var outputType =
                    file.type === "image/png" || file.type === "image/webp"
                        ? file.type
                        : "image/jpeg";
                var result = canvas.toDataURL(
                    outputType,
                    outputType === "image/png" ? undefined : THUMBNAIL_QUALITY
                );

                cleanup();
                resolveDeferred(scope, deferred, result);
            } catch (error) {
                cleanup();
                rejectDeferred(scope, deferred, error);
            }
        };

        image.onerror = function () {
            cleanup();
            readAsOriginalDataURL(file, scope).then(
                function (result) {
                    resolveDeferred(scope, deferred, result);
                },
                function (error) {
                    rejectDeferred(scope, deferred, error);
                }
            );
        };

        image.src = objectUrl;

        return deferred.promise;
    };

    return {
        readAsDataUrl: readAsThumbnailDataURL,
    };
});

app.controller("ordersController", function ($scope, $http, $location) {
    $scope.subscriberlist = {};
    $scope.products = {};
    $("#loading").show();
    $http({
        method: "GET",
        url: base_url + "getSubscribers",
    }).then(
        function (response) {
            $("#loading").hide();
            $scope.subscriberlist = response.data;
        },
        function (error) {
            $("#loading").hide();
        }
    );
    $scope.showProduct = function (products) {
        $scope.products = products;
        // console.log($scope.products);
        $("#modal-default").modal("show");
    };
});

app.controller(
    "quotatationWithoutApiController",
    function ($scope, $http, $location, fileReader) {
        $scope.title = "Send Quotation";
        $scope.quotation = {};
        $scope.po = "";
        $scope.subsc_expiry_time = "30";
        $scope.expiry_time = "30";
        $scope.download_expiry = "30";
        $scope.custom_expiry_time = "";
        $scope.custom_subsc_expiry_time = "";
        $scope.custom_download_expiry = "";
        $scope.selected_currency = "INR";

        //$scope.uid
        function normalizeExpiryOption(value, defaultMode) {
            var normalized = value == null ? "" : String(value).trim();
            if (["7", "15", "30"].indexOf(normalized) !== -1) {
                return { mode: normalized, custom: "" };
            }
            if (normalized !== "") {
                return { mode: "custom", custom: normalized };
            }
            return { mode: defaultMode || "30", custom: "" };
        }

        function resolveExpiryValue(mode, customValue) {
            var normalizedMode = mode == null ? "" : String(mode).trim();
            if (normalizedMode === "custom") {
                var normalizedCustom = customValue == null ? "" : String(customValue).trim();
                if (!/^\d+$/.test(normalizedCustom) || parseInt(normalizedCustom, 10) <= 0) {
                    return "";
                }
                return normalizedCustom;
            }

            if (["7", "15", "30"].indexOf(normalizedMode) !== -1) {
                return normalizedMode;
            }

            return "";
        }

        function createEmptyCustomProduct() {
            return {
                name: "",
                pro_size: "",
                pro_type: "",
                id: "",
                image: "",
                price: "",
                footage: "",
                type: "Image",
                licence_type: "",
                extra_details: "",
                currency: $scope.selected_currency || "INR",
            };
        }
        $scope.syncCustomProductCurrencies = function () {
            var currency = $scope.selected_currency || "INR";
            $scope.selected_currency = currency;
            angular.forEach($scope.quotation.product || [], function (product) {
                product.currency = currency;
            });
        };
        $scope.sanitizeProductPrice = function (product) {
            if (!product) {
                return;
            }
            product.price = sanitizeAmountValue(product.price);
        };
        $scope.normalizeCustomProductPrices = function () {
            sanitizeCustomProductPrices($scope.quotation.product);
        };
        $scope.discount_amount_display = "";
        $scope.subsc_discount_amount_display = "";
        $scope.download_discount_amount_display = "";
        $scope.customPromo = createPromoState();
        $scope.subscriptionPromo = createPromoState();
        $scope.downloadPromo = createPromoState();

        function recalculateCustomTotalsV2() {
            var calculation = calculatePromoAdjustedTotals(
                getProductsSubtotal($scope.quotation.product),
                !!$scope.GST,
                $scope.customPromo,
                gst_value
            );

            $scope.tax = calculation.tax;
            $scope.total = calculation.total.toFixed(2);
            $scope.discount_amount_display =
                calculation.discount > 0
                    ? calculation.discount.toFixed(2)
                    : "";
        }

        function recalculateSubscriptionTotalsV2() {
            var calculation = calculatePromoAdjustedTotals(
                $scope.subscriptionprice,
                !!$scope.GSTS,
                $scope.subscriptionPromo,
                gst_value
            );

            $scope.subsc_tax = calculation.tax;
            $scope.subsc_total = calculation.total.toFixed(2);
            $scope.subsc_discount_amount_display =
                calculation.discount > 0
                    ? calculation.discount.toFixed(2)
                    : "";
        }

        function recalculateDownloadTotalsV2() {
            var calculation = calculatePromoAdjustedTotals(
                $scope.downloadprice,
                !!$scope.GSTD,
                $scope.downloadPromo,
                gst_value
            );

            $scope.taxdownload = calculation.tax;
            $scope.total_download = calculation.total.toFixed(2);
            $scope.download_discount_amount_display =
                calculation.discount > 0
                    ? calculation.discount.toFixed(2)
                    : "";
        }

        $scope.clearCustomPromo = function () {
            $scope.customPromo = createPromoState();
            recalculateCustomTotalsV2();
        };

        $scope.clearSubscriptionPromo = function () {
            $scope.subscriptionPromo = createPromoState();
            recalculateSubscriptionTotalsV2();
        };

        $scope.clearDownloadPromo = function () {
            $scope.downloadPromo = createPromoState();
            recalculateDownloadTotalsV2();
        };
        $scope.applyCustomPromo = function (promo, countryId) {
            if (hasPromoState(promo)) {
                $scope.customPromo = createPromoState(promo);
            }

            if (!!$scope.GST && countryId !== 101) {
                alert('This user is belongs to other country are you sure want to apply tax?');
            }

            $scope.normalizeCustomProductPrices();
            recalculateCustomTotalsV2();
        };
        $scope.applySubscriptionPromo = function (promo, countryId) {
            if (hasPromoState(promo)) {
                $scope.subscriptionPromo = createPromoState(promo);
            }

            if (!!$scope.GSTS && countryId !== 101) {
                alert('This user is belongs to other country are you sure want to apply tax?');
            }

            recalculateSubscriptionTotalsV2();
        };
        $scope.applyDownloadPromo = function (promo, countryId) {
            if (hasPromoState(promo)) {
                $scope.downloadPromo = createPromoState(promo);
            }

            if (!!$scope.GSTD && countryId !== 101) {
                alert('This user is belongs to other country are you sure want to apply tax?');
            }

            recalculateDownloadTotalsV2();
        };
        $scope.quotation.product = [createEmptyCustomProduct()];
        $scope.quotation_type_var = "custom";
        $scope.addProduct = function () {
            var newProduct = createEmptyCustomProduct();
            $scope.quotation.product.push(newProduct);
            $scope.syncCustomProductCurrencies();
            setTimeout(function () {
                CKEDITOR.replace(
                    "licence_type-" + $scope.quotation.product.length
                );
            }, 0);
        };

        $scope.$on("fileProgress", function (e, progress) {
            $scope.progress = progress.loaded / progress.total;
        });

        $scope.removeProduct = function (product) {
            if (($scope.quotation.product || []).length <= 1) {
                return;
            }
            var index = $scope.quotation.product.indexOf(product);
            if (index === -1) {
                return;
            }
            $scope.quotation.product.splice(index, 1);
            if (!$scope.quotation.product.length) {
                $scope.quotation.product.push(createEmptyCustomProduct());
            }
            $scope.syncCustomProductCurrencies();
            $scope.getTheTotal();
        };
        $scope.prices = [];
        $scope.getproduct = function (product,secondForm = '') {
            if (product.name != "") {
                $("#loading").show();
                var index = $scope.quotation.product.indexOf(product);
                $http({
                    method: "GET",
                    url:
                        image_path +
                        "api/product/" +
                        product.name +
                        "?type=" +
                        product.type,
                    //url:  'http://localhost/imagefootage/backend/api/product/' + product.name +'?type='+ product.type,
                }).then(
                    function (response) {
                        // console.log(response);
                        if (response.status == "200") {
                            $("#loading").hide();
                            if (product.type == "Image") {
                                $scope.quotation.product[index].name =
                                    response.data[0].product_code;
                                $scope.quotation.product[index].id =
                                    response.data[0].id;
                                if (response.data[0].type == "Royalty Free") {
                                    $scope.quotation.product[index].pro_type =
                                        "royalty_free";
                                } else {
                                    $scope.quotation.product[index].pro_type =
                                        "right_managed";
                                }
                                $scope.quotation.product[index].image =
                                    response.data[0].thumbnail_image;
                                $scope.prices[index] = response.data[0];
                            } else {
                                if (response.data[0].clip_data) {
                                    $scope.quotation.product[index].name =
                                        response.data[0].clip_data.id;
                                    $scope.quotation.product[index].id =
                                        response.data[0].clip_data.n;
                                    $scope.quotation.product[index].image =
                                        "https://p5iconsp.s3-accelerate.amazonaws.com/" +
                                        response.data[2];
                                    $scope.quotation.product[index].footage =
                                        "https://p5resellerp.s3-accelerate.amazonaws.com/" +
                                        response.data[1];
                                } else {
                                    $scope.quotation.product[index].name =
                                        response.data[0].id;
                                    $scope.quotation.product[index].id =
                                        response.data[0].id;
                                    $scope.quotation.product[index].image =
                                        response.data[0].thumbnail
                                    $scope.quotation.product[index].footage =
                                        response.data[0].thumbnail
                                }
                                $scope.prices[index] = [
                                    { size: "4K", pr: "16500" },
                                    { size: "HD (1080)", pr: "11500" },
                                ];
                                //$scope.prices[index] = response.data[0].clip_data.versions;
                                // console.log($scope.prices[index]);
                                //$scope.quotation.product[index] = response.data[0];
                            }
                        }
                    },
                    function (error) {
                        $scope.quotation.product[index].image = ''; // Refresh previous display image
                        $scope.quotation.product[index].value = null;
                        var productIndexId = index + 1;
                        if(secondForm == ''){
                            $("#product_" + productIndexId).val("");
                            alert("image not found");
                        }
                        $("#loading").hide();
                    }
                );
            }
        };

        $scope.getThetotalAmount = function (product) {
            console.log(product);
            var index = $scope.quotation.product.indexOf(product);
            // console.log($scope.prices);
            if (product.type == "Image") {
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
            } else if (product.type == "Footage") {
                getFootageSizeDetails.find(function (entry) {
                    if (entry.type === product.pro_size) {
                        amount = entry.price;
                    }
                });
            } else if (product.type == "Music") {
                getMusicLicenceDetails.find(function (entry) {
                    if (entry.value === product.licence_type.trim()) {
                        amount = entry.price;
                    }
                });
            } else {
                for (let i = 0; i < $scope.prices[index].length; i++) {
                    if (product.pro_size == $scope.prices[index][i].size) {
                        amount = $scope.prices[index][i].pr;
                    }
                }
                // console.log(amount);
            }
            $scope.quotation.product[index].price = amount;
            $scope.getTheTotal();
        };
        /* Subscription and Download  */
        $scope.tax = 0;
        $scope.prod_type_var = "";
        $scope.plan_type_var = "";
        $scope.search = false;
        $scope.taxdownload = 0;

        $scope.quotation_type_set = function (type) {

            $scope.search = false;
            $scope.quotation_type_var = type;
            if (type == "custom") {
                $scope.syncCustomProductCurrencies();
            }
        };
        $scope.getTheTotal = function () {
            if ($scope.quotation_type_var == "subscription") {
                recalculateSubscriptionTotalsV2();
                return;
            }

            if ($scope.quotation_type_var == "download") {
                recalculateDownloadTotalsV2();
                return;
            }

            $scope.normalizeCustomProductPrices();
            recalculateCustomTotalsV2();
        };
        $scope.checkThetax = function (tax_percent, type, promo = {},countryId = '') {
            if (hasPromoState(promo)) {
                $scope.customPromo = createPromoState(promo);
            }

            $scope.GST = !!tax_percent;
            if ($scope.GST && countryId !== 101) {
                alert('This user is belongs to other country are you sure want to apply tax?')
            }

            $scope.normalizeCustomProductPrices();
            recalculateCustomTotalsV2();
        };

        $scope.prod_type = function (type) {
            $scope.prod_type_var = type;
        };
        $scope.plan_type_select = function (type) {
            $scope.plan_type_var = type;
        };

        $scope.getPlans = function () {
            $scope.plansData = [];
            //console.log(product);
            $("#loading").show();
            $http({
                method: "POST",
                url: api_path + "plans",
                data: {
                    quotation_type: $scope.quotation_type_var,
                    prod_type: $scope.prod_type_var,
                    product_dur: $scope.plan_type_var,
                },
            }).then(
                function (response) {
                    $("#loading").hide();
                    if (response.data.status == "success") {
                        $scope.search = true;
                        $scope.plansData = response.data.data;
                        if ($scope.prod_type_var == "foot") {
                            angular.forEach(
                                response.data.data,
                                function (value, key) {
                                    if (value.footage_tier == "1") {
                                        var licence_type = "Commercial";
                                    } else if (value.footage_tier == "2") {
                                        var licence_type = "Non Commercial";
                                    } else if (value.footage_tier == "3") {
                                        var licence_type = "Web Only";
                                    } else {
                                        var licence_type = "FULL RF";
                                    }
                                    $scope.plansData[key][
                                        "package_description"
                                    ] =
                                        value.package_description +
                                        " ( " +
                                        licence_type +
                                        " )";
                                }
                            );
                            // console.log($scope.plansData);
                        }
                    } else {
                        alert("There is no Plan for selection");
                    }
                },
                function (error) {
                    $("#loading").hide();
                }
            );
        };

        $scope.selectPlanfromlist = function (selectedPlanData, type) {
            selectedPlanData = JSON.parse(selectedPlanData);
            // console.log(selectedPlanData);
            // console.log(type);
            $scope.GSTD = false;
            $scope.taxdownload = 0;
            $scope.subsc_tax = ""; // Reset tax
            $scope.selected_plan = selectedPlanData;
            if (type == "download") {
                $scope.downloadprice = selectedPlanData["package_price"];
                $scope.selected_currency = selectedPlanData["currency"];
                recalculateDownloadTotalsV2();
            } else {
                $scope.subscriptionprice = selectedPlanData["package_price"];
                recalculateSubscriptionTotalsV2();
            }
        };

        $scope.checkDownloadtax = function (tax_percent, type,countryId) {
            $scope.GSTD = !!tax_percent;
            if ($scope.GSTD && countryId !== 101) {
                alert('This user is belongs to other country are you sure want to apply tax?')
            }
            recalculateDownloadTotalsV2();
        };

        $scope.checksubsctax = function (tax_percent, type,countryId) {
            $scope.GSTS = !!tax_percent;
            if ($scope.GSTS && countryId !== 101) {
                alert('This user is belongs to other country are you sure want to apply tax?')
            }
            recalculateSubscriptionTotalsV2();
        };

        $scope.submitQuotation = function () {
            // console.log($scope);
            if ($scope.quotation_type_var == "subscription") {
                $scope.submitSubscription();
            } else if ($scope.quotation_type_var == "download") {
                $scope.submitDownload();
            } else {
                $scope.submitCustom();
            }
        };

        $scope.submitDownload = function () {
            // console.log($scope.quotation);
            // console.log($scope);
            if (!$scope.selected_plan) {
                alert("Please select Plan");
                return false;
            } else if (!$scope.downloadprice) {
                alert("Please enter Subtotal");
                return false;
            } else {
                $("#loading").show();
                var resolvedDownloadExpiry = resolveExpiryValue(
                    $scope.download_expiry,
                    $scope.custom_download_expiry
                );
                if (!resolvedDownloadExpiry) {
                    $("#loading").hide();
                    alert("Please select a valid expiry period");
                    return false;
                }

                var sendData = {
                    uid: $("#uid").val(),
                    quotation_type: $scope.quotation_type_var,
                    plan_id: $scope.selected_plan,
                    plan_type_var: $scope.plan_type_var,
                    //"po": $scope.poDownload,
                    //"poDate": $scope.downloadpoDate,
                    expiry_date: resolvedDownloadExpiry,
                    tax: $scope.taxdownload,
                    total: $scope.total_download,
                    subscription_subtotal: $scope.downloadprice,
                    GSTS: $scope.GSTD,
                    currency: $scope.selected_currency || "INR",
                    email: $("#download_email_id").val(),
                };
                // console.log(sendData);
                // console.log($scope.quotation);
                var fd = new FormData();
                // angular.forEach($scope.quotation[0],function(file){
                //     fd.append('file',file);
                // });
                $http({
                    method: "POST",
                    url: base_url + "saveDownloadInvoice",
                    data: sendData,
                    headers: { "Content-Type": undefined },
                }).then(
                    function (response) {
                        $("#loading").hide();
                        if (response.data.this.statuscode == "1") {
                            alert(response.data.this.statusdesc);
                        } else {
                            alert(response.data.this.statusdesc);
                        }
                        window.location =
                            api_path + "users/invoices/" + $("#uid").val();
                    },
                    function (error) {
                        $("#loading").hide();
                    }
                );
            }
        };

        $scope.submitSubscription = function () {
            //  console.log($scope.quotation);
            //  console.log($scope);
            if (!$scope.selected_plan) {
                alert("Please select Plan");
                return false;
            } else if (!$scope.subscriptionprice) {
                alert("Please enter Subtotal");
                return false;
            } else {
                $("#loading").show();
                var resolvedSubscriptionExpiry = resolveExpiryValue(
                    $scope.subsc_expiry_time,
                    $scope.custom_subsc_expiry_time
                );
                if (!resolvedSubscriptionExpiry) {
                    $("#loading").hide();
                    alert("Please select a valid expiry period");
                    return false;
                }

                var sendData = {
                    uid: $("#uid").val(),
                    quotation_type: $scope.quotation_type_var,
                    plan_id: $scope.selected_plan,
                    plan_type_var: $scope.plan_type_var,
                    //"po": $scope.subsc_po,
                    //"poDate": $scope.subsc_poDate,
                    expiry_date: resolvedSubscriptionExpiry,
                    tax: $scope.subsc_tax,
                    total: $scope.subsc_total,
                    subscription_subtotal: $scope.subscriptionprice,
                    GSTS: $scope.GSTS,
                    email: $("#subsc_email_id").val(),
                };
                //  console.log(sendData);
                //  console.log($scope.quotation);
                var fd = new FormData();
                // angular.forEach($scope.quotation[0],function(file){
                //     fd.append('file',file);
                // });
                $http({
                    method: "POST",
                    url: base_url + "saveSubscriptionInvoice",
                    data: sendData,
                    headers: { "Content-Type": undefined },
                }).then(
                    function (response) {
                        $("#loading").hide();
                        if (response.data.this.statuscode == "1") {
                            alert(response.data.this.statusdesc);
                        } else {
                            alert(response.data.this.statusdesc);
                        }
                        window.location =
                            api_path + "users/invoices/" + $("#uid").val();
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
                    },
                    function (error) {
                        $("#loading").hide();
                    }
                );
            }
        };

        $scope.submitCustom = function () {
                $scope.syncCustomProductCurrencies();
                $scope.normalizeCustomProductPrices();
                $scope.quotation.product.map(function (editor, index) {
                    if(editor.pro_type == 'right_managed'){
                        for (var i in CKEDITOR.instances) {
                            if (
                                CKEDITOR.instances[i].element.$.classList.contains(
                                    "licence_type"
                                )
                            ) {
                                let ci = i[i.length - 1] - 1;
                                if (index == ci) {
                                    editor.licence_type =
                                        CKEDITOR.instances[i].getData();
                                }
                            }
                        }
                    }
                    return editor;
                });


            for (var i = 0; i < $scope.quotation.product.length; i++) {
                if ($scope.quotation.product[i].price == undefined || $scope.quotation.product[i].price == "" || $scope.quotation.product[i].price == null) {
                  alert('Sub total cannot be null');
                  return false; // If you want to stop checking after the first null price is found

                }
            }
              $("#loading").show();
            var resolvedCustomExpiry = resolveExpiryValue(
                $scope.expiry_time,
                $scope.custom_expiry_time
            );
            if (!resolvedCustomExpiry) {
                $("#loading").hide();
                alert("Please select a valid expiry period");
                return false;
            }

            var sendData = {
                uid: $("#uid").val(),
                end_client: $("#end_client").val(),
                quotation_type: $scope.quotation_type_var,
                products: $scope.quotation,
                promoCode: $scope.promoCode,
                //"po": $scope.po,
                //"poDate": $scope.poDate,
                expiry_date: resolvedCustomExpiry,
                tax: $scope.tax,
                total: $scope.total,
                GST: $scope.GST,
                email: $("#email_id").val(),
                flag: $("#flag").val(),
                promo_code_id: $("#promo_code_id").val(),
            };
            //  console.log(sendData);
            //  console.log($scope.quotation);
            var fd = new FormData();
            // angular.forEach($scope.quotation[0],function(file){
            //     fd.append('file',file);
            // });
            $http({
                method: "POST",
                url: api_path + "saveInvoice",
                data: sendData,
                headers: { "Content-Type": undefined },
            }).then(
                function (response) {
                    $("#loading").hide();
                    if (response.data.this.statuscode == "1") {
                        alert(response.data.this.statusdesc);
                    } else {
                        alert(response.data.this.statusdesc);
                    }
                    window.location =
                        api_path + "users/invoices/" + $("#uid").val();
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
                },
                function (error) {
                    $("#loading").hide();
                }
            );
        };

        $scope.checkProduct = function (product_type) {
            //  console.log(product_type);
        };
    }
);
