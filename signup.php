<?php

require('connections.php');

#for sign up
if(isset($_POST['signup']))
{
    $user_exist_query="SELECT * FROM  `customers` WHERE `username`='$_POST[username]' OR `email`='$_POST[email]' ";
    $result=mysqli_query($con,$user_exist_query);

    if($result)
     {
         if(mysqli_num_rows($result)>0)
           {
               #if any user has already taken usename or email
               $result_fetch=mysqli_fetch_assoc($result);
                   if($result_fetch['username']==$_POST['username'])
                        {
                          #error for username already registered
                             echo"
                              <script>
                               alert('$result_fetch[username] - Username already taken');
                               window.location.href='CustomerSignup.php';
                            </script>
                             ";
                          }
                   else
                        {
                             echo"
                                <script>
                                 alert('$result_fetch[email] - Email already registered');
                                 window.location.href='CustomerSignup.php';
                                </script>
                              ";
                          }
                   }
            else
                {
                      $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
                      $query="INSERT INTO `customers`(`username`, `email`, `password`) VALUES ('$_POST[username]', '$_POST[email]', '$password')";
                       if(mysqli_query($con,$query))
                          {
                               #if data inserted successfully
                               $_SESSION['logged_in']=true;
                                  $_SESSION['username']=$result_fetch['username'];
                              echo"
                              <script>
                               alert('Registration Successfull');
                               window.history.back();
                              </script>
                              ";
                            }
                      else
                          {
                             #if data cannont be inserted
                             echo"
                              <script>
                               alert('Cannot Run Query');
                               window.location.href='CustomerSignup.php';
                               </script>
                              ";
                           }
                     }
         }
       else
          {
              echo"
             <script>
              alert('Cannot Run Query1');
              window.location.href='CustomerSignup.php';
            </script>
             ";
          }
}
else
{
  echo"
 <script>
  alert('Cannot Run Query2');
  window.location.href='CustomerSignup.php';
</script>
 ";
}
