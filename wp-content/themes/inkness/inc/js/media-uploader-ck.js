(function(e){e(document).ready(function(){function t(t,r){var i=e(".uploaded-file"),s,o=e(this);t.preventDefault();if(s){s.open();return}s=wp.media({title:o.data("choose"),button:{text:o.data("update"),close:!1}});s.on("select",function(){var t=s.state().get("selection").first();s.close();r.find(".upload").val(t.attributes.url);t.attributes.type=="image"&&r.find(".screenshot").empty().hide().append('<img src="'+t.attributes.url+'"><a class="remove-image">Remove</a>').slideDown("fast");r.find(".upload-button").unbind().addClass("remove-file").removeClass("upload-button").val(optionsframework_l10n.remove);r.find(".of-background-properties").slideDown();r.find(".remove-image, .remove-file").on("click",function(){n(e(this).parents(".section"))})});s.open()}function n(n){n.find(".remove-image").hide();n.find(".upload").val("");n.find(".of-background-properties").hide();n.find(".screenshot").slideUp();n.find(".remove-file").unbind().addClass("upload-button").removeClass("remove-file").val(optionsframework_l10n.upload);e(".section-upload .upload-notice").length>0&&e(".upload-button").remove();n.find(".upload-button").on("click",function(){t(event,e(this).parents(".section"))})}e(".remove-image, .remove-file").on("click",function(){n(e(this).parents(".section"))});e(".upload-button").click(function(n){t(n,e(this).parents(".section"))})})})(jQuery);