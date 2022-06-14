1) Add the project folder to the Xampp/htdocs folder

2) Due to the fact that we are using another custom port for our XAMPP Services (3307), 
  for anyone who is using the default port (3006) should change the files "function.php",
  which appears twice in our project. In each file, 2 similar changes must be done:
 - Substitute this line:
    $cn = mysqli_connect("localhost", "root", "", "travel", "3307");
  With this line: 
    $cn = mysqli_connect("localhost", "root", "", "travel");
    
3) If you are using another port, different from the two mentioned, just replace the 
  the port number in the above line, as follows: 
    $cn = mysqli_connect("localhost", "root", "", "travel", "YOUR_PORT_NUMBER");
    
4) Enjoy the project!!!
