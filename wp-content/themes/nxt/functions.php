<?php
// require_once ('inc/class-tgm-plugin-activation.php');
    add_theme_support('title-tag');
    add_theme_support( 'custom-logo', array(
           'header-text' => array( 'site-title', 'site-description' ),
        ) );
    add_theme_support( 'post-thumbnails' );

    //** Theme enqueue scripts
    function nxt_enqueue_scripts()
    {
    	
    	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/assets/css/bootstrap.min.css');
    	wp_enqueue_style( 'Main', get_template_directory_uri().'/assets/css/main.css');
    	wp_enqueue_style( 'blue', get_template_directory_uri().'/assets/css/blue.css');
    	wp_enqueue_style( 'owl_carousel', get_template_directory_uri().'/assets/css/owl.carousel.css');
    	wp_enqueue_style( 'owl_transitions', get_template_directory_uri().'/assets/css/owl.transitions.css');
    	wp_enqueue_style( 'animate_min', get_template_directory_uri().'/assets/css/animate.min.css');
    	wp_enqueue_style( 'bootstrap_select_min', get_template_directory_uri().'/assets/css/bootstrap-select.min.css');
    	wp_enqueue_style( 'font_awesome', get_template_directory_uri().'/assets/css/font-awesome.css');
    	//theme stylesheet
    	wp_enqueue_style('style', get_stylesheet_uri());

    	//WP latest jQuery
    	wp_enqueue_script('jquery');
    	wp_enqueue_script('bootstrap.min',get_template_directory_uri().'/assets/js/bootstrap.min.js',true);
    	wp_enqueue_script('bootstrap-hover-dropdown.min',get_template_directory_uri().'/assets/js/bootstrap-hover-dropdown.min.js',true);
    	wp_enqueue_script('owl.carousel',get_template_directory_uri().'/assets/js/owl.carousel.min.js',true);
    	wp_enqueue_script('echo',get_template_directory_uri().'/assets/js/echo.min.js',true);
    	wp_enqueue_script('jquery.easing-1.3',get_template_directory_uri().'/assets/js/jquery.easing-1.3.min.js',true);
    	wp_enqueue_script('bootstrap-slider',get_template_directory_uri().'/assets/js/bootstrap-slider.min.js',true);
    	wp_enqueue_script('bootstrap-select',get_template_directory_uri().'/assets/js/bootstrap-select.min.js',true);
    	wp_enqueue_script('wow',get_template_directory_uri().'/assets/js/wow.min.js',true);
    	wp_enqueue_script('scripts',get_template_directory_uri().'/assets/js/scripts.js',true);

    }
    add_action( 'wp_enqueue_scripts', 'nxt_enqueue_scripts');


    //woocommerce theme support
    add_action( 'after_setup_theme', 'woocommerce_support' );
    function woocommerce_support() {
        add_theme_support( 'woocommerce' );
    }
    // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
        'our-menu' => esc_html__( 'Our Menu', 'nxt' )
    ));
    // Change number or products per row to 3
        add_filter('loop_shop_columns', 'loop_columns');
        if (!function_exists('loop_columns')) {
            function loop_columns() {
                return 3; // 3 products per row
            }
        }

    //remove breadcrumbs
    add_action( 'init', 'nxt_remove_wc_breadcrumbs' );
    function nxt_remove_wc_breadcrumbs() {
        remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
    }

    add_filter( 'woocommerce_breadcrumb_defaults', 'nxt_woocommerce_breadcrumbs' );
    function nxt_woocommerce_breadcrumbs() {
        return array(
                'delimiter'   => ' &#47; ',
                'wrap_before' => '<div class="breadcrumb-inner"><ul class="list-inline list-unstyled">',
                'wrap_after'  => '<ul></div>',
                'before'      => '',
                'after'       => '',
                'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
            );
    }
    //remove result count
    add_action( 'init', 'nxt_remove_result_count' );
    function nxt_remove_result_count()
    {
        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20  );
    }

    //remove catelog ordering
    add_action( 'init', 'nxt_remove_wp_catelog_ordering' );
    function nxt_remove_wp_catelog_ordering()
    {
        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30  );
    }
    // pagination
    function nxt_pagination() {

        global $wp_query;

        $big = 999999999; // need an unlikely integer

        $pages = paginate_links( array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $wp_query->max_num_pages,
                'type'  => 'array',
                'prev_next'          => true,
                'prev_text'          => __('<i class="fa fa-angle-left"></i>'),
                'next_text'          => __('<i class="fa fa-angle-right"></i>'),
            ) );
            if( is_array( $pages ) ) {
                $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
                echo '<div class="pagination-container"><ul class="list-inline list-unstyled">';
                foreach ( $pages as $page ) {
                        echo "<li>$page</li>";
                }
               echo '</ul></div>';
                }
        }


    //remove default pagination
    add_action( 'init', 'nxt_remove_default_pg' );
    function nxt_remove_default_pg()
    {
        remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10  );
        
    }
    //product show per page
     function woocommerce_catalog_page_ordering() {
    ?>
   
        <form action="" method="POST" name="results" class="woocommerce-ordering">
        <select name="woocommerce-sort-by-columns" id="woocommerce-sort-by-columns" class="sortby" onchange="this.form.submit()">
    <?php
     
    //Get products on page reload
    if  (isset($_POST['woocommerce-sort-by-columns']) && (($_COOKIE['shop_pageResults'] <> $_POST['woocommerce-sort-by-columns']))) {
            $numberOfProductsPerPage = $_POST['woocommerce-sort-by-columns'];
              } else {
            $numberOfProductsPerPage = $_COOKIE['shop_pageResults'];
              }
     
    //  This is where you can change the amounts per page that the user will use  feel free to change the numbers and text as you want, in my case we had 4 products per row so I chose to have multiples of four for the user to select.
                $shopCatalog_orderby = apply_filters('woocommerce_sortby_page', array(
                //Add as many of these as you like, -1 shows all products per page
                  //  ''       => __('Results per page', 'woocommerce'),
                    '10'        => __('10', 'woocommerce'),
                    '20'        => __('20', 'woocommerce'),
                    '30'        => __('30', 'woocommerce'),
                    '40'        => __('40', 'woocommerce'),
                    '-1'        => __('All', 'woocommerce'),
                ));

            foreach ( $shopCatalog_orderby as $sort_id => $sort_name )
                echo '<option value="' . $sort_id . '" ' . selected( $numberOfProductsPerPage, $sort_id, true ) . ' >' . $sort_name . '</option>';
    ?>
    </select>
    </form>

    <?php echo ' </span>' ?>
    <?php
    }
     
    // now we set our cookie if we need to
    function dl_sort_by_page($count) {
      if (isset($_COOKIE['shop_pageResults'])) { // if normal page load with cookie
         $count = $_COOKIE['shop_pageResults'];
      }
      if (isset($_POST['woocommerce-sort-by-columns'])) { //if form submitted
        setcookie('shop_pageResults', $_POST['woocommerce-sort-by-columns'], time()+1209600, '/', 'www.your-domain-goes-here.com', false); //this will fail if any part of page has been output- hope this works!
        $count = $_POST['woocommerce-sort-by-columns'];
      }
      // else normal page load and no cookie
      return $count;
    }
     
    add_filter('loop_shop_per_page','dl_sort_by_page');

    //custom sorting option

    add_filter( 'woocommerce_catalog_orderby', 'nxt_woocommerce_catalog_orderby' );
    function nxt_woocommerce_catalog_orderby( $sortby ) {
        $sortby['menu_order'] = 'Position';
        $sortby['price'] = 'Price:Lowest first';
        $sortby['price-desc'] = 'Price:Highest first';
        unset($sortby['popularity']);
        unset($sortby['date']);
        unset($sortby['rating']);
        return $sortby;
    }
    // remove grid/list view
    add_action( 'woocommerce_archive_description', 'remove_grid_list_view');
    function remove_grid_list_view()
    {
        global $WC_List_Grid;
        remove_action( 'woocommerce_before_shop_loop', array($WC_List_Grid, 'gridlist_toggle_button'),30 );
    }

    //sidebar register
    add_action( 'widgets_init', 'sidebar_widgets_init' );
    function sidebar_widgets_init() {
        register_sidebar( array(
            'name'          => __( 'Left Sidebar', 'nxt' ),
            'id'            => 'left-sidebar',    // ID should be LOWERCASE  ! ! !
            'description'   => '',
            'class'         => '',
            'before_widget' => '<div class="sidebar-widget wow fadeInUp">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="section-title">',
            'after_title'   => '</h3>',
        ) );
    }

    // remove product price
    add_action( 'init', 'remove_default_price');
    function remove_default_price()
    {
       
        remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_price',10 );
        add_action( 'woocommerce_single_product_summary','woocommerce_template_single_price',25 );
        remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_meta',40 );
        // remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );

    }
   //footer sidebar register
    register_sidebar( array(
    'name' => 'Footer social 1',
    'id' => 'footer-social-1',
    ) );


