<?php

/* Template Name: Youtube Page */

get_header();
$layout = engage_page_layout();
$general_layout = engage_general_layout( $layout );
$sidebar_width = engage_sidebar_width();
$page_width = engage_page_width();
$container_class = engage_container_class( $page_width );
$channelId = 'UCVTPaFDFmx4Jl33V1XYxekA';
$maxResults = 30;
$API_key = 'AIzaSyCD7oXQBu8JfU3k1Qw4-PzZni90cwMgKso';
$video_list = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$channelId.'&maxResults='.$maxResults.'&key='.$API_key.''));
 ?>
<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.js"></script>

<section class="section-page <?php echo esc_attr( $general_layout ); ?> page-layout-<?php echo esc_attr( $layout ); ?> sidebar-width-<?php echo esc_attr( $sidebar_width ); ?> page-width-<?php echo esc_attr( $page_width ); ?>"
    <?php engage_page_content_styles(); ?>>
    <div class="container">
        <div class="row main-row">
            <div id="page-content" class="page-content">
            <div class="row">
                <?php
                foreach($video_list->items as $item)
                {
                    if(isset($item->id->videoId)){
              echo '
                    <div class="col-md-4 col-sm-6 col-lg-3">
                    <div class="card youtube-video shadow-lg" id="'. $item->id->videoId .'" style="margin-bottom: 20px">
                        <a class="various fancybox.iframe" href="http://www.youtube.com/embed/'. $item->id->videoId .'?autoplay=1" title="'. $item->snippet->title .'">
                            <img class="card-img-top" src="'. $item->snippet->thumbnails->medium->url .'" alt="'. $item->snippet->title .'" alt="Card image cap"> 
                        </a>
                        <div class="card-body">
                            <h6 class="card-title">'. $item->snippet->title .'</h6>
                        </div>
                    </div>
                    </div>
                    ';
                    
                        }
                        //Embed playlist
                        else if(isset($item->id->playlistId))
                        {
                            echo '<div class="col-md-4 col-sm-6 col-lg-3">
                            <div id="'. $item->id->playlistId .'" class="card youtube-playlist shadow-lg" style="margin-bottom: 20px">
                        <a href="#'. $item->id->playlistId .'" title="'. $item->snippet->title .'">
                            <img src="'. $item->snippet->thumbnails->medium->url .'" alt="'. $item->snippet->title .'" class="img-responsive" height="130px" />
                         </a>   
                        <div class="card-body">
                            <h6 class="card-title">'. $item->snippet->title .'</h6>
                        </div>
                    </div>
                    </div>
                    ';
                        }
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</section>