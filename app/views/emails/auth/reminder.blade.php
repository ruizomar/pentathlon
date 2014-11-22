<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
<body>
	<h2>Estimado(a) {{$nombre}}</h2>
<div>
	<p>Recientemente has solicitado restablecer tu contraseña.</p>

	<p>Click en el enlase para restablecer tu contraseña:<br>
	{{ URL::to('recover', array($token)) }}</p>

	<p>Te recomendamos que cambies la contraseña por una que recuerdes fácilmente.</p>

	<p>Atentamente<br/>
	Pentathlón Deportivo Militarizado Universitario</p>
</div>
</body>
</html>
