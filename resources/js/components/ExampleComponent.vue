<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import 'datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css';
import 'datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js';
import 'datatables.net-bs5/css/dataTables.bootstrap5.css';
import 'datatables.net-bs5/js/dataTables.bootstrap5.js';
import 'datatables.net-buttons/js/dataTables.buttons.min.js';
import 'datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js';
import 'datatables.net-buttons/js/buttons.html5.min.js';
import 'datatables.net-buttons/js/buttons.print.min.js';
import 'datatables.net-buttons/js/buttons.colVis.min.js';
import 'jszip/dist/jszip.min.js';
import 'pdfmake/build/pdfmake.min.js';
import 'pdfmake/build/vfs_fonts.js';
import 'datatables.net-select-bs5/js/select.bootstrap5.min.js';

export default {
  mounted() {
    $(this.$el).find('table').DataTable({
      dom: 'Bfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });
  },
  destroyed() {
    $(this.$el).DataTable().destroy(true);
  }
}
</script>



