var WindowSizeFunctions, validator, DeviceDetector, BtnMenuMobile, PortfolioItemSize, HoverPortfolio;

var ISeffects;

ISeffects = {
    Loadding : function(){

        var _complete;
        _complete = function(){

            elHTML = {
                header: jQuery('header'),
                content: jQuery('#RJRContent'),
                load: jQuery('#loadding')
            }

            pos = {
                delay: 100,
                posLeft: 0,
                timeAnimate: 1500
            }

            elHTML.load.hide();
            elHTML.header.delay(pos.delay).animate({left: pos.posLeft}, pos.timeAnimate);
            elHTML.content.delay(pos.timeAnimate).animate({opacity: 1}, pos.timeAnimate);

        };

        jQuery(window).load(function(){
            _complete();
        });

    }
};

ISeffects.Loadding();

WindowSizeFunctions = function(){
    var WindowHeight;
    WindowHeight = jQuery(window).height();

    //Scroll Height
    jQuery('#RJRScroller').css('height',WindowHeight);
};

validator = function(){
    var IS_hasValidate, message;

    //Validator Plugin
    IS_hasValidate = function(){

        // Regular Expression to test whether the value is valid
        jQuery.tools.validator.fn("[type=time]", "Por favor, forneça uma hora válida", function (input, value) {
            return(/^\d\d:\d\d$/).test(value);
        });

        jQuery.tools.validator.fn("[data-equals]", "Valor não é igual com o campo $1", function (input) {
            var name = input.attr("data-equals"),
                field = this.getInputs().filter("[name=" + name + "]");
            return input.val() === field.val() ? true : [name];
        });

        jQuery.tools.validator.fn("[minlength]", function (input, value) {
            var min = input.attr("minlength");

            return value.length >= min ? true : {
                pt : "Por favor, forneça pelo menos " + min + " caráter(s)" + (min > 1 ? "s" : "")
            };
        });

        jQuery.tools.validator.fn("[id=cpf]", "Informe um CPF válido.", function(input, value) {

            value = jQuery.trim(value);
            value = value.replace('.','');
            value = value.replace('.','');
            cpf = value.replace('-','');

            while(cpf.length < 11) cpf = "0"+ cpf;
            var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
            var a = [];
            var b = new Number;
            var c = 11;

            for (i=0; i<11; i++){
                a[i] = cpf.charAt(i);
                if (i < 9) b += (a[i] * --c);
            }

            if ( (x = b % 11) < 2 )
                a[9] = 0;
            else
                a[9] = 11-x;

            b = 0;
            c = 11;

            for (y=0; y<10; y++) b += (a[y] * c--);

            if( (x = b % 11) < 2 )
                a[10] = 0;
            else
                a[10] = 11-x;

            var retorno = true;

            if( (cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg) ) retorno = false;

            return retorno;

        }); // Mensagem padrão


        jQuery.tools.validator.localizeFn("[type=time]", {
            pt : 'Por favor, forneça uma hora válida'
        });

        jQuery.tools.validator.localizeFn("[id=cpf]", {
            pt : 'Informe um CPF válido.'
        });

        jQuery.tools.validator.localize("pt", {
            ':email'  		: 'Digite um endere&ccedil;o de e-mail v&aacute;lido',
            '[required]' 	: 'Campo Obrigat&oacute;rio'
        });

        jQuery(".has-validation").validator({
            position: "top left",
            offset: [0, 0],
            messageClass: "form-error",
            message: "<div><em/></div>",
            lang: "pt"
        }).bind("onSuccess", function(e, els) {

                var button, form, numExpected, numSucceeded;

                numSucceeded = els.length;
                numExpected = jQuery(this).data("validator").getInputs().length;

                //Se o número de campos validados é igual ao número de campos esperados
                if (numSucceeded === numExpected) {

                    form = jQuery(this);

                    button = form.find('input[type=submit]');
                    button.attr('disable', 'disable').text('Processando...');

                    jQuery.post(form.attr("action"), form.serialize(), (function(responseText) {

                        console.log( responseText );

                        form.html( message(responseText.type, responseText.message) );

                        return false;

                    }), "json");

                }

                return false;

            }).attr("novalidate", "novalidate");
    }

    //AJAX SEND FORM
    message = function( tipo, mensagem ) {

        if( tipo == '' )
            tipo = 'sucesso';

        switch( tipo ){

            case "info":
                tipo  = "";
                break;

            case "sucesso":
                tipo  = "alert-success";
                break;

            case "erro":
                tipo  = "alert-error";
                break;

            default:
                tipo  = '';
                mensagem = "Você declarou um tipo de mensagem inválido no código!";
        }

        console.log(  tipo +' '+ mensagem );

        return '<div class="alert '+ tipo +'">' + mensagem + '</div>';
    }
};

