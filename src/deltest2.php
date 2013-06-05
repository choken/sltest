<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<title>HTML</title>
		<meta name="description" content="" />
		<meta name="author" content="choken" />

		<meta name="viewport" content="width=device-width; initial-scale=1.0" />

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico" />
		<link rel="apple-touch-icon" href="/apple-touch-icon.png" />

		<script src="js/jquery-2.0.2.min.js"></script>
		<script type="text/javascript">
			var myVarData = {"greeting": "Välkommen!", "extraAnimal1": "Elefanter", "extraAnimal2": "Krokodiler"};
		
		
			$.fn.tempMaster = function(pathToTemplateMain, vardata) {
				pathToTemplates = pathToTemplateMain.substring(0, url.lastIndexOf("/") + 1);
				
				$.get(pathToTemplates + '/' + filepath, function(data) {
					this.html(data);
				});

				// Lets chain
				return this._tempMaster(pathToTemplates, vardata);

				});


			$.fn._tempMaster = function(pathToTemplates, vardata) {
				// Iterate
				return this.each(function() {
					// Iterate through all text nodes.
					this.contents().filter(function() {
						return this.nodeType === 3;
						//Node.TEXT_NODE
					}).each(function() {
						// For each text node look for the tokens '{' and '}'
						var matches = this.text().match("\\{([\\w\\/\\.]+)\\s?([\\w\\/\\.]*)\\}");
						if (matches) {
							if (matches.length > 2 && matches[1].trim === "include") {
								filepath = matches[2];
								$.get(pathToTemplates + '/' + filepath, function(data) {
									this.html(data);
								});
							} else {
								//Todo: Deltest2
							}

						}
					});

					// Do it recursive in dom
					this.children().each(function() {
						this.tempMaster(pathToTemplates);
					})
					// Lets chain
					return this;

				});
			}

			$(document).ready(function() {
				$("content").tempMaster("templates/main.html");
			});
		</script>
	</head>

	<body>
		<div>
			<header>
				<h1>HTML</h1>
			</header>
			<nav>
				<p>
					<a href="/">Home</a>
				</p>
				<p>
					<a href="/contact">Contact</a>
				</p>
			</nav>

			<div id="content">

			</div>

			<footer>
				<p>
					&copy; Copyright  by choken
				</p>
			</footer>
		</div>
	</body>
</html>
