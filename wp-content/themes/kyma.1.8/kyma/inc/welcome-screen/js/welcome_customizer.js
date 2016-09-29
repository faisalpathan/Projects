jQuery(document).ready(function() {
    var Kyma_aboutpage = kymaLiteWelcomeScreenCustomizerObject.aboutpage;
    var Kyma_nr_actions_required = kymaLiteWelcomeScreenCustomizerObject.nr_actions_required;

    /* Number of required actions */
    if ((typeof Kyma_aboutpage !== 'undefined') && (typeof Kyma_nr_actions_required !== 'undefined') && (Kyma_nr_actions_required != '0')) {
        jQuery('#accordion-section-themes .accordion-section-title').append('<a href="' + Kyma_aboutpage + '"><span class="kyma-lite-actions-count">' + Kyma_nr_actions_required + '</span></a>');
    }

    /* Upsell in Customizer (Link to Welcome page) */
    if ( !jQuery( ".kyma-upsells" ).length ) {
        jQuery('#customize-theme-controls > ul').prepend('<li class="accordion-section kyma-upsells">');
    }
    if (typeof Kyma_aboutpage !== 'undefined') {
        jQuery('.kyma-upsells').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="' + Kyma_aboutpage + '" class="button" target="_blank">{themeinfo}</a>'.replace('{themeinfo}', kymaLiteWelcomeScreenCustomizerObject.themeinfo));
    }
    if ( !jQuery( ".kyma-upsells" ).length ) {
        jQuery('#customize-theme-controls > ul').prepend('</li>');
    }
});