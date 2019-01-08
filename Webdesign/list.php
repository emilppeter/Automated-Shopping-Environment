<?php
		
	$sum1=0;
	$sum2=0;
	$sum3=0;
	$sum4=0;

	$con = mysqli_connect('localhost','root','');
	global $con;

	if(!$con)
	{
		echo 'Not connected to Server';
	}

	if(!mysqli_select_db($con,'ecart'))
	{
		echo 'Database not Selected';
	}

	$tom=$_GET['Oroq'];
	$car=$_GET['DoubleMintq'];
	$Snickers=$_GET['Snickersq'];
	//$sug=$_GET['Sugarq'];
	//$pot=$_GET['Potatoq'];
	$MinuteMaid=$_GET['MinuteMaidq'];
	if(isset($_GET['Oroc']))
	{
		$t='a';
	}
	else
	{
		$t='b';
	}
	if(isset($_GET['DoubleMintc']))
	{
		$c='a';
	}
	else
	{
		$c='b';
	}
	if(isset($_GET['Snickersc']))
	{
		$m='a';
	}
	else
	{
		$m='b';
	}
	/*if(isset($_GET['Sugarc']))
	{
		$s='a';
	}
	else
	{
		$s='b';
	}
	if(isset($_GET['Potatoc']))
	{
		$p='a';
	}
	else
	{
		$p='b';
	}*/
	if(isset($_GET['MinuteMaidc']))
	{
		$l='a';
	}
	else
	{
		$l='b';
	}
	$myfile = fopen("read.txt", "w") or die("Unable to open file!");
				fwrite($myfile, '@');

	if ($t=='a')
	{
		$sql1 = "INSERT INTO list (Product,Quantity) VALUES ('Oro',$tom)";

		if(!mysqli_query($con,$sql1))
		{
			echo 'NOT INSERTED DATA Oro';


		}
		else
			{
				$myfile = fopen("read.txt", "a") or die("Unable to open file!");
				//fwrite($myfile, '@');
				fwrite($myfile, 'T');
				fwrite($myfile, $tom);
				//fwrite($myfile, '#');
				//fwrite($myfile, ' ');					
				fclose($myfile);	
				$sqls15="SELECT Price FROM price WHERE Item='Oro'";
				$results1=mysqli_query($con, $sqls15);
				$row = mysqli_fetch_assoc($results1);
				$sum1=$tom*$row["Price"] ;
				
				global $results1;		}		
			}

		if($c=='a')
			{
		$sql2 = "INSERT INTO list (Product,Quantity) VALUES ('DoubleMint',$car)";

		if(!mysqli_query($con,$sql2))
		{
			echo 'NOT INSERTED DATA DoubleMint';

		}
		else
			{
				$myfile = fopen("read.txt", "a") or die("Unable to open file!");
				//fwrite($myfile, '@');	
				fwrite($myfile, 'C');
				fwrite($myfile, $car);
				//fwrite($myfile, '#');
				//fwrite($myfile, ' ');			
				fclose($myfile);
				$sqls15="SELECT Price FROM price WHERE Item='DoubleMint'";
				$results2=mysqli_query($con, $sqls15);
				$row = mysqli_fetch_assoc($results2);
				$sum2=$car*$row["Price"] ;
				
				
				global $results2;			}		
	}
	
	if($m=='a')
	{
		$sql3 = "INSERT INTO list (Product,Quantity) VALUES ('Snickers',$Snickers)";

		if(!mysqli_query($con,$sql3))
		{
			echo 'NOT INSERTED DATA Snickers';

		}
		else
			{
				$myfile = fopen("read.txt", "a") or die("Unable to open file!");
				//fwrite($myfile, '@');	
				fwrite($myfile, 'M');
				fwrite($myfile, $Snickers);
				//fwrite($myfile, '#');
				//fwrite($myfile, ' ');			
				fclose($myfile);
				$sqls15="SELECT Price FROM price WHERE Item='Snickers'";
				$results3=mysqli_query($con, $sqls15);
				$row = mysqli_fetch_assoc($results3);
				$sum3=$Snickers*$row["Price"] ;
				
				
				global $results3;			}		
	}

	/*if($s=='a')
	{
		$sql4 = "INSERT INTO list (Product,Quantity) VALUES ('Sugar',$sug)";

		if(!mysqli_query($con,$sql4))
		{
			echo 'NOT INSERTED DATA SUGAR';

		}
		else
			{
				$myfile = fopen("read.txt", "a") or die("Unable to open file!");
fwrite($myfile, '@');	
fwrite($myfile, 'S');	
fwrite($myfile, '\n');		
fclose($myfile);			}		
	}

	if($p=='a')
	{
		$sql5 = "INSERT INTO list (Product,Quantity) VALUES ('Potato',$pot)";

		if(!mysqli_query($con,$sql5))
		{
			echo 'NOT INSERTED DATA POTATO';

		}
		else
			{
				$myfile = fopen("read.txt", "a") or die("Unable to open file!");
fwrite($myfile, '@');	
fwrite($myfile, 'P');
fwrite($myfile, '\n');			
fclose($myfile);			}		
	}*/

	if($l=='a')
	{
		$sql6 = "INSERT INTO list (Product,Quantity) VALUES ('Minute Maid',$MinuteMaid)";

		if(!mysqli_query($con,$sql6))
		{
			echo 'NOT INSERTED DATA Minute Maid';

		}
		else
			{
				$myfile = fopen("read.txt", "a") or die("Unable to open file!");
				//fwrite($myfile, '@');	
				fwrite($myfile, 'L');
				fwrite($myfile, $MinuteMaid);
				//fwrite($myfile, '#');
				//fwrite($myfile, ' ');;			
				fclose($myfile);
				$sqls15="SELECT Price FROM price WHERE Item='Minute Maid'";
				$results4=mysqli_query($con, $sqls15);
				$row = mysqli_fetch_assoc($results4);
				$sum4=$MinuteMaid*$row["Price"] ;
								global $results4;			}		
	}

				$myfile = fopen("read.txt", "a") or die("Unable to open file!");
				fwrite($myfile, '#');
				fclose($myfile);		

	$sum=$sum1+$sum2+$sum3+$sum4;
	/*echo "\n";
	echo "Total Bill : ";
	echo $sum;*/
	
	echo"<img src=\"thankyou.jpg\" alt=\"Thankyou\"style=position:relative;opacity:0.85;width:100%>";
		echo"<div style=position:absolute;transform:translate(-50%,-50%);top:50%;left:50%;text-align:center;font-family:algerian;font-size:20px><h1>E-Cart</h1><p>Your Order's Total cost is Rs.$sum /-.</p><p>Your order would be delivered in 30 Snickerss!</p><p>THANK YOU!</p><p>Do visit again!</p></div>";

	header("refresh:8, url=erase.php");
?>