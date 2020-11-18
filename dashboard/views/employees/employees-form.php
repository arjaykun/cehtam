<form enctype="multipart/form-data" method="POST">  
    <?php if(!isset($edit)): ?>  
    <div class="is-flex is-justify-content-center">     
      <figure class="image" style="height: 156px; width: 156px">
        <img class="is-rounded" src="/assets/images/employees/default.png" id="image" style="height: 156px; width: 156px">
      </figure>
    </div>
    <div class="field mt-3">
      <div class="file is-info is-centered">
        <label class="file-label">
          <input class="file-input" type="file" name="emp_image" id="emp_image">
          <span class="file-cta">
            <span class="file-icon">
              <i class="fa fa-upload"></i>  
            </span>
            <span class="file-label">
              Upload Image
            </span>
          </span>
        </label>
      </div>
    </div>
    <?php else: ?>
      <input type="hidden" name="id" value="<?php echo ($employee->id ?? '') ?>">
      <input type="hidden" name="old_emp_id" value="<?php echo ($employee->emp_id ?? '') ?>">
    <?php endif; ?>

    <h4 class="is-size-4 has-text-info has-font-weight-bold">Personal Information</h4>

    <div class="field">
      <label class="label">Name</label>
      <div class="control">
        <input class="input <?php echo $v->error('name')? 'is-danger' : '' ?>" type="text" placeholder="e.g Michael Atanacio" name="name" value="<?php echo $employee->name ?? $name ?>">
      </div>
      <?php if($v->error('name')): ?>
        <p class="help is-danger"><?php echo $v->error('name') ?></p>
      <?php endif; ?>
    </div>

    <div class="field">
      <label class="label">Email</label>
      <div class="control">
        <input class="input <?php echo $v->error('email')? 'is-danger' : '' ?>" type="text" placeholder="e.g. your@email.com" name="email" value="<?php echo $employee->email ?? $email ?>">
      </div>
       <?php if($v->error('email')): ?>
        <p class="help is-danger"><?php echo $v->error('email') ?></p>
       <?php endif; ?>
    </div>


    <div class="field">
      <label class="label">Contact #</label>
      <div class="control">
        <input class="input <?php echo $v->error('contact_num')? 'is-danger' : '' ?>" type="text" placeholder="e.g. +639369216075 or 09369216075 or 2131316" name="contacts" value="<?php echo $employee->contact_num ?? $contacts ?>">
      </div>
      <?php if($v->error('contact_num')): ?>
        <p class="help is-danger"><?php echo $v->error('contact_num') ?></p>
       <?php endif; ?>
    </div>


    <h4 class="is-size-4 has-text-info has-font-weight-bold">Employment Information</h4>

    <div class="field">
      <label class="label">Employee I.D.</label>
      <div class="control">
        <input class="input  <?php echo $v->error('emp_id')? 'is-danger' : '' ?>" type="text" placeholder="e.g. 202000001" name="emp_id" value="<?php echo $employee->emp_id ?? $emp_id ?>">
      </div>
      <?php if($v->error('emp_id')): ?>
        <p class="help is-danger"><?php echo $v->error('emp_id') ?></p>
       <?php endif; ?>
    </div>

    <div class="field">
      <label class="label">Position</label>
      <div class="control">
        <input class="input  <?php echo $v->error('job_title')? 'is-danger' : '' ?>" type="text" placeholder="e.g. Senior Accountant, Messenger or Sex Worker" name="job_title" value="<?php echo $employee->job_title ?? $job_title ?>">
      </div>
      <?php if($v->error('job_title')): ?>
        <p class="help is-danger"><?php echo $v->error('job_title') ?></p>
       <?php endif; ?>
    </div>
    <div class="control mb-3">
      <label class="label">Department</label>
      <div class="select is-fullwidth <?php echo $v->error('department')? 'is-danger' : '' ?>">
        <select name="department">
          <option value="" <?php $department=="" ? 'selected':'' ?>>Select Department</option>
          <?php foreach($deptObject->get() as $dept): ?>
             <option 
              value="<?php echo $dept->dept_id ?>"
              <?php echo (($employee->dept_id ?? $department)==$dept->dept_id) ? 'selected':'' ?>
             >
              <?php echo ucwords($dept->dept_name) ?>
             </option>
          <?php endforeach;?>
        </select>
      </div>
      <?php if($v->error('department')): ?>
        <p class="help is-danger"><?php echo $v->error('department') ?></p>
       <?php endif; ?>
    </div>


    <div class="control mb-3">
      <label class="label">Employment Status</label>
      <div class="select is-fullwidth <?php echo $v->error('emp_status')? 'is-danger' : '' ?>">
        <select name="emp_status">
          <option value="" <?php $emp_status=="" ? 'selected':'' ?>>Select Status</option>
          <option 
            value="regular"
            <?php echo (($employee->emp_status ?? $emp_status)=='regular') ? 'selected':'' ?>
           >Regular</option>
          <option value="on probation" 
            <?php echo (($employee->emp_status ?? $emp_status)=='on probation') ? 'selected':'' ?>
           >On Probation</option>
          <option value="contractual" 
            <?php echo (($employee->emp_status ?? $emp_status)=='contractual') ? 'selected':'' ?>
           >Contractual</option>
           <?php if (isset($edit) && $edit==1): ?>
             <option value="resigned" 
              <?php echo (($employee->emp_status ?? $emp_status)=='resigned') ? 'selected':'' ?>
             >Resigned</option>
            <option value="terminated" 
              <?php echo (($employee->emp_status ?? $emp_status)=='terminated') ? 'selected':'' ?>
             >Terminated</option>
           <?php endif; ?>
        </select>
      </div>
      <?php if($v->error('emp_status')): ?>
        <p class="help is-danger"><?php echo $v->error('emp_status') ?></p>
       <?php endif; ?>
    </div>

    <input type="submit" value="<?php echo (isset($edit) && $edit==1 ? 'Update Employee' : 'Add Employee')?>" name="submit" class="button is-info is-fullwidth">

   </form>