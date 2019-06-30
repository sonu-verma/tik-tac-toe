<html>
<head>
	<title> X & 0</title>
	<style type="text/css">
		table{
			height: 350px;
		    width: 350px;
		    text-align: center;
		    margin-left: 35%;
		    margin-top: 5%;
		}

		tr,td{
			border: 1px solid;
		}
		td{
			padding: 5px 5px 5px 5px;
			height: 50px;
		    width: 50px;
		}

		h1{
			text-align: center;
		}
		.reset-btn{
			text-align: center;
		}

	</style>
</head>
	<link rel="stylesheet" href="./bootstrap.min.css">

	<script src="./jquery-3.3.1.slim.min.js"></script>	
	<script src="./popper.min.js"></script>
	<script src="./bootstrap.min.js"></script>
	<script type="text/javascript" src="./jquery.min.js"></script>
	<body>
			
		<div class="container">
			<!-- <div class="row"> -->
				<div><h1>Turn <span class="turn">X</span></h1></div>
				<div class="reset-btn">  
					<span>
						<button onclick="initialStart()">Reset</button>
					</span>
				</div>
			<!-- </div> -->
				<table>
					<?php
						for($i = 0; $i < 3; $i++){
								
							echo "<tr>";	
							for($j=0 ; $j< 3; $j++){
								echo '<td class="cells" id="cell_'.$i.'_'.$j.'"  data-check="['.$i.','.$j.']" data-val=""></td>';
							}
							echo "</tr>";	
						}
					?>
				</table>
		</div>

		
	</body>

	<script type="text/javascript">
		a = true;
		var user = '';
		$('.cells').click(function(){	

			if($(this).data('val') != ''){
				return false;
			}
			if(a){
				user = 'Player 1';
				$(this).text('X');
				$('.turn').text('0');
				$(this).data('val','X');	
			}else{
				user = 'Player 2';
				$(this).text('0');
				$('.turn').text('X');
				$(this).data('val','0');	
			}

			// var valll = {};
			var myarray=[
						[], 
						[], 
						[]
						];
			for(let i = 0;i < 3; i++){
				for(let j = 0;j < 3; j++){
					//console.log('['+i+','+j+']',$('#cell_'+i+'_'+j).data('val'));
						myarray[i][j] = $('#cell_'+i+'_'+j).data('val');	
				}	
			}	

	
			let output = computeRow(myarray);
			
			let output1 = computeColumn(myarray)
			
			let output2 = diagonalCheck(myarray)
			
			let output3 = is_drawn(myarray);
			
			if(output){
				successMsg();
			}else if(output1){
				successMsg();
			}else if(output2){
				successMsg();
			}else if(output3){

				setTimeout(() => {
					alert("the game is drawn!");
					
					initialStart();
				},  100)
				return;

			}else{
					a = !a; 
			}

			
		});

		function successMsg(){
			setTimeout(() => {

					alert(user+" Win!");
					initialStart();
				},  100)
				return;
		}


		function computeRow(myarray){

			for(let i = 0; i < myarray.length; i++){
				let firstValue = myarray[i][0];
				let counter = 0;
				if(firstValue === ""){
					continue;
				}
				for(let j = 0; j < myarray.length; j++){
					if(myarray[i][j] !== firstValue){
						break;
					}
					counter++;
				}
				if(counter > 2){
					return true;
				}
				

			}
			return false;
		}

		function computeColumn(myarray){
			for (var j = 0; j < myarray.length; j++) {
				let firstValue = myarray[0][j];
				let counter = 0;

				if(firstValue === ""){
					continue;
				}

				for(let i = 0; i < myarray.length; i++){
					if(myarray[i][j] !== firstValue){
						break;
					}
					counter++;
				}
				if(counter > 2){
					return true;
				}
			}
			return false;

		}


		function diagonalCheck(myarray){

			let counter = 0;

			for (var i = 0; i < myarray.length; i++) {
				let firstValue = myarray[0][0];
				if(firstValue === ""){
					break;
				}
				if(myarray[i][i] !== firstValue){
					break;
				}

				counter++;
			}
			

			if(counter > 2){
				return true;
			}

			counter = 0;
			let j = 2;
			for(var i=0 ; i<myarray.length; i++)
			{
				let firstValue =  myarray[0][2];
				if(firstValue === ""){
					break;
				}
				if(myarray[i][j] !== firstValue){
					break;
				}
				counter++;

				j--;
			}

			if(counter > 2){
				return true;
			}	

			return false;
		}	


		function initialStart(){
			a =  true;
			$('.turn').text('X');
			$('.cells').data('check','');
			$('.cells').data('val','');
			$('.cells').text('');
		}	


		function is_drawn(myarray){
			var arr = [];
			for(let i = 0; i < myarray.length; i++ ){
				for(let j = 0; j < myarray.length; j++ ){
						arr.push(myarray[i][j]);
					
				}	
			}

			if(!arr.includes("")){
				
				return true;
			} 
		}	
	</script>
				
</html>