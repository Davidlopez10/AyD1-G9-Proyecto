<?php

/* @var $this yii\web\View */

$this->title = 'Dashboard';
?>
<style>
.list-group-horizontal .list-group-item {
    display: inline-block;
}
.list-group-horizontal .list-group-item {
	margin-bottom: 0;
	margin-left:-4px;
	margin-right: 0;
}
.list-group-horizontal .list-group-item:first-child {
	border-top-right-radius:0;
	border-bottom-left-radius:4px;
}
.list-group-horizontal .list-group-item:last-child {
	border-top-right-radius:4px;
	border-bottom-left-radius:0;
}
</style>
<div class="site-index">

    <!--div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div-->

    <div class="body-content">

        <div class="row">
            <?php
                foreach($data_arrs as $data_arr){
            ?>
            <div clas="row">
                    <div class="row">
                        <h3 class="colo-lg-8"><?php echo $data_arr['area']->nombre; ?>&nbsp;&nbsp;<a data-toggle="collapse" data-target="#area<?php echo $data_arr['area']->id; ?>" class="badge badge-danger">Toggle</a></h3>
                        
                    </div>
                    <div id="area<?php echo $data_arr['area']->id; ?>" class="collapse in">
                        <?php foreach($data_arr['cursos'] as $curso){ ?>
                            <section id="curso<?php $curso->curso0->codigo; ?>" class="row">
                                <div class="list-group list-group-horizontal">
                                    <div class="list-group-item col-lg-2"><?php echo $curso->curso0->codigo; ?></div>
                                    <div class="list-group-item col-lg-4 <?php 
                                        if($curso->estado_curso == 2)
                                            echo "list-group-item-success";
                                        else if($curso->estado_curso == 3)
                                            echo "list-group-item-danger";
                                        else if($curso->estado_curso == 4)
                                            echo "list-group-item-info";
                                    ?>"><?php echo $curso->curso0->nombre; ?><span class="badge badge-pill badge-dark"><?php echo $curso->curso0->creditos; ?> creditos</span></div>
                                    <div class="list-group-item col-lg-3">
                                        <?php 
                                            if(!$curso->curso0->prerrequisitos0){
                                                echo "&nbsp";
                                            } // if
                                            foreach($curso->curso0->prerrequisitos0 as $prerrequisito){
                                        ?> 
                                            <a data-toggle="tooltip" data-placement="top" title="<?php echo $prerrequisito->pre0->nombre; ?>">
                                                <?php echo $prerrequisito->pre; ?>
                                            </a>       
                                        <?php 
                                        }  // foreach
                                        ?>
                                    </div>
                                </div>
                            </section>
                        <?php } // foreach ?>
                    </div>
            </div>
            <?php 
                } // foreach
            ?>
        </div>

        <!--div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div-->

    </div>
</div>
