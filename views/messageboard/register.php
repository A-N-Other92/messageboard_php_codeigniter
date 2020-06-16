<div class="row">
   <div class="col-md-4">


      <?php echo validation_errors(); ?>

      <?php echo form_open('messageboard/register') ?>

          <div class="form-group">
             <BR>
             <label for="username">Username</label><BR>
             <input type="input" class="form-control" name="username" value="<?php echo set_value('username'); ?>" placeholder="Username"  />
          </div>

          <div class="form-group">
             <label for="email">Email address</label><BR>
             <input type="input" class="form-control" name="email" value="<?php echo set_value('email'); ?>" placeholder="email address"  />
          </div>

          <div class="form-group">
             <label for="email2">Confirm email address</label><BR>
             <input type="input" class="form-control" name="email2" value="<?php echo set_value('email2'); ?>" placeholder="confirm email address"  />
          </div>

          <div class="form-group">
             <label for="password">Password</label><BR>
             <input type="password" class="form-control" name="password" placeholder="Password" />
          </div>

          <div class="form-group">
             <label for="password2">Confirm password</label><BR>
             <input type="password" class="form-control" name="password2" placeholder="Confirm password" />
          </div>

          <input type="submit" name="submit" value="Register" class="btn btn-default" />

      </form>

   </div>

   <div class="col-md-8 ">
 
   </div>
 
</div>