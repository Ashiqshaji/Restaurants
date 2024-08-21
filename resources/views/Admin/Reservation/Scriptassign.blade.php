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

        function toggleCardUpdate(id) {
            const checkbox = document.getElementById('itemupdate' + id);
            const card = document.getElementById('cardupdate' + id);

            checkbox.checked = !checkbox.checked;

            if (checkbox.checked) {
                card.style.border = "2px solid Red";
                card.style.backgroundColor = "Red";
            } else {
                card.style.border = "";
                card.style.backgroundColor = "";
            }

            const anyChecked = document.querySelectorAll('.form-check-input:checked').length > 0;
            const tableAssignBtn = document.getElementById('table_assign_btn_update');

            tableAssignBtn.style.display = anyChecked ? 'block' : 'none';
        }

        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('click', function(event) {
                const checkbox = card.querySelector('.form-check-input');

                if (checkbox.id.startsWith('itemupdate')) {
                    toggleCardUpdate(checkbox.value);
                } else {
                    toggleCard(checkbox.value);
                }
            });
        });

        document.getElementById('confirmButton')?.addEventListener('click', function() {
            var myModalEl = document.getElementById('confirmModal');
            var modal = bootstrap.Modal.getInstance(myModalEl);
            modal.hide();

            var form = document.getElementById('table_confirm');
            if (form) {
                form.submit();
            }
          
        });

        document.getElementById('RemoveButton')?.addEventListener('click', function() {
            var myModalEl = document.getElementById('RemoveModal');
            var modal = bootstrap.Modal.getInstance(myModalEl);
            modal.hide();

            var form = document.getElementById('table_update_remove');
            if (form) {
                form.submit();
            }

        });

        var sectionSelect = document.getElementById('section-select');
        var tableIdElement = document.getElementById('table_id');

        sectionSelect.addEventListener('change', function() {
            var selectedSection = sectionSelect.value;
            var tableIdValue = tableIdElement.value;

            $.ajax({
                url: "{{ route('admin.selectionsection') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    section_id: selectedSection,
                    tableid: tableIdValue
                },
                success: function(response) {
                    $('#table_list_id').html(response);
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                }
            });
        });
    });
</script>
