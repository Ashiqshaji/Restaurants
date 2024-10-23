 
 

 <div class="col-12">
     <div class="row">
         <?php $__currentLoopData = $matchedReservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $results): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php
                 $colorClass = $results->reservationData_color == 'Yes' ? 'bg-data-color' : '';
                 $isSelectable = $results->reservationData_color != 'Yes';
             ?>
             <div class="col-2">
                 <div class="card mt-3 <?php echo e($colorClass); ?>" id="card<?php echo e($results->btnTexts); ?>" style="">
                     <div class="card-body">

                         <input class="form-check-input" type="checkbox" name="selected_items[]"
                             value="<?php echo e($results->btnTexts); ?>" id="item<?php echo e($results->btnTexts); ?>"
                             onclick="toggleCard('<?php echo e($results->btnTexts); ?>')" style="display:none">

                         <label for="item<?php echo e($results->btnTexts); ?>">
                             <h4 class="card-title"><?php echo e(htmlspecialchars($results->btnText)); ?></h4>
                         </label>
                     </div>
                 </div>
             </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </div>
 </div>


 
 

 <script>
     function toggleCard(id) {
         const checkbox = document.getElementById('item' + id);
         const card = document.getElementById('card' + id);

         if (checkbox.checked) {
             card.style.border = "2px solid #cb982b";
             card.style.backgroundColor = "#cb982b";
         } else {
             card.style.border = "";
             card.style.backgroundColor = "";
         }

         const anyChecked = document.querySelectorAll('.form-check-input:checked').length > 0;
         const tableAssignBtn = document.getElementById('table_assign_btn');

         tableAssignBtn.style.display = anyChecked ? 'block' : 'none';
     }

     document.addEventListener('DOMContentLoaded', function() {
         document.querySelectorAll('.card').forEach(card => {
             card.addEventListener('click', function(event) {
                 const checkbox = card.querySelector('.form-check-input');

                 if (event.target.type !== 'checkbox') {
                     checkbox.checked = !checkbox.checked;
                     toggleCard(checkbox.value);
                 }
             });
         });

         document.getElementById('confirmButton').addEventListener('click', function() {
             const myModalEl = document.getElementById('confirmModal');
             const modal = bootstrap.Modal.getInstance(myModalEl);
             modal.hide();
             document.querySelector('form').submit();
         });
     });
 </script>
<?php /**PATH C:\xampp\htdocs\Restaurants\resources\views\Admin\Reservation\Partials\table_list.blade.php ENDPATH**/ ?>