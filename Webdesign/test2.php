<html>
<head>
<style>
.container {
    position: relative;
	background-image:url("drawer.jpg");
	opacity:.90;

}
.dot1 {
    height: 10px;
    width: 10px;
    background-color: red;
    border-radius: 50%;
    display: inline-block;
}
.dot2 {
    height: 10px;
    width: 10px;
    background-color: green;
    border-radius: 50%;
    display: inline-block;
}

.center {
    position: absolute;
    top: 50%;
    left: 50%;
	transform: translate(-50%, -50%);
    font-size: 18px;
	
}
.center1 {
    position: relative;
    
    
	
}
.place{
	float:right;
}
table,th,td{ border:1px solid black;
border-collapse:collapse;}
th { background-color:red;
color:black;
font-family:times new roman;
font-size:20px;
}
td { background-color:#eee;
font-family:monotype corsiva;
color:black;
}
</style>
</head>
<body>
<?php

	$val=$_GET['data'];
	$myfile = fopen("read1.txt", "w") or die("Unable to open file!");
fwrite($myfile, $val);
//fwrite($myfile, $humidity);

fclose($myfile);

$con = mysqli_connect('localhost','root','');
if(!$con)
		{
			echo 'Not connected to Server';
		}

		if(!mysqli_select_db($con,'cust'))
		{
			echo 'Database not Selected';
		}
if(!$con)
		{
			echo 'Not connected to Server';
		}

		if(!mysqli_select_db($con,'cust'))
		{
			echo 'Database not Selected';
		}

switch ($val) 
		{
			case '@T':
				$query = "SELECT Quantity FROM drawer WHERE Item ='Oro'";
				$result = mysqli_query($con,$query);
				$row = mysqli_fetch_assoc($result);
				$data=$row['Quantity']+1;
				$sql1 = "UPDATE drawer SET Quantity = $data WHERE Item = 'Oro'";

				if(!mysqli_query($con,$sql1))
				{
					echo 'NOT INSERTED DATA Oro';
				}		
				break;

			case '@R':	
				$query = "SELECT Quantity FROM drawer WHERE Item ='DoubleMint'";
				$result = mysqli_query($con,$query);
				$row = mysqli_fetch_assoc($result);
				$data=$row['Quantity']+1;
				$sql1 = "UPDATE drawer SET Quantity = $data WHERE Item = 'DoubleMint'";

				if(!mysqli_query($con,$sql1))
				{
					echo 'NOT INSERTED DATA LASUN';}
			
				break;

			case '@G':
				$query = "SELECT Quantity FROM drawer WHERE Item ='Minute Maid'";
				$result = mysqli_query($con,$query);
				$row = mysqli_fetch_assoc($result);
				$data=$row['Quantity']+1;
				$sql1 = "UPDATE drawer SET Quantity = $data WHERE Item = 'Minute Maid'";

				if(!mysqli_query($con,$sql1))
				{
					echo 'NOT INSERTED DATA Oro';
				}	
				break;	
			case '@C':
				$query = "SELECT Quantity FROM drawer WHERE Item ='Snickers'";
				$result = mysqli_query($con,$query);
				$row = mysqli_fetch_assoc($result);
				$data=$row['Quantity']+1;
				$sql1 = "UPDATE drawer SET Quantity = $data WHERE Item = 'Snickers'";

				if(!mysqli_query($con,$sql1))
				{
					echo 'NOT INSERTED DATA Oro';
				}
					
				break;

			case '$T':	
				$query = "SELECT Quantity FROM drawer WHERE Item ='Oro'";
				$result = mysqli_query($con,$query);
				$row = mysqli_fetch_assoc($result);
				$data=$row['Quantity']-1;
				$sql1 = "UPDATE drawer SET Quantity = $data WHERE Item = 'Oro'";

				if(!mysqli_query($con,$sql1))
				{
					echo 'NOT DELETED DATA Oro';
				}	
					
				break;
			
			case '$R':	
				$query = "SELECT Quantity FROM drawer WHERE Item ='DoubleMint'";
				$result = mysqli_query($con,$query);
				$row = mysqli_fetch_assoc($result);
				$data=$row['Quantity']-1;
				$sql1 = "UPDATE drawer SET Quantity = $data WHERE Item = 'DoubleMint'";

				if(!mysqli_query($con,$sql1))
				{
					echo 'NOT DELETED DATA LASUN';
				}		
				
				break;
			case '$G':
				$query = "SELECT Quantity FROM drawer WHERE Item ='Minute Maid'";
				$result = mysqli_query($con,$query);
				$row = mysqli_fetch_assoc($result);
				$data=$row['Quantity']+1;
				$sql1 = "UPDATE drawer SET Quantity = $data WHERE Item = 'Minute Maid'";

				if(!mysqli_query($con,$sql1))
				{
					echo 'NOT INSERTED DATA Oro';
				}
						
				break;	
			case '$C':
				$query = "SELECT Quantity FROM drawer WHERE Item ='Snickers'";
				$result = mysqli_query($con,$query);
				$row = mysqli_fetch_assoc($result);
				$data=$row['Quantity']+1;
				$sql1 = "UPDATE drawer SET Quantity = $data WHERE Item = 'Snickers'";
				if(!mysqli_query($con,$sql1))
				{
					echo 'NOT INSERTED DATA Oro';
				}
						
				break;	

			default:
				echo "Invalid String";
				break;
		}
