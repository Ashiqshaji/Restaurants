

<div class="col-12">
    <div class="row">
        <!-- Add the Select All checkbox -->
        <div class="col-12">
            <input type="checkbox" id="select_all" onclick="selectAllCards()" style="margin: 10px;">
            <label for="select_all">Select All</label>
        </div>
        <?php $__currentLoopData = $matchedReservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $results): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $colorClass = $results->reservationData_color == 'Yes' ? 'bg-data-color' : '';
                $isSelectable = $results->reservationData_color != 'Yes';
            ?>
            <div class="col-2">
                <div class="card mt-3 <?php echo e($colorClass); ?>" id="card<?php echo e($results->btnTexts); ?>"
                    style="cursor: <?php echo e($isSelectable ? 'pointer' : 'pointer'); ?>;">
                    <div class="card-body">
                        <?php if($isSelectable): ?>
                            <input class="form-check-input" type="checkbox" name="selected_items[]"
                                value="<?php echo e($results->btnTexts); ?>" id="item<?php echo e($results->btnTexts); ?>"
                                onclick="toggleCard('<?php echo e($results->btnTexts); ?>')" style="display:none">
                        <?php endif; ?>
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
    function selectAllCards() {
        const selectAllCheckbox = document.getElementById('select_all');
        const allCheckboxes = document.querySelectorAll('.form-check-input');
        const allCards = document.querySelectorAll('.card');

        allCheckboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked; // Set all checkboxes to the same state
            toggleCard(checkbox.value); // Update the card appearance
        });

        // Update the "Assign Table" button visibility
        const tableAssignBtn = document.getElementById('table_assign_btn');
        tableAssignBtn.style.display = selectAllCheckbox.checked ? 'block' : 'none';
    }

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
<?php /**PATH C:\xampp\htdocs\Restaurants\resources\views/Admin/Reservation/Partials/table_list.blade.php ENDPATH**/ ?>