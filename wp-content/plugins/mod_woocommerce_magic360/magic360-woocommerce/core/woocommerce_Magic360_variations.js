'use strict';
var prodVariations;
var clicked = false;
var ready = false;
var lastChangedImage = null;
window.current_img = false;
mainImageId = "Magic360Image_Main_Product"+prodId;
var onZoomReady = false;
mzOptions["onZoomReady"] = function() { onZoomReady = true; change(); }

window['MagicRefresh'] = function() {
   
    var aHref = $('.invisImg').attr("href");
    if (typeof($('.invisImg').attr("src")) != "undefined" && $('.invisImg').attr("src").length > 0) {
        var imgSrc = $('.invisImg').attr("src");
    } else {
        var imgSrc = $('.invisImg img').attr("src");
    }
    MagicZoom.stop();
    
    jQuery("#"+mainImageId+" img").removeAttr("srcset");
    jQuery("#"+mainImageId).removeAttr("data-image-2x");

    jQuery("#"+mainImageId+" > img").attr("src", imgSrc);
    jQuery("#"+mainImageId).attr("data-image", imgSrc);
    jQuery("#"+mainImageId).attr("href",aHref);

    jQuery("#"+mainImageId+" > img")[0].currentSrc;

    setTimeout(function () {
        MagicZoom.start();
    }, 0);
    
    if (jQuery(".MagicToolboxSelectorsContainer a").length > 1) {
        jQuery(".MagicToolboxSelectorsContainer").show();
    } else {
        jQuery(".MagicToolboxSelectorsContainer").hide();
    }
    
};


function getCurrentVariationByImage (img) {

    img = img.match(/wp-content.*/)[0];
    
    for(var i in prodVariations) {
        if (prodVariations[i]["image"]["url"].match(/wp-content.*/)[0] == img) {
            return prodVariations[i];
        }
    }
}

function activateVariationAttributes (variation, link) {
    attrs = Object.keys(variation.attributes);
    result = new Array();

    /*clicked = true;
    $('.reset_variations').trigger('click');
    clicked = false;*/

    $(attrs).each(function (attribute) {
        value = variation.attributes[attrs[attribute]]+"";
        if (value != "") {
            $("form.variations_form [name$=\'" + attrs[attribute] + "\']").val(value).change();
        }
    });
}


window['onMagic360SelectorClick'] = function(elem) {
    link = $(elem).attr("href");
    variation = getCurrentVariationByImage(link);
    activateVariationAttributes(variation, link);
};

function getName(src) {
    return src.match(/([^\/]*?\.(?:jpg|jpeg|png|gif))/)[1];
}

window['change'] = function (reset) {
    
    var a = $('.invisImg'),
        //img1 = (isWoo301 && !reset) ? a : $('.invisImg img'),
        img1 = a,
        img2 = $('#'+mainImageId+' img'),
        firstName;

    if (img2.length > 1) img2 = $('#'+mainImageId+' > figure > img'); //prevent lazyzoom issue

    if (!onZoomReady) { return; }
    
    //if (!ready || !img1.attr('src')) { return; }
    //if (img1.attr('src') == $('#'+mainImageId+' img').attr('src')) { return; }
    if (!ready || !img1.attr('href')) { return; }
    if (img1.attr('href') == $('#'+mainImageId).attr('href')) { return; }
    
    
        
    //firstName = reset ? getName(a.attr('href')) : getName(img1.attr('src'));
    firstName = reset ? getName(a.attr('href')) : getName(img1.attr('href'));
    if (!reset) {
        var activeSlide = $('.mt-active').attr('data-magic-slide');
        if(activeSlide != 'zoom'){
           $('.mt-active').removeClass('mt-active');
           $('[data-magic-slide="zoom"]').addClass('mt-active');
           $('.active-selector').removeClass('active-selector');
        }
    }
    if (window.current_img && !reset) {
        Magic360.update(mainImageId, a.attr('href').replace(/\?.*/,''), window.current_img.replace(/\?.*/,''));
        window.current_img = false;
    } else {
        if (!addVarEnabled) {
            if (firstName !== getName(img2.attr('src')) || lastChangedImage !== img1) {
                //var $src = img1.attr('src'), $selector = jQuery('a[data-image][href*="'+a.attr('href')+'"]').first(); 
                var $src = img1.attr('href'), $selector = jQuery('a[data-image][href*="'+a.attr('href')+'"]').first(); 
                if ($selector.length) {
                    $src = $selector.attr('data-image');
                }
                
                Magic360.update(mainImageId, a.attr('href').replace(/\?.*/,''), $src.replace(/\?.*/,''));
                lastChangedImage = img1;
                jQuery("#"+mainImageId).attr('href',a.attr('href'));
            }
        }
    }
}


