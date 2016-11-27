<?php include ("cabecalho_usuario.php");
	include ("php/conexao.php");
 ?>
<?php 
		# code...
		$dataPesquisa = date("Y-m-d");
		$diaPesquisa = date("d");
		$mesPesquisa = date("m");
		$anoPesquisa = date("Y");
		$servico = (int)$_GET['servico']; 
		$estado = (int)$_GET['estado'];
		$regiao = (int)$_GET['regiao'];
		$cidade = $_GET['cidade'];
		$periodo = (int)$_GET['periodo'];
		if ($periodo == 0) {
			$periodo = 120;
		}
		
		$dataPeriodo = mktime(0,0,0,$mesPesquisa,$diaPesquisa+$periodo,$anoPesquisa);
		$dataPeriodo = date("Y-m-d",$dataPeriodo);

	
 ?>
 <!-- Se for ensaio Regional mostra essa tabela-->
<?php if ($servico == 5) { 

	
		# algoritimo de Busca
		$query = "SELECT l.id_lista, l.data, s.nome_servico, h.horario, i.ds_igreja, c.nome_cidade, r.nome_regiao, lt.id_regiao, p.nome as anciao, ec.nome as encarregado
			FROM lista_cultos l 
			INNER JOIN lista lt ON (lt.id_lista = l.id_lista)
			INNER JOIN tipo_servico s ON (s.id_servico = l.id_servico)
			INNER JOIN horario h ON  (h.id_horario = l.id_horario)
			INNER JOIN igreja i ON (i.id_igreja = l.id_igreja)
			INNER JOIN cidade c ON (c.id_cidade = l.id_cidade)
			INNER JOIN presbitero p ON (p.id_presbitero = l.id_presbitero)
            INNER JOIN presbitero ec ON (ec.id_presbitero = l.id_encarregado)
			INNER JOIN regiao r ON (r.id_regiao = lt.id_regiao)
			WHERE l.id_servico = $servico AND r.id_regiao = $regiao AND c.nome_cidade LIKE '%$cidade%'  AND l.data >= '$dataPesquisa' AND l.data <= '$dataPeriodo' ORDER BY l.data";
		?>

	<section class="bg-primary">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<table class="table table-responsive table-condensed">
							<tr>
								<th>Serviço</th>
								<th>Cidade</th>
								<th>Ancião e Encarregado</th>
								<th>Data e Horário</th>
							</tr>
							<?php 
								$stmt = $conexao->query($query); #ESTANCIAMENTO
							    $resultado = $stmt->fetchAll();  

							    foreach ($resultado as $pesquisa) {
							     	# code...
							     ?>
							<tr>
								<td><?php echo $pesquisa['nome_servico']; ?></td>
								<td><?php echo $pesquisa['nome_cidade'] . " (" . $pesquisa['ds_igreja'] .  ")";?></td>
								<td><?php echo "Ir. " .$pesquisa['anciao'] . " Cardia <br>Enc. Louvo " . $pesquisa['encarregado'];?></td>
								<td><?php echo date("d/m", strtotime($pesquisa['data'])) . " " .date("H:i", strtotime($pesquisa['horario']));;?></td>
							</tr>
							<?php } ?>
						</table>
					</div>
					<div class="col-md-1"></div>
					<div class="text-center">
						<a href="index.php#indexpesquisa" class="btn btn-default btn-xl sr-button">Voltar</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Se nao for ensaio Regional mostra essa tabela-->
<?php } else { 


		# algoritimo de Busca
		$query = "SELECT l.id_lista, l.data, s.nome_servico, h.horario, i.ds_igreja, c.nome_cidade, r.nome_regiao, lt.id_regiao, p.nome as anciao, ec.nome as encarregado
			FROM lista_cultos l 
			INNER JOIN lista lt ON (lt.id_lista = l.id_lista)
			INNER JOIN tipo_servico s ON (s.id_servico = l.id_servico)
			INNER JOIN horario h ON  (h.id_horario = l.id_horario)
			INNER JOIN igreja i ON (i.id_igreja = l.id_igreja)
			INNER JOIN cidade c ON (c.id_cidade = l.id_cidade)
			INNER JOIN presbitero p ON (p.id_presbitero = l.id_presbitero)
            INNER JOIN presbitero ec ON (ec.id_presbitero = l.id_encarregado)
			INNER JOIN regiao r ON (r.id_regiao = lt.id_regiao)
			WHERE l.id_servico = $servico AND r.id_regiao = $regiao AND c.nome_cidade LIKE '%$cidade%' AND l.data >= '$dataPesquisa' AND l.data <= '$dataPeriodo' ORDER BY l.data";
			?>
<section class="bg-primary">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<table class="table table-responsive table-condensed">
							<tr>
								<th>Serviço</th>
								<th>Cidade</th>
								<th>Ancião</th>
								<th>Data e Horario</th>
							</tr>
							<?php 
								$stmt = $conexao->query($query); #ESTANCIAMENTO
							    $resultado = $stmt->fetchAll();  

							    foreach ($resultado as $pesquisa) {
							     	# code...
							     ?>
							<tr>
								<td><?php echo $pesquisa['nome_servico']; ?></td>
								<td><?php echo $pesquisa['nome_cidade'] . " (" . $pesquisa['ds_igreja'] .  ")";?></td>
								<td><?php echo $pesquisa['anciao']; ?></td>
								<td><?php echo date("d/m", strtotime($pesquisa['data'])) . " " .date("H:i", strtotime($pesquisa['horario']));;?></td>
							</tr>
							<?php } ?>
						</table>
					</div>
					<div class="col-md-1"></div>
					<div class="text-center">
						<a href="index.php#indexpesquisa" class="btn btn-default btn-xl sr-button">Voltar</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>
<?php include("rodape_usuario.php") ?>