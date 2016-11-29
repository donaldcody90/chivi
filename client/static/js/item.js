(function ($, w) {
    if (typeof $.fn.slick === 'function') {
        $('.hz-slider')
            .slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                focusOnSelect: true,
                arrows: true,
                //centerMode: true,
                prevArrow: '<button type="button" class="slick-prev"><i class="glyphicon glyphicon-menu-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="glyphicon glyphicon-menu-right"></i></button>'
            })
            .on('click', '.item', function (event) {
                var img = $(this).find('img:first').attr('data-view');
                $('.image-featured > img').attr('src', img);
            }).on('click', '.slick-arrow', function () {
            var currentSlide = $('.hz-slider').slick('slickCurrentSlide');
            var obj = $('.hz-slider').find('.slick-active.slick-current[data-slick-index="' + currentSlide + '"]');
            if (obj.length === 1) {
                var img = obj.find('img:first').attr('data-view');
                $('.image-featured > img').attr('src', img);
            }
        });
    }
	
	
	hzDialogInit = function () {
            if ($('.hz-dialog').length === 0) {
                $('body').append('<div class="hz-dialog" title=""></div>');
            }
            $("body").on('click', '.btn-dialog-close', function () {
                $(this).closest(".hz-dialog").dialog('close');
            }).on('click', '.btn-redirect-cart', function () {
                $(this).closest(".hz-dialog").dialog('close');
            });
            return $('.hz-dialog');
        };
		
    hzAlert = function (title, msg) {
            var dialog = hzDialogInit();
            dialog.html(msg).dialog({
                title: title,
                resizable: false,
                modal: true,
                width: 400,
                dialogClass: 'fixed-dialog',
                show: {
                    effect: "fade",
                    duration: 200
                },
                buttons: {
                    close: {
                        text: 'Đóng',
                        class: 'btn hz-btn-warning btn-sm',
                        click: function () {
                            $(this).dialog('close');
                        }
                    }
                }
            });
        };
    
	hzConfirm =function (title, msg, buttons) {
            var dialog = hzDialogInit();
            dialog.attr('title', title)
                .html(msg)
                .dialog({
                    title: title,
                    resizable: false,
                    modal: true,
                    width: 400,
                    dialogClass: 'fixed-dialog',
                    show: {
                        effect: "fade",
                        duration: 200
                    },
                    buttons: buttons
                });
        };
		
    hzPrompt = function () {

    };
	
	
})(jQuery, jQuery(window));

