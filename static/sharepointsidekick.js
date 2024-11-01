var ImageCode = {
   
    init: function () {
        jQuery("#lnkUpdateCode").click(function () {
            ImageCode.generateUrl()
        });
        jQuery("#lnkResetCode").click(function () {
            ImageCode.reset()
        });
        jQuery("#txtBorderColor").ColorPicker({
            onBeforeShow: function () {
                jQuery(this).ColorPickerSetColor(this.value)
            },
            onShow: function (A) {
                jQuery(A).slideDown("normal");
                return false
            },
            onHide: function (A) {
                jQuery(A).slideUp("normal");
                return false
            },
            onChange: function (A, C, B) {
                jQuery("#txtBorderColor").val(C);
                jQuery("#spnBorderColor").css("backgroundColor", "#" + C)
            },
            onSubmit: function (A, C, B) {
                jQuery("#txtBorderColor").val(C);
                jQuery("#spnBorderColor").css("backgroundColor", "#" + C)
            }
        }).change(function () {
            jQuery("#spnBorderColor").css("backgroundColor", "#" + jQuery(this).val())
        });
        jQuery("#txtTextBackColor").ColorPicker({
            onBeforeShow: function () {
                jQuery(this).ColorPickerSetColor(this.value)
            },
            onShow: function (A) {
                jQuery(A).slideDown("normal");
                return false
            },
            onHide: function (A) {
                jQuery(A).slideUp("normal");
                return false
            },
            onChange: function (A, C, B) {
                jQuery("#txtTextBackColor").val(C);
                jQuery("#spnTextBackColor").css("backgroundColor", "#" + C)
            },
            onSubmit: function (A, C, B) {
                jQuery("#txtTextBackColor").val(C);
                jQuery("#spnTextBackColor").css("backgroundColor", "#" + C)
            }
        }).change(function () {
            jQuery("#spnTextBackColor").css("backgroundColor", "#" + jQuery(this).val())
        });
        jQuery("#txtTextForeColor").ColorPicker({
            onBeforeShow: function () {
                jQuery(this).ColorPickerSetColor(this.value)
            },
            onShow: function (A) {
                jQuery(A).slideDown("normal");
                return false
            },
            onHide: function (A) {
                jQuery(A).slideUp("normal");
                return false
            },
            onChange: function (A, C, B) {
                jQuery("#txtTextForeColor").val(C);
                jQuery("#spnTextForeColor").css("backgroundColor", "#" + C)
            },
            onSubmit: function (A, C, B) {
                jQuery("#txtTextForeColor").val(C);
                jQuery("#spnTextForeColor").css("backgroundColor", "#" + C)
            }
        }).change(function () {
            jQuery("#spnTextForeColor").css("backgroundColor", "#" + jQuery(this).val())
        });
        jQuery("#txtCountBackColor").ColorPicker({
            onBeforeShow: function () {
                jQuery(this).ColorPickerSetColor(this.value)
            },
            onShow: function (A) {
                jQuery(A).slideDown("normal");
                return false
            },
            onHide: function (A) {
                jQuery(A).slideUp("normal");
                return false
            },
            onChange: function (A, C, B) {
                jQuery("#txtCountBackColor").val(C);
                jQuery("#spnCountBackColor").css("backgroundColor", "#" + C)
            },
            onSubmit: function (A, C, B) {
                jQuery("#txtCountBackColor").val(C);
                jQuery("#spnCountBackColor").css("backgroundColor", "#" + C)
            }
        }).change(function () {
            jQuery("#spnCountBackColor").css("backgroundColor", "#" + jQuery(this).val())
        });
        jQuery("#txtCountForeColor").ColorPicker({
            onBeforeShow: function () {
                jQuery(this).ColorPickerSetColor(this.value)
            },
            onShow: function (A) {
                jQuery(A).slideDown("normal");
                return false
            },
            onHide: function (A) {
                jQuery(A).slideUp("normal");
                return false
            },
            onChange: function (A, C, B) {
                jQuery("#txtCountForeColor").val(C);
                jQuery("#spnCountForeColor").css("backgroundColor", "#" + C)
            },
            onSubmit: function (A, C, B) {
                jQuery("#txtCountForeColor").val(C);
                jQuery("#spnCountForeColor").css("backgroundColor", "#" + C)
            }
        }).change(function () {
            jQuery("#spnCountForeColor").css("backgroundColor", "#" + jQuery(this).val())
        });
        jQuery("#txtImageCode").click(function () {
            jQuery(this)[0].select()
        });
        ImageCode.generateUrl()
    },
    generateUrl: function () {
        var G = "";
        var F = "";
        var D = "";
        var E = "";
        var A = "";
        G = jQuery("#txtBorderColor").val()
        F = jQuery("#txtTextBackColor").val()
        D = jQuery("#txtTextForeColor").val()
        E = jQuery("#txtCountBackColor").val()
        A = jQuery("#txtCountForeColor").val()
        var C = '';
        if (G.length > 0) {
            C += "&borderColor=" + encodeURIComponent(G)
        }
        if (F.length > 0) {
            C += "&textBackColor=" + encodeURIComponent(F)
        }
        if (D.length > 0) {
            C += "&textForeColor=" + encodeURIComponent(D)
        }
        if (E.length > 0) {
            C += "&countBackColor=" + encodeURIComponent(E)
        }
        if (A.length > 0) {
            C += "&countForeColor=" + encodeURIComponent(A)
        }
        var SPS_URL = 'http://www.sharepointsidekick.com/image.axd?url='+encodeURIComponent('http://test.com/');
        var B = '<img src="'+ SPS_URL + C + '" style="border:0px"/>';
       
        jQuery("#imgPreview").html(B);
        jQuery("#imgQS").val(C);
    }
};
jQuery(document).ready(function(){
   ImageCode.init();

});
