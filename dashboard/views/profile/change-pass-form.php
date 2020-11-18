<div class="modal px-2" id="change-pass-modal">
  <div class="modal-background"></div>
  <div class="modal-content ">
   	<div class="card">
   		<div class="card-content">
   			
   			<h1 class="title is-4"><i class="has-text-info fa fa-eye mr-1"></i>Change Password</h1>
   			<h3 class="subtitle">
   				Provide current/ old password to change password.
   			</h3>

				<form id="change-pass-form">
					
					<div class="field">
					  <label class="field-label">Old Password</label>
					  <div class="field-body">
					    <div class="field is-expanded">
					      <div class="field has-addons has-addons-right">
					        <p class="control is-expanded">
					          <input class="input" type="password" name="old_pwd" required id="old_pwd">
					        </p>
					        <p class="control">
					        	<span class="button show"><span class="icon"><i class="fa fa-eye pwd-icon"></i></span></span>
					        </p>
					      </div>
					    </div>
					  </div>
					</div>

					<div class="field">
					  <label class="field-label">New Password</label>
					  <div class="field-body">
					    <div class="field is-expanded">
					      <div class="field has-addons has-addons-right">
					        <p class="control is-expanded">
					          <input class="input" type="password" name="new_pwd" required id="new_pwd">
					        </p>
					        <p class="control">
					        	<span class="button show"><span class="icon"><i class="fa fa-eye pwd-icon"></i></span></span>
					        </p>
					      </div>
					    </div>
					  </div>
					</div>


					<div class="field">
					  <label class="field-label">Confirm Password</label>
					  <div class="field-body">
					    <div class="field is-expanded">
					      <div class="field has-addons has-addons-right">
					        <p class="control is-expanded">
					          <input class="input" type="password" name="confirm_pwd" required id="confirm_pwd">
					        </p>
					        <p class="control">
					        	<span class="button show"><span class="icon"><i class="fa fa-eye pwd-icon"></i></span></span>
					        </p>
					      </div>
					    </div>
					  </div>
					</div>

					<input type="submit" name="submit" value="SUBMIT" class="button is-info is-fullwidth"> 

				</form>
			      
				</div>
   		</div>
   	</div>	
   	 <button class="modal-close is-large" aria-label="close"></button>		
  </div>
 