/* build order FORM */
$.fn.itemOrderForm = function (opt) {
    var options = $.extend({}, opt);
    return this.each(function () {
        var itemOrderForm = $(this);

        itemOrderForm.selected = 0;
        itemOrderForm.amount = 0;
        itemOrderForm.firstPropertyId = 0;
        itemOrderForm.firstPropertyValueId = 0;

        itemOrderForm.buildForm = function () {
            itemOrderForm.calculateSkuPrice();
            var html = "";
            // Trường hợp chỉ có 1 Property
            if (options.properties.length == 1) {
                var property = options.properties[0];
                html = itemOrderForm.buildPropertyTable(property);
                $('.item-select-sku', itemOrderForm).html(html);
                itemOrderForm.addRowActions();
            } else { // Trường hợp có 2 Property
                var firstProperty = options.properties[0];
                html = itemOrderForm.buildPropertyList(firstProperty);
                $('.item-select-property-list', itemOrderForm).html(html);
                itemOrderForm.addListActions();
                // Lựa chọn PropertyListItem đầu tiên.
                $('.first-property-items .item-selected:first', itemOrderForm).trigger('click');
                itemOrderForm.calculateSelectedQuantity();

            }
        };

        itemOrderForm.getSkuByProperties = function (properties) {
            if (itemOrderForm.firstPropertyValueId) {
                properties.push(itemOrderForm.firstPropertyValueId);
            }
            for (var i = 0; i < options.skus.length; i++) {
                var sku = options.skus[i];
                if (sku.properties) {
                    if (properties.length == sku.properties.length) {
                        var isSku = true;
                        for (var j = 0; j < sku.properties.length; j++) {
                            var ok = false;
                            for (var k = 0; k < properties.length; k++) {
                                if (sku.properties[j].value_id == properties[k]) {
                                    ok = true;
                                    break;
                                }
                            }
                            if (!ok)
                                isSku = ok;
                        }
                       if (isSku) {
                            return sku;
                        }
                    }
                }
            }
            return null;
        };

        itemOrderForm.getCurrentPrice = function () {
            if (options.product.type == 2) {
                var price = 0;
                for (var i = 0; i < options.priceRanges.length; i++) {
                    if (price == 0 || itemOrderForm.selected >= options.priceRanges[i].quantity) {
                        price = options.priceRanges[i].price;
                    }
                }

                return price;
            }
            return 0;
        };

        itemOrderForm.calculateSkuPrice = function () {			
            if (options.product.type == 2) {
                var price = itemOrderForm.getCurrentPrice();
                for (var i = 0; i < options.skus.length; i++) {
                    options.skus[i].price = price;
                }
                itemOrderForm.buildSkuPrice(price);
            }
        };

        itemOrderForm.buildSkuPrice = function (price) {
            $('.item-price', itemOrderForm).html(parseFloat(price).formatMoney(0, ',', '.'));
        };

        itemOrderForm.setSkuQuantity = function (id, quantity) {
            for (var i = 0; i < options.skus.length; i++) {
                if (options.skus[i].id == id) {
                    options.skus[i].selected = quantity;
                    break;
                }
            }
            itemOrderForm.calculateSelectedQuantity();
        };

        itemOrderForm.calculateSelectedQuantity = function () {
            itemOrderForm.selected = 0;
            itemOrderForm.amount = 0;
            // Tính tổng số đã được chọn.
            for (var i = 0; i < options.skus.length; i++) {
                itemOrderForm.selected +=parseInt(options.skus[i].selected);
            }
            // Tính giá theo khoảng giá.
            itemOrderForm.calculateSkuPrice();
            // Tính tổng tiền và summary (thống kê số lượng theo thuộc tính đầu tiên).
            var summary = {};
            var firstProperty = options.properties[0];

            for (var i = 0; i < options.skus.length; i++) {
                var sku = options.skus[i];
                itemOrderForm.amount += (sku.selected * sku.price);
                for (var j = 0; j < sku.properties.length; j++) {
                    var p = sku.properties[j];
                    if (p.id == firstProperty.id) {
                        if (typeof summary[p.value_id] == 'undefined') {
                            summary[p.value_id] = 0;
                        }
                        summary[p.value_id] += sku.selected;
                    }
                }
            }
            // Build Summary
            var htmlSummary = '';

            if (summary) {
                for (var i = 0; i < firstProperty.values.length; i++) {
                    var value = firstProperty.values[i];
                    if (typeof summary[value.property_value_id] !== 'undefined' && summary[value.property_value_id] > 0) {
                        htmlSummary += '<li><div class="s-name tsf">' + value.value + '</div><span class="s-quantity"><strong>' + summary[value.property_value_id] + '</strong></span></li>';
                    }
                }
            }
            if (htmlSummary) {
                $('.sku-items', itemOrderForm).html(htmlSummary);
            } else {
                $('.sku-items', itemOrderForm).html('<li class="text-center">Chưa có sản phẩm nào được chọn</li>');
            }

            $('.txtTotalQuantity', itemOrderForm).html(parseInt(itemOrderForm.selected).formatMoney(0, ',', '.'));
            $('.txtTotalMoney', itemOrderForm).html(parseFloat(itemOrderForm.amount).formatMoney(0, ',', '.'));
        };

        itemOrderForm.addListActions = function () {
            $('.first-property-items .item-selected', itemOrderForm).each(function () {
                var tag = $(this);
                $(tag).click(function () {
                    if ($(tag).hasClass('selected')) return;
                    $('.first-property-items .item-selected', itemOrderForm).removeClass('selected');
                    $(tag).addClass('selected');

                    // Select current first property
                    itemOrderForm.firstPropertyId = $(tag).data('property-id');
                    itemOrderForm.firstPropertyValueId = $(tag).data('property-value-id');

                    var secondProperty = options.properties[1];
                    html = itemOrderForm.buildPropertyTable(secondProperty);
                    $('.item-select-property-table', itemOrderForm).html(html);
                    itemOrderForm.addRowActions();
                });
            });
        };

        itemOrderForm.addRowActions = function () {
            $('.property-items tbody tr', itemOrderForm).each(function () {
                var tr = $(this);
                tr.getCurrentQuantity = function () {
                    var v = parseInt($('.txtQuantity', tr).val());
                    if (isNaN(v)) {

                    }
                    return v;
                };

                tr.setQuantity = function (qty) {
                    if (isNaN(qty)) {
                        qty = 0;
                    }
                    if (qty < 0) {
                        qty = 0;
                    } else if (qty > tr.config.quantity_max) {
                        qty = tr.config.quantity_max;
                    }
                    if (qty % tr.config.ws_rule_number !== 0) {
                        qty = qty - (qty % tr.config.ws_rule_number);
                    }
                    itemOrderForm.setSkuQuantity(tr.config.sku_id, qty);
                    $('.txtQuantity', tr).val(qty);
                };

                tr.config = {
                    sku_id: $(tr).data('sku-id'),
                    ws_rule_number: $(tr).data('ws-rule-number'),
                    quantity_max: $(tr).data('quantity-max')
                };
                $('.btnIncrease', tr).click(function () {
                    var v = tr.getCurrentQuantity();
                    v = v + tr.config.ws_rule_number;
                    tr.setQuantity(v);
                });

                $('.btnDecrease', tr).click(function () {
                    var v = tr.getCurrentQuantity();
                    v = v - tr.config.ws_rule_number;
                    tr.setQuantity(v);
                });
                $('.txtQuantity', tr).change(function () {
                    var v = parseInt($(this).val());
                    tr.setQuantity(v);
                });

                $('.item-tooltip:visible').each(function (e) {
                    var _this = $(this),
                        image = _this.find('img.image-tooltip:first').data('large'),
                        w = _this.width(),
                        offset = _this.offset();

                    if (typeof image !== 'undefined' && image != '') {
                        _this.attr('data-id', e + 1);
                        var thumb = '<div class="property-image-thumb" id="property-thumb-' + (e + 1) + '" style="left: ' + (offset.left - 75 + (w / 2)) + 'px; top: ' + (offset.top - 165) + 'px;"><img class="" src="' + image + '"></div>';
                        $('body').append(thumb);
                    }
                }).hover(function () {
                    // Hover in
                    $('#property-thumb-' + $(this).data('id')).show();
                }, function () {
                    // hover out
                    $('.property-image-thumb').hide();
                });
            });
        };

        itemOrderForm.getFormattedValue = function (value, type) {
            var html = '';
            if (value.type == 1) {
                if (type == 'table') {
                    html += '<strong class="tsf item-tooltip secondary-propery" data-id="' + value.property_value_id + '">' +
                        '<img src="' + value.type_value.thumb + '" class="image-tooltip" data-large="' + value.type_value.large + '" />' +
                        '</strong>';
                    html += '<p class="tsf">' + value.value + '</p>';
                } else {
                    html += '<img class="image-tooltip" src="' + value.type_value.thumb + '" alt="" data-large="' + value.type_value.large + '">';
                }

            } else if (value.type == 2) {
                if (type == 'table') {
                    html += '<strong class="tsf item-tooltip secondary-propery" title="' + value.value + '">' +
                        '<span class="color-holder" style="background-color: ' + value.type_value + '"></span>' +
                        '</strong>';
                    html += '<p class="tsf">' + value.value + '</p>';
                } else {
                    html += '<span class="color-holder" style="background-color: ' + value.type_value + '"></span>';
                }

            } else {
                html += '<p class="tsf">' + value.value + '</p>';
            }

            return html;
        };

        itemOrderForm.buildPropertyList = function (property) {
            var propertyValueHtml = '';
            for (var i = 0; i < property.values.length; i++) {
                propertyValueHtml += '<a class="pf-item pf-cs item-selected tsf item-tooltip" ' +
                    'href="javascript:void(0);" title="' + property.values[i].value + '" data-property-id="' + property.id + '" ' +
                    'data-property-value-id="' + property.values[i].property_value_id + '">' +
                    '<span class="tsf item-wrap">' + itemOrderForm.getFormattedValue(property.values[i], 'list') + '</span>' +
                    '</a>';
            }
            var html = '<table class="table first-property-items" style="margin-bottom: 0;">' +
                '<tr>' +
                '<td style="width: 15%; border: none; white-space: nowrap;"><strong><p class="tsf">' + property.name + '</p></strong></td>' +
                '<td style="border: none;">' +
                propertyValueHtml +
                '</td>' +
                '</tr>' +
                '</table>';
            return html;
        };

        itemOrderForm.buildPropertyTable = function (property) {
            var html = '<table class="table property-items" style="margin-bottom: 0;">' +
                '<thead>' +
                '<tr>' +
                '<th class="tsf">' + property.name + '</th>' +
                '<th style="width: 150px;" class="text-right">Giá</th>' +
                '<th style="width: 100px;" class="text-right">Còn lại</th>' +
                '<th style="width: 200px;" class="text-center">Số lượng</th>' +
                '</tr>' +
                '</thead><tbody>';

            for (var i = 0; i < property.values.length; i++) {
                var propertyValue = property.values[i];
                var sku = itemOrderForm.getSkuByProperties([propertyValue.property_value_id]);
                if (!sku) {
                    continue;
                }
                html += '<tr class="ps-item" data-sku-id=' + sku.id + ' data-property-id="' + property.id + '" data-property-value-id="' + propertyValue.id + '" data-ws-rule-number="' + options.product.ws_rule_number + '" data-quantity-max="' + sku.quantity + '">' +
                    '<td>' + itemOrderForm.getFormattedValue(propertyValue, 'table') + '</td>' +
                    '<td class="item-price text-right">' + parseFloat(sku.price).formatMoney(0, ',', '.') + '</td>' +
                    '<td class="text-right item-quantity">' + parseInt(sku.quantity).formatMoney(0, ',', '.') + '</td>' +
                    '<td class="text-center">' +
                    '<span class="ui-spinner ui-widget ui-widget-content ui-corner-all" style="height: 28px;">' +
                    '<input type="text" class="num-range ui-spinner-input txtQuantity" value="' + sku.selected + '" aria-valuemin="0" aria-valuenow="0" autocomplete="off" role="spinbutton" data-valuemax="5" aria-valuemax="5">' +
                    '<a class="ui-spinner-button ui-spinner-up ui-corner-tr ui-button ui-widget ui-state-default ui-button-text-only btnIncrease" tabindex="-1" role="button">' +
                    '<span class="ui-button-text"><span class="ui-icon ui-icon-triangle-1-n">+</span></span></a>' +
                    '<a class="ui-spinner-button ui-spinner-down ui-corner-br ui-button ui-widget ui-state-default ui-button-text-only btnDecrease" tabindex="-1" role="button">' +
                    '<span class="ui-button-text"><span class="ui-icon ui-icon-triangle-1-s">-</span></span></a></span>' +
                    '</td>' +
                    '</tr>';
            }
            html += '</tbody></table>';

            return html;
        };

		
		
		
		
		
		
		
        var form = $('#frm-add-cart');
        var error = null;
        var btnAddToCart = $('.btn-add-cart', itemOrderForm);
        btnAddToCart.lock = function () {
            btnAddToCart.html('Đang xử lý ...');
            btnAddToCart.attr('disabled', 'disabled');
        };
        btnAddToCart.unlock = function () {
            btnAddToCart.html('Chọn mua');
            btnAddToCart.removeAttr('disabled');
        };
        btnAddToCart.click(function () {
            error = null;
            btnAddToCart.lock();

            if (itemOrderForm.selected > 0) {
                if (itemOrderForm.selected % options.product.ws_rule_number == 0) {
                    if (itemOrderForm.selected >= options.product.quantity_min) {
                        var submitData = [];
                        for (var i = 0; i < options.skus.length; i++) {
                            var sku = options.skus[i];
                            if (sku.selected > 0) {
                                submitData.push({'id': sku.id, 'quantity': sku.selected});
                            }
                        }
						console.log(submitData);
                        if (submitData.length) {
                            $.post(form.attr('action'), form.serialize() + '&data=' + JSON.stringify(submitData), function (res) {
                                btnAddToCart.unlock();
                                if (res.status == 'success') {
                                    var newHtml = '<div class="row-option">' +
                                        '<div class="ui-dialog-buttonpane ui-widget-content ui-helper-clearfix">' +
                                        '<div class="ui-dialog-buttonset">' +
                                        '<a href="/shopping-cart" target="_blank" title="Giỏ hàng" class="btn hz-btn-info btn-sm ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only btn-redirect-cart"><span class="ui-button-text">Giỏ hàng</span>  </a>' +
                                        '<button type="button" class="btn hz-btn-primary btn-sm ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only btn-dialog-close" role="button"><span class="ui-button-text">Mua tiếp</span></button>' +
                                        '</div>' +
                                        '</div>' +
                                        '</div>';
                                    hzConfirm('Giỏ hàng', res.message + '<p>* Lưu ý: Quý khách nên đặt mua nhiều sản phẩm cùng một shop, trong cùng một đơn hàng để được phí vận chuyển rẻ hơn!</p>' + newHtml, {});
                                } else {
                                    hzAlert('Giỏ hàng', res.message);
                                }
                            },'JSON');
                        }
                    } else {
                        error = 'Quý khách vui lòng đặt mua từ ' + options.product.quantity_min + ' sản phẩm trở lên.';
                    }
                } else {
                    error = 'Số lượng sản phẩm đặt mua phải là bội số của ' + options.product.ws_rule_number + '.';
                }
            } else {
                error = 'Quý khách vui lòng chọn số lượng sản phẩm muốn đặt hàng.';
            }

            if (error !== null) {
                hzAlert('Giỏ hàng', error);
				btnAddToCart.unlock();
				return false;
                
            }

        });

        itemOrderForm.buildForm();
    });
};


