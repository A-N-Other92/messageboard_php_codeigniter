<div class="row">
   <div class="col-md-8">


      <?php echo validation_errors(); ?>

      <?php echo form_open('messageboard/newmessages/' . $topicid ) ?>

          <div class="form-group">
             <BR>
             <label for="messagebox"><?php echo $topicname[0]['topicname']  ?></label><BR>
             <textarea class="form-control" rows="8" name="messagebox"  placeholder="Enter your message here (max 700 chars)" maxlength="700"></textarea>
          </div>



          <input type="submit" name="submit" value="Submit message" class="btn btn-default" />

      </form>

   </div>

   <div class="col-md-4 ">
 
   </div>
 
</div>