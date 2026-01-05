// Elementor archive template IDs
const ELEM_TMPL_CAT_HAS_CHILDREN = 31605; // Category Archive
const ELEM_TMPL_LEAF_CATEGORY    = 31629; // All Product Archives

add_action('template_redirect', function () {
    if ( is_admin() && ! wp_doing_ajax() ) return;
    if ( ! is_tax('product_cat') ) return;

    $term = get_queried_object();
    if ( ! $term || is_wp_error($term) ) return;

    // Fast check for children (includes empty terms)
    $has_children = ! is_wp_error(
        $kids = get_terms([
            'taxonomy'   => 'product_cat',
            'parent'     => $term->term_id,
            'hide_empty' => false,
            'fields'     => 'ids',
            'number'     => 1,
        ])
    ) && ! empty($kids);

    $tpl_id = $has_children ? ELEM_TMPL_CAT_HAS_CHILDREN : ELEM_TMPL_LEAF_CATEGORY;

    if ( class_exists('\Elementor\Plugin') && get_post_status($tpl_id) ) {
        // Use Woo/WoodMart wrappers so the layout stays intact
        get_header('shop');

        do_action('woocommerce_before_main_content');
        // If your Elementor template already shows its own archive header/tools,
        // you can comment the next line to avoid duplicates:
        // do_action('woocommerce_shop_loop_header');

        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($tpl_id);

        do_action('woocommerce_after_main_content');

        // WoodMart sidebar position is respected by this hook
        do_action('woocommerce_sidebar');

        get_footer('shop');
        exit;
    }
});
