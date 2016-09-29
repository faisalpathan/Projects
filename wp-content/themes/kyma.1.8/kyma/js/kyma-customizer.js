(function ($) {
    // Add Upgrade Message
    if ('undefined' !== typeof kyma_button) {
        /* Customizer Buttons */
        $('.wp-full-overlay-sidebar-content').prepend('<a style="width: 80%; background-color:#02b7b7; color: #fff; margin: 10px auto 5px auto; display: block; text-align: center;" href="http://www.demo.webhuntinfotech.com/demo?theme=kyma-advanced" class="button" target="_blank">' + kyma_button.pro + '</a>');
        $('.wp-full-overlay-sidebar-content').prepend('<a style="width: 80%; background-color:#02b7b7; color: #fff; margin: 10px auto 5px auto; display: block; text-align: center;" href="https://wordpress.org/support/theme/kyma" class="button" target="_blank">' + kyma_button.support + '</a>');
        webhunt = $('<a class="prefix-webhunt-link"></a>')
            .attr('href', kyma_button.prefixURL)
            .attr('target', '_blank')
            .text(kyma_button.prefixLabel)
            .css({
                'display': 'inline-block',
                'background-color': 'rgb(231, 76, 60)',
                'color': '#fff',
                'text-transform': 'uppercase',
                'margin-top': '6px',
                'padding': '3px 6px',
                'font-size': '9px',
                'letter-spacing': '1px',
                'line-height': '1.5',
                'clear': 'both'
            })
        ;
        setTimeout(function () {
            $('.preview-notice').append(webhunt);
            $('.customize-panel-back').css('height', '97px');
        }, 200);
        // Remove accordion click event
        $('.prefix-webhunt-link').on('click', function (e) {
            e.stopPropagation();
        });
    }
})(jQuery);