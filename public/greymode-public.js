(function ($){
    function Greymode (el) {
        var context = this;
        var container = el;
        var toggle = '#gray-switch';
        this.init = function (_toggle) {
            $.mourn({
                gray: _toggle ? $(_toggle).is(':checked') : container.attr('data-gm-grey-enable'),
                grayScale: container.attr('data-gm-grey-scale'),
                greyLabel: container.attr('data-gm-button-name'),
                greySwitchColor: container.attr('data-gm-button-color'),
                ribbon: container.attr('data-gm-ribbon-enable'),
                ribbonSize: container.attr('data-gm-ribbon-size'),
                ribbonPosition: container.attr('data-gm-ribbon-position'),
            });
        }
        this.onToggle = function (document) {
            $(document).on('change', toggle, function(){
                context.init(this);
            });
        }
    }
    $(document).ready(function () {
        var greymodeContainer = $(this).find('#hiro-greymode');
        if (greymodeContainer.length) {
            var greymodeObject = new Greymode(greymodeContainer);
            greymodeObject.init();
            greymodeObject.onToggle(this);
        } 
    });
})(jQuery);