//     add_action( 'tgmpa_register', 'register_required_plugins' );

//     function register_required_plugins() {
//     /**
//     * Register the required plugins for this theme.
//     *
//     * In this example, we register two plugins – one included with the TGMPA library
//     * and one from the .org repo.
//     *
//     * The variable passed to tgmpa_register_plugins() should be an array of plugin
//     * arrays.
//     *
//     * This function is hooked into tgmpa_init, which is fired within the
//     * TGM_Plugin_Activation class constructor.
//     */
//     /**
//     * Array of plugin arrays. Required keys are name and slug.
//     * If the source is NOT from the .org repo, then source is also required.
//     */
//     $plugins = array(

//     // This is an example of how to include a plugin pre-packaged with a theme.
//     array(
//     'name' => 'TGM Example Plugin', // The plugin name.
//     'slug' => 'tgm-example-plugin', // The plugin slug (typically the folder name).
//     'source' => get_stylesheet_directory() . '/lib/plugins/tgm-example-plugin.zip', // The plugin source.
//     'required' => true, // If false, the plugin is only 'recommended' instead of required.
//     'version' => ”, // E.g. 1.0.0. If set, the active plugin must be this version or higher.
//     'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
//     'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
//     'external_url' => ”, // If set, overrides default API URL and points to an external URL.
//     ),

