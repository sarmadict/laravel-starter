<?php if ($showLabel && $showField): ?>
<?php if ($options['wrapper'] !== false): ?>
<div <?= $options['wrapperAttrs'] ?> >
    <?php endif; ?>
    <?php endif; ?>

    <?php if ($showLabel && $options['label'] !== false && $options['label_show']): ?>
        <?= Form::customLabel($name, $options['label'], $options['label_attr']) ?>
    <?php endif; ?>

    <?php if ($showField): ?>
        <?= (isset($options['widget_prefix'])) && $showLabel ? $options['widget_prefix'] : ''; ?>
        <?= Form::input($type, $name, $options['value'], $options['attr']) ?>

        <?php include 'help_block.php' ?>
        <?php include 'errors.php' ?>
        <?= (isset($options['widget_suffix'])) && $showLabel ? $options['widget_suffix'] : ''; ?>
    <?php endif; ?>


    <?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
</div>
<?php endif; ?>
<?php endif; ?>
