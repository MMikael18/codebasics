<?php

/*
class Type_Settigns {
    public static $text_domain = 'simularpages_domain';
    
    public static $category = 'simular_category';
    public static $tags     = 'simular_tags';
    public static $postname = 'simularpages';
}


class SimularPages_Post_Type {

    function __construct() {
        add_action( 'init', array( $this , 'create_custom_post')  );
        add_action( 'add_meta_boxes', array( $this , 'custom_meta_boxs' ) );
        add_action( 'save_post', array( $this , 'save_your_fields_meta' ) );
    }

    function create_custom_post() {

        register_taxonomy(
            Type_Settigns::$category,
            array( Type_Settigns::$category ), 
            array(
                'hierarchical' => true,
                'label' => "Simular Category",
                'singular_label' => "Simular Category",
                'rewrite' => true
            )
        );

        register_taxonomy(
            Type_Settigns::$tags,
            array( Type_Settigns::$tags ), 
            array(
                'hierarchical' => true,
                'label' => "Simular Tags",
                'singular_label' => "Simular Tag",
                'rewrite' => true,
                'hierarchical' => false
            )
        );

        register_post_type( Type_Settigns::$postname,
                array(
                'labels' => array(
                        'name' => __( 'Simular Pages' ),
                        'singular_name' => __( 'simularlink' ),
                ),
                'public' => true,
                'has_archive' => true,
                'supports' => array(
                        'title',
                        'thumbnail'
                ),
                'taxonomies' => array( Type_Settigns::$category , Type_Settigns::$tags )
        ));

        
    }

    function custom_meta_boxs() {
        add_meta_box(
            'fields',                                 // $id
            'Fields',                                 // $title
             array( $this , 'field_form_callback' ),  // $callback
            Type_Settigns::$postname,                 // $screen
            'normal'                                  // $context
        );
    }

    function field_form_callback() {
    
        // nonce 
        wp_nonce_field( basename(__FILE__) , 'simularpages_meta_box_nonce' );
    
        // fields 
        global $post;
        $meta = get_post_meta( $post->ID, 'your_fields', true );

        ?>
        <p>
            <label for="your_fields[siteurl]">Site url</label>
            <br>
            <input type="text" name="your_fields[siteurl]" id="your_fields[siteurl]" class="regular-text" value="<?php echo $meta['siteurl']; ?>">
        </p>
        <p>
            <label for="your_fields[textarea]">Description</label>
            <br>
            <textarea name="your_fields[textarea]" id="your_fields[textarea]" rows="5" cols="30" style="width:500px;"><?php echo $meta['textarea']; ?></textarea>
        </p>
        <p>
            <label for="your_fields[icon]">Icon</label><br>
            <input type="text" name="your_fields[icon]" id="your_fields[icon]" class="meta-image regular-text" value="<?php echo $meta['icon']; ?>">
            <input type="button" class="button image-upload" value="Browse">
        </p>
        <div class="image-preview"><img src="<?php echo $meta['icon']; ?>" style="max-width: 250px;"></div>

        <script>
        jQuery(document).ready(function ($) {

            // Instantiates the variable that holds the media library frame.
            var meta_image_frame;
            // Runs when the image button is clicked.
            $('.image-upload').click(function (e) {
                e.preventDefault();
                var meta_image = $(this).parent().children('.meta-image');

                // If the frame already exists, re-open it.
                if (meta_image_frame) {
                    meta_image_frame.open();
                    return;
                }
                // Sets up the media library frame
                meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
                    title: meta_image.title,
                    button: {
                        text: meta_image.button
                    }
                });
                // Runs when an image is selected.
                meta_image_frame.on('select', function () {
                    // Grabs the attachment selection and creates a JSON representation of the model.
                    var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
                    // Sends the attachment URL to our custom image input field.
                    meta_image.val(media_attachment.url);
                });
                // Opens the media library frame.
                meta_image_frame.open();
            });
        });
        </script>

        <?php
    }

    function save_your_fields_meta( $post_id ) {   
        // verify nonce
        if ( !wp_verify_nonce( $_POST['simularpages_meta_box_nonce'], basename(__FILE__) ) ) {
            return $post_id; 
        }
        // check autosave
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }
        // check permissions
        if ( 'page' === $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }  
        }
        
        $old = get_post_meta( $post_id, 'your_fields', true );
        $new = $_POST['your_fields'];

        if ( $new && $new !== $old ) {
            update_post_meta( $post_id, 'your_fields', $new );
        } elseif ( '' === $new && $old ) {
            delete_post_meta( $post_id, 'your_fields', $old );
        }
    }
    
}



class SimularPages_List_Table {

    function __construct() {
        $type = Type_Settigns::$postname;
        
        add_filter("manage_".$type."_posts_columns" , array( $this , 'cpt_columns') );
        add_action( 'manage_posts_custom_column' , array( $this , 'custom_columns') , 10, 2 );
    }

    function cpt_columns($columns) {
        $new_columns = array(
            Type_Settigns::$category => __( Type_Settigns::$category, Type_Settigns::$text_domain ),            
            Type_Settigns::$tags     => __( Type_Settigns::$tags,     Type_Settigns::$text_domain ),       
        );
        return array_merge($columns, $new_columns);
    }    

    function custom_columns( $column, $post_id ) {
        switch ( $column ) {
            case Type_Settigns::$category:
                $terms = get_the_term_list( $post_id, Type_Settigns::$category, '', ',', '' );
                if ( is_string( $terms ) ) {
                    echo $terms;
                } else {
                    _e( 'cc no', Type_Settigns::$text_domain );
                }
                break;

            case Type_Settigns::$tags:
                $terms = get_the_term_list( $post_id, Type_Settigns::$tags, '', ',', '' );
                if ( is_string( $terms ) ) {
                    echo $terms;
                } else {
                    _e( 'cc no', Type_Settigns::$text_domain );
                }
                break;
        }
    }

}



?>