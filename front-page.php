<?php 
/*
    Template Name: Front Page
*/
    get_header();
?>


<!--Modal Code-->
<aside role= "complementary" >
    <div class = "modal">
        <div  class = "card" id = "the-modal-content">
            <div >
            <button id = "close-button" class = "close" tabindex = 1 >&times</button>
<?php
    if( isset( $_POST[ 'security' ] ) && isset( $_POST[ 'id' ] ) )
    { 
        $args = 
        [
            'post_type'      => 'person',
            'posts_per_page' => 1,
            'p'              => $_POST['id']
        ];

        $loop = new WP_Query( $args );

        while( $loop->have_posts() )
        {
            $loop->the_post();
            $name = get_post_meta( get_the_ID( $_POST[ 'id' ] ), '_name_value_key' , true );

            $description = get_post_meta( get_the_ID( $_POST[ 'id' ] ), '_description_value_key' , true );

            $facebook = get_post_meta( get_the_ID( $_POST[ 'id' ] ), '_social_media_Facebook_key' , true );

            $github = get_post_meta( get_the_ID( $_POST[ 'id' ] ), '_social_media_Github_key' , true );

            $linkedIn = get_post_meta( get_the_ID( $_POST[ 'id' ] ), '_social_media_LinkedIn_key' , true );

            $xing = get_post_meta( get_the_ID( $_POST[ 'id' ] ), '_social_media_Xing_key' , true );
?>
        <div class = "img-thumbnail">
        <?php the_post_thumbnail( 'medium-thumbnail' ); ?>
        </div>
            <p class = "card-text"> 
                <b>Name:</b> <?php echo ($name) ?>
                <br />
                <b>Description:</b> <?php echo ($description) ?>
                <br />
            </p>
                <a  href = "http://<?php echo ($facebook) ?>" class = "card-link"
                    target = "_blank" rel = "noopener noreferrer" > FaceBook </a>

                <a  href = "http://<?php echo ($linkedIn) ?>" class = "card-link"
                    target = "_blank" rel = "noopener noreferrer" > LinkedIn </a>

                <a  href = "http://<?php echo ($github) ?>" class = "card-link" 
                    target = "_blank" rel = "noopener noreferrer" > Github </a>

                <a  href="http://<?php echo ($xing) ?>" class = "card-link" 
                    target="_blank" rel="noopener noreferrer"> Xing </a>
                
        <?php 
        } 
        unset( $_POST[ 'id' ] );
    }
        wp_reset_postdata();
        ?>

            </div>
        </div>
    </div> 
</aside>


<!-- Content Code-->
<h2>Company Empolyee's</h2>
<br />

<main>
    <section>

<?php 

    $args = 
    [
        'post_type'      => 'person',
        'posts_per_page' => -1
    ];

    $loop = new WP_Query( $args );

    if( $loop->have_posts() ):

        while( $loop->have_posts() ) :
            $loop->the_post();
            
            $name = get_post_meta( get_the_ID( $_POST[ 'id' ] ), '_name_value_key', true);
            
            $position = get_post_meta( get_the_ID( $_POST[ 'id' ] ), '_position_value_key', true);
?>

<div id = "<?php the_ID(); ?>"   class = "get-id" tabindex = 0 role="alert" aria-live="assertive">
    <div class = "card mb-3" id = "card-style">
        <div class = "row no-gutters">
            <div class = "col-md-4">
                <div class = "bio">
                    <div  class = "img-thumbnail">
                    <?php the_post_thumbnail( 'small-thumbnail' ); ?>
                    </div>
                </div>
            </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p aria-atomic="true" id = "name-tag" class="card-title">
                        <b>Name: </b><?php echo ($name) ?>
                        <br /><br />
                        <b>Position:</b> <?php echo ($position) ?>
                        </p>
                    </div> 
                </div> 
        </div> 
    </div> 
</div>

<br />
    <?php 
        endwhile;
        else :
            echo( '<p>No content found.</p>' );
        endif;
    wp_reset_postdata();
    ?>

    </section>
</main>
<?php echo("<br />");?>
<?php echo("<br />");?>

<?php get_footer(); ?> 