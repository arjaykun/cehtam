<div class="modal px-2" id="confirm-modal">
  <div class="modal-background"></div>
  <div class="modal-content ">
   	<div class="card">
   		<div class="card-content">
   			
   			<h1 class="title is-3"><i class="has-text-info fa fa-question-circle mr-1"></i>Password Confirmation </h1>
   			<h3 class="subtitle">
   				Please confirm your password to proceed.
   			</h3>

				<form id="confirm-form">
					<input type="hidden" id="confirm-id" name="id">
					
					<div class="field" id="password-div">
					  <div class="control has-icons-left">
					    <input class="input" type="password" name="password" id="confirm-password-input">
					    <span class="icon is-small is-left">
					      <i class="fa fa-lock"></i>
					    </span>
					  </div>
					</div>

					<div class="buttons">
						
						<button class="button is-danger" type="submit">
				      Confirm
				    </button>
				      <button class="button" id="cancel">
			      Cancel
			    </button>
					</div>

				</form>
			      
				</div>
   		</div>
   	</div>			
  </div>
  <button class="modal-close is-large" aria-label="close"></button>
</div>