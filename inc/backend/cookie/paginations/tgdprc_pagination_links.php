<?php
defined('ABSPATH') or die('No scripts for you!!');
$checked_id_array = array();
if (isset($_POST['checked_state'])) {
    $checked_id_array = explode(',', $_POST['checked_state']);
}
if (isset($_POST['key_val_pair'])) {
    $temp_array = $_POST['key_val_pair'];
    $args = array(
        'public' => true,
    );
    $output = 'names'; // names or objects, note names is the default
    $operator = 'and'; // 'and' or 'or'
    $post_types = get_post_types($args, $output, $operator);
    unset($post_types['attachment']); //Attachment is excluded
    $i = 1;
    foreach ($post_types as $post_type_name) {
        if ($post_type_name != 'totalgdprcompliance') {
            $paged = "paged" . intval($i);
            $indexid = 1;
            foreach ($temp_array as $index => $key_val_pair) {
                $key_val_pair_array = explode('=', esc_attr($key_val_pair));
                $key = esc_attr($key_val_pair_array[0]);
                $value = intval($key_val_pair_array[1]);
                if ($key == $paged) {
                    $indexid = $value;
                }
            }
            ?>
            <div class="tgdprc_posts_of_post_type tgdprc_post_type_<?php echo esc_attr($post_type_name) ?>">
                <div class="tgdprc_post_type_container">
                    <div>
                        <label><?php echo ucwords(esc_attr($post_type_name)); ?></label>
                    </div>
                    <?php
                    $posts_per_page = 8;
                    $excluded_posts = array(
                        intval(get_option('page_for_posts')),
                        intval(get_option('page_on_front'))
                    );
                    $args = array(
                        'posts_per_page' => $posts_per_page,
                        'post_type' => $post_type_name,
                        'paged' => $indexid,
                        'post__not_in' => $excluded_posts
                    );
                    $post_type_object = new WP_Query($args);
                    $posts_array = $post_type_object->posts;
                    ?>
                    <div class="tgdprc_post_type_field">
                        <?php
                        if (isset($posts_array)) {
                            foreach ($posts_array as $index => $act_value) {
                                $matched_value = '';
                                if (is_array($checked_id_array)) {
                                    foreach ($checked_id_array as $index => $value) {
                                        if ($act_value->ID == $value) {
                                            $matched_value = $value;
                                        }
                                    }
                                }
                                ?>
                                <div class="tgdprc_individual_term"><input type="checkbox" class="tgdprc_post_type_term" value="<?php echo $act_value->ID; ?>" <?php checked($matched_value, $act_value->ID) ?>><span><?php echo (!empty($act_value->post_title)) ? esc_attr($act_value->post_title) : "#" . (intval($act_value->ID)); ?></span></div>
                                <?php
                            } //End of Posts of certain post type
                        }
                        ?>
                    </div>
                </div>
                <div class="tgdprc_pagination_links" data-paged="<?php echo esc_attr($paged) . '=' . intval($indexid) ?>">
                    <?php
                    // $big = 999999999;
                    $pargs = array(
                        'current' => $indexid,
                        'format' => '?' . $paged . '=%#%',
                        'prev_next' => true,
                        'prev_text' => esc_attr__('« Previous', TGDPRCL_DOMAIN),
                        'next_text' => esc_attr__('Next »', TGDPRCL_DOMAIN),
                        'type' => 'plain',
                        'add_args' => false,
                        'base' => str_replace('%_%', (1 == $indexid) ? '' : "?$" . $paged . "=%#%", "?" . $paged . "=%#%&page=tgdprcl-cookie-settings"),
                        // 'base'			=> str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                        'total' => $post_type_object->max_num_pages
                    );
                    echo paginate_links($pargs);
                    $i++;
                    ?>
                </div>
                <span class="tgdprc-loader" style="display:none;"><img src="<?php echo TGDPRCL_IMAGE . 'tgdprc-loader.gif'; ?>"/></span>
            </div>
            <?php
        }//End if not current plugin service posts
    } //End of Post Type Loops
} //End key_val_pair