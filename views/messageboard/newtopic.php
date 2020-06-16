<div class="row">
   <div class="col-md-8">


      <?php echo validation_errors(); ?>

      <?php echo form_open('messageboard/newtopic/') ?>

          <div class="form-group">
             <BR>
             <h3>Start a new thread</h3>
             <textarea class="form-control" name="topicbox" rows="1"  placeholder="Enter the name of the thread (max 60 chars)" maxlength="60"></textarea>
          </div>

          <input type="submit" name="submit" value="Submit message" class="btn btn-default" />

      </form>

   </div>

   <div class="col-md-4 ">
 
   </div>
 
</div>