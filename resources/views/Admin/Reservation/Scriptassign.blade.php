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

            // Check if any checkbox is selected
            const anyChecked = document.querySelectorAll('.form-check-input:checked').length > 0;
            const tableAssignBtn = document.getElementById('table_assign_btn');

            if (anyChecked) {
                tableAssignBtn.style.display = 'block';
            } else {
                tableAssignBtn.style.display = 'none';
            }
        }

        // Allow clicking on the card to toggle the checkbox
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('click', function(event) {
                const checkbox = card.querySelector('.form-check-input');

                // Toggle the checkbox only if the click is not on the checkbox itself
                if (event.target.type !== 'checkbox') {
                    checkbox.checked = !checkbox.checked;
                    toggleCard(checkbox.value);
                }
            });
        });

        document.getElementById('confirmButton').addEventListener('click', function() {
            // Close the modal
            var myModalEl = document.getElementById('confirmModal');
            var modal = bootstrap.Modal.getInstance(myModalEl);
            modal.hide();

            // Submit the form
            document.querySelector('form').submit();
        });


    });
    document.addEventListener('DOMContentLoaded', function() {
        var sectionSelect = document.getElementById('section-select');
        var tableIdElement = document.getElementById('table_id'); // Renamed variable to avoid conflict

        sectionSelect.addEventListener('change', function() {
            var selectedSection = sectionSelect.value;
            var tableIdValue = tableIdElement.value; // Retrieve the value from the element


            $.ajax({
                url: "{{ route('admin.selectionsection') }}", // Replace with your route name
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    section_id: selectedSection,
                    tableid: tableIdValue
                },
                success: function(response) {
                    // Handle the response (e.g., update the UI with the returned data)
                    console.log(response);
                    // Example: You might update a component or another part of the page
                    $('#table_list_id').html(response);
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                }
            });
        });
    });
</script>
