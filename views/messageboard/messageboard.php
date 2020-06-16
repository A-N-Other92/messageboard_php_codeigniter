<?php if (isset($topics)) { echo '<h3>Topics</h3>'; } ?>

<?php if (isset($messages)) { echo '<h3>' . $messages[0]['topicname'] . '</h3>'; } ?>

<div class="row">
  <div class="col-md-8">


<table class="table table-bordered">



  <?php if (isset($topics)) 
{  foreach ($topics as $each_topic):  

        
     echo '<tr class="underline" ><td class="col-md-6"><a href ="'; ?><?php echo base_url('index.php/messageboard/show_messages/' . $each_topic['topicid'] ) ?><?php echo ' ">' .  $each_topic['topicname'] . '</a></td><td class="col-md-2">' . $each_topic['message_count'] . ' messages</td></tr>';
       
                         
  
 endforeach; } ?>  


  <?php if (isset($messages)) 
{  foreach ($messages as $each_message):  

        
     echo '<tr><td class="col-md-1">' . $each_message['date_posted'] . '</td><td class="col-md-2">' . $each_message['username'] . '</td><td class="col-md-5">' .  $each_message['message'] . '</td></tr>';
       
                         
  
 endforeach; } ?>  


</table>

<BR>

<p><div class = "pag" ><?php echo $links; ?></div></p>


 <?php       
  if(isset($_SESSION['loggedin']) && isset($topics)) {
   /*    echo '<div class="underline"><a href="newtopic.php"><h3>Start a new topic</h3></a></div>';  */
  
       echo '<div class="underline"><a href="' . base_url('index.php/messageboard/newtopic/') . '"><h3>Start a new topic</h3></a></div>';
  }

  if(!isset($_SESSION['loggedin']) && isset($topics)) {
       echo '<h3>You must be logged in to start a new topic</h3>';
  }

  if(isset($_SESSION['loggedin']) && isset($messages)) {
       echo '<div class="underline"><a href="' . base_url('index.php/messageboard/newmessages/' . $messages[0]['topicid'] ) . '"><h3>Submit a message</h3></a></div>';
  }
 


  if(!isset($_SESSION['loggedin']) && isset($messages)) {
       echo '<h3>You must be logged in to post a message</h3>';
  }

  if(isset($messages)) {
       echo '<BR>';
       echo '<div class="underline"><a href="' . base_url('index.php/messageboard') . '"><h4>Return to list of threads</h4></a></div>';
  }




?> 



   </div>

    <div class="col-md-4">

    <!--  Room for additional content on the right of messages and threads     -->


  </div>
</div>
        





