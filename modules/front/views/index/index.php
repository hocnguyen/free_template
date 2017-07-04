<div class="three-column">
    <div class="container">
        <div class="row">                
            <div class="col-xs-12 col-md-9 three-column-second">                      
                <div class="button-group" data-filter-group="gridsorting">
                    <ul class="layout-option">
                        <li id="grid-view-big" class="layout-option" title="Large Grid View"><button class="button is-checked" data-filter=".grid-view-big"><div class="grid-view"></div></button></li>
                        <li id="standard-view" class="layout-option" title="Standard View"><button class="button" data-filter=".standard-view"><div class="list-view"></div></button></li>
                        <li id="list-view-headline" class="layout-option" title="List View"><button class="button" data-filter=".list-view"><div class="headline"></div></button></li>
                   </ul>
                </div>        
                <div class="clear"></div>   

                <div class="isotope results">
                 <!-- GRID VIEW BIG -->    
                <div class="intro grid-view-big recent">
                    <ul class="layout-sorting">
                        <?= \yii\widgets\ListView::widget( [
                                'dataProvider'=>$products,
                                'itemView' => '_view_grid',
                                'summary'  =>'',
                        ] );?>                                        
                    </ul>
                </div>                                 
                <!-- STANDARD VIEW -->         
                <div class="intro standard-view recent">
                    <ul class="layout-sorting">
                        <?= \yii\widgets\ListView::widget( [
                                'dataProvider'=>$products,
                                'itemView' => '_view_standard',
                                'summary'  =>'',
                        ] );?>                      
                    </ul>
                </div>
                <!-- LIST VIEW -->
                <div class="intro list-view recent">
                    <ul class="layout-sorting">
                        <?= \yii\widgets\ListView::widget( [
                                'dataProvider'=>$products,
                                'itemView' => '_view_list',
                                'summary'  =>'',
                        ] );?>                    
                    </ul>
                </div>

                </div>  
              </div>                    
            <?php echo yii\web\View::render('../elements/widget/left_menu'); ?>    
  
        </div>
    </div>

            <div class="col-md-12 separator">
                <div></div>
            </div>

        </div>

    </div>