BtnMenuMobile = function(){

    jQuery('#BtnMenuMobile').click(function(){

        var FindVisible;

        FindVisible = jQuery('.opened').length;

        if(FindVisible == 0)
            jQuery('nav').find('ul').addClass('opened');
        else
            jQuery('nav').find('ul').removeClass('opened');


    });

    jQuery('nav ul a').click(function(){
        jQuery('nav').find('ul').removeClass('opened');
    });
};

PortfolioItemSize = function(){

    var el, img, ItemHeight;

    el = jQuery('.job');
    img = jQuery('img');
    ItemHeight = el.find(img).height();

    el.css('height', ItemHeight);
};

HoverPortfolio = function(){

    jQuery(function() {
        galleryItem = jQuery('.job');

        galleryItem.hover(
            function(event){ customHoverAnimation( "over", event, jQuery(this), jQuery("figcaption", this) ); },
            function(event){ customHoverAnimation( "out", event, jQuery(this), jQuery("figcaption", this) ); }
        );

    });

    function customHoverAnimation( type, event, parent, child ){
        var directionCSS = getDirectionCSS( parent, { x : event.pageX, y : event.pageY } );

        console.log(directionCSS);

        if( type == "over" ){
            child.removeClass(); child.css("left", directionCSS.from.val1); child.css("top", directionCSS.from.val2);
            TweenMax.to( child, .3, { css:{ left:directionCSS.to.val1, top: directionCSS.to.val2},  ease:Sine.easeInOut });
        }
        else if( type == "out" ){ TweenMax.to( child, .3, { css:{ left:directionCSS.from.val1, top: directionCSS.from.val2},  ease:Sine.easeInOut }); }
    }

    function getDirectionCSS( $element, coordinates ){
        /** the width and height of the current div **/
        var w = $element.width(), h = $element.height(),

        /** calculate the x and y to get an angle to the center of the div from that x and y. **/ /** gets the x value relative to the center of the DIV and "normalize" it **/
                x = ( coordinates.x - $element.offset().left - ( w/2 )) * ( w > h ? ( h/w ) : 1 ),
            y = ( coordinates.y - $element.offset().top  - ( h/2 )) * ( h > w ? ( w/h ) : 1 ),
        /** the angle and the direction from where the mouse came in/went out clockwise (TRBL=0123);**/
            /** first calculate the angle of the point, add 180 deg to get rid of the negative values divide by 90 to get the quadrant
             add 3 and do a modulo by 4  to shift the quadrants to a proper clockwise TRBL (top/right/bottom/left) **/
                direction = Math.round( ( ( ( Math.atan2(y, x) * (180 / Math.PI) ) + 180 ) / 90 ) + 3 )  % 4;
        var fromClass, toClass;
        switch( direction ) {
            case 0:/* from top */
                fromClass = {instance:'hover-slideFromTop', val1: "0px", val2:"-100%"};
                toClass	  = {instance:'hover-slideTopLeft', val1: "0px", val2:"0px"};
                break;
            case 1:/* from right */
                fromClass = {instance:'hover-slideFromRight', val1: "100%", val2:"0px"};
                toClass	  = {instance:'hover-slideTopLeft', val1: "0px", val2:"0px"};
                break;
            case 2:/* from bottom */
                fromClass = {instance:'hover-slideFromBottom', val1: "0px", val2:"100%"};
                toClass	  = {instance:'hover-slideTopLeft', val1: "0px", val2:"0px"};
                break;
            case 3:/* from left */
                fromClass = {instance:'hover-slideFromLeft', val1: "-100%", val2:"0px"};
                toClass	  = {instance:'hover-slideTopLeft', val1: "0px", val2:"0px"};
                break;
        };
        return { from : fromClass, to: toClass };
    }
};

DeviceDetector = function(){
    var ua, uMobile, BoolMovel;

    ua = navigator.userAgent.toLowerCase();
    uMobile += 'iphone;ipod;windows phone;android;iemobile 8';
    v_uMobile = uMobile.split(';');
    BoolMovel = false;

    for(i=0; i<=v_uMobile.length; i++){

        if (ua.indexOf(v_uMobile[i]) != -1)
            BoolMovel = true;
    }

    if (BoolMovel == true){
        jQuery('.NoMobile').remove();

    }else{
        HoverPortfolio();
    }
};