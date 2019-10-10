<?php
$source = 'Mohammed Savad';
mb_internal_encoding("UTF-8");
			
			if(strlen($source) == 1)
			{
				if($source=='i')
				{
					echo "آ";
				}
			}
			// check for arabic chars in
			// remove all the vowels unless they're doubled up or u or ie
			echo " ";
			for ($i = 0; $i < strlen($source); $i++) 
			{
				$char = substr($source, $i, 1);
				// check for arabic characters in the string and just output them if they exist
				if(ord(substr($source, 0, 1))==216 || ord(substr($source, 0, 1))==217)
				{	
					echo substr($source, $i, 2);
					$i++;
					continue;
				}
				$char = strtolower($char);
				switch($char)
				{
					case 'a':
						echo 'ا'; // alif
					break;
					case 'b':
						echo 'ب'; // bah
					break;
					case 'c':
						echo 'ك'; // kah
					break;
					case 'd':
						echo 'د'; // dal
					break;
					case 'e':
						echo 'ي'; // yeh
					break;
					case 'f':
						echo 'ف'; // feh
					break;
					case 'g':
						echo 'غ'; // ghaim
					break;
					case 'h':
						echo 'ه'; // heh
					break;
					case 'i':
						echo 'ي'; // yeh
					break;
					case 'j':
						echo 'ج'; // jeem
					break;
					case 'k':
						echo 'ك'; // kaf
					break;
					case 'l':
						echo 'ل'; // lam
					break;
					case 'm':
						echo 'م'; // meem
					break;
					case 'n':
						echo 'ن'; // noon
					break;
					case 'o':
						echo 'و'; // waw
					break;
					case 'p':
						echo 'ب'; // beh
					break;
					case 'q':
						echo 'ك'; // kah
					break;
					case 'r':
						echo 'ر'; // reh
					break;
					case 's':
						echo 'س'; // seen
					break;
					case 't':
						echo 'ت'; // teh
					break;
					case 'u':
						echo 'و'; // waw
					break;
					case 'v':
						echo 'ڤ'; // veh
					break;
					case 'w':
						echo 'و'; // waw
					break;
					case 'x':
						echo 'كس'; // kaf and seen
					break;
					case 'y':
						echo 'ي'; // yeh
					break;
					case 'z':
						echo 'ز'; // zain
					break;
					default:
						echo $char;						
					break;
				}
			}
?>