$(document).ready(function($) {
    prodVariations = window['product_variations_' + prodId];
    clicked = false;
    addVarEnabled = false;
    
    jQuery( document ).ajaxComplete(function() {
        if (arguments[1].responseText.match(/cedImageVariant woocommerce\-product-gallery/gm)) {
            var newSelectors = '<div class="MagicToolboxSelectors">';

            $(arguments[1].responseText).find('a').each(function(){
                newSelectors = newSelectors + '<a class="lightbox-added" data-zoom-id="'+mainImageId+'" href="' + $(this).attr('href') + '"  data-image="' + $(this).attr('href') + '"><img class="attachment-90x90" src="'+ $(this).attr('href') +'"  alt=""></a>';
                
            })

            newSelectors = newSelectors + '</div>';
            
            
            $(".MagicToolboxSelectorsContainer").html(newSelectors);
            
            
            setTimeout("MagicRefresh();", 500);
        }
    });

    if (typeof($.wc_additional_variation_images_frontend) == "object" && typeof($.wc_additional_variation_images_frontend.imageSwap) == "function") {
        addVarEnabled = true;
        $.wc_additional_variation_images_frontend.imageSwap_old = $.wc_additional_variation_images_frontend.imageSwap;
        $.wc_additional_variation_images_frontend.imageSwap = function() {
            $.wc_additional_variation_images_frontend.imageSwap_old(arguments[0], arguments[1]);
            if (typeof(Magic360) != "undefined") {
                
                if (typeof(arguments[0].gallery_images) != "undefined" && arguments[0].gallery_images.length > 0) {
                        
                        $(".MagicToolboxSelectorsContainer").html(arguments[0].gallery_images);
                        $(".MagicToolboxSelectorsContainer a").each(function() {
                            
                            $(this).attr("class", "").attr("rev", $(this).attr("href")).attr("data-zoom-id", mainImageId).attr("data-rel", "");
                        });

                        setTimeout("MagicRefresh();", 50);

                } else if (typeof(arguments[0].main_images) != "undefined" && arguments[0].main_images.length > 0) {
                        
                    var newSelectors = $.parseHTML(arguments[0].main_images);

                    if ($(newSelectors).find("img").length > 1) {
                        
                        $(newSelectors).removeAttr("class");
                        $(newSelectors).find("figure.woocommerce-product-gallery__wrapper").removeAttr("class");
                        $(newSelectors).find("img.attachment-shop_single").removeAttr("class").removeAttr("srcset").removeAttr("width").removeAttr("height");

                        $(newSelectors).find("img").each(function () { return $(this).attr("src",$(this).parent().attr("data-thumb")).attr("style","height: "+thumbHeight+" !important;"); });
                        
                        $(newSelectors).find('figure.woocommerce-product-gallery__image, div.woocommerce-product-gallery__image').each(function() {
                            $(this).replaceWith($('<a class="lightbox-added" data-magic-slide-id="zoom" data-product-id="'+prodId+'" data-zoom-id="'+mainImageId+'">' + this.innerHTML + '</a>'));
                            
                        });
                        
                        $(newSelectors).find("a.lightbox-added").each(function () { 
                            var newHref = $(this).find("> img").attr("data-large_image");
                            return $(this).attr("href",newHref).attr("data-image",newHref);
                            
                        });
                        
                        var spin = '';
                        if ($('a[data-magic-slide-id="360"]').length) {
                            var spin = $('a[data-magic-slide-id="360"]')[0];
                        } 
                        $("#MagicToolboxSelectors" + prodId).html($(newSelectors).find('a')).prepend(spin);

                        setTimeout("MagicRefresh();", 50);
                        setTimeout(function(){
                            magictoolboxBindSelectors($("#MagicToolboxSelectors" + prodId)[0],prodId);
                        }, 500);

                    } else if ($(newSelectors).find("img").length){ //just update image, in case if there is no additional selectors

                        setTimeout("MagicRefresh();", 50); 

                    }
                }
                
            }
        }
    }
    
    
    if (useWpImages) {

        if(typeof prodVariations === 'undefined') {
            prodVariations = $.parseJSON($('.variations_form').attr('data-product_variations'));
        };

        if (jsonVariations != false)
            $.each(jsonVariations, function(index, value) {
                if (typeof prodVariations != 'undefined') {
                    var resEl = $.grep(prodVariations, function(e) { return e.variation_id == index; });
                } else {
                    var resEl = $.grep($('form.variations_form').data('product_variations'), function(e) { return e.variation_id == index; });
                }

                if (typeof resEl!="undefined" && typeof resEl[0]!="undefined" && resEl[0].image_src !="undefined") {
                    resEl[0].image_src = value.thumb;
                    resEl[0].image_link = value.original;

                    if (isWoo301) {
                        resEl[0].image.url = value.original;
                        resEl[0].image.src = value.thumb;
                        resEl[0].image.full_src = value.original;
                    }
                }
            });

        $('.variations_form').attr('data-product_variations', JSON.stringify(prodVariations));
        $('.variations_form').data('product_variations', prodVariations);
        $('.variations_form').trigger('reload_product_variations');
    }
    
    $('form.variations_form').on('found_variation', function() {
        setTimeout("change();",500);
    });


    
    $('form.variations_form').on('reset_image', function() {
        if ($("a.reset_variations").css('visibility') != 'hidden' && !clicked) {
            setTimeout("change(true);",500);
        }
    });


    ready = true;
    change();
});