/* tab in product detail */
$('body').on('click', '#tab-product-comment', function () {
    var _this = $(this);
    if ($('#product-comment').is(':empty')) {
        $.ajax({
            url: _this.data('action'),
            type: "POST",
            dataType: "json",
            async: false,
            success: function (data) {
                if (data) {
                    $('#product-comment').html(data);
                    _this.tab('show');
                }
            }
        });
    }
}).on('submit', '#form-comment-parent', function (e) {
    if (user.isGuest === true) {
        $.hzAlert('Bạn chưa đăng nhập', 'Quý khách vui lòng đăng nhập để gửi câu hỏi về sản phẩm này cho người bán.');
        return false;
    }
    e.preventDefault();
    e.stopImmediatePropagation();
    var _this = $(this);
    var formData = $(this).serialize();
    $.ajax({
        url: $(this).attr('action'),
        type: "POST",
        dataType: "json",
        data: formData,
        async: false,
        success: function (data) {
            if (data.status == 'login') {
                $.hzAlert('Bạn chưa đăng nhập', 'Quý khách vui lòng đăng nhập để gửi câu hỏi về sản phẩm này cho người bán.');
            } else {
                $('#product-comment').html(data.data);
            }
        }
    });
}).on('click', '.reply-comment-item', function (e) {
    e.preventDefault();
    var _li = $(this).closest('li');
    var _id = _li.attr('data-id');
    var _this = $(this);

    if (!$(this).hasClass('close')) {
        if ($('#comment-form-' + _id).length === 0) {
            $.ajax({
                url: _this.attr('href'),
                type: "POST",
                dataType: "json",
                data: {id: _id},
                async: false,
                success: function (data) {
                    if (data) {
                        _li.append('<div id="comment-form-' + _id + '">' + data + '</div>');
                        $('html,body').animate({scrollTop: $('#comment-form-' + _id).offset().top - 50}, 500);
                        $('#productcommentform-content', _li).focus();
                    }
                }
            });
        }
        $('#comment-form-' + _id).show();
        $('html,body').animate({scrollTop: $('#comment-form-' + _id).offset().top - 50}, 500);
        $('#productcommentform-content', _li).focus();
        $(this).html('<i class="fa fa-times"></i> Đóng').addClass('close');
    } else {
        $(this).html('<i class="fa fa-reply"></i> Trả lời').removeClass('close');
        $('#comment-form-' + _id).hide();
    }
    return false;
}).on('click', '#link-pager-comment a', function (e) {
    e.preventDefault();
    $.get(this.href, {ajax: true}, function (html) {
        $('#product-comment').html(html);
    });
}).on('click', '.send-comment-children', function (e) {
    if (user.isGuest === true) {
        $.hzAlert('Bạn chưa đăng nhập', 'Quý khách vui lòng đăng nhập để gửi câu hỏi về sản phẩm này cho người bán.');
        return false;
    }
    e.preventDefault();
    e.stopImmediatePropagation();
    var myForm = $(this).closest('.comment-children-form');
    var formData = myForm.serialize();
    $.ajax({
        url: myForm.attr('action'),
        type: "POST",
        dataType: "json",
        async: false,
        data: formData,
        success: function (data) {
            if (data) {
                if (data.status == 'success') {
                    if ($('#comment-child-' + data.parentId).length == 0) {
                        $(myForm).before('<div class="box-comment-child"><ul id="comment-child-' + data.parentId + '" class="comment-child"><li><div class="header"><b>' + data.userName + ' </b>' +
                            '<span> 1 giây trước</span></div><div class="comment-content-sub">' + data.content + '</div></li></ul></div>');
                    } else {
                        $('#comment-child-' + data.parentId).append('<li><div class="header"><b>' + data.userName + ' </b>' +
                            '<span> 1 giây trước</span></div><div class="comment-content-sub">' + data.content + '</div></li>');
                    }
                    myForm.find('textarea').val('');
                }
                if (data.status == 'login') {
                    $.hzAlert('Bạn chưa đăng nhập', 'Quý khách vui lòng đăng nhập để gửi câu hỏi về sản phẩm này cho người bán.');
                }
            }
        }
    });
    return false;
}).on('click', '#productcommentform-content', function (e) {
    if (user.isGuest === true) {
        $.hzAlert('Bạn chưa đăng nhập', 'Quý khách vui lòng đăng nhập để gửi câu hỏi về sản phẩm này cho người bán.');
    }
})

