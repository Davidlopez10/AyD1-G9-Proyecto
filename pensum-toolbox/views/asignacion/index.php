<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Asignacion Temporal';
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css");



//saco el numero de elementos
$longitud = count($cursos_marcados);
for($i=0; $i<$longitud; $i++)
{
  //saco el valor de cada elemento
  //echo print_r((int)$cursos_marcados[$i]."\n");

}
if($longitud>0){
  $funcion = "function seleccionar()
      {
          // Recorremos todos los valores
          $(\"#cursos option\").each(function(){
              // Marcamos cada valor como seleccionado
              ";
  $funcion.="
  if(";
  for($i=0; $i<$longitud; $i++)
  {
    //saco el valor de cada elemento
    $funcion.=" Number(this.value) == ".(int)$cursos_marcados[$i];
    if($i!=$longitud-1){
        $funcion.=" || ";
    }
  }
  $funcion.="){
              $(\"#cursos option[value=\"+this.value+\"]\").prop(\"selected\",true);
              }
          });
      }
      seleccionar();";
  $this->registerJs($funcion);
}

$this->registerJs("$(document).ready(function() {
$('#cursos').multiselect({
nonSelectedText: 'Elegir cursos',
includeSelectAllOption: true,
buttonWidth: 350,
enableFiltering: true
});
});");

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

    <div class="row" >
        <!-- <div class="col-lg-4">
            <div class="row">
                <h4>Carnet: <?php echo $carnet_usuario; ?></h4>
            </div>
        </div> -->

        <div class="col-lg-5" style="margin:20px">
            <div class="row">
                <h2 class="page-header">Cursos Disponibles&nbsp;&nbsp;</h2>
                <div id="cursosdisp" class="collapse in">
                    <?php
                    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'action' => ['asignacion/ver-siguientes'], 'method' => 'post']);
                    ?>
                    <div class="form-group">
                        <select class="cursos_class" id="cursos" name="cursos[]" multiple >
                            <?php foreach($cursos_disponibles as $cursos_disponible){ ?>
                                <option value="<?php echo $cursos_disponible['codigo']; ?>"><?php echo $cursos_disponible['nombre']; ?></option>
                            <?php } // foreach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Ver cursos siguientes</button>
                    </div>
                    <?php
                    ActiveForm::end();
                    ?>

                </div>
            </div>
        </div>
        <div class="col-lg-5" style="margin:20px">
            <div class="row">
                <h2 class="page-header">Cursos siguientes&nbsp;&nbsp;</h2>
                <div id="cursosdisp" class="collapse in">
                    <ul class="list-group">
                      <?php foreach((array)$cursos_siguientes_nuevos as $cursos_siguientes_nuevo){ ?>
                          <li class="list-group-item list-group-item-success"><?php echo $cursos_siguientes_nuevo['nombre']; ?></li>
                      <?php } // foreach ?>
                    <?php foreach((array)$cursos_siguientes as $cursos_siguiente){ ?>
                        <li class="list-group-item"><?php echo $cursos_siguiente['nombre']; ?></li>
                    <?php } // foreach ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
