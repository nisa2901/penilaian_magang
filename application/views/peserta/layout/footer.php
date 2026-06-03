</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function(){

    if (!$.fn.DataTable.isDataTable('#tabelLogbook')) {

        $('#tabelLogbook').DataTable({
            responsive: true,
            pageLength: 5,
            lengthMenu: [5,10,25,50],
            language:{
                search:"Cari:",
                lengthMenu:"Tampilkan _MENU_ data",
                info:"Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate:{
                    next:"Next",
                    previous:"Prev"
                }
            }

        });

    }

});
</script>

</body>
</html>