/* product tabbb */
$(window).load(function () {
    if (window.location.hash) {
        var hash = window.location.hash.substring(1);
        if (hash == 'comment') {
            $('#tab-product-comment').click();
            $('html,body').animate({scrollTop: $('#product-tabs').offset().top - 10}, 500);
        }
    }
});

$.fn.showFeedback = function () {
    var _this = $(this);
    $('#tab-product-feedback').on('click', function () {
        $.ajax({
            url: $(this).data('action'),
            type: 'POST',
            dataType: 'json',
            async: false,
            success: function (data) {
                if (data && data.status == 'success') {
                    _this.html(data.content);
                    _this.renderRating();
                    _this.ajaxPagination();
                }
            }
        });
    });
}

$.fn.renderRating = function () {
    var _this = $(this);
    $('.point-rateyo', _this).each(function (e) {
        $(this).rateYo({
            fullStar: true,
            starWidth: "12px",
            spacing: "3px",
            readOnly: true,
            rating: $(this).data('rating'),
        });
    });
}

$.fn.ajaxPagination = function () {
    var _this = $(this);
    var _page = $('.pagination li a', _this);
    $(_page.selector).each(function () {
        $(this).click(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: $(this).attr('href'),
                async: false,
                dataType: 'JSON',
                success: function (data) {
                    _this.html(data.content);
                    _this.renderRating();
                    _this.ajaxPagination();
                }
            });

        });
    });
}

Number.prototype.formatMoney = function (c, d, t) {
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};