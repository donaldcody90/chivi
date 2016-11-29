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

if (!String.prototype.repeat) {
    String.prototype.repeat = function (num) {
        return new Array(num + 1).join(this);
    }
}


(function ($) {
    $.extend({
        getProvince: function (opt) {
            var options = $.extend({}, opt);
            var elements = options.elements ? options.elements : {
                province: '#province',
                district: '#district',
                ward: '#ward'
            };

            var selected = options.selected ? options.selected : {
                province: '',
                district: '',
                ward: ''
            };

            var remote = options.remote ? options.remote : LT_ROOT_URL + '/site/ajax-get-province';

            var defaultText = {
                province: $(elements.province).html(),
                district: $(elements.district).html(),
                ward: $(elements.ward).html()
            };

            $.post(remote, {type: 'province', parentId: 0, level: 1, selectedId: selected.province}, function (res) {
                $(elements.province).html(res);
                $(elements.district).html(defaultText.district);
                $(elements.ward).html(defaultText.ward);
                if (selected.province != '' || selected.province > 0) {
                    $(elements.province).change();
                }
            });

            $(elements.province).change(function () {
                if ($(this).val() == '') {
                    $(elements.district).html(defaultText.district);
                } else {
                    $.post(remote, {
                        type: 'province',
                        parentId: $(this).val(),
                        level: 2,
                        selectedId: selected.district
                    }, function (res) {
                        $(elements.district).html(res);
                        $(elements.ward).html(defaultText.ward);
                        if (selected.district != '' || selected.district > 0) {
                            $(elements.district).change();
                        }
                    });
                }
            });

            $(elements.district).change(function () {
                if ($(this).val() == '') {
                    $(elements.ward).html(defaultText.ward);
                } else {
                    $.post(remote, {
                        type: 'province',
                        parentId: $(this).val(),
                        level: 3,
                        selectedId: selected.ward
                    }, function (res) {
                        $(elements.ward).html(res).change();
                    });
                }
            });
        },
        readFile: function (file) {
            if (typeof file === 'undefined') return null;

            var reader = new FileReader();
            var deferred = $.Deferred();

            reader.onload = function (event) {
                deferred.resolve(event.target.result);
            };

            reader.onerror = function () {
                deferred.reject(this);
            };

            reader.readAsDataURL(file);

            return deferred.promise();
        },
        hzDialogInit: function () {
            if ($('.hz-dialog').length === 0) {
                $('body').append('<div class="hz-dialog" title=""></div>');
            }
            $("body").on('click', '.btn-dialog-close', function () {
                $(this).closest(".hz-dialog").dialog('close');
            }).on('click', '.btn-redirect-cart', function () {
                $(this).closest(".hz-dialog").dialog('close');
            });
            return $('.hz-dialog');
        },
        hzAlert: function (title, msg) {
            var dialog = $.hzDialogInit();
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
        },
        hzConfirm: function (title, msg, buttons) {
            var dialog = $.hzDialogInit();
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
        },
        hzPrompt: function () {

        }
    });

    if (typeof $.fn.hzInputFile === 'undefined') {
        $.fn.hzInputFile = function (opt) {
            var options = $.extend({}, opt);

            var buttonClassName = options.class ? options.class : 'btn btn-default';

            var template = '<div class="input-item">' +
                '<i class="glyphicon glyphicon-open-file"></i>' +
                '<span class="file-label" id="label-{id}">Không có file được chọn</span>' +
                '</div>';

            this.css({
                opacity: 0,
                position: 'absolute',
                top: 0, right: 0,
                bottom: 0, left: 0,
                '-ms-filter': "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)",
                filter: 'alpha(opacity=50)'
            }).each(function (e) {
                var _this = $(this);

                var id = e + 2108;
                _this.attr('data-id', id);

                if (_this.attr('type') == 'file') {
                    _this.wrapAll('<div class="' + buttonClassName + ' input-file-wrap" id="input-wrap-' + id + '" data-id="' + id + '"></div>');
                    _this.parent()
                        .append(template.replace('{id}', id));
                }

                $('body').append('<input type="hidden" id="val-hidden-' + id + '"/>');
            }).change(function () {
                var itemId = $(this).data('id');
                var btn = $('#label-' + itemId);
                var wrap = $('#input-wrap-' + itemId);
                var text = '';

                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#val-hidden-' + itemId).val(e.target.result);
                };
                reader.readAsDataURL($(this)[0].files[0]);

                var val = $(this).val().split('\\');
                var fileName = val[val.length - 1];
                if (typeof fileName != 'undefined') {
                    if (fileName.length > 20) {
                        fileName = fileName.substr(0, 5) + '...' + fileName.substr(fileName.length - 12, 12);
                    }
                    text += ' ' + fileName;
                } else {
                    text += ' Không có file được chọn';
                }
                btn.html(text);
            });

            $('.input-file-wrap')
                .popover({
                    trigger: 'hover',
                    title: 'Xem trước ảnh upload',
                    content: function () {
                        var itemId = $(this).data('id');
                        var itemVal = $('#val-hidden-' + itemId).val();
                        if (itemVal != '') {
                            return '<div class="responsive-img" style="background-color: #fff;"><img src="' + itemVal + '"></div>';
                        } else {
                            var itemSrc = $(this).find('input[type="file"]:first').data('src');
                            return itemSrc != '' ? '<div class="responsive-img" style="background-color: #fff;"><img src="' + itemSrc + '"></div>' : 'Chưa có ảnh được chọn';
                        }
                    },
                    container: 'body',
                    placement: 'right',
                    html: true
                });
        };
    }

    $('.hz-input-file').hzInputFile();

    $.fn.hzParseJSON = function (str) {
        if (!str) {
            str = this.val();
        }
        if (!str) return {};

        var result = $.parseJSON(str);
        if (typeof result !== 'object') {
            result = this.hzParseJSON(result);
            return false;
        }
        return result;
    };

    $.fn.hzAddFavorite = function (opt) {
        var options = $.extend({}, opt);
        var _this = this,
            remote = options.remote ? options.remote : LT_ROOT_URL + '/favorite/ajax-add',
            remoteGet = options.remoteGet ? options.remoteGet : LT_ROOT_URL + '/favorite/ajax-get';

        _this.click(function () {
            var item = $(this);
            if (!item.hasClass('hz-disabled')) {
                var data = item.data();
                $.ajax({
                    url: remote,
                    data: data,
                    method: 'post',
                    xhrFields: {
                        withCredentials: true
                    }
                }).done(function (res) {
                    $.hzAlert('Thêm vào yêu thích', res.message);
                    if (res.status == 'success') {
                        $('.hz-favorite[data-id="' + data.id + '"][data-type="' + data.type + '"]').addClass('hz-disabled');
                        item.addClass('hz-disabled');
                    }
                });

            } else {
                $.hzAlert('Thêm vào yêu thích', 'Bạn đã yêu thích mục này.');
            }
            return false;
        });

        $(window).load(function () {
            var arrayId = [];
            var arrayType = [];
            _this.each(function (e) {
                var __this = $(this);
                arrayId.push(parseInt(__this.data('id')));
                arrayType.push(__this.data('type'));
            });
            var dataOnPage = {
                id: arrayId,
                type: arrayType,
                _csrf: yii.getCsrfToken()
            };

            if ($.isEmptyObject(dataOnPage.id) === false) {
                $.ajax({
                    url: remoteGet,
                    data: dataOnPage,
                    method: 'post',
                    xhrFields: {
                        withCredentials: true
                    }
                }).done(function (res) {
                    $.each(res, function (k, v) {
                        $('.hz-favorite[data-id="' + v.id + '"][data-type="' + v.type + '"]').addClass('hz-disabled');
                    });
                });
            }
        });
    };

    $('.hz-favorite').hzAddFavorite();
})(jQuery);
;
(function ($) {
    $.fn.wrapLongTitle = function (options) {
        return this.each(function () {
            var plugin = $(this);
            plugin.maxTitleHeight = 36;

            if (typeof options !== "undefined" && typeof options.maxTitleHeight !== "undefined") {
                plugin.maxTitleHeight = options.maxTitleHeight;
            }
            plugin.init = function () {
                var h = $(plugin).height();
                var nt = $(plugin).html().trim();
                if (h > plugin.maxTitleHeight) {
                    while (true) {
                        if (h <= plugin.maxTitleHeight) {
                            break;
                        }
                        $(plugin).html(nt + ' ...');
                        h = $(plugin).height();
                        nt = nt.substring(0, nt.lastIndexOf(' '));
                    }
                }
            };
            plugin.init();
        });
    }
    $.fn.wrapLongTitleOneLine = function (options) {
        return this.each(function () {
            var plugin = $(this);
            plugin.maxTitleHeight = 18;

            if (typeof options !== "undefined" && typeof options.maxTitleHeight !== "undefined") {
                plugin.maxTitleHeight = options.maxTitleHeight;
            }
            plugin.init = function () {
                var h = $(plugin).height();
                var nt = $(plugin).html().trim();
                if (h > plugin.maxTitleHeight) {
                    while (true) {
                        if (h <= plugin.maxTitleHeight) {
                            break;
                        }
                        $(plugin).html(nt + ' ...');
                        h = $(plugin).height();
                        nt = nt.substring(0, nt.lastIndexOf(' '));
                    }
                }
            };
            plugin.init();
        });
    }
})(jQuery);

