<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Actividades Extra';
?>
<div class="row">
    <h4>Carnet: <?php echo $carnet_usuario; ?></h4>
</div>
<h1>Actividades Extra Curriculares</h1>
<div class="row">
    <h4>Total de creditos por actividades extra: <?php echo $creditos_extra; ?></h4>
</div>

<div class="body-content">
  <div class="row">
    <div class="collapse in">
      <?php
          foreach($actividades_disponibles as $actividades_disponible){
      ?>
      <section id="actividad<?php echo $actividades_disponible['nombre']; ?>" class="row">
        <div class="list-group list-group-horizontal">
          <div class="list-group-item col-lg-1 btn">
            <?php echo $actividades_disponible['codigo']; ?>
          </div>
          <div class="list-group-item col-lg-4 btn
          <?php
              foreach ($usuario_cursos as $usuario_curso) {
                // code...
                if($usuario_curso['estado_curso'] == 2 and $actividades_disponible['codigo']==$usuario_curso['curso'])
                  echo "list-group-item-success";
              }
                ?>">

              <?php echo $actividades_disponible['nombre']; ?>
              <span class="badge badge-pill badge-dark"><?php echo $actividades_disponible['creditos']; ?> creditos</span>
          </div>
          <div class="list-group-item col-lg-2">
            <?php
            //for ($i=0;i<count($usuario_cursos);i++){
              $encontrado=false;
              foreach ($usuario_cursos as $usuario_curso) {
                if($usuario_curso['estado_curso'] != 2 and $actividades_disponible['codigo']==$usuario_curso['curso']){
                    echo Html::a('Aprobar', ['/extra/aprobar-actividad', 'codigo_curso' => $actividades_disponible['codigo']], ['class'=>'']);
                }else if ($usuario_curso['estado_curso'] != 1 and $actividades_disponible['codigo']==$usuario_curso['curso']){
                    echo Html::a('No Aprobar', ['/extra/no-aprobar-actividad', 'codigo_curso' => $actividades_disponible['codigo']], ['class'=>'']);
                    //echo count($usuario_cursos);
                } // else
              }
            //}
            ?>
          </div>
        </div>

      </section>


    <?php } // foreach ?>
    </div>
  </div>
</div>
