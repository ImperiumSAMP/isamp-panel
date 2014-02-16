<html>
<head>
<link rel="stylesheet" href="table-styles.css" />
</head>
<body>
<h2>Iniciar Sesi&oacute;n</h2>
<div class="login-form">
<?php echo validation_errors(); ?>
<?php if ( $this->session->flashdata( 'message' ) ) : ?>
    <p><?php echo $this->session->flashdata( 'message' ); ?></p>
<?php endif; ?>
<?php echo form_open('login'); ?>
<h5>Usuario</h5>
<input type="text" name="username" value="<?php echo set_value('username')?>" size="50" />

<h5>Password</h5>
<input type="text" name="password" value="" size="50" />

<div><input type="submit" value="Iniciar sesi&oacute;n" /></div>
<?php echo form_close(); ?>
</div>
</body>
</html>