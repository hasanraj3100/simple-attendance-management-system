<section class="add-course">
    <h2>Add a New <?=$page_name;?></h2>

  
      <form action="" method="post" class="manage-form>
        <div class="cols-4">
          <label for="course-name" class="manage-label"><?=$page_name;?> Name:</label>
          <input type="text" id="course-name" name="<?=strtolower($page_name);?>[name]" class="manage-input"  required>
        </div>
        <div class="row">

        <button type="submit" class="manage-button"> Add <?=$page_name;?> </button>

        </div>
      </form>


  </section>