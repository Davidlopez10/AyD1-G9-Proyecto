<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

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

    <div class="row">
        <div class="col-lg-4">
            <div class="row">
                <h4>Carnet: <?php echo $carnet_usuario; ?></h4>
            </div>
            <div class="row">
                <h4>Total de creditos: <?php echo $suma_creditos; ?></h4>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="row">
                <h2 class="page-header">Cursos Disponibles&nbsp;&nbsp;<a data-toggle="collapse" data-target="#cursosdisp" class="badge badge-danger">Toggle</a></h2>
                <div id="cursosdisp" class="collapse in">
                    <ul class="list-group">
                    <?php foreach($cursos_disponibles as $cursos_disponible){ ?>
                        <li class="list-group-item"><?php echo $cursos_disponible['nombre']; ?></li>
                    <?php } // foreach ?>
                    </ul>
                </div>
            </div>
            <div class="row">
                <h2 class="page-header">Modalidades Disponibles&nbsp;&nbsp;<a data-toggle="collapse" data-target="#modalidades" class="badge badge-danger">Toggle</a></h2>
                <div id="modalidades" class="collapse">
                    <ul class="list-group">
                    <?php foreach($modalidades as $modalidad){ ?>
                        <li class="list-group-item"><?php echo $modalidad; ?></li>
                    <?php } // foreach ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <h2 class="page-header">Avance en Areas&nbsp;&nbsp;<a data-toggle="collapse" data-target="#areas" class="badge badge-danger">Toggle</a></h2>
                <div id="areas" class="collapse in">
                    <?php foreach($data_arrs as $data_arr){ ?>
                        <div class="col-lg-3">
                            <?php echo $data_arr['area']->nombre; ?>
                        </div>
                        <div class="progress col-lg-7">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $data_arr['porcentaje']; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $data_arr['porcentaje']; ?>%">
                                <span class="sr-only"><?php echo $data_arr['porcentaje']; ?>% Completado</span>
                            </div>
                        </div>
                    <?php } // foreach ?>
                </div>
            </div>
        </div>
    </div>
    <div class="body-content">
        <h2 class="page-header">Listado de Cursos</h2>
        <div class="row">
            <?php
                foreach($data_arrs as $data_arr){
                  if($data_arr['area']->id!=8){
            ?>
            <div clas="row">
                    <div class="row">
                        <h3 class="colo-lg-8"><?php echo $data_arr['area']->nombre; ?>&nbsp;&nbsp;<a data-toggle="collapse" data-target="#area<?php echo $data_arr['area']->id; ?>" class="badge badge-danger">Toggle</a></h3>
                    </div>
                    <div id="area<?php echo $data_arr['area']->id; ?>" class="collapse in">
                        <?php foreach($data_arr['cursos'] as $curso){ ?>
                            <section id="curso<?php $curso->curso0->codigo; ?>" class="row">
                                <div class="list-group list-group-horizontal">
                                    <div class="list-group-item col-lg-1 btn">
                                        <!--span class="glyphicon glyphicon-barcode" ></span-->
                                        <?php echo $curso->curso0->codigo; ?>
                                    </div>
                                    <div class="list-group-item col-lg-4 btn <?php
                                        if($curso->estado_curso == 2)
                                            echo "list-group-item-success";
                                        else if($curso->estado_curso == 3)
                                            echo "list-group-item-danger";
                                        else if($curso->estado_curso == 4)
                                            echo "list-group-item-info";
                                    ?>">
                                        <!--span class="glyphicon glyphicon-align-justify" ></span-->
                                        <?php echo $curso->curso0->nombre; ?>
                                        <span class="badge badge-pill badge-dark"><?php echo $curso->curso0->creditos; ?> creditos</span>
                                    </div>
                                    <div class="list-group-item col-lg-2 btn">
                                        <!--span class="glyphicon glyphicon-check" ></span-->
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
                                    <div class="list-group-item col-lg-2">
                                        <?php
                                            if($curso->estado_curso != 2){
                                                echo Html::a('Aprobar', ['/site/aprobar-curso', 'codigo_curso' => $curso->curso0->codigo], ['class'=>'']);
                                            }else{
                                                echo Html::a('No Aprobar', ['/site/no-aprobar-curso', 'codigo_curso' => $curso->curso0->codigo], ['class'=>'']);
                                            } // else
                                        ?>
                                        <!--span class="glyphicon glyphicon-ok"></span-->
                                    </div>
                                    <div class="list-group-item col-lg-2">
                                        <?php
                                            if($curso->estado_curso != 3){
                                                echo Html::a('Retra Unica', ['/site/retra-unica', 'codigo_curso' => $curso->curso0->codigo], ['class'=>'']);
                                            }else{
                                                echo Html::a('No Aprobar', ['/site/no-aprobar-curso', 'codigo_curso' => $curso->curso0->codigo], ['class'=>'']);
                                            } // else
                                        ?>
                                        <!--span class="glyphicon glyphicon-ok"></span-->
                                    </div>
                                    <!--div class="list-group-item col-lg-1">
                                        <?php
                                            if($curso->estado_curso != 4){
                                                echo Html::a('Pre-Post', ['/site/pre-post', 'codigo_curso' => $curso->curso0->codigo], ['class'=>'']);
                                            }else{
                                                echo Html::a('No Aprobar', ['/site/no-aprobar-curso', 'codigo_curso' => $curso->curso0->codigo], ['class'=>'']);
                                            } // else
                                        ?>
                                    </div-->
                                </div>
                            </section>
                        <?php } // foreach ?>
                    </div>
            </div>
            <?php
                  }//endif
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