//     // This is an example of how to include a plugin from a private repo in your theme.
//     array(
//     'name' => 'TGM New Media Plugin', // The plugin name.
//     'slug' => 'tgm-new-media-plugin', // The plugin slug (typically the folder name).
//     'source' => 'https://s3.amazonaws.com/tgm/tgm-new-media-plugin.zip', // The plugin source.
//     'required' => true, // If false, the plugin is only 'recommended' instead of required.
//     'external_url' => 'https://github.com/thomasgriffin/New-Media-Image-Uploader', // If set, overrides default API URL and points to an external URL.
//     ),

//     // This is an example of how to include a plugin from the WordPress Plugin Repository.
//     array(
//     'name' => 'BuddyPress',
//     'slug' => 'buddypress',
//     'required' => false,
//     ),

//     );

//     /**
//     * Array of configuration settings. Amend each line as needed.
//     * If you want the default strings to be available under your own theme domain,
//     * leave the strings uncommented.
//     * Some of the strings are added into a sprintf, so see the comments at the
//     * end of each line for what each argument will be.
//     */
//     $config = array(
//     'default_path' => ”, // Default absolute path to pre-packaged plugins.
//     'menu' => 'tgmpa-install-plugins', // Menu slug.
//     'has_notices' => true, // Show admin notices or not.
//     'dismissable' => true, // If false, a user cannot dismiss the nag message.
//     'dismiss_msg' => ”, // If 'dismissable' is false, this message will be output at top of nag.
//     'is_automatic' => false, // Automatically activate plugins after installation or not.
//     'message' => ”, // Message to output right before the plugins table.
//     'strings' => array(
//     'page_title' => __( 'Install Required Plugins', 'tgmpa' ),
//     'menu_title' => __( 'Install Plugins', 'tgmpa' ),
//     'installing' => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
//     'oops' => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
//     'notice_can_install_required' => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
//     'notice_can_install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
//     'notice_cannot_install' => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
//     'notice_can_activate_required' => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
//     'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
//     'notice_cannot_activate' => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
//     'notice_ask_to_update' => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
//     'notice_cannot_update' => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
//     'install_link' => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
//     'activate_link' => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
//     'return' => __( 'Return to Required Plugins Installer', 'tgmpa' ),
//     'plugin_activated' => __( 'Plugin activated successfully.', 'tgmpa' ),
//     'complete' => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
//     'nag_type' => 'updated' // Determines admin notice type – can only be 'updated', 'update-nag' or 'error'.
//     )
//     );

//     tgmpa( $plugins, $config );

//     }

    
// // sample content importer
//     if(is_admin()){
//         include_once('importer/importer.inc.php');
//     }
    
?>

