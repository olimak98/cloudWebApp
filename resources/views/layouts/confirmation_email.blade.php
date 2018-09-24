<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
</head>
<body>
	<h2>Bienvenido {{$first_name}} </h2>
	<p>Para confirmar tu correo da click al siguiente enlace</p>
	<a href="{{ url('register/verify/') . '/' . $email . '/' . $confirmation_code }}">
		Click para confirmar el correo.
	</a>
</body>
</html>