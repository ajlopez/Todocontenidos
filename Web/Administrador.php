<?
	include('Usuarios.inc.php');

	AdministradorControla('');

	include('Conexion.inc.php');

	Conectar();

	include('Campos.inc.php');

	$PaginaTitulo = "Administrador";

	require('Inicio.inc.php');
?>

<center>

<p>
<a href="Usuarios.php">Usuarios</a>
<br>
<a href="EjecutaSqlEx.php?Consulta=<? echo urlencode("select p.Descripcion, count(*) from usuarios u left join paises p on u.IdPais = p.Id group by p.Descripcion order by 2 desc"); ?>&Titulo=Usuarios+por+Pais">Usuarios por Pais</a>
<br>
<a href="CursosCategorias.php">Categor&iacute;as de Cursos</a>
<br>
<a href="Cursos.php">Cursos</a>
<br>
<a href="Categorias.php">Categor&iacute;as</a>
<br>
<a href="Items.php">Items</a>
<br>
<a href="Articulos.php">Art&iacute;culos</a>
<br>
<a href="ItemsExplora.php">Explora Items</a>
<br>
<a href="ItemsSugeridosExplora.php">Explora Items Sugeridos</a>
<br>
<a href="Eventos.php">Eventos</a>
<br>
<a href="Eventos.php?Tipo=IN">Ingresos</a>
<br>
<a href="Eventos.php?Tipo=RM">Emails</a>
<br>
<a href="Eventos.php?Tipo=RR">Referidos</a>
<br>
<a href="EventosPorFecha.php">Eventos por Fecha</a>
<br>
<a href="Eventos.php?Tipo=RG">Registraciones</a>
<br>
<a href="EjecutaSqlEx.php?Consulta=<? echo urlencode("select * from contactos order by id desc"); ?>&Titulo=Contactos">Contactos</a>
<br>
<a href="EjecutaSqlEx.php?Consulta=<? echo urlencode("select * from usuarioscursos where Precio>0"); ?>&Titulo=Cursos+Pagos">Cursos Pagos</a>
<br>
<a href="EjecutaSqlEx.php?Consulta=<? echo urlencode("select * from pagos"); ?>&Titulo=Pagos">Pagos</a>
<br>
<a href="EjecutaSqlEx.php?Consulta=<? echo urlencode("select Id, Codigo, Email, Comentarios from usuarios where Comentarios>'' order by Id desc"); ?>&Titulo=Comentarios">Comentarios</a>
<br>
<a href="RankingCategorias.php">Ranking de Categor&iacute;as</a>
<br>
<a href="RankingItems.php">Ranking de Items</a>
<br>
<a href="RankingArticulos.php">Ranking de Art&iacute;culos</a>
<br>
<a href="EjecutaSql.php">Ejecuta SQL</a>
<br>
<a href="EnviarEmail.php">Enviar Email</a>
<br>
<a href="PhpInfo.php" target="_blank">PhpInfo</a>
<br>
<a href="http://www.todocontenidos.com/mysqlcontrol" target="_blank">PhpMyAdmin Remoto</a>
<br>
<a href="http://www.todocontenidos.com/siteadmin" target="_blank">Panel de Control Remoto</a>
<br>

</p>

</center>

<?
	Desconectar();
	require('Final.inc.php');
?>



