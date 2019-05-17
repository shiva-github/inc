<?php
if (!class_exists('Business_Recent_Post_Widget')) {
    class Business_Recent_Post_Widget extends WP_Widget
    {

        private function defaults()
        {

            $defaults = array(
                'cat_id' => 0,
                'title' => esc_html__('Latest Blogs', 'business-hour'),
                'sub-title' => '',

            );
            return $defaults;
        }

        public function __construct()
        {
            parent::__construct(
                'business_epic-recent-post-widget',
                esc_html__('Business Recent Post Widget', 'business-hour'),
                array('description' => esc_html__('Business Recent Post Section', 'business-hour'))
            );
        }

        public function form($instance)
        {
            $instance = wp_parse_args((array )$instance, $this->defaults());
            $catid = absint($instance['cat_id']);
            $title = esc_attr($instance['title']);


            ?>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                    <?php esc_html_e('Title', 'business-hour'); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>" class="widefat"
                       id="<?php echo esc_attr($this->get_field_id('title')); ?>" value="<?php echo $title; ?>">
            </p>


            <p>
                <label for="<?php echo esc_attr($this->get_field_id('cat_id')); ?>">
                    <?php esc_html_e('Select Category', 'business-hour'); ?>
                </label><br/>
                <?php
                $business_con_dropown_cat = array(
                    'show_option_none' => esc_html__('From Recent Posts', 'business-hour'),
                    'orderby' => 'name',
                    'order' => 'asc',
                    'show_count' => 1,
                    'hide_empty' => 1,
                    'echo' => 1,
                    'selected' => $catid,
                    'hierarchical' => 1,
                    'name' => esc_attr($this->get_field_name('cat_id')),
                    'id' => esc_attr($this->get_field_name('cat_id')),
                    'class' => 'widefat',
                    'taxonomy' => 'category',
                    'hide_if_empty' => false,
                );
                wp_dropdown_categories($business_con_dropown_cat);
                ?>
            </p>
            <hr>
            <?php
        }

        public function update($new_instance, $old_instance)
        {
            $instance = $old_instance;
            $instance['cat_id'] = (isset($new_instance['cat_id'])) ? absint($new_instance['cat_id']) : '';
            $instance['title'] = sanitize_text_field($new_instance['title']);

            return $instance;

        }

        public function widget($args, $instance)
        {
            echo $args['before_widget'];
            if (!empty($instance)) {
                $instance = wp_parse_args((array )$instance, $this->defaults());

         
                $catid = absint($instance['cat_id']);
                $title = apply_filters('widget_title', !empty($instance['title']) ? esc_html($instance['title']) : '', $instance, $this->id_base);
             

                ?>
                <section id="ample-business-theme-blog" class="">
                    <div class="container">
                        <div class="main-title wow fadeInDown" data-wow-duration="2s">
                            <?php
                            if (!empty($title)) {
                                ?>
                                <h2 class="widget-title"><?php echo $title; ?></h2>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="row">
                            <div class="blog-list">
                                <?php
                                $i = 0;
                                $sticky = get_option('sticky_posts');
                                if ($catid != -1) {
                                    $home_recent_post_section = array(
                                        'ignore_sticky_posts' => true,
                                        'post__not_in' => $sticky,
                                        'cat' => $catid,
                                        'posts_per_page' => 3,
                                        'order' => 'DESC'
                                    );
                                } else {
                                    $home_recent_post_section = array(
                                        'ignore_sticky_posts' => true,
                                        'post__not_in' => $sticky,
                                        'post_type' => 'post',
                                        'posts_per_page' => 3,
                                        'order' => 'DESC'
                                    );
                                }

                                $home_recent_post_section_query = new WP_Query($home_recent_post_section);

                                if ($home_recent_post_section_query->have_posts()) {
                                    while ($home_recent_post_section_query->have_posts()) {
                                        $home_recent_post_section_query->the_post();
                                        ?>
                                        <!-- Single blog item -->
                                        <div class="col-xs-12 col-sm-4  text-left">
                                            <div class="blog-item">
                                                <a href="">
                                                    <div class="view hm-zoom">
                                                        <?php
                                                        if (has_post_thumbnail()) {
                                                            $image_id = get_post_thumbnail_id();
                                                            $image_url = wp_get_attachment_image_src($image_id, 'medium', true);
                                                            ?>
                                                            <img src="<?php echo esc_url($image_url[0]); ?>" class="
                                                 img-fluid" alt="">
                                                        <?php }
                                                        ?>
                                                        <div class="mask flex-center">
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="blog-details">
                                                    <header class="entry-header">
                                                        <h4 class="entry-title"><a
                                                                href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                        </h4>
                                                        <div class="enty-meta">
                                                        <span class="posted-on">
                                                        <a href="" rel="">
                                                            <i class="fa fa-calendar"></i>
                                                            <time class="entry-date published" datetime=""><?php echo get_the_date(); ?></time>
                                                        </a>
                                                        </span>
                                                        <span class="posted-by">
                                                        <a href= "<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>  " rel="">
                                                            <i class="fa fa-user"></i>
                                                            <time class="entry-date published" datetime=""><?php the_author(); ?></time>
                                                        </a>
                                                        </span>
                                                        <span class="leavecomment pull-right">
                                                        <a href="<?php comments_link(); ?>" rel="">
                                                            <i class="fa fa-comment"></i>
                                                            <time class="entry-date published" datetime=""><?php  esc_html_e('Leave a comment','business-hour')?></time>
                                                        </a>
                                                        </span>
                                                        </div>
                                                        <div class="entry-content">
                                                            <p><?php echo esc_html(wp_trim_words(get_the_content(), 20)); ?></p>
                                                            <a href="<?php the_permalink();?>" class="article-readmore"><?php esc_html_e('Continue Reading', 'business-hour'); ?><span class="arrow-continue"><?php echo esc_html('→','business-hour');?></span></a>

                                                        </div>
                                                    </header>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end Single blog item -->
                                        <?php
                                        $i++;
                                    }
                                    wp_reset_postdata();
                                } ?>

                            </div>
                        </div>
                    </div>
                </section>

                <?php
                echo $args['after_widget'];
            }
        }

    }
}