?>	
<div style="width:100%;">	
<div class="container"><img style="height:150;">
<div class="center"><h1 style="text-align:center;font-family:algerian;font-size:30px;color:dark red;">Automated Shopping Sytem</h1></div></div>
<table style="width:100%">
<caption style="font-size:25px;text-align:center;font-family:algerian"><b>Smart Drawer</caption>
</div>
		<tr>
		<th value="Item">Item</th>
		<th value="Quantity">Quantity</th>
		<th value="Indicator">Indicator</th>
		</tr>
<tr>
	<td style="text-align:center;" width="(100/3)%">Oro</td>
	<td style="text-align:center;" width="(100/3)%"><?php
				$query = "SELECT Quantity FROM drawer WHERE Item ='Oro'";
				$result = mysqli_query($con,$query);
				$row = mysqli_fetch_assoc($result);
				echo $row['Quantity']
				?>
	</td>
	<td style="text-align:center;" width="(100/5)%">
	<?php
				$query = "SELECT Quantity FROM drawer WHERE Item ='Oro'";
				$result = mysqli_query($con,$query);
				$row = mysqli_fetch_assoc($result);
				$des=$row['Quantity'];
				if($des<=2)
   				{	echo"<img src=\"reddot.jpg\" alt=\"Reddot\"style=position:relative;width:4%>";
					}
				else
    			{
     				echo"<img src=\"greendot.jpg\" alt=\"Greendot\"style=position:relative;width:4%>";    }
				?>
	
	</td>			
	
</tr>	
<tr>
	<td style="text-align:center;" width="(75/2)%">Double Mint</td>
	<td style="text-align:center;" width="(75/2)%"><?php
				$query = "SELECT Quantity FROM drawer WHERE Item ='DoubleMint'";
				$result = mysqli_query($con,$query);
				$row = mysqli_fetch_assoc($result);
				echo $row['Quantity']
				?>
					
	</td>
	<td style="text-align:center;" width="25%">
	<?php
				$query = "SELECT Quantity FROM drawer WHERE Item ='DoubleMint'";
				$result = mysqli_query($con,$query);
				$row = mysqli_fetch_assoc($result);
				$des=$row['Quantity'];
				if($des<=2)
   				{	echo"<img src=\"reddot.jpg\" alt=\"Reddot\"style=position:relative;width:4%>";
					}
				else
    			{
     				echo"<img src=\"greendot.jpg\" alt=\"Greendot\"style=position:relative;width:4%>";    }
				?>
	
	</td>
</tr>	
<tr>
	<td style="text-align:center;" width="(100/3)%">Minute Maid</td>
	<td style="text-align:center;" width="(100/3)%"><?php
				$query = "SELECT Quantity FROM drawer WHERE Item ='Minute Maid'";
				$result = mysqli_query($con,$query);
				$row = mysqli_fetch_assoc($result);
				echo $row['Quantity']
				?>
					
	</td>
	<td style="text-align:center;" width="(100/3)%">
	<?php
				$query = "SELECT Quantity FROM drawer WHERE Item ='Minute Maid'";
				$result = mysqli_query($con,$query);
				$row = mysqli_fetch_assoc($result);
				$des=$row['Quantity'];
				if($des<=2)
   				{	echo"<div class='center1' ><img src=\"reddot.jpg\" alt=\"Reddot\"style=position:relative;width:4%></div>";
   					
					}
				else
    			{
     				echo"<img src=\"greendot.jpg\" alt=\"Greendot\"style=position:relative;width:4%>";    }
				?>
	
	</td>
</tr>	
<tr>
	<td style="text-align:center;" width="(100/3)%">Snickers</td>
	<td style="text-align:center;" width="(100/3)%"><?php
				$query = "SELECT Quantity FROM drawer WHERE Item ='Snickers'";
				$result = mysqli_query($con,$query);
				$row = mysqli_fetch_assoc($result);
				echo $row['Quantity']
				?>
					
	</td>
	<td style="text-align:center;" width="(100/3)%">
	<?php
				$query = "SELECT Quantity FROM drawer WHERE Item ='Snickers'";
				$result = mysqli_query($con,$query);
				$row = mysqli_fetch_assoc($result);
				$des=$row['Quantity'];
				if($des<=2)
   				{	echo"<img src=\"reddot.jpg\" alt=\"Reddot\"style=position:relative;width:4%>";
					}
				else
    			{
     				echo"<img src=\"greendot.jpg\" alt=\"Greendot\"style=position:relative;width:4%>";    }
				?>
	
	</td>
</tr>	

</table>	

<p align="center"><a href="main.html"><input type="button" name="button" value="Go To Cart"></a></p>
<footer style="text-align:center;background-color:black;color:white">Copyright &copy Automatedshoppingsystem.com</footer>

</body>
</div>
</html>