$(document).ready(function () {
    $(".remove-favorite-product").click(function () {
        var _this = $(this);
        var productId = _this.attr('data-id');
        var urlFavorite = _this.attr('href');
        //ajax remove product favorite
        jQuery.post(urlFavorite, {'productId': productId}).done(function (data) {
            if (data && data.status == "error" && data.url) {
                location.href = data.url;
            } else if (data.status == "pass") {
                //remove khoi product
                alert('Xóa sản phẩm khỏi danh sách yêu thích thành công !')
                _this.closest('.product-favorited').remove();
            }
        });
        return false;
    });
    $('.footer').on('submit', 'form#registerEmail', function (e) {
        var formData = new FormData(this);
        e.preventDefault();
        e.stopImmediatePropagation();
        var urlAjax = LT_ROOT_URL + $(this).attr('action');
        $.ajax({
            url: urlAjax,
            type: "POST",
            dataType: "JSON",
            async: false,
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                //if (data.status == "success") {
                $('form#registerEmail').remove();
                $('.register-new-feed').append('<p>Bạn đã đăng ký nhận thông tin khuyến mãi thành công.<br/> Thông tin của bạn sẽ được giữ kín tuyệt đối, và bạn có thể hủy đăng ký bất cứ lúc nào.</p>')
                //} else {
                //    if (data.message) {
                //
                //    }
                //}
            }
        });
    });
});
$(function () {
    $("img.lazy").lazyload();
});