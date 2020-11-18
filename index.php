<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<link href="style.css" rel="stylesheet" />

    <title>MyUpload</title>
  </head>
  <?php 
	if(isset($_GET['select'])){
		$background = "style='background-image: url(arquivos/".$_GET['select'].")'";
	}else{
		$background = "style='background-color: #777'";
	}
	 print("<body $background  id='body'>"); 
  ?>
    <div class="container">
		<div class="row">
			<div class="col-lg-6 offset-lg-3 jumbotron mt-3">
				<p class="lead text-center">Defina o fundo do jeito que você quiser!</p>
				<form class="bg-secondary text-light rounded p-3" action="salvar.php" method="POST" enctype="multipart/form-data">

					<div class="form-group m-0 entrada">

						<img src="input_image.svg" alt="entrada de imagem" id="preview" for="input_arquivo" class="inputImage" />
						
						<input type="file" id="input_arquivo" class="form-control p-1" name="documento" accept="jpg|jpeg|gif|bmp|png|tiff|svg">

					</div>

					<button type="submit" class="alterar">alterar fundo</button>

				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12" id="pai">
				<?php
					// criando conexão
					$conn = new mysqli("localhost","root","","myupload");

					// verifica conexão
					if($conn->connect_error){
						exit("<span>Erro ao conectar ao banco de dados.</span>");
					}
					
					$sql = "SELECT id, documento, `data` FROM arquivos";
					
					$res = $conn->query($sql);
					
					if($res->num_rows > 0){
						while($row = $res->fetch_object()){
							print "
								<div id='boximagem'>
									<a href='index.php?select=".$row->documento."'>
										<img src='arquivos/".$row->documento."' id='imagem' class='imagem' />
									</a>
								</div>
							";
						}
					}

				?>
			</div>
		</div>
	</div>

	<script>
		function readImage(){
			if(this.files && this.files[0]){
				var file = new FileReader();
				file.onload = function(e){
					document.getElementById("preview").src = e.target.result;
					document.getElementById("preview").classList.add('preview');
				};
				file.readAsDataURL(this.files[0]);
			}
			console.log(this.files);
		}
		document.getElementById("input_arquivo").addEventListener("change", readImage, false);
	</script>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>