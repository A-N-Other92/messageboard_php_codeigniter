<div class="row">
   <div class="col-md-4">


      <?php echo validation_errors(); ?>

      <?php echo form_open('messageboard/login') ?>

          <div class="form-group">
             <BR>
             <label for="username">Username</label><BR>
             <input type="input" class="form-control" name="username" value="<?php echo set_value('username'); ?>" placeholder="Username"  />
          </div>

          <div class="form-group">
             <label for="password">Password</label><BR>
             <input type="password" class="form-control" name="password" placeholder="Password" />
          </div>

          <input type="submit" name="submit" value="Login" class="btn btn-default" />

      </form>

   </div>

   <div class="col-md-8 ">
 
   </div>
 
</div>