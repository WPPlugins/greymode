(function($) {
    // declare variables
    var switchSlider = $('#gray-switch');

    // Mourn.js
    $.mourn = function(options) {
  		var settings = $.extend({
            ribbon: true,
            ribbonSize: 'large',
            ribbonPosition: 'top-right',
            gray: true,
            grayScale: 1.0,
            greyLabel: 'GREYMODE',
            greySwitchColor: ''
      }, options);

      // set gray scale
      if(settings.gray){
        grayscale = settings.grayScale*100+'%';

        var styles = {
          'filter' : 'gray',
          'filter': 'grayscale('+grayscale+')',
          '-moz-filter': 'grayscale('+grayscale+')',
          '-webkit-filter': 'grayscale('+grayscale+')'
        };
        $('html').css(styles);

        if(switchSlider.size() == 0){
        var greySwitchColor = (settings.greySwitchColor) ? 'style=background-color:' + settings.greySwitchColor : '';
          $('body').append(
            '<div class="switch-container">'
              + '<div class="title">' + settings.greyLabel + '</div>'
              + '<label class="switch">'
                + '<input type="checkbox" checked="checked" id="gray-switch">'
                + '<div class="slider round" ' + greySwitchColor + '></div>'
              + '</label>'
            + '</div>'
          );
        }
      }else{
        var styles = {
          'filter' : 'initial',
          'filter': 'initial',
          '-moz-filter': 'initial',
          '-webkit-filter': 'initial'
        };
        $('html').css(styles);
      }

      // add a ribbon
      if(settings.ribbon){
        $('.mourn-ribbon').remove();
        $('body').append(
          '<div class="mourn-ribbon ' + settings.ribbonSize + '">'
            + '<div class="ribbon-top"></div>'

            + '<div class="ribbon-wing ribbon-left">'
              + '<div class="ribbon-outside"><div class="ribbon-content"></div><div class="ribbon-bottom"></div></div>'
              + '<div class="ribbon-inside"><div class="ribbon-content"></div><div class="ribbon-bottom"></div></div>'
            + '</div>'

            + '<div class="ribbon-wing ribbon-right">'
              + '<div class="ribbon-outside"><div class="ribbon-content"></div><div class="ribbon-bottom"></div></div>'
              + '<div class="ribbon-inside"><div class="ribbon-content"></div><div class="ribbon-bottom"></div></div>'
            + '</div>'

          + '</div>'
        );

        // set ribbon position
        if(settings.ribbonPosition=='top-right'){
          var styles = {
            'position' : 'fixed',
            'right': 0,
            'top': 0
          };
        }else if(settings.ribbonPosition=='top-left'){
          var styles = {
            'position' : 'fixed',
            'left': 0,
            'top': 0
          };
        }else if(settings.ribbonPosition=='bottom-right'){
          var styles = {
            'position' : 'fixed',
            'bottom': 0,
            'right': 0
          };
        }else if(settings.ribbonPosition=='bottom-left'){
          var styles = {
            'position' : 'fixed',
            'bottom': 0,
            'left': 0
          };
        }
        $('.mourn-ribbon').css(styles);
      }
  	};
}(jQuery));
