 {{-- <div class="col-12">
     <div class="row">
         @foreach ($mergedResults as $results)
             @php
                 $colorClass = $results->reservationData_color == 'Yes' ? 'bg-data-color' : '';
             @endphp
             <div class="col-2">
                 <div class="card mt-3 {{ $colorClass }}" id="card{{ $results->btnTexts }}" style="cursor: pointer;">
                     <div class="card-body">
                         <input class="form-check-input" type="checkbox" name="selected_items[]"
                             value="{{ $results->btnTexts }}" id="item{{ $results->btnTexts }}"
                             onclick="toggleCard('{{ $results->btnTexts }}')" style="display:none">
                         <label for="item{{ $results->btnTexts }}">
                             <h4 class="card-title">{{ htmlspecialchars($results->btnText) }}</h4>
                         </label>
                     </div>
                 </div>
             </div>
         @endforeach
     </div>
 </div> --}}
 <div class="col-12">
     <div class="row">
         @foreach ($mergedResults as $results)
             @php
                 $colorClass = $results->reservationData_color == 'Yes' ? 'bg-data-color' : '';
                 $isSelectable = $results->reservationData_color != 'Yes';
             @endphp
             <div class="col-2">
                 <div class="card mt-3 {{ $colorClass }}" id="card{{ $results->btnTexts }}"
                     style="cursor: {{ $isSelectable ? 'pointer' : 'not-allowed' }};">
                     <div class="card-body">
                         @if ($isSelectable)
                             <input class="form-check-input" type="checkbox" name="selected_items[]"
                                 value="{{ $results->btnTexts }}" id="item{{ $results->btnTexts }}"
                                 onclick="toggleCard('{{ $results->btnTexts }}')" style="display:none">
                         @endif
                         <label for="item{{ $results->btnTexts }}">
                             <h4 class="card-title">{{ htmlspecialchars($results->btnText) }}</h4>
                         </label>
                     </div>
                 </div>
             </div>
         @endforeach
     </div>
 </div>

 {{--
<script>
    document.addEventListener('DOMContentLoaded', function() {
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
</script> --}}
 {{-- <div class="col-12">
    <div class="row">
        @foreach ($mergedResults as $results)
            @php
                $colorClass = $results->reservationData_color == 'Yes' ? 'bg-data-color' : '';
            @endphp
            <div class="col-2">
                <div class="card mt-3 {{ $colorClass }}" id="card{{ $results->btnTexts }}" style="cursor: pointer;">
                    <div class="card-body">
                        <input class="form-check-input" type="checkbox" name="selected_items[]"
                            value="{{ $results->btnTexts }}" id="item{{ $results->btnTexts }}"
                            onclick="toggleCard('{{ $results->btnTexts }}')" style="display:none">
                        <label for="item{{ $results->btnTexts }}">
                            <h4 class="card-title">{{ htmlspecialchars($results->btnText) }}</h4>
                        </label>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div> --}}

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
