<DOCTYPE! html>
<html lang="es">
 <head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="index.css" media="all"/>
	<title>Plazas de TAE's Prepa 3</title>
 </head>
 <body>
	<!--Mensaje de bienvenida para la página y barra de navegación-->
	<header id="inicio">
		<nav id="myTopnav" class="topnav">
		<img src="prepa3-logo.jpg" style="margin:5px;display:block; float:left; height:35px; width:30px;">
		<a href="#home" class="active">Inicio</a>
		<a href="#taes">Ver TAES por Departamento</a>
		<a href="#">Ver Lista de TAEs</button>
		<a href="#contactos">Contacto</a>
		<a href="login.php" id="login">¿Profesor?</a>
		</nav>
	</header>

	<div id="home">
		<div class="bg-image">
			<div style="padding-top:10%; display:block; position:relative; float:center;">
				<h1 class="bg-text">Bienvenido a TAEs Prepa 3</h1>
				<p class="bg-text">Escoge un departamento y selecciona tu TAE favorita</p>
				<p class="bg-text"><a href="#taes">¡ Comenzar !</a></p>
			</div>
		</div>
	</div>
	
	<!-------------------------------Departamentos de las TAEs------------------>
	<section id="taes">
		<p>Puedes escoger un departamento para ver sus TAEs correespondientes</p>
		<br>
		<div>
			<a href="#salud_cnat">Ciencias Naturales y Salud</a>
			<a href="#humm_soc">Humanidades y Sociedad</a>
			<a href="#mates">Matemática</a>
			<a href="#comm">Comunicación</a>
			<a href="#sociotec">Socio-tecnologías</a>
		</div>
	</section>
	<div class="corto" id="fondo-taes1"></div>
	<!-------------------------------------------------------------------------->
	
		<!-------------------------------Opciones----------------------------------->
		<!--Se introducen "modal" de formulario de -->
		<!--formulario para inscripción a la TAE -->
		<!--NOTA: Modal es un panel que muestra información -->
		<!--en primer plano y que se cierra dando clic fuera de él -->
		<!--o con un botón-->
		<!-------------------------------------------------------------------------->
		<section id="salud_cnat">
		<hr>
		<h1>Salud y Ciencias Naturales</h1>
			<article id="proteccivil">
				<h1>Protección Civil</h1>
				<br>
				<p>Breve descripción de la TAE</p>
				<button onclick="document.getElementById('proteccivil').style.display='block'">Formulario de Inscripción</button>
					<div id="proteccivil" class="modal">	
						<form class="modal-contenido animate" method="post" action="">
							 <span onclick="document.getElementById('proteccivil').style.display='none'" class="close" title="Cerrar">&times;</span>
							<table>
								<tr>
									<td style="text-align:center;"><h1>Protección Civil</h1></td>
								</tr>
								<tr>
									<td style="text-align:right;">Nombre(s): </td><td><input type="text" name="nombres" required></td>
								</tr>
								<tr>
									<td style="text-align:right;">Apellido Paterno: </td><td><input type="text" name="apellido_pa" required></td>
								</tr>
								<tr>
									<td style="text-align:right;">Apellido Materno: </td><td><input type="text" name="apellido_ma"></td>
								</tr>
								<tr>
									<td>Número de Alumno:</td><td><input type="number" name="cod_alumno" minlength="9" maxlength="9" required></td><td>Turno: <select name="turno" required><option selected>Matutino</option><option>Vespertino</option></select></td>
								</tr>
								<tr>
									<td colspan="2"><button type="reset">limpiar campos</button></td>
									<td colspan="2"><button type="submit">Enviar</button></td>
								</tr> 
							</table>
						</form>
					</div>
				<script>
				// Obtener modal
				var modal = document.getElementById('proteccivil');
				// cuando se cliquea donde sea entonces cerrar modal:
				window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
					}
				}
				</script>
			</article>
			<article class="gestsalud">
				<h1>Gestión de la Salud</h1>
				<br>
				<p>Breve descripción de la TAE</p>
				
				<button onclick="document.getElementById('gestsalud').style.display='block'">Formulario de Inscripción</button>
					<div id="gestsalud" class="modal">	
						<form class="modal-contenido animate" method="post" action="">
							 <span onclick="document.getElementById('gestsalud').style.display='none'" class="close" title="Cerrar">&times;</span>
							<table>
								<tr>
									<td style="text-align:center;"><h1>Gestión de la Salud</h1></td>
								</tr>
								<tr>
									<td style="text-align:right;">Nombre(s): </td><td><input type="text" name="nombres" required></td>
								</tr>
								<tr>
									<td style="text-align:right;">Apellido Paterno: </td><td><input type="text" name="apellido_pa" required></td>
								</tr>
								<tr>
									<td style="text-align:right;">Apellido Materno: </td><td><input type="text" name="apellido_ma"></td>
								</tr>
								<tr>
									<td>Número de Alumno:</td><td><input type="number" name="cod_alumno" minlength="9" maxlength="9" required></td><td>Turno: <select name="turno" required><option selected>Matutino</option><option>Vespertino</option></select></td>
								</tr>
								<tr>
									<td colspan="2"><button type="reset">limpiar campos</button></td>
									<td colspan="2"><button type="submit">Enviar</button></td>
								</tr> 
							</table>
						</form>
					</div>
				<script>
				// Obtener modal
				var modal = document.getElementById('gestsalud');
				// cuando se cliquea donde sea entonces cerrar modal:
				window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
					}
				}
				</script>
			</article>
		</section>
		<!-------------------------------------------------------------------------->
		<div class="corto" id="fondo-taes2"></div>
		<!-------------------------------------------------------------------------->
		<section id="humm_soc">
			<hr>
			<h1>Humanidades y Sociedad</h1>
			<article class="proyectempr">
				<h1>Proyecto Emprendedor</h1>
				<br>
				<p>Breve descripción de la TAE</p>
			</article>
			<article class="politic">
				<h1>Liderazgo y Política en la Sociedad Mexicana</h1>
				<br>
				<p>Breve descripción de la TAE</p>
			</article>
			<article class="danzco">
				<h1>Danza Contemporánea</h1>
				<br>
				<p>Breve descripción de la TAE</p>
			</article>
			<article class="danzfolc">
				<h1>Danza Folclórica</h1>
				<br>
				<p>Breve descripción de la TAE</p>
			</article>
			<article class="teatro">
				<h1>Expresión Teatral</h1>
				<br>
				<p>Breve descripción de la TAE</p>
			</article>
			<article class="musica">
				<h1>Interpretación y Creación Musical</h1>
				<br>
				<p>Breve descripción de la TAE</p>
			</article>
		</section>
		<!-------------------------------------------------------------------------->
		
		<!-------------------------------------------------------------------------->
		<section id="mates">
			<hr>
			<h1>Matemática</h1>
			<article class="su_mat">
				<h1>Creatividad en el Pensamiento Matemático</h1>
				<br>
				<p>Breve descripción de la TAE</p>
			</article>
		</section>
		<!-------------------------------------------------------------------------->
		
		<!-------------------------------------------------------------------------->
		<section id="comm" class="opc_menu">
			<hr>
			<h1>Comunicación</h1>
			<article class="frances">
				<h1>Francés</h1>
				<br>
				<p>Breve descripción de la TAE</p>
			</article>
		</section>
		<!-------------------------------------------------------------------------->
		
		<!-------------------------------------------------------------------------->
		<section id="sociotec">
			<hr>
			<h1>Socio-Tecnologías</h1>
			<article class="electr_res">
				<h1>Instalaciones Eléctricas Residenciales</h1>
				<br>
				<p>Breve descripción de la TAE</p>
			</article>
			<article class="robot">
				<h1>Fundamentos de Electrónica y Robótica</h1>
				<br>
				<p>Breve descripción de la TAE</p>
			</article>
		</section>
		<!-------------------------------------------------------------------------->
		<footer id="contactos" style="background-color:black; color:white; text-align:center;">
				<div>
					<p>Escuela Preparatoria No. 3  Contáctanos: tel.: 33333333 e-mail: dgsgdgsg@ggsdgg.com </p>
					<p>Dirección: Goméz De Mendiola y gdgdggdgd no. 333 col. Oblatos, Guadalajara, Jalisco</p>
				</div>
		</footer>
 </body>
</html>
















