<?php

require('connections.php');
session_start();

#for login
if(isset($_POST['login']))
{
      $query="SELECT * FROM `customers` WHERE  `username`='$_POST[username]' ";
      $result=mysqli_query($con,$query);
        if($result)
        {
             if(mysqli_num_rows($result)==1)
                  {
                      $result_fetch=mysqli_fetch_assoc($result);
                            if(password_verify($_POST['password'],$result_fetch['password']))
                              {
                                  $_SESSION['logged_in']=true;
                                  $_SESSION['username']=$result_fetch['username'];
                                  echo"<script>
                                  window.location.href='index.php';
                                  </script>";
                              }
                            else
                             {
                                  echo"
                                      <script>
                                         alert('Incorrect Password');
                                         window.location.href='CustomerLogin.php';
                                     </script>
                                    ";
                              }
                          }
           else
               {
                    echo"
                         <script>
                           alert('Username Not Registered');
                           window.location.href='CustomerLogin.php';
                        </script>
                       ";
                  }
          }
        else
         {
              echo"
               <script>
                   alert('Cannot Run Query_login');
                   window.location.href='CustomerLogin.php';
               </script>
                 ";
            }
}
else
{
  echo"
   <script>
       alert('Cannot Run Query_login1');
       window.location.href='CustomerLogin.php';
   </script>
     ";
}
