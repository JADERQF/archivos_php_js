<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; DS <?php echo date("Y"); ?></div>
            <div>
                <a href="https://www.facebook.com" target="_blank">Facebook</a>
                &middot;
                <a href="https://www.instagram.com" target="_blank">Instagram</a>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<script src="<?php echo base_url(); ?>/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?php echo base_url(); ?>/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>/js/Chart.min.js" crossorigin="anonymous"></script>
<script src="<?php echo base_url(); ?>/assets/demo/chart-area-demo.js"></script>
<script src="<?php echo base_url(); ?>/assets/demo/chart-bar-demo.js"></script>
<script src="<?php echo base_url(); ?>/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="<?php echo base_url(); ?>/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="<?php echo base_url(); ?>/assets/demo/datatables-demo.js"></script>

<script>
     
    $('#modal-confirmar').on('show.bs.modal', function(e){
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>
</body>

</html>