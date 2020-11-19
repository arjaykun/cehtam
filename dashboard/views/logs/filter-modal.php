<!-- filter modal -->
<div class="modal px-2" id="filter-modal">
  <div class="modal-background"></div>
  <div class="modal-content ">
   	<div class="card">
   		<div class="card-content">
   			<h1 class="title is-3">Filter Time Logs</h1>
   			<div class="is-size-5 has-text-weight-semibold mt-2 mb-2">Quick Filters</div>
				<div class="buttons">				
					<button class="button is-small is-primary" id="today">Today</button>			
					<button class="button is-small is-dark" id="this_week">This Week</button>	
					<button class="button is-small is-dark" id="this_month">This Month</button>	
					<button class="button is-small is-dark" id="this_year">This Year</button>	
					<button class="button is-small is-dark" id="last_7_days">Last 7 Days</button>	
					<button class="button is-small is-dark" id="last_15_days">Last 15 Days</button>	
					<button class="button is-small is-dark" id="last_30_days">Last 30 Days</button>	
					<button class="button is-small is-info" id="all">View All</button>	
				</div>
				<div class="is-size-5 has-text-weight-semibold mb-2">Custom Filter</div>
				<form id="filter-form">
				
			    <div class="field">
			      <label class="label">From</label>
			      <div class="control">
			        <input class="input datepicker" type="text" name="from" id="from">
			      </div>
			    </div>

			    <div class="field">
			      <label class="label">To</label>
			      <div class="control">
			        <input class="input datepicker" type="text" name="to" id="to">
			      </div>
			    </div>

			
					<button class="button is-info mr-1 is-fullwidth" type="submit">
			     SUBMIT
			    </button>
				</form>
			    
   		</div>
   	</div>			
  </div>
  <button class="modal-close is-large" aria-label="close"></button>
</div>