<?php
/* @var $this ClassPlanController */
/* @var $model ClassPlan */

$this->breadcrumbs=array(
	'Aulas'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ClassPlan', 'url'=>array('index')),
	array('label'=>'Create ClassPlan', 'url'=>array('create')),
	array('label'=>'Update ClassPlan', 'url'=>array('update', 'id'=>$model->id_class)),
	array('label'=>'Delete ClassPlan', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_class),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClassPlan', 'url'=>array('admin')),
);
?>

<h1>
	<?php echo $model->title; ?>
	<?php if($model->released): ?>
	<?php endif; ?>
</h1>

<div class="row">
	<div class="col-lg-10">
		<p><?php echo CHtml::link('Versão Aluno', array('/classPlan/plan', 'id'=>$model->id_class), array('class'=>'btn btn-primary btn-xs', 'target'=>'blank')); ?><br /></p>
		<p>
		 <?php foreach (explode(' ', $model->tags) as $tag):?> 
		  <small><?php if($tag != '') echo CHtml::link($tag, array('/classPlan/tag', 'tag'=>$tag), array('class'=>'btn btn-info btn-xs')); ?></small>
		 <?php endforeach;?>
		</p>
	</div>
<div class="col-lg-2">
	<?php if($model->id_owner == Yii::app()->user->getId()): ?>
	  	 	<p>
				<?php echo CHtml::link('Editar', array('/classPlan/update', 'id'=>$model->id_class), array('class'=>'btn btn-primary btn-xs')); ?>
			<?php echo CHtml::link("Excluir",'#', array(
					'submit'=>array('/classPlan/delete', 'id'=>$model->id_class),
					'confirm'=>"Você deseja deletar este plano?",
					'class'=>'btn btn-danger btn-xs',
					'title'=>'Excluir'
					
				))?>
		</p>		
	 <?php endif; ?>
</div>
</div>

<h3>Descrição</h3>
<p><?php echo $model->description ?></p>
<h3>Objetivos</h3>
<p><?php echo $model->objectives ?></p>
<h3>Conteúdo</h3>
<p><?php echo $model->contents; ?></p>
<h3>Recursos</h3>
<p><?php echo $model->resources; ?></p>
<h3>Sistema de Avaliação</h3>
<p><?php echo $model->evaluation; ?></p>



<?php if($model->id_owner == Yii::app()->user->getId()): ?>
  	<?php echo CHtml::link('Editar', array('/classPlan/update', 'id'=>$model->id_class), array('class'=>'btn btn-primary')); ?>
			<?php echo CHtml::link("Excluir",'#', array(
					'submit'=>array('/classPlan/delete', 'id'=>$model->id_class),
					'confirm'=>"Você deseja deletar este plano?",
					'class'=>'btn btn-danger',
					'title'=>'Excluir'
					
				))?>
 <?php endif; ?>