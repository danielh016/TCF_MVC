<div class="col-md-12 col-xs-12">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">

            <?php 
            
            for( $i=0; $i<count($carousels, 0); $i++ ){
                if( $i==0 )
                {
                    echo('<li data-target="#carousel-example-generic" data-slide-to="'.$i.'" class="active"></li>');
                }
                else
                {
                    echo('<li data-target="#carousel-example-generic" data-slide-to="'.$i.'"></li>');
                }
            }

            ?>

        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">

            <?php foreach($carousels as $key => $row): ?>

            <div class="item <?php if($key==0) echo('active');?>">
                <div class="blur col-md-12 col-xs-12" style="background-image: url('<?=$row->topic_photo_addr?>');"></div>
                
                <div class="carousel-caption">
                    <?php       //若不是匿名(條件開始)
                        $ano = $row->ano;
                        if($ano==0){
                            $check_photo = $row->user_photo_addr;
                            if($check_photo==NULL){
                    ?>
                        <img src="../../user_image/TC_defaultuser.png" alt="" class="user-img img-circle">
                    <?php
                            }
                            else if($check_photo!=NULL){
                    ?>
                        <img src="<?=$row->user_photo_addr?>" alt="" class="user-img img-circle">
                    <?php
                            }
                        }
                        else if($ano==1){
                    ?>
                        <img src="../../user_image/TC_defaultuser.png" alt="" class="user-img img-circle">
                    <?php
                        }
                    ?>
                    <p><a href="<?=base_url().'Topic/'.$row->aid?>"><?=$row->topicname?></a></p>
                </div>
            </div>

            <?php endforeach;?>

        </div>
    </div>